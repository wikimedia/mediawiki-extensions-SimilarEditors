<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Unit;

use MediaWiki\Extension\SimilarEditors\ResultsFormatter;
use MediaWiki\Extension\SimilarEditors\ResultsFormatterFactory;
use MediaWiki\Language\Language;
use MediaWiki\User\UserFactory;
use MediaWikiUnitTestCase;

/**
 * @group SimilarEditors
 * @covers \MediaWiki\Extension\SimilarEditors\ResultsFormatterFactory
 */
class ResultsFormatterFactoryTest extends MediaWikiUnitTestCase {

	public function testCreateFormatter() {
		$userFactory = $this->createMock( UserFactory::class );
		$language = $this->createMock( Language::class );

		$resultsFormatterFactory = new ResultsFormatterFactory( $userFactory );
		$formatter = $resultsFormatterFactory->createFormatter( $language );

		$this->assertInstanceof( ResultsFormatter::class, $formatter );
	}
}
