<?php

namespace MediaWiki\Extension\SimilarEditors;

class Neighbor {

	/**
	 * User name of the neighbor
	 * @var string|null
	 */
	private $userText;

	/**
	 * Number of edits made by the neighbor in the data
	 *
	 * @var int|null
	 */
	private $numEditsInData;

	/**
	 * Number of pages edited by the neighbor in the data
	 *
	 * @var int|null
	 */
	private $numPages;

	/**
	 * Number of overlapping edited pages divided by number of pages edited by queried editor (between 0 and 1)
	 *
	 * @var float|null
	 */
	private $editOverlap;

	/**
	 * Number of overlapping edited pages divided by number of pages edited by the neighbor (between 0 and 1)
	 *
	 * @var float|null
	 */
	private $editOverlapInv;

	/**
	 * Level of temporal overlap (editing the same days of the week) with queried editor
	 *
	 * @var TimeOverlap|null
	 */
	private $dayOverlap;

	/**
	 * Level of temporal overlap (editing the same hours of the day) with queried editor
	 * @var TimeOverlap|null
	 */
	private $hourOverlap;

	/**
	 * Additional tool links in API response for follow-up on data
	 * @var string[]|null
	 */
	private $followUp;

	/**
	 * @param string|null $userText
	 * @param int|null $numEditsInData
	 * @param int|null $numPages
	 * @param float|null $editOverlap
	 * @param float|null $editOverlapInv
	 * @param TimeOverlap|null $dayOverlap
	 * @param TimeOverlap|null $hourOverlap
	 * @param string[]|null $followUp
	 */
	public function __construct(
		$userText = null,
		$numEditsInData = null,
		$numPages = null,
		$editOverlap = null,
		$editOverlapInv = null,
		$dayOverlap = null,
		$hourOverlap = null,
		$followUp = null
	) {
		$this->userText = $userText;
		$this->numEditsInData = $numEditsInData;
		$this->numPages = $numPages;
		$this->editOverlap = $editOverlap;
		$this->editOverlapInv = $editOverlapInv;
		$this->dayOverlap = $dayOverlap;
		$this->hourOverlap = $hourOverlap;
		$this->followUp = $followUp;
	}

	/**
	 * @return string|null
	 */
	public function getUserText(): ?string {
		return $this->userText;
	}

	/**
	 * @return int|null
	 */
	public function getNumEditsInData(): ?int {
		return $this->numEditsInData;
	}

	/**
	 * @return int|null
	 */
	public function getnumPages(): ?int {
		return $this->numPages;
	}

	/**
	 * @return float|null
	 */
	public function getEditOverlap(): ?float {
		return $this->editOverlap;
	}

	/**
	 * @return float|null
	 */
	public function getEditOverlapInv(): ?float {
		return $this->editOverlapInv;
	}

	/**
	 * @return TimeOverlap|null
	 */
	public function getDayOverlap(): ?TimeOverlap {
		return $this->dayOverlap;
	}

	/**
	 * @return TimeOverlap|null
	 */
	public function getHourOverlap(): ?TimeOverlap {
		return $this->hourOverlap;
	}

	/**
	 * @return string[]|null
	 */
	public function getFollowUp(): ?array {
		return $this->followUp;
	}
}
