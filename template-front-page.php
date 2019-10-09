<?php
/**
 * Template Name: Front Page
 *
 * Front Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Avocado
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main front-page-grid-items">
			
			<?php
				$posts_per_page = get_option( 'posts_per_page' );

				$args = array(
					'post_type'      => 'phone_app',
					'post_status'    => 'publish',
					'order'          => 'DESC',
					'orderby'        => 'ID',
					'posts_per_page' => $posts_per_page,
				);
                
				$loop        = new WP_Query( $args );
				$total_pages = $loop->max_num_pages;
				$post_count  = $loop->post_count;

				while ( $loop->have_posts() ) :
					$loop->the_post();

					// template for the content.
					get_template_part( 'template-parts/page-grid' );

				endwhile;

				wp_reset_postdata();

				?>

		</main><!-- #main -->
		<?php
		if ( $total_pages > 1 ) {
			?>
				
				<button type="button" class="front-page-load-more"><?php echo __( 'Load More', 'avocado' ); ?></button>
				<script>
					var avocado_front_page = {
						'posts_per_page': <?php echo $posts_per_page; ?>,
						'total_pages': <?php echo $total_pages; ?>,
						'post_count': <?php echo $post_count; ?>,
					};
				</script>
				
			<?php
		}
		?>
		
	</div><!-- #primary -->

<?php
get_footer();
