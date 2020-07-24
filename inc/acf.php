<?php
/**
 * ACF
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Update Settings
 */
add_action('acf/init', function () {
    if (function_exists('acf_update_setting')) {
        // acf_update_setting('google_api_key', 'xxx');
    }
});

/**
 * Add Options Page
 */
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title'  => __('Site Options', 'my-theme'),
            'menu_title'  => __('Site Options', 'my-theme'),
            'menu_slug'   => 'theme-options',
            'parent_slug' => null,
        ]);
    }
});

/**
 * Alter field settings
 *
 * @param array $field
 * @return array
 */
add_filter('acf/load_field', function ($field) {

    // Populate select field with editor color names. Usage: set field CSS class to my-theme-editor-colors.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-editor-colors( |$)/', $field['wrapper']['class'])) {
        if (current_theme_supports('editor-color-palette')) {
            $field['choices'] = wp_list_pluck(get_theme_support('editor-color-palette')[0], 'name', 'slug');
        }
    }

    // Populate select field with editor font size names. Usage: set field CSS class to my-theme-editor-font-sizes.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-editor-font-sizes( |$)/', $field['wrapper']['class'])) {
        if (current_theme_supports('editor-font-sizes')) {
            $field['choices'] = wp_list_pluck(get_theme_support('editor-font-sizes')[0], 'name', 'slug');
        }
    }

    // Populate select field with image size names. Usage: set field CSS class to my-theme-image-sizes.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-image-sizes( |$)/', $field['wrapper']['class'])) {
        $field['choices'] = apply_filters('image_size_names_choose', [
            'thumbnail' => __('Thumbnail', 'my-theme'),
            'medium'    => __('Medium', 'my-theme'),
            'large'     => __('Large', 'my-theme'),
            'full'      => __('Full Size', 'my-theme'),
        ]);
    }

    // Populate select field with icon names. Usage: set field CSS class to my-theme-icons.
    if ($field['type'] == 'select' && preg_match('/(^| )my-theme-icons( |$)/', $field['wrapper']['class'])) {
        $choices = [];
        $icons = get_icons();
        foreach ($icons as $key => $svg) {
            $choices[$key] = ucwords(str_replace(['-', '_'], ' ', $key));
        }
        $field['choices'] = $choices;
    }

    return $field;
}, PHP_INT_MAX);
