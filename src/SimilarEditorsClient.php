<?php

namespace MediaWiki\Extension\SimilarEditors;

use MediaWiki\Http\HttpRequestFactory;

class SimilarEditorsClient implements Client {

	/**
	 * @var HttpRequestFactory
	 */
	private $httpRequestFactory;

	/**
	 * @var string
	 */
	private $apiUrl;

	/**
	 * @var string
	 */
	private $apiUser;

	/**
	 * @var string
	 */
	private $apiPassword;

	/**
	 * @param HttpRequestFactory $httpRequestFactory
	 * @param string $apiUrl
	 * @param string $apiUser
	 * @param string $apiPassword
	 */
	public function __construct(
		HttpRequestFactory $httpRequestFactory,
		string $apiUrl,
		string $apiUser,
		string $apiPassword
	) {
		$this->httpRequestFactory = $httpRequestFactory;
		$this->apiUrl = $apiUrl;
		$this->apiUser = $apiUser;
		$this->apiPassword = $apiPassword;
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
		$response = $this->httpRequestFactory->get( $this->apiUrl . '?usertext=' . urlencode( $editor ), [
			'username' => $this->apiUser,
			'password' => $this->apiPassword
		], __METHOD__ );
		if ( $response ) {
			$json = json_decode( $response, true );
			if ( $json && !empty( $json['results'] ) ) {
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
			return null;
		}
		return null;
	}
}
