<?php
/**
 * Avocado Enqueue scripts & styles.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Avocado
 */

/**
 * Enqueue scripts and styles.
 */
function avocado_scripts() {

	$version = '1.0.0';

	wp_enqueue_style( 'avocado-style', get_stylesheet_uri() );

	wp_enqueue_style( 'avocado-fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css' );

	wp_enqueue_script( 'avocado-main', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), $version, true );

	wp_localize_script(
		'avocado-main',
		'avocado_obj',
		array(
			'ajax_url'   => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'avocado_nonce' ),
			'load_more'  => __( 'Load More', 'avocado' ),
			'loading'    => __( 'Loading...', 'avocado' ),
		)
	);

	wp_enqueue_script( 'avocado-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), $version, true );

	wp_enqueue_script( 'avocado-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'avocado_scripts' );
