<?php

namespace MediaWiki\Extension\SimilarEditors;

use HTMLForm;
use SpecialPage;

class SpecialSimilarEditors extends SpecialPage {
	public function __construct() {
		parent::__construct( 'SimilarEditors', 'checkuser', true );
	}

	/**
	 * @inheritDoc
	 */
	public function execute( $par ) {
		$this->setHeaders();
		$this->checkPermissions();
		$this->outputHeader();

		$fields = [
			'Target' => [
				'type' => 'user',
				'label-message' => 'similareditors-form-field-target-label',
				'placeholder-message' => 'similareditors-form-field-target-placeholder',
				'exists' => true,
				'ipallowed' => true,
				'required' => true,
			],
		];

		$form = HTMLForm::factory( 'ooui', $fields, $this->getContext() );
		$form
			->setMethod( 'get' )
			->setWrapperLegendMsg( 'similareditors-form-legend' )
			->setSubmitTextMsg( 'similareditors-form-submit' )
			->setSubmitCallback( [ $this, 'onSubmit' ] )
			->prepareForm()
			->show();
	}

	/**
	 * Placeholder for the submit callback as required by HTMLForm
	 *
	 * @param array $formData
	 * @return bool
	 */
	public function onSubmit( $formData ) {
		return false;
	}
}
