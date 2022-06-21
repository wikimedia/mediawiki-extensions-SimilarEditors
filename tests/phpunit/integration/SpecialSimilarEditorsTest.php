<?php

namespace MediaWiki\Extension\SimilarEditors\Test\Integration;

use FauxRequest;
use MediaWiki\Extension\SimilarEditors\Client;
use MediaWiki\Extension\SimilarEditors\MockSimilarEditorsClient;
use MediaWiki\Extension\SimilarEditors\ResultsFormatterFactory;
use MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors;
use SpecialPageExecutor;
use SpecialPageTestBase;

/**
 * @coversDefaultClass MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors
 */
class SpecialSimilarEditorsTest extends SpecialPageTestBase {
	/**
	 * @inheritDoc
	 */
	protected function newSpecialPage() {
		$this->setGroupPermissions( 'sysop', 'similareditors', true );
		$client = $this->createMock( Client::class );
		$resultsFormatterFactory = $this->createMock( ResultsFormatterFactory::class );
		return new SpecialSimilarEditors( $client, $resultsFormatterFactory );
	}

	/**
	 * @covers MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors::__construct
	 */
	public function testConstruct() {
		$this->assertInstanceOf( SpecialSimilarEditors::class, $this->newSpecialPage(), 'No errors' );
	}

	/**
	 * @covers MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors::onSubmit
	 */
	public function testOnSubmit() {
		$this->assertTrue( $this->newSpecialPage()->onSubmit( [] ) );
	}

	/**
	 * @covers MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors::execute
	 */
	public function testExecuteWithNoTarget() {
		$user = $this->getTestSysop();
		list( $html ) = $this->executeSpecialPage( '', null, 'qqx', $user->getUser() );
		$this->assertRegExp( '/name=\'wpTarget\' value=\'/', $html );
	}

	/**
	 * @covers MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors::execute
	 */
	public function testExecuteWithTargetNoResults() {
		$user = $this->getTestSysop();
		$request = new FauxRequest( [
			'wpTarget' => 'someuser0',
		], true );
		list( $html ) = $this->executeSpecialPage( '', $request, 'qqx', $user->getUser() );
		$this->assertStringContainsString( 'similareditors-no-results', $html );
	}

	/**
	 * @covers MediaWiki\Extension\SimilarEditors\SpecialSimilarEditors::execute
	 */
	public function testExecuteWithResults() {
		$client = new MockSimilarEditorsClient();
		$userFactory = $this->getServiceContainer()->getUserFactory();
		$resultsFormatterFactory = new ResultsFormatterFactory( $userFactory );
		$specialPage = new SpecialSimilarEditors( $client, $resultsFormatterFactory );
		$this->setGroupPermissions( 'sysop', 'similareditors', true );
		$user = $this->getTestSysop();
		$request = new FauxRequest( [
			'wpTarget' => 'someuser0',
		], true );
		list( $html ) = ( new SpecialPageExecutor() )->executeSpecialPage(
			$specialPage,
			'',
			$request,
			'qqx',
			$user->getUser()
		);

		// assert results table is created
		$this->assertRegExp( '/table class="mw-datatable/', $html );
		// asserts output contains results
		$this->assertStringContainsString( 'SomeUser1', $html );
	}
}
