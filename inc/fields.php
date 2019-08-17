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
 * Usage: Add field CSS class 'my-theme-editor-colors-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function editor_color_names_field( $field ) {

	if ( ! preg_match( '/(^| )my-theme-editor-colors-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	if ( ! current_theme_supports( 'editor-color-palette' ) ) {
		return $field;
	}

	$settings = get_theme_support( 'editor-color-palette' );

	$field['choices'] = wp_list_pluck( $settings[0], 'name', 'slug' );

	return $field;
}

add_filter( 'acf/load_field/type=select', __NAMESPACE__ . '\editor_color_names_field' );

/**
 * Populate select field with editor font size names.
 *
 * Usage: Add field CSS class 'my-theme-editor-font-sizes-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function editor_font_sizes_field( $field ) {

	if ( ! preg_match( '/(^| )my-theme-editor-font-sizes-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	if ( ! current_theme_supports( 'editor-font-sizes' ) ) {
		return $field;
	}

	$settings = get_theme_support( 'editor-font-sizes' );

	$field['choices'] = wp_list_pluck( $settings[0], 'name', 'slug' );

	return $field;
}

add_filter( 'acf/load_field/type=select', __NAMESPACE__ . '\editor_font_sizes_field' );

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
