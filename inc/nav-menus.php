<?php
/**
 * Navigation Menus
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Include WP_Bootstrap_Navwalker.
 *
 * @link https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
require get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

/**
 * Convert a menu item link to a button.
 *
 * This feature can be applied by using menu item 'CSS Classes' setting in admin area.
 *
 * Usage: Use button CSS classes prefixed by a dash character '-'.
 * e.g. '-btn -btn-primary -btn-sm' adds link CSS classes 'btn btn-primary btn-sm'.
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
function nav_menu_button( $atts, $item, $nav_menu, $depth ) {

	// Get button classes.

	$btn_classes = array();

	foreach ( $item->classes as $class ) {
		if ( preg_match( '/^-(btn-[\w-]+)$/', $class, $matches ) ) {
			$btn_classes[ $matches[1] ] = $matches[1];
		}
	}

	// Stop when no classes.

	if ( ! $btn_classes ) {
		return $atts;
	}

	// Make sure 'btn' class is added.

	$btn_classes = array( 'btn' => 'btn' ) + $btn_classes;

	// Make sure 'class' attribute is set.

	if ( ! isset( $atts['class'] ) ) {
		$atts['class'] = '';
	}

	// Remove 'nav-link' class.

	$atts['class'] = preg_replace( '/(^| )nav-link( |$)/', '', $atts['class'] );

	// Add button attributes.

	$atts['class'] .= ' ' . implode( ' ', $btn_classes );

	$atts['role'] = 'button';

	// Sanitize 'class' attribute.

	$atts['class'] = trim( $atts['class'] );

	// Return.

	return $atts;
}

add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\nav_menu_button', 15, 4 );

/**
 * Toggle modal on item click.
 *
 * This feature can be applied by using menu item 'CSS Classes' setting in admin area.
 *
 * Usage: '-modal'
 *
 * The modal reference can be set via the 'URL' setting for custom links. e.g. '#my-modal'.
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
function nav_menu_modal( $atts, $item, $nav_menu, $depth ) {
	if ( in_array( '-modal', $item->classes, true ) ) {
		$atts['data-toggle'] = 'modal';
	}

	return $atts;
}

add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\nav_menu_modal', 10, 4 );
