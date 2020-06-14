<?php
/**
 * Plugin Name: Kellomuseo plugin
 * Description: Kellomuseo plugin level features
 * Author: Kirill Vitchenko
 * Version: 1.0.0
 * Text Domain: kellomuseo-plugin
 * Domain Path: /languages/
 *
 * @author    Pixels Helsinki
 * @category
 * @copyright Copyright (c) 2019
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @package Kellomuseo
 */

namespace Pixels\Kellomuseo;

// Composer autoload.
require_once __DIR__ . '/vendor/autoload.php';

/**
 * App class
 * Bootstraps rest of the plugin
 */
final class App {

	/**
	 * Variable to enable debug mode.
	 * In debug mode method "debug" is run on every page load
	 *
	 * @var bool
	 */
	const DEBUG_MODE = false;

	/**
	 * Model instance
	 *
	 * @var Model
	 */
	private $model;

	/**
	 * REST instance
	 *
	 * @var RestAPI
	 */
	private $rest;

	/**
	 * Ajax instance
	 *
	 * @var Ajax
	 */
	private $ajax;

	/**
	 * Cron instance
	 *
	 * @var Cron
	 */
	private $cron;

	/**
	 * Main class constructor
	 *
	 * @since 1.0
	 */
	public function __construct() {

		// Class instances.
		$this->model = new Model();
		$this->rest  = new RestAPI();
		$this->ajax  = new Ajax();
		$this->cron  = new Cron();

		// Load plugin translations.
		add_action( 'after_setup_theme', array( $this, 'load_plugin_textdomain' ), 100 );

		// Clear crons on deactivate.
		register_deactivation_hook( __FILE__, array( $this->cron, 'clear_cron_schedules' ) );

		// Debug action, always run on page load.
		if ( self::DEBUG_MODE ) :
			add_action( 'wp', array( $this, 'debug' ) );
		endif;
	}

	/**
	 * Load translation for the theme.
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'kellomuseo-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Debug / dump problems on pageload
	 * Only run if debug is enabled
	 */
	public function debug() {
	}

} // end App


new App();
