<?php
/**
 * Editor
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Editor features
 *
 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 */
add_action('after_setup_theme', function () {
    /**
     * Set editor colors.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
     */
    add_theme_support('editor-color-palette', [
        [
            'name'  => __('Primary', 'my-theme'),
            'slug'  => 'primary',
            'color' => '#007bff',
        ],
        [
            'name'  => __('Secondary', 'my-theme'),
            'slug'  => 'secondary',
            'color' => '#6c757d',
        ],
        [
            'name'  => __('Light', 'my-theme'),
            'slug'  => 'light',
            'color' => '#f8f9fa',
        ],
        [
            'name'  => __('Dark', 'my-theme'),
            'slug'  => 'dark',
            'color' => '#343a40',
        ],
    ]);

    /**
     * Set editor font sizes.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
     */
    add_theme_support('editor-font-sizes', [
        [
            'name'      => __('Small', 'my-theme'),
            'shortName' => __('SM', 'my-theme'),
            'size'      => 16 * 0.875,
            'slug'      => 'small',
        ],
        [
            'name'      => __('Normal', 'my-theme'),
            'shortName' => __('N', 'my-theme'),
            'size'      => 16,
            'slug'      => 'normal',
        ],
        [
            'name'      => __('Large', 'my-theme'),
            'shortName' => __('LG', 'my-theme'),
            'size'      => 16 * 1.25,
            'slug'      => 'large',
        ],
    ]);

    /**
     * Add support for Block Styles.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
     */
    add_theme_support('wp-block-styles');

    /**
     * Enable align 'wide' and 'full' block settings.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
     */
    add_theme_support('align-wide');

    /**
     * Enable responsive embeds.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Disable custom colors.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
     * @example add_theme_support('disable-custom-colors');
     */

    /**
     * Disable custom font sizes.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-font-sizes
     * @example add_theme_support('disable-custom-font-sizes');
     */

    /**
     * Enable editor styles
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
     */
     add_theme_support('editor-styles');

    /**
     * Set editor style.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
     */
    add_editor_style('build/styles/editor-styles.css');

    /**
     * Adjust the color of the UI to work on dark backgrounds.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#dark-backgrounds
     * @example add_theme_support('dark-editor-style');
     */
});

/**
 * Filter whether a post is able to be edited in the block editor.
 *
 * @link https://developer.wordpress.org/reference/hooks/use_block_editor_for_post_type/
 * @param bool   $use_block_editor Whether the post can be edited or not.
 * @param string $post_type        The post being checked.
 * @return bool
 */
add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
    return $use_block_editor;
}, 10, 2);

/**
 * Filter the allowed block types for the editor.
 *
 * @link https://developer.wordpress.org/reference/hooks/allowed_block_types/
 * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $post                The post resource data.
 * @return bool|array
 */
add_filter('allowed_block_types', function ($allowed_block_types, $post) {
    return $allowed_block_types;
}, 10, 2);
