<?php

namespace MediaWiki\Extension\SimilarEditors;

use HTMLForm;
use SpecialPage;

class SpecialSimilarEditors extends SpecialPage {

	/** @var Client */
	private $similarEditorsClient;

	/**
	 * @param Client $similarEditorsClient
	 */
	public function __construct(
		Client $similarEditorsClient
	) {
		parent::__construct( 'SimilarEditors', 'similareditors', true );
		$this->similarEditorsClient = $similarEditorsClient;
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
			->setSubmitCallback( [ $this, 'onSubmit' ] );

		if ( $this->getRequest()->getVal( 'wpTarget' ) === null ) {
			$form->prepareForm()
				->displayForm( false );
		} else {
			$form->show();
		}
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
