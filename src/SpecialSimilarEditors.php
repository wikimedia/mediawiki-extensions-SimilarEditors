<?php

namespace MediaWiki\Extension\SimilarEditors;

use Html;
use HTMLForm;
use SpecialPage;
use Status;

class SpecialSimilarEditors extends SpecialPage {
	public function __construct() {
		parent::__construct( 'SimilarEditors', 'similareditors', true );
	}

	/**
	 * @inheritDoc
	 */
	public function execute( $par ) {
		$this->setHeaders();
		$this->checkPermissions();
		$this->outputHeader();

		$out = $this->getOutput();
		$out->addModuleStyles( 'ext.similarEditors.styles' );

		// Ensure the correct survey is added, in case multiple are enabled
		$out->addHTML( Html::element( 'div', [ 'id' => 'similareditors-survey-embed' ] ) );

		$fields = [
			'Target' => [
				'type' => 'user',
				'label-message' => 'similareditors-form-field-target-label',
				'placeholder-message' => 'similareditors-form-field-target-placeholder',
				'exists' => true,
				'ipallowed' => true,
				'required' => true,
			],
			'Survey' => [
				'type' => 'hidden',
				'name' => 'quicksurvey',
				'default' => 'similareditors',
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
			$status = $form->showAlways();
			if ( $status === true || $status instanceof Status && $status->isGood() ) {
				$this->onSuccess();
			}
		}
	}

	/**
	 * Placeholder for the submit callback as required by HTMLForm
	 *
	 * @param array $formData
	 * @return bool
	 */
	public function onSubmit( $formData ) {
		return true;
	}

	/**
	 * Show results and feedback survey
	 */
	public function onSuccess() {
		$out = $this->getOutput();
		$out->addModules( 'ext.quicksurveys.init' );
	}
}
