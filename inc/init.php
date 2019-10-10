<?php
/**
 * Avocado WordPress init actions.
 *
 * @package Avocado
 */

/**
 * Register Custom Taxonomy.
 */
if ( ! function_exists( 'avocado_register_custom_taxonomy' ) ) {

	/**
	 * Register Custom Taxonomy Function.
	 */
	function avocado_register_custom_taxonomy() {

		$labels = array(
			'name'                       => _x( 'OS', 'Taxonomy General Name', 'avocado' ),
			'singular_name'              => _x( 'OS', 'Taxonomy Singular Name', 'avocado' ),
			'menu_name'                  => __( 'OS', 'avocado' ),
			'all_items'                  => __( 'All OS', 'avocado' ),
			'parent_item'                => __( 'Parent OS', 'avocado' ),
			'parent_item_colon'          => __( 'Parent OS:', 'avocado' ),
			'new_item_name'              => __( 'New OS Name', 'avocado' ),
			'add_new_item'               => __( 'Add New OS', 'avocado' ),
			'edit_item'                  => __( 'Edit OS', 'avocado' ),
			'update_item'                => __( 'Update OS', 'avocado' ),
			'view_item'                  => __( 'View OS', 'avocado' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'avocado' ),
			'add_or_remove_items'        => __( 'Add or remove OS', 'avocado' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'avocado' ),
			'popular_items'              => __( 'Popular OS', 'avocado' ),
			'search_items'               => __( 'Search OS', 'avocado' ),
			'not_found'                  => __( 'Not Found', 'avocado' ),
			'no_terms'                   => __( 'No OS', 'avocado' ),
			'items_list'                 => __( 'OS list', 'avocado' ),
			'items_list_navigation'      => __( 'OS list navigation', 'avocado' ),
		);
		$args   = array(
			'labels'            => $labels,
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		);
		register_taxonomy( 'os', array( 'phone_app' ), $args );

	}
	add_action( 'init', 'avocado_register_custom_taxonomy', 0 );

}

/**
 * Register Custom Post Type.
 */
if ( ! function_exists( 'avocado_register_custom_post_type' ) ) {

	/**
	 * Register Custom Post Type.
	 */
	function avocado_register_custom_post_type() {

		$labels = array(
			'name'                  => _x( 'Phone Apps', 'Post Type General Name', 'avocado' ),
			'singular_name'         => _x( 'Phone App', 'Post Type Singular Name', 'avocado' ),
			'menu_name'             => __( 'Phone Apps', 'avocado' ),
			'name_admin_bar'        => __( 'Phone Apps', 'avocado' ),
			'archives'              => __( 'Phone App Archives', 'avocado' ),
			'attributes'            => __( 'Phone App Attributes', 'avocado' ),
			'parent_item_colon'     => __( 'Parent Phone App:', 'avocado' ),
			'all_items'             => __( 'All Phone Apps', 'avocado' ),
			'add_new_item'          => __( 'Add New Phone App', 'avocado' ),
			'add_new'               => __( 'Add New', 'avocado' ),
			'new_item'              => __( 'New Phone App', 'avocado' ),
			'edit_item'             => __( 'Edit Phone App', 'avocado' ),
			'update_item'           => __( 'Update Phone App', 'avocado' ),
			'view_item'             => __( 'View Phone App', 'avocado' ),
			'view_items'            => __( 'View Phone Apps', 'avocado' ),
			'search_items'          => __( 'Search Phone App', 'avocado' ),
			'not_found'             => __( 'Not found', 'avocado' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'avocado' ),
			'featured_image'        => __( 'Featured Image', 'avocado' ),
			'set_featured_image'    => __( 'Set featured image', 'avocado' ),
			'remove_featured_image' => __( 'Remove featured image', 'avocado' ),
			'use_featured_image'    => __( 'Use as featured image', 'avocado' ),
			'insert_into_item'      => __( 'Insert into Phone App', 'avocado' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Phone App', 'avocado' ),
			'items_list'            => __( 'Phone Apps list', 'avocado' ),
			'items_list_navigation' => __( 'Phone Apps list navigation', 'avocado' ),
			'filter_items_list'     => __( 'Filter Phone Apps list', 'avocado' ),
		);
		$args   = array(
			'label'               => __( 'Phone App', 'avocado' ),
			'description'         => __( 'Latest Phone Apps', 'avocado' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'          => array( 'os' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-screenoptions',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'phone_app', $args );

	}
	add_action( 'init', 'avocado_register_custom_post_type', 0 );

}
