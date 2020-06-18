<?php
/**
 * Class for Workshop Post Type.
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\PostTypes;

use Pixels\Kellomuseo\Model\TraitSingleton;

/**
 * Register Workshop class
 * Extends AbstractPostType
 */
class Workshop extends AbstractPostType implements PostTypeInterface {

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
		$this->set_name( 'Workshop' );

		// Set labels.
		$this->prepare_labels();

		// Define args.
		$this->set_args( $this->define_args() );

		// Hook up Workshop cpt.
		add_action( 'init', array( $this, 'create' ) );
	}

	/**
	 * Prepare base labels to props.
	 * Behavior depends on TRANSLATE_LABELS const.
	 */
	public function prepare_labels() {

		if ( self::TRANSLATE_LABELS ) :
			// If you need to translate labels.
			$singular = __( 'Workshop', 'kellomuseo-plugin' );
			$plural   = __( 'Workshops', 'kellomuseo-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'Workshop' );
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
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
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
			'name'               => _x( 'Workshops', 'post type general name', 'kellomuseo-plugin' ),
			'singular_name'      => _x( 'Workshop', 'post type singular name', 'kellomuseo-plugin' ),
			'menu_name'          => _x( 'Workshops', 'admin menu', 'kellomuseo-plugin' ),
			'name_admin_bar'     => _x( 'Workshop', 'add new on admin bar', 'kellomuseo-plugin' ),
			'add_new'            => _x( 'Add New', 'add new item', 'kellomuseo-plugin' ),
			'add_new_item'       => __( 'Add New Workshop', 'kellomuseo-plugin' ),
			'new_item'           => __( 'New Workshop', 'kellomuseo-plugin' ),
			'edit_item'          => __( 'Edit Workshop', 'kellomuseo-plugin' ),
			'view_item'          => __( 'View Workshop', 'kellomuseo-plugin' ),
			'all_items'          => __( 'All Workshops', 'kellomuseo-plugin' ),
			'search_items'       => __( 'Search Workshops', 'kellomuseo-plugin' ),
			'parent_item_colon'  => __( 'Parent Workshops:', 'kellomuseo-plugin' ),
			'not_found'          => __( 'No Workshops found.', 'kellomuseo-plugin' ),
			'not_found_in_trash' => __( 'No Workshops found in Trash.', 'kellomuseo-plugin' ),
		);

		return $labels;
	}
} //end Workshop
