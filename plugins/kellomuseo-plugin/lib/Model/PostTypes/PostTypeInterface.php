<?php
/**
 * Interface for PostType
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\PostTypes;

/**
 * Requires each post type to have certain methods.
 */
interface PostTypeInterface {

	/**
	 * Get arguments array for registration
	 */
	public function define_args();

	/**
	 * Set post type labels.
	 */
	public function prepare_labels();
}
