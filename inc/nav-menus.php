<?php
/**
 * Navigation Menus
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Is nav menu nav
 *
 * Check if nav menu has a `nav` or `navbar-nav` CSS class.
 *
 * @param stdClass $nav_menu An object of wp_nav_menu() arguments.
 *
 * @return bool
 */
function is_nav_menu_nav( $nav_menu ) {
	return preg_match( '/(^| )(nav|navbar-nav)( |$)/', $nav_menu->menu_class );
}

/**
 * CSS Class
 *
 * Add custom CSS classes to the nav menu item.
 *
 * @param array    $classes   Array of the CSS classes.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
function nav_menu_css_class( $classes, $item, $nav_menu, $depth ) {

	if ( ! is_nav_menu_nav( $nav_menu ) ) {
		return $classes;
	}

	if ( 0 === $depth ) {
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$classes[] = 'dropdown';
		} else {
			$classes[] = 'nav-item';
		}
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\nav_menu_css_class', 10, 4 );

/**
 * Link Attributes
 *
 * Alter nav menu item link attributes.
 *
 * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
function nav_menu_link_attributes( $atts, $item, $nav_menu, $depth ) {

	if ( ! is_nav_menu_nav( $nav_menu ) ) {
		return $atts;
	}

	// Make sure 'class' attribute is set.
	if ( ! isset( $atts['class'] ) ) {
		$atts['class'] = '';
	}

	// Nav link.
	if ( 0 === $depth ) {
		$atts['class'] .= ' nav-link';

		// Dropdown.
		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$atts['href']          = '#';
			$atts['class']        .= ' dropdown-toggle';
			$atts['data-toggle']   = 'dropdown';
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
		}
	} elseif ( 1 === $depth ) {
		// Dropdown item.
		$atts['class'] .= ' dropdown-item';
	}

	// Active.
	if ( $item->current || $item->current_item_ancestor || $item->current_item_parent ) {
		$atts['class'] .= ' active';
	}

	// Sanitize 'class' attribute.
	$atts['class'] = trim( $atts['class'] );

	// Return.
	return $atts;
}

add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\nav_menu_link_attributes', 10, 4 );

/**
 * Submenu CSS Class
 *
 * Add custom CSS classes to the nav menu submenu.
 *
 * @param array    $classes   Array of the CSS classes that are applied to the menu <ul> element.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return array
 */
function nav_menu_submenu_css_class( $classes, $nav_menu, $depth ) {

	if ( is_nav_menu_nav( $nav_menu ) ) {
		$classes[] = 'dropdown-menu';
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', __NAMESPACE__ . '\nav_menu_submenu_css_class', 10, 3 );
