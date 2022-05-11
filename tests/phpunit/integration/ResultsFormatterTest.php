<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Integration;

use Language;
use MediaWiki\Extension\SimilarEditors\Neighbor;
use MediaWiki\Extension\SimilarEditors\ResultsFormatter;
use MediaWiki\User\UserFactory;
use MediaWikiIntegrationTestCase;
use User;

/**
 * @group SimilarEditors
 * @covers \MediaWiki\Extension\SimilarEditors\ResultsFormatter
 */
class ResultsFormatterTest extends MediaWikiIntegrationTestCase {

	public function testFormatResults() {
		$user = $this->createMock( User::class );
		$user->method( 'getId' )
			->willReturn( 0 );
		$user->method( 'getName' )
			->willReturn( '1.2.3.4' );

		$userFactory = $this->createMock( UserFactory::class );
		$userFactory->method( 'newFromName' )
			->willReturn( $user );

		$language = $this->createMock( Language::class );

		$resultsFormatter = new ResultsFormatter(
			$userFactory,
			$language
		);
		$results = $resultsFormatter->formatResults( [
			$this->createMock( Neighbor::class ),
			$this->createMock( Neighbor::class ),
		] );

		$this->assertStringContainsString(
			'<table class="mw-datatable sortable">',
			$results,
			'no table element, or incorrect classes'
		);
		$this->assertStringContainsString(
			'<thead><tr><th>',
			$results,
			'thead element should contain row and cells'
		);
		$this->assertStringContainsString(
			'<tbody><tr><td>',
			$results,
			'tbody element should contain row and cells'
		);
		$this->assertStringContainsString(
			'</tr><tr><td>',
			$results,
			'table should contain second row and cells'
		);
	}
}
