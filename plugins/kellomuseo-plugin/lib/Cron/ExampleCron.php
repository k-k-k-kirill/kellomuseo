<?php
/**
 * Class for ExampleCron
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Cron;

// Services.
// use \Pixels\Kellomuseo\Services\ExampleService;.

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Kellomuseo ExampleCron class
 * Handle cron actions assigned in main cron class
 *
 * @since 1.0
 * @author Pixels
 */
class ExampleCron {

	/**
	 * Description of cron action
	 */
	public static function example() {
		/**
		 * Handle cron action
		 * Call services for further business logic
		 */
	}
} //end ExampleCron
