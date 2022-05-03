<?php

namespace MediaWiki\Extension\SimilarEditors;

class MockSimilarEditorsClient implements Client {

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
		return [];
	}
}
