<?php
/**
 * Template part for displaying grid items for 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Avocado
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
	<header class="entry-header">
		<?php
			$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); 
			$thubnail_bg_style = !empty( $thumbnail_url ) ? "url('" . esc_url( $thumbnail_url ) . "')" : 'unset';
		?>
		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<div class="grid-thumb-image-container" style="background-image: <?php echo $thubnail_bg_style; ?>;"></div>
		</a>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<div class="post-title-wrapper">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<i class="far fa-thumbs-up"></i>
		</div>
		<?php the_excerpt(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
