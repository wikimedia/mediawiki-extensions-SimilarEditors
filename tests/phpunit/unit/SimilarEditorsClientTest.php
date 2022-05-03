<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Unit;

use MediaWiki\Extension\SimilarEditors\SimilarEditorsClient;
use MediaWikiUnitTestCase;

/**
 * @group SimilarEditors
 * @covers \MediaWiki\Extension\SimilarEditors\SimilarEditorsClient
 */
class SimilarEditorsClientTest extends MediaWikiUnitTestCase {

	public function testCreateClient() {
		$client = new SimilarEditorsClient();
		$this->assertNotNull( $client );
	}
}
