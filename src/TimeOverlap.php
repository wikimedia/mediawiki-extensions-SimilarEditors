<?php

namespace MediaWiki\Extension\SimilarEditors;

class TimeOverlap {
	/**
	 * Similarity score
	 *
	 * @var int
	 */
	private $cosineSimilarity;

	/**
	 * Qualitative description of the similarity score
	 * possible values: no overlap, low, medium, high
	 *
	 * @var string
	 */
	private $level;

	/**
	 * @param int $cosineSimilarity
	 * @param string $level
	 */
	public function __construct(
		int $cosineSimilarity,
		string $level
	) {
		$this->cosineSimilarity = $cosineSimilarity;
		$this->level = $level;
	}

	/**
	 * @return int
	 */
	public function getCosineSimilarity(): int {
		return $this->cosineSimilarity;
	}

	/**
	 * @return string
	 */
	public function getLevel(): string {
		return $this->level;
	}
}
