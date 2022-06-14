<?php

namespace MediaWiki\Extension\SimilarEditors;

use Html;
use HTMLForm;
use SpecialPage;
use Status;

class SpecialSimilarEditors extends SpecialPage {

	/** @var Client */
	private $similarEditorsClient;

	/** @var ResultsFormatterFactory */
	private $resultsFormatterFactory;

	/**
	 * @param Client $similarEditorsClient
	 * @param ResultsFormatterFactory $resultsFormatterFactory
	 */
	public function __construct(
		Client $similarEditorsClient,
		ResultsFormatterFactory $resultsFormatterFactory
	) {
		parent::__construct( 'SimilarEditors', 'similareditors', true );
		$this->similarEditorsClient = $similarEditorsClient;
		$this->resultsFormatterFactory = $resultsFormatterFactory;
	}

	/**
	 * @inheritDoc
	 */
	public function execute( $par ) {
		$this->setHeaders();
		$this->checkPermissions();
		$this->outputHeader();
		$this->addHelpLink( 'Help:Extension:SimilarEditors' );

		$out = $this->getOutput();
		$out->addModuleStyles( 'mediawiki.pager.styles' );
		$out->addModuleStyles( 'ext.similarEditors.styles' );

		// Ensure the correct survey is added, in case multiple are enabled
		$out->addHTML( Html::element( 'div', [ 'id' => 'similareditors-survey-embed' ] ) );

		$fields = [
			'Target' => [
				'type' => 'user',
				'label-message' => 'similareditors-form-field-target-label',
				'placeholder-message' => 'similareditors-form-field-target-placeholder',
				// TODO: revert as part of T309675
				'exists' => false,
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

		$target = $this->getRequest()->getVal( 'wpTarget' );
		$neighbors = $this->similarEditorsClient->getSimilarEditors( $target );

		if ( $neighbors !== null ) {
			$resultsFormatter = $this->resultsFormatterFactory->createFormatter(
				$this->getLanguage()
			);
			$out->addHtml( $resultsFormatter->formatResults( $neighbors ) );
		} else {
			$out->addHtml( $this->msg( 'similareditors-no-results' ) );
		}
	}
}
