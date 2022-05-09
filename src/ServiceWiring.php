<?php

use MediaWiki\Extension\SimilarEditors\MockSimilarEditorsClient;
use MediaWiki\Extension\SimilarEditors\SimilarEditorsClient;
use MediaWiki\MediaWikiServices;

return [
	'SimilarEditorsClient' => static function ( MediaWikiServices $services ) {
		$config = $services->getMainConfig();
		if ( $config->get( 'SimilarEditorsApiUrl' ) ) {
			return new SimilarEditorsClient();
		}
		return new MockSimilarEditorsClient();
	},
];
