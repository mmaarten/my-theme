<?php
/**
 * Editor
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Editor
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_filter('use_block_editor_for_post', [__CLASS__, 'useForPost'], 10, 2);
        add_filter('allowed_block_types', [__CLASS__, 'allowedBlockTypes'], 10, 2);
    }

    /**
     * Setup
     */
    public static function setup()
    {
        // Set editor colors.
        add_theme_support('editor-color-palette', [
            [
                'name'  => __('Primary', 'my-theme'),
                'slug'  => 'primary',
                'color' => '#007bff', // Value of `$primary`.
            ],
            [
                'name'  => __('Secondary', 'my-theme'),
                'slug'  => 'secondary',
                'color' => '#6c757d', // Value of `$secondary`.
            ],
            [
                'name'  => __('Light', 'my-theme'),
                'slug'  => 'light',
                'color' => '#f8f9fa', // Value of `$light`.
            ],
            [
                'name'  => __('Dark', 'my-theme'),
                'slug'  => 'dark',
                'color' => '#343a40', // Value of `$dark`.
            ],
        ]);

        // Set editor font sizes.
        add_theme_support('editor-font-sizes', [
            [
                'name'      => __('Small', 'my-theme'),
                'shortName' => __('SM', 'my-theme'),
                'size'      => 16 * 0.875, // Value of `$font-size-sm`.
                'slug'      => 'small',
            ],
            [
                'name'      => __('Normal', 'my-theme'),
                'shortName' => __('N', 'my-theme'),
                'size'      => 16, // Value of `$font-size-base`.
                'slug'      => 'normal',
            ],
            [
                'name'      => __('Large', 'my-theme'),
                'shortName' => __('LG', 'my-theme'),
                'size'      => 16 * 1.25, // Value of `$font-size-lg`.
                'slug'      => 'large',
            ],
        ]);

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Enable align 'wide' and 'full' block settings.
        add_theme_support('align-wide');

        // Enable responsive embeds.
        add_theme_support('responsive-embeds');

        // Disable custom colors.
        // add_theme_support('disable-custom-colors');

        // Disable custom font sizes.
        // add_theme_support('disable-custom-font-sizes');

        // Add editor normalization style.
        add_theme_support('editor-styles');
        add_editor_style('build/styles/editor-styles.css');

        // Use dark editor style.
        // add_theme_support('dark-editor-style');
    }

    /**
     * Filter whether a post is able to be edited in the block editor.
     *
     * @param bool   $use_block_editor Whether the post can be edited or not.
     * @param string $post             The post being checked.
     *
     * @return bool
     */
    public static function useForPost($use_block_editor, $post)
    {
        return $use_block_editor;
    }

    /**
     * Filter the allowed block types for the editor.
     *
     * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
     * @param object     $post                The post resource data.
     *
     * @return bool|array
     */
    public static function allowedBlockTypes($allowed_block_types, $post)
    {
        return $allowed_block_types;
    }
}
