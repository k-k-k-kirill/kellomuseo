<?php
/**
 * Class for RestAPI
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo;

// Controllers.
use RestControllers\ExampleController;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Kellomuseo RestAPI class
 * --> Register custom rest routes
 * --> Assign routes to controllers
 *
 * @since 1.0
 */
class RestAPI {

	/**
	 * Namespace for plugin REST endpoints
	 */
	const REST_NAMESPACE = 'Kellomuseo/v1/';

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Register custom endpoints.
		add_action( 'rest_api_init', array( $this, 'register_rest_endpoints' ) );
	}

	/**
	 * Add custom endpoints to WP
	 * Assign endpoints to REST controllers
	 */
	public function register_rest_endpoints() {

		// Create example endpoint.
		register_rest_route(
			self::REST_NAMESPACE,
			'example',
			array(
				array(
					'methods'  => 'GET',
					'callback' => 'Pixels\Kellomuseo\RestControllers\ExampleController::get',
				),
				array(
					'methods'  => 'POST',
					'callback' => 'Pixels\Kellomuseo\RestControllers\ExampleController::post',
				),
			)
		);
	}
} // end RestAPI
