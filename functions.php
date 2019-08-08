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
my_theme_inc(
	array(
		'autoload.php',           // Include autoloader.
		'setup.php',              // Set up theme defaults and register support for features.
		'nav-menus.php',          // Custom navigation menu functions.
		'widgets.php',            // Register widget areas.
		'scripts.php',            // Enqueue scripts and styles.
		'template-tags.php',      // Custom template tags for this theme.
		'template-functions.php', // Functions which enhance the theme by hooking into WordPress.
		'editor.php',             // Custom editor features.
		'fields.php',             // Custom fields related functions.
		'options-page.php',       // Add options page.
		'blocks.php',             // Register block types.
		'hero-image.php',         // Include hero image.
	)
);
