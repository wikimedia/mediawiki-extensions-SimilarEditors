<?php

use MediaWiki\Extension\SimilarEditors\MockSimilarEditorsClient;
use MediaWiki\Extension\SimilarEditors\SimilarEditorsClient;
use MediaWiki\MediaWikiServices;

return [
	'SimilarEditorsClient' => static function ( MediaWikiServices $services ) {
		$config = $services->getMainConfig();
		$apiUrl = $config->get( 'SimilarEditorsApiUrl' );
		$apiUser = $config->get( 'SimilarEditorsApiUser' );
		$apiPassword = $config->get( 'SimilarEditorsApiPassword' );
		if (
			$apiUrl &&
			$apiUser &&
			$apiPassword
		) {
			return new SimilarEditorsClient(
				$services->getHttpRequestFactory(),
				$apiUrl,
				$apiUser,
				$apiPassword
			);
		}
		return new MockSimilarEditorsClient();
	},
];
