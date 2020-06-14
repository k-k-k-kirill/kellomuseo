<?php
/**
 * Interface for Taxonomy.
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\Taxonomies;

/**
 * Requires each taxonomy to have certain methods.
 */
interface TaxonomyInterface {

	/**
	 * Get arguments array for registration
	 */
	public function define_args();

	/**
	 * Set taxonomy labels.
	 */
	public function prepare_labels();
}
