<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Unit;

use MediaWiki\Extension\SimilarEditors\SimilarEditorsClient;
use MediaWiki\Http\HttpRequestFactory;
use MediaWikiUnitTestCase;

/**
 * @group SimilarEditors
 * @covers \MediaWiki\Extension\SimilarEditors\SimilarEditorsClient
 */
class SimilarEditorsClientTest extends MediaWikiUnitTestCase {

	public function testCreateClient() {
		$httpRequestFactory = $this->getMockBuilder( HttpRequestFactory::class )
			->disableOriginalConstructor()
			->onlyMethods( [ 'get' ] )
			->getMock();

		$client = new SimilarEditorsClient(
			$httpRequestFactory,
			'foo',
			'bar',
			'baz'
		);
		$this->assertNotNull( $client );
	}
}
