<?php

namespace MediaWiki\Extension\SimilarEditors;

class Neighbor {

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
	 * @var int|null
	 */
	private $editOverlap;

	/**
	 * Number of overlapping edited pages divided by number of pages edited by the neighbor (between 0 and 1)
	 *
	 * @var int|null
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
	 * @param int|null $numEditsInData
	 * @param int|null $numPages
	 * @param int|null $editOverlap
	 * @param int|null $editOverlapInv
	 * @param TimeOverlap|null $dayOverlap
	 * @param TimeOverlap|null $hourOverlap
	 * @param string[]|null $followUp
	 */
	public function __construct(
		$numEditsInData = null,
		$numPages = null,
		$editOverlap = null,
		$editOverlapInv = null,
		$dayOverlap = null,
		$hourOverlap = null,
		$followUp = null
	) {
		$this->numEditsInData = $numEditsInData;
		$this->numPages = $numPages;
		$this->editOverlap = $editOverlap;
		$this->editOverlapInv = $editOverlapInv;
		$this->dayOverlap = $dayOverlap;
		$this->hourOverlap = $hourOverlap;
		$this->followUp = $followUp;
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
	 * @return int|null
	 */
	public function getEditOverlap(): ?int {
		return $this->editOverlap;
	}

	/**
	 * @return int|null
	 */
	public function getEditOverlapInv(): ?int {
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
