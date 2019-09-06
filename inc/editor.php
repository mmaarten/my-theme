<?php
/**
 * Editor
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Setup
 */
function block_editor_setup() {

	// Set editor colors.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => __( 'Primary', 'my-theme' ),
				'slug'  => 'primary',
				'color' => '#007bff', // Value of $primary.
			),
			array(
				'name'  => __( 'Secondary', 'my-theme' ),
				'slug'  => 'secondary',
				'color' => '#6c757d', // Value of $secondary.
			),
			array(
				'name'  => __( 'Success', 'my-theme' ),
				'slug'  => 'success',
				'color' => '#28a745', // Value of $success.
			),
			array(
				'name'  => __( 'Info', 'my-theme' ),
				'slug'  => 'info',
				'color' => '#17a2b8', // Value of $info.
			),
			array(
				'name'  => __( 'Warning', 'my-theme' ),
				'slug'  => 'warning',
				'color' => '#ffc107', // Value of $warning.
			),
			array(
				'name'  => __( 'Danger', 'my-theme' ),
				'slug'  => 'danger',
				'color' => '#dc3545', // Value of $danger.
			),
			array(
				'name'  => __( 'Light', 'my-theme' ),
				'slug'  => 'light',
				'color' => '#f8f9fa', // Value of $light.
			),
			array(
				'name'  => __( 'Dark', 'my-theme' ),
				'slug'  => 'dark',
				'color' => '#343a40', // Value of $dark.
			),
			array(
				'name'  => __( 'White', 'my-theme' ),
				'slug'  => 'white',
				'color' => '#ffffff', // Value of $white.
			),
		)
	);

	// Set editor font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			// 'normal' slug is required to set default font size
			array(
				'name'      => __( 'Small', 'my-theme' ),
				'shortName' => __( 'SM', 'my-theme' ),
				'size'      => 16 * 0.875, // Value of $font-size-sm.
				'slug'      => 'small',
			),
			array(
				'name'      => __( 'Normal', 'my-theme' ),
				'shortName' => __( 'MD', 'my-theme' ),
				'size'      => 16, // Value of $font-size-base.
				'slug'      => 'normal',
			),
			array(
				'name'      => __( 'Large', 'my-theme' ),
				'shortName' => __( 'LG', 'my-theme' ),
				'size'      => 16 * 1.25, // Value of $font-size-lg.
				'slug'      => 'large',
			),
		)
	);

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Enable align 'wide' and 'full' block settings.
	add_theme_support( 'align-wide' );

	// Enable responsive embeds.
	add_theme_support( 'responsive-embeds' );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\block_editor_setup' );

/**
 * Filter whether a post is able to be edited in the block editor.
 *
 * @param bool    $use_block_editor Whether the post can be edited or not.
 * @param WP_Post $post             The post being checked.
 *
 * @return bool
 */
function use_block_editor_for_post( $use_block_editor, $post ) {

	return $use_block_editor;
}

add_filter( 'use_block_editor_for_post', __NAMESPACE__ . '\use_block_editor_for_post', 10, 2 );

/**
 * Filter the allowed block types for the editor.
 *
// Set limitions.
$allowed_block_types = array(
	'core/block', // Required for reusable blocks.
	'core/heading',
	'core/paragraph',
	'core/image',
	'core/list',
	'core/embed',
	'core/html',
	'core/shortcode',
	'core/template',
	'core/video',
	'core/columns',
);
 *
 * @uses acf_get_block_types()
 *
 * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $post                The post resource data.
 *
 * @return bool|array
 */
function allowed_block_types( $allowed_block_types, $post ) {

	// Include our ACF block types when limitions are set.
	if ( is_array( $allowed_block_types ) && function_exists( 'acf_get_block_types' ) ) {
		$allowed_block_types = array_merge( $allowed_block_types, array_keys( acf_get_block_types() ) );
	}

	return $allowed_block_types;
}

add_filter( 'allowed_block_types', __NAMESPACE__ . '\allowed_block_types', 10, 2 );

/**
 * Enqueue block assets for the editing interface
 */
function enqueue_block_editor_assets() {

	$theme         = wp_get_theme();
	$theme_version = $theme->get( 'Version' );

	$css_version = filemtime( get_template_directory() . '/dist/styles/editor.css' );
	wp_enqueue_style( 'my_theme-editor', get_template_directory_uri() . '/dist/styles/editor.css', array(), "{$theme_version}.{$css_version}" );
}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_assets' );
