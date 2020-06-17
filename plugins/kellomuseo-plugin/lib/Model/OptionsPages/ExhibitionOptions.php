<?php
/**
 * Class for Example Options Page.
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\OptionsPages;

/**
 * Register options page for example
 *
 * @since 1.0
 */
class ExhibitionOptions {

	/**
	 * Class constructor
	 */
	public function __construct() {
		acf_add_options_sub_page(
			array(
				'page_title'  => 'Exhibition Options',
				'menu_title'  => 'Exhibition Options',
				'parent_slug' => 'edit.php?post_type=exhibition',
			)
		);
	}

} //end Example
