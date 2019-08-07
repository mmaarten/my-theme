<?php
/**
 * Options Page
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package MyTheme
 */

/**
 * Add options page
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 *
 * @uses acf_add_options_page()
 */
function my_theme_add_options_page() {

	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Theme Settings', 'my-theme' ),
			'menu_title' => __( 'Theme Settings', 'my-theme' ),
			'menu_slug'  => 'theme-settings',
		)
	);

}

add_action( 'acf/init', 'my_theme_add_options_page' );
