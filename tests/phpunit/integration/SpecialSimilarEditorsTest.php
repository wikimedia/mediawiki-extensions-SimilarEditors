<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Integration;

use MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors;
use SpecialPageTestBase;

/**
 * @coversDefaultClass MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors
 */
class SpecialSimilarEditorsTest extends SpecialPageTestBase {
	/**
	 * @inheritDoc
	 */
	protected function newSpecialPage() {
		return new SpecialSimilarEditors();
	}
}
