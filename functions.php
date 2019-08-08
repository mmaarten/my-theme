<?php
/**
 * Theme functions and definitions
 *
 * @package MyTheme
 */

/**
 * Load common helper functions.
 */
require get_template_directory() . '/inc/common.php';

/**
 * Include files from inside the /inc directory.
 */
$my_theme_includes = array(
	'setup.php'              => true, // Set up theme defaults and register support for features.
	'nav-menus.php'          => true, // Custom navigation menu functions.
	'widgets.php'            => true, // Register widget areas.
	'scripts.php'            => true, // Enqueue scripts and styles.
	'template-tags.php'      => true, // Custom template tags for this theme.
	'template-functions.php' => true, // Functions which enhance the theme by hooking into WordPress.
	'editor.php'             => true, // Custom editor features.
	'fields.php'             => true, // Custom fields related functions.
	'options-page.php'       => true, // Add options page.
	'blocks.php'             => true, // Register block types.
	'hero-image.php'         => true, // Include hero image.
);

my_theme_inc( array_keys( array_filter( $my_theme_includes ) ) );
