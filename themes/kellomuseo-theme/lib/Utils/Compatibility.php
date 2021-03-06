<?php
/**
 * Checks that the theme is compatible with the install environment.
 *
 * @package  WordPress
 * @subpackage  Pixels\Theme
 */

namespace Pixels\Theme\Utils;

/**
 * Compatibility class
 *
 * Check PHP version
 * Check WP version
 * Do any other requirement checks
 */
class Compatibility {

	/**
	 * PHP version to compare to
	 *
	 * @var string
	 */
	const PHP_VERSION = '7.1.0';

	/**
	 * WP version to compare to
	 *
	 * @var string
	 */
	const WP_VERSION = '4.7.0';

	/**
	 * Run all checks on theme start
	 *
	 * @return bool $compatible status.
	 */
	public static function run_checks() {
		$compatible =
		self::check_php_version()
		&& self::check_wordpress_version()
		&& self::check_timber_plugin();

		return $compatible;
	}

	/**
	 * Ensure compatible version of PHP is used
	 *
	 * @return bool $compatible status;
	 * @since 1.0
	 */
	public static function check_php_version() {

		$compatible = true;

		if ( version_compare( self::PHP_VERSION, phpversion(), '>=' ) ) {
			// phpcs:ignore
			wp_die( esc_attr( __( 'You must be using PHP ' . self::PHP_VERSION . ' or greater.', 'kellomuseo-theme' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'kellomuseo-theme' ) ) );

			$compatible = false;
		}

		return $compatible;
	}

	/**
	 * Ensure compatible version of WordPress is used
	 *
	 * @return bool $compatible status;
	 * @since 1.0
	 */
	public static function check_wordpress_version() {

		$compatible = true;

		if ( version_compare( self::WP_VERSION, get_bloginfo( 'version' ), '>=' ) ) {
			// phpcs:ignore
			wp_die( esc_attr( __( 'You must be using WordPress ' . self::WP_VERSION . ' or greater.', 'kellomuseo-theme' ) ), esc_attr( __( 'Theme &rsaquo; Error', 'kellomuseo-theme' ) ) );

			$compatible = false;
		}

		return $compatible;
	}

	/**
	 * Ensure Timber plugin is in use
	 *
	 * @return bool $compatible status;
	 */
	public static function check_timber_plugin() {

		$compatible = true;

		if ( ! class_exists( 'Timber' ) ) :
			if ( is_admin() ) :
				echo '<div class="error"><p>' . esc_attr( __( 'Timber not activated. Make sure you activate the plugin', 'kellomuseo-theme' ) ) . '</p></div>';
			else :
				wp_die( esc_attr( __( 'Oh no! You need to activate the Timber plugin before you can use this theme.', 'kellomuseo-theme' ) ) );
			endif;

			$compatible = false;
		endif;

		return $compatible;
	}
}
