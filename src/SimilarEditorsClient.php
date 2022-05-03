<?php

namespace MediaWiki\Extension\SimilarEditors;

class SimilarEditorsClient implements Client {

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
