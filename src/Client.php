<?php

namespace MediaWiki\Extension\SimilarEditors;

interface Client {

	/**
	 * Retrieve the queried editor
	 *
	 * @param string $target
	 * @return Editor|null
	 */
	public function getEditor( string $target );

	/**
	 * Retrieve similar editors
	 *
	 * @param string $target
	 * @return Neighbor[]|null
	 */
	public function getSimilarEditors( string $target );
}
