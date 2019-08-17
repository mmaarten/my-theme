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

namespace MyTheme;

/**
 * Add options page
 *
 * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
 *
 * @uses acf_add_options_page()
 */
function add_options_page() {

	if ( ! function_exists( 'acf_add_options_page' ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( 'Function <code>acf_add_options_page</code> does not exist.', E_USER_WARNING );
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Site Options', 'my-theme' ),
			'menu_title' => __( 'Site Options', 'my-theme' ),
			'menu_slug'  => 'theme-settings',
		)
	);

}

add_action( 'acf/init', __NAMESPACE__ . '\add_options_page' );
