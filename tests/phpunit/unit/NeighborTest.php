<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Unit;

use MediaWiki\Extension\SimilarEditors\Neighbor;
use MediaWikiUnitTestCase;

/**
 * @group SimilarEditors
 * @covers \MediaWiki\Extension\SimilarEditors\Neighbor
 */
class NeighborTest extends MediaWikiUnitTestCase {
	public function testDefaultValues() {
		$neighbor = new Neighbor();

		$this->assertNull( $neighbor->getNumEditsInData() );
		$this->assertNull( $neighbor->getnumPages() );
		$this->assertNull( $neighbor->getEditOverlap() );
		$this->assertNull( $neighbor->getEditOverlapInv() );
		$this->assertNull( $neighbor->getDayOverlap() );
		$this->assertNull( $neighbor->getHourOverlap() );
		$this->assertNull( $neighbor->getFollowUp() );
	}
}
