<?php
/**
 * Fields
 *
 * Dependency: Advanced Custom Fields
 *
 * @link https://www.advancedcustomfields.com
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Populate select field with editor color names.
 *
 * Usage: Add field CSS class 'my-theme-colors-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function colors_field( $field ) {

	if ( ! preg_match( '/(^| )my-theme-colors-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	if ( ! current_theme_supports( 'editor-color-palette' ) ) {
		return $field;
	}

	$settings = get_theme_support( 'editor-color-palette' );

	$field['choices'] = wp_list_pluck( $settings[0], 'name', 'slug' );

	return $field;
}

add_filter( 'acf/load_field/type=select', __NAMESPACE__ . '\colors_field' );

/**
 * Populate select field with editor font size names.
 *
 * Usage: Add field CSS class 'my-theme-font-sizes-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function font_sizes_field( $field ) {

	if ( ! preg_match( '/(^| )my-theme-font-sizes-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	if ( ! current_theme_supports( 'editor-font-sizes' ) ) {
		return $field;
	}

	$settings = get_theme_support( 'editor-font-sizes' );

	$field['choices'] = wp_list_pluck( $settings[0], 'name', 'slug' );

	return $field;
}

add_filter( 'acf/load_field/type=select', __NAMESPACE__ . '\font_sizes_field' );

/**
 * Populate select field with image size names.
 *
 * Usage: Add field CSS class 'my-theme-image-sizes-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function image_sizes_field( $field ) {

	if ( ! preg_match( '/(^| )my-theme-image-sizes-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	$field['choices'] = apply_filters(
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
		'image_size_names_choose',
		array(
			'thumbnail' => __( 'Thumbnail', 'my-theme' ),
			'medium'    => __( 'Medium', 'my-theme' ),
			'large'     => __( 'Large', 'my-theme' ),
			'full'      => __( 'Full', 'my-theme' ),
		)
	);

	return $field;
}

add_filter( 'acf/load_field/type=select', __NAMESPACE__ . '\image_sizes_field' );
