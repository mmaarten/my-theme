<?php
/**
 * Theme functions and definitions
 *
 * @package MyTheme
 */

/**
 * Set up theme defaults and register support for features.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Custom navigation menu functions.
 */
require get_template_directory() . '/inc/nav-menus.php';

/**
 * Register widget areas.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom block editor functionality.
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Custom fields related functions.
 */
require get_template_directory() . '/inc/fields.php';

/**
 * Add options page.
 */
require get_template_directory() . '/inc/options-page.php';

/**
 * Register block types.
 */
require get_template_directory() . '/inc/blocks.php';
