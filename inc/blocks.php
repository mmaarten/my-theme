<?php
/**
 * Common helper functions
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Enqueue block assets for the editing interface
 */
function enqueue_block_assets() {

	$theme         = wp_get_theme();
	$theme_version = $theme->get( 'Version' );

	$css_version = filemtime( get_template_directory() . '/dist/styles/blocks.css' );
	wp_enqueue_style( 'my-theme-blocks', get_template_directory_uri() . '/dist/styles/blocks.css', array(), "{$theme_version}.{$css_version}" );
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_block_assets' );
