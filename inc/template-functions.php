<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package MyTheme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function my_theme_body_classes( $classes ) {

	$include = array(
		// Common.
		'singular' => is_singular(),
		'hfeed'    => ! is_singular(),
		'blocks'   => function_exists( 'has_blocks' ) && has_blocks(),
		// Browsers & devices.
		'iphone'   => $GLOBALS['is_iphone'],
		'chrome'   => $GLOBALS['is_chrome'],
		'safari'   => $GLOBALS['is_safari'],
		'ns4'      => $GLOBALS['is_NS4'],
		'opera'    => $GLOBALS['is_opera'],
		'mac-ie'   => $GLOBALS['is_macIE'],
		'win-ie'   => $GLOBALS['is_winIE'],
		'gecko'    => $GLOBALS['is_gecko'],
		'lynx'     => $GLOBALS['is_lynx'],
		'ie'       => $GLOBALS['is_IE'],
		'edge'     => $GLOBALS['is_edge'],
		// Mobile.
		'mobile'   => wp_is_mobile(),
		'desktop'  => ! wp_is_mobile(),
	);

	// Add classes.
	foreach ( $include as $class => $do_include ) {
		if ( $do_include ) {
			$classes[ $class ] = $class;
		}
	}

	// Return.
	return $classes;
}

add_filter( 'body_class', 'my_theme_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function my_theme_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'my_theme_pingback_header' );

/**
 * Filter custom logo output.
 *
 * @param mixed $html The HTML Markup.
 *
 * @return string
 */
function my_theme_modify_custom_logo( $html ) {

	$html = str_replace(
		'class="custom-logo-link"',
		sprintf(
			'class="custom-logo-link site-logo" itemprop="url" title="%s"',
			esc_attr_x( 'Home', 'Used as link title to refer to homepage.', 'my-theme' )
		),
		$html
	);
	$html = str_replace( 'class="custom-logo"', 'class="custom-logo img-fluid"', $html );

	return $html;
}

add_filter( 'get_custom_logo', 'my_theme_modify_custom_logo' );
