<?php
/**
 * Avocado AJAX functions.
 *
 * @package Avocado
 */

if ( ! function_exists( 'load_more_phone_app_ajax_hook' ) ) {
	/**
	 * Load more phone_app custom post type.
	 */
	function load_more_phone_app_ajax_hook() {

		// If nonce verification fails die.
		check_ajax_referer( 'avocado_nonce', 'security' );

		$current_page = isset( $_POST['data']['currentPage'] ) ? $_POST['data']['currentPage'] : '';
		$current_page = preg_replace( '/[^0-9]/', '', $current_page );
		$current_page = sanitize_text_field( wp_unslash( $current_page ) );

		$current_post_count = isset( $_POST['data']['currentPostCount'] ) ? $_POST['data']['currentPostCount'] : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$current_post_count = preg_replace( '/[^0-9]/', '', $current_post_count );
		$current_post_count = sanitize_text_field( wp_unslash( $current_post_count ) );

		$posts_per_page = get_option( 'posts_per_page' );
		$new_page       = $current_page + 1;

		$offset = ( $new_page - 1 ) * $posts_per_page;

		$args = array(
			'post_type'      => 'phone_app',
			'post_status'    => 'publish',
			'order'          => 'DESC',
			'orderby'        => 'ID',
			'posts_per_page' => $posts_per_page,
			'page'           => $new_page,
			'offset'         => $offset,
		);

		$loop        = new WP_Query( $args );
		$total_pages = $loop->max_num_pages;
		$post_count  = $loop->post_count;

		ob_start();

		while ( $loop->have_posts() ) :
			$loop->the_post();

			// Template for the content.
			get_template_part( 'template-parts/page-grid' );

		endwhile;

		$post_content = ob_get_contents();

		ob_clean();

		wp_reset_postdata();

		wp_send_json_success(
			array(
				'content'      => $post_content,
				'total_page'   => $total_pages,
				'post_count'   => $post_count,
				'current_page' => $new_page,
			)
		);
	}

	add_action( 'wp_ajax_load_phone_app_ajax_hook', 'load_more_phone_app_ajax_hook' );
	add_action( 'wp_ajax_nopriv_load_phone_app_ajax_hook', 'load_more_phone_app_ajax_hook' );
}
