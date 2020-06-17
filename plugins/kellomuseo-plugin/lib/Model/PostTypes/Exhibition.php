<?php
/**
 * Class for Exhibition Post Type.
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\PostTypes;

use Pixels\Kellomuseo\Model\TraitSingleton;

/**
 * Register Exhibition class
 * Extends AbstractPostType
 */
class Exhibition extends AbstractPostType implements PostTypeInterface {

	/**
	 * Constant do define if post labels should be translatable
	 * --> If true, define labels as translatable strings
	 * --> If false, autocreate labels from one word
	 */
	const TRANSLATE_LABELS = false;

	// Trait that allows singleton behavior.
	use TraitSingleton;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Set up post type slug.
		$this->set_name( 'Exhibition' );

		// Set labels.
		$this->prepare_labels();

		// Define args.
		$this->set_args( $this->define_args() );

		// Hook up Exhibition cpt.
		add_action( 'init', array( $this, 'create' ) );
	}

	/**
	 * Prepare base labels to props.
	 * Behavior depends on TRANSLATE_LABELS const.
	 */
	public function prepare_labels() {

		if ( self::TRANSLATE_LABELS ) :
			// If you need to translate labels.
			$singular = __( 'Exhibition', 'kellomuseo-plugin' );
			$plural   = __( 'Exhibitions', 'kellomuseo-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'Exhibition' );
		endif;

	}

	/**
	 * Get arguments array for registration
	 *
	 * @return array $args of post.
	 */
	public function define_args() {

		// Check if we're using manual or automatic labels.
		if ( null === $this->post_label_singular && null === $this->post_label_plural ) :
			$labels = $this->define_labels();
		else :
			$labels = $this->get_labels();
		endif;

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
            'menu_icon'          => 'dashicons-clock' 
		);

		return $args;
	}

	/**
	 * OPTIONAL: Set labels manually for registration
	 * If you need to set everything manually, comment out the IF block in constructor
	 *
	 * @return array $labels of post.
	 */
	public function define_labels() {

		$labels = array(
			'name'               => _x( 'Exhibitions', 'post type general name', 'kellomuseo-plugin' ),
			'singular_name'      => _x( 'Exhibition', 'post type singular name', 'kellomuseo-plugin' ),
			'menu_name'          => _x( 'Exhibitions', 'admin menu', 'kellomuseo-plugin' ),
			'name_admin_bar'     => _x( 'Exhibition', 'add new on admin bar', 'kellomuseo-plugin' ),
			'add_new'            => _x( 'Add New', 'add new item', 'kellomuseo-plugin' ),
			'add_new_item'       => __( 'Add New Exhibition', 'kellomuseo-plugin' ),
			'new_item'           => __( 'New Exhibition', 'kellomuseo-plugin' ),
			'edit_item'          => __( 'Edit Exhibition', 'kellomuseo-plugin' ),
			'view_item'          => __( 'View Exhibition', 'kellomuseo-plugin' ),
			'all_items'          => __( 'All Exhibitions', 'kellomuseo-plugin' ),
			'search_items'       => __( 'Search Exhibitions', 'kellomuseo-plugin' ),
			'parent_item_colon'  => __( 'Parent Exhibitions:', 'kellomuseo-plugin' ),
			'not_found'          => __( 'No Exhibitions found.', 'kellomuseo-plugin' ),
			'not_found_in_trash' => __( 'No Exhibitions found in Trash.', 'kellomuseo-plugin' ),
		);

		return $labels;
	}
} //end Exhibition
