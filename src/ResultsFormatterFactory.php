<?php

namespace MediaWiki\Extension\SimilarEditors;

use MediaWiki\Language\Language;
use MediaWiki\User\UserFactory;

class ResultsFormatterFactory {
	public function __construct( private readonly UserFactory $userFactory ) {
	}

	/**
	 * @param Language $language
	 * @return ResultsFormatter
	 */
	public function createFormatter(
		Language $language
	): ResultsFormatter {
		return new ResultsFormatter( $this->userFactory, $language );
	}
}
