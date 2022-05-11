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
		return [
			new Neighbor(
				'SomeUser1',
				100,
				10,
				0.2,
				0.4,
				new TimeOverlap( 0.6, 'medium' ),
				new TimeOverlap( 0.8, 'high' ),
				null
			),
			new Neighbor(
				'SomeUser2',
				500,
				5,
				0.7,
				0.5,
				new TimeOverlap( 0.3, 'low' ),
				new TimeOverlap( 0.1, 'low' ),
				null
			),
		];
	}
}
