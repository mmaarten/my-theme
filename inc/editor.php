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
function block_editor_setup()
{
    // Set editor colors.
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name'  => __('Primary', 'my-theme'),
                'slug'  => 'primary',
                'color' => '#007bff', // Value of $primary.
            ],
            [
                'name'  => __('Secondary', 'my-theme'),
                'slug'  => 'secondary',
                'color' => '#6c757d', // Value of $secondary.
            ],
            [
                'name'  => __('Light', 'my-theme'),
                'slug'  => 'light',
                'color' => '#f8f9fa', // Value of $light.
            ],
            [
                'name'  => __('Dark', 'my-theme'),
                'slug'  => 'dark',
                'color' => '#343a40', // Value of $dark.
            ],
        ]
    );

    // Set editor font sizes.
    // 'normal' slug is required to set default font size.
    add_theme_support(
        'editor-font-sizes',
        [
            [
                'name'      => __('Small', 'my-theme'),
                'shortName' => __('SM', 'my-theme'),
                'size'      => 16 * 0.875, // Value of $font-size-sm.
                'slug'      => 'small',
            ],
            [
                'name'      => __('Normal', 'my-theme'),
                'shortName' => __('N', 'my-theme'),
                'size'      => 16, // Value of $font-size-base.
                'slug'      => 'normal',
            ],
            [
                'name'      => __('Large', 'my-theme'),
                'shortName' => __('LG', 'my-theme'),
                'size'      => 16 * 1.25, // Value of $font-size-lg.
                'slug'      => 'large',
            ],
        ]
    );

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Enable align 'wide' and 'full' block settings.
    add_theme_support('align-wide');

    // Enable responsive embeds.
    add_theme_support('responsive-embeds');
}

add_action('after_setup_theme', __NAMESPACE__ . '\block_editor_setup');

/**
 * Block editor settings.
 *
 * @param array $settings
 *
 * @return array
 */
function block_editor_settings($settings)
{
    // Styles.
    $styles_file = get_template_directory() . '/build/styles/editor-styles.css';
    if (file_exists($styles_file)) {
        $settings['styles'][] = ['css' => file_get_contents($styles_file)];
    }

    // Return.
    return $settings;
}

add_filter('block_editor_settings', __NAMESPACE__ . '\block_editor_settings');

/**
 * Filter whether a post is able to be edited in the block editor.
 *
 * @param bool    $use_block_editor Whether the post can be edited or not.
 * @param WP_Post $post             The post being checked.
 *
 * @return bool
 */
function use_block_editor_for_post($use_block_editor, $post)
{
    return $use_block_editor;
}

add_filter('use_block_editor_for_post', __NAMESPACE__ . '\use_block_editor_for_post', 10, 2);

/**
 * Filter the allowed block types for the editor.
 *
 * @uses acf_get_block_types()
 *
 * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $post                The post resource data.
 *
 * @return bool|array
 */
function allowed_block_types($allowed_block_types, $post)
{
    return $allowed_block_types;
}

add_filter('allowed_block_types', __NAMESPACE__ . '\allowed_block_types', 10, 2);
