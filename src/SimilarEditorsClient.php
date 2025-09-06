<?php

namespace MediaWiki\Extension\SimilarEditors;

use MediaWiki\Http\HttpRequestFactory;
use MediaWiki\Status\Status;
use Psr\Log\LoggerInterface;

class SimilarEditorsClient implements Client {

	public function __construct(
		private readonly HttpRequestFactory $httpRequestFactory,
		private readonly LoggerInterface $logger,
		private readonly string $apiUrl,
		private readonly string $apiUser,
		private readonly string $apiPassword,
	) {
	}

	/**
	 * @inheritDoc
	 */
	public function getEditor( string $editor ) {
		return null;
	}

	/**
	 * @inheritDoc
	 */
	public function getSimilarEditors( string $editor ) {
		$request = $this->httpRequestFactory->create(
			$this->apiUrl . '?usertext=' . urlencode( $editor ),
			[
				'method' => 'GET',
				'username' => $this->apiUser,
				'password' => $this->apiPassword
			],
			__METHOD__
		);

		$status = $request->execute();
		$requestContent = $request->getContent();
		$json = $requestContent !== null ? json_decode( $requestContent, true ) : null;

		if ( $status->isOK() ) {
			if ( $json && isset( $json['results'] ) ) {
				return array_map( static function ( $result ) {
					return new Neighbor(
						$result['user_text'],
						$result['num_edits_in_data'],
						$result['edit-overlap'],
						$result['edit-overlap-inv'],
						new TimeOverlap(
							$result['day-overlap']['cos-sim'],
							$result['day-overlap']['level']
						),
						new TimeOverlap(
							$result['hour-overlap']['cos-sim'],
							$result['hour-overlap']['level']
						),
						$result['follow-up'] ?? [] );
				}, $json['results'] );
			}
		}

		// Bad status, or good status but response body contains either an error or bad data
		$this->logErrors( $status, $requestContent );
		if ( $json && isset( $json['error-type'] ) ) {
			return $json['error-type'];
		}
		return '';
	}

	/**
	 * @param Status $status
	 * @param string|null $content
	 * @return void
	 */
	private function logErrors( $status, $content ) {
		$this->logger->warning(
			Status::wrap( $status )->getWikiText( false, false, 'en' ),
			[
				'error' => $status->getErrorsByType( 'error' ),
				'caller' => __METHOD__,
				'content' => $content
			]
		);
	}
}
