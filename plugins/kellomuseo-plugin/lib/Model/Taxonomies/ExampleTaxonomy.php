<?php
/**
 * Class for ExampleTaxonomy
 *
 * @package Kellomuseo.
 */

namespace Pixels\Kellomuseo\Model\Taxonomies;

use Pixels\Kellomuseo\Model\TraitSingleton;

/**
 * Registers ExampleTaxonomy tax
 */
class ExampleTaxonomy extends AbstractTaxonomy implements TaxonomyInterface {

	// Trait that allows singleton behavior.
	use TraitSingleton;

	/**
	 * Constant do define if post labels should be translatable
	 * --> If true, define labels as translatable strings
	 * --> If false, autocreate labels from one word
	 */
	const TRANSLATE_LABELS = false;

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Set up tax.
		$this->set_name( 'example_category' );
		$this->set_post_type( 'example' );

		// Set labels.
		$this->prepare_labels();

		$this->set_args( $this->define_args() );

		// Hook up example taxonomy.
		add_action( 'init', array( $this, 'create' ) );
	}

	/**
	 * Prepare base labels to props.
	 * Behavior depends on TRANSLATE_LABELS const.
	 */
	public function prepare_labels() {

		if ( self::TRANSLATE_LABELS ) :
			// If you need to translate labels.
			$singular = __( 'Example Category', 'kellomuseo-plugin' );
			$plural   = __( 'Example Categories', 'kellomuseo-plugin' );

			$this->set_manual_labels( $singular, $plural );
		else :
			// Automatically generate labels from one word.
			$this->set_automatic_labels( 'Example Category' );
		endif;

	}

	/**
	 * Get arguments for tax registration
	 *
	 * @return array $labels
	 */
	public function define_args() {

		// Check if we're using manual or automatic labels.
		if ( null === $this->tax_label_singular && null === $this->tax_label_plural ) :
			$labels = $this->define_labels();
		else :
			$labels = $this->get_labels();
		endif;

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'has_archive'       => true,
			'rewrite'           => array(
				'slug'       => 'examples',
				'with_front' => true,
			),
		);

		return $args;
	}

	/**
	 * OPTIONAL: Set labels manually for registration
	 * If you need to set everything manually,
	 * comment out the prepare_labels() in constructor
	 *
	 * @return array $labels
	 */
	public function define_labels() {

		$labels = array(
			'name'              => _x( 'Example Tax', 'taxonomy general name', 'kellomuseo-plugin' ),
			'singular_name'     => _x( 'Example Tax', 'taxonomy singular name', 'kellomuseo-plugin' ),
			'search_items'      => __( 'Search Example ', 'kellomuseo-plugin' ),
			'all_items'         => __( 'All Examples', 'kellomuseo-plugin' ),
			'parent_item'       => __( 'Parent Examples', 'kellomuseo-plugin' ),
			'parent_item_colon' => __( 'Parent Example:', 'kellomuseo-plugin' ),
			'edit_item'         => __( 'Edit Example', 'kellomuseo-plugin' ),
			'update_item'       => __( 'Update Example', 'kellomuseo-plugin' ),
			'add_new_item'      => __( 'Add New Example', 'kellomuseo-plugin' ),
			'delete_item'       => __( 'Delete item', 'kellomuseo-plugin' ),
			'new_item_name'     => __( 'New Example', 'kellomuseo-plugin' ),
		);

		return $labels;
	}

} //end ExampleTaxonomy
