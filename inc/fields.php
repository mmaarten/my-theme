<?php
/**
 * Fields
 *
 * Dependency: Advanced Custom Fields
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Populate field choices with editor color names.
 *
 * Usage: Add field CSS class 'my-theme-editor-colors-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function editor_colors_field( $field ) {

	// Check field CSS class.
	if ( ! preg_match( '/(^| )my-theme-editor-colors-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	// Check theme support.
	if ( ! current_theme_supports( 'editor-color-palette' ) ) {
		return $field;
	}

	// Get feature arguments.
	$args = get_theme_support( 'editor-color-palette' );

	// Add field choices.
	$field['choices'] = wp_list_pluck( $args[0], 'name', 'slug' );

	// Return.
	return $field;
}

add_action( 'acf/load_field/type=select', __NAMESPACE__ . '\editor_colors_field' );

/**
 * Populate field choices with editor font size names.
 *
 * Usage: Add field CSS class 'my-theme-editor-font-sizes-field'.
 *
 * @param array $field The field settings.
 *
 * @return array
 */
function editor_font_sizes_field( $field ) {

	// Check field CSS class.
	if ( ! preg_match( '/(^| )my-theme-editor-font-sizes-field( |$)/', $field['wrapper']['class'] ) ) {
		return $field;
	}

	// Check theme support.
	if ( ! current_theme_supports( 'editor-font-sizes' ) ) {
		return $field;
	}

	// Get feature arguments.
	$args = get_theme_support( 'editor-font-sizes' );

	// Add field choices.
	$field['choices'] = wp_list_pluck( $args[0], 'name', 'slug' );

	// Return.
	return $field;
}

add_action( 'acf/load_field/type=select', __NAMESPACE__ . '\editor_font_sizes_field' );
