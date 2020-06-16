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
class SiteSettings {

	/**
	 * Class constructor
	 */
	public function __construct() {
		acf_add_options_page(
			array(
				'page_title'  =>  __('Site options', 'kellomuseo-plugin'),
				'menu_title'  => __('Site options', 'kellomuseo-plugin'),
				'menu_slug' => 'site-settings',
			)
		);
	}

} //end SiteSettings
