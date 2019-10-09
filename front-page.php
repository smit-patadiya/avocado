<?php
/**
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

            $args = array (
                'post_type'             => 'phone_app',
                'post_status'           => 'publish',
                'order'                 => 'DESC',
                'orderby'               => 'ID',
                'posts_per_page'        => 10,
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
                
                // template for the content
                get_template_part( 'template-parts/page-grid' );

            endwhile;
            
            wp_reset_postdata();

        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
