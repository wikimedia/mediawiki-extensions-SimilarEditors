<?php

namespace MediaWiki\Extension\SimilarEditors;

use SpecialPage;

class SpecialSimilarEditors extends SpecialPage {
	public function __construct() {
		parent::__construct( 'SimilarEditors', 'checkuser' );
	}

	/**
	 * @inheritDoc
	 */
	public function execute( $par ) {
		$this->setHeaders();
		$this->checkPermissions();
	}
}
