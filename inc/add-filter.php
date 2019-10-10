<?php
/**
 * Avocado apply add_filter.
 *
 * @package Avocado
 */

/**
 * Add a All Apps Link in primary navigation
 *
 * @param string $items Menu item html.
 * @param object $args Menu item arguments.
 *
 * @return string
 *
 * @since  1.0.0
 */
function add_all_apps_link( $items, $args ) {

	if ( 'menu-1' === $args->theme_location ) {

		$archive_link = get_post_type_archive_link( 'phone_app' );
		$items        = '<li class="menu-item menu-item-type-taxonomy menu-item-filter-allapp"><a href="' . $archive_link . '">All apps</a></li>' . $items;

	}

	return $items;
}

/**
 * Add custom Menu item for the navigation menu.
 */
add_filter( 'wp_nav_menu_items', 'add_all_apps_link', 10, 2 );
