<?php
/**
 * Avocado functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Avocado
 */

if ( ! function_exists( 'avocado_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function avocado_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Avocado, use a find and replace
		 * to change 'avocado' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'avocado', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'avocado' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'avocado_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
	}
endif;
add_action( 'after_setup_theme', 'avocado_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function avocado_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'avocado_content_width', 640 );
}
add_action( 'after_setup_theme', 'avocado_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function avocado_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'avocado' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'avocado' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'avocado_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function avocado_scripts() {
	wp_enqueue_style( 'avocado-style', get_stylesheet_uri(), '' );

	wp_enqueue_style( 'avocado-fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css' );
	
	wp_enqueue_script( 'avocado-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '20151215', true );

	wp_localize_script ( 
		'avocado-main', 
		'avocado_obj', 
		array( 
			'ajax_url'		=> admin_url( 'admin-ajax.php' ),
			'ajax_nonce'	=> wp_create_nonce( 'avocado_nonce' ),
			'load_more'		=> __( 'Load More', 'avocado' ),
			'loading'		=> __( 'Loading...', 'avocado' ),
		)
	);

	wp_enqueue_script( 'avocado-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );
	
	wp_enqueue_script( 'avocado-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'avocado_scripts' );

if ( ! function_exists( 'avocado_register_custom_taxonomy' ) ) {

	// Register Custom Taxonomy
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
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'os', array( 'phone_app' ), $args );

	}
	add_action( 'init', 'avocado_register_custom_taxonomy', 0 );

}

if ( ! function_exists('avocado_register_custom_post_type') ) {

	// Register Custom Post Type
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
		$args = array(
			'label'                 => __( 'Phone App', 'avocado' ),
			'description'           => __( 'Latest Phone Apps', 'avocado' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
			'taxonomies'            => array( 'os' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-screenoptions',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'phone_app', $args );

	}
	add_action( 'init', 'avocado_register_custom_post_type', 0 );

}

add_image_size( 'phone-app-grid', 752, 470 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_filter( 'wp_nav_menu_items', 'add_all_apps_link', 10, 2);

/**
 * Add a All Apps Link in primary navigation
 */
function add_all_apps_link( $items, $args )
{
    if($args->theme_location == 'menu-1')
    {
		$archive_link = get_post_type_archive_link( 'phone_app' );
		$items = '<li class="menu-item menu-item-type-taxonomy menu-item-filter-allapp"><a href="' . $archive_link . '">All apps</a></li>' . $items;
    }

    return $items;
}

if ( ! function_exists( 'load_more_phone_app_ajax_hook' ) ) {
	/**
	 * Send OTP .
	 */
	function load_more_phone_app_ajax_hook() {

		// If nonce verification fails die.
		check_ajax_referer( 'avocado_nonce', 'security' );

		$currentPage	= isset( $_POST['data']['currentPage'] ) ? $_POST['data']['currentPage'] : '';
		$currentPage	= preg_replace( '/[^0-9]/', '', $currentPage );
		$currentPage	= sanitize_text_field( wp_unslash( $currentPage ) );

		$currentPostCount	= isset( $_POST['data']['currentPostCount'] ) ? $_POST['data']['currentPostCount'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$currentPostCount	= preg_replace( '/[^0-9]/', '', $currentPostCount );
		$currentPostCount	= sanitize_text_field( wp_unslash( $currentPostCount ) );

		$posts_per_page = get_option( 'posts_per_page' );
		$new_page = $currentPage + 1;

		$offset = ( $new_page - 1 ) * $posts_per_page;
		
		$args = array (
			'post_type'             => 'phone_app',
			'post_status'           => 'publish',
			'order'                 => 'DESC',
			'orderby'               => 'ID',
			'posts_per_page'        => $posts_per_page,
			'page'					=> $new_page,
			'offset'				=> $offset,
		);

		$loop = new WP_Query( $args );
		$total_pages = $loop->max_num_pages;
		$post_count = $loop->post_count;
		
		ob_start();

		while ( $loop->have_posts() ) : $loop->the_post();
			
			// template for the content
			get_template_part( 'template-parts/page-grid' );

		endwhile;
		
		$post_content = ob_get_contents();

		ob_clean();

		wp_reset_postdata();

		wp_send_json_success(
			array(
				'content' => $post_content,
				'total_page'	=> $total_pages,
				'post_count'	=> $post_count,
				'current_page'	=> $new_page,
			)
		);
	}

	add_action( 'wp_ajax_load_phone_app_ajax_hook', 'load_more_phone_app_ajax_hook' );
	add_action( 'wp_ajax_nopriv_load_phone_app_ajax_hook', 'load_more_phone_app_ajax_hook' );
}