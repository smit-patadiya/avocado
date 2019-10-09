<?php
/**
 * Avocado functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Avocado
 */

/**
 * Implement the theme setup actions.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Initialize widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts & styles.
 */
require get_template_directory() . '/inc/frontend-scripts.php';

/**
 * WordPress init actions.
 */
require get_template_directory() . '/inc/init.php';

/**
 * WordPress add_filter actions.
 */
require get_template_directory() . '/inc/add-filter.php';

/**
 * WordPress AJAX hander.
 */
require get_template_directory() . '/inc/ajax-handler.php';

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
