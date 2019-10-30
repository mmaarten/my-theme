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
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'useForPostType'], 10, 2);
        add_filter('allowed_block_types', [__CLASS__, 'allowedBlockTypes'], 10, 2);
    }

    /**
     * Setup
     */
    public static function setup()
    {
        // Set editor colors.
        if ($colors = Config::get('editor_colors')) {
            add_theme_support('editor-color-palette', $colors);
        }

        // Set editor font sizes.
        if ($font_sizes = Config::get('editor_font_sizes')) {
            add_theme_support('editor-font-sizes', $font_sizes);
        }

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Enable align 'wide' and 'full' block settings.
        if (Config::get('align_wide')) {
            add_theme_support('align-wide');
        }

        // Enable responsive embeds.
        if (Config::get('responsive_embeds')) {
            add_theme_support('responsive-embeds');
        }

        // Disable custom colors.
        if (Config::get('disable_custom_colors')) {
            add_theme_support('disable-custom-colors');
        }

        // Disable custom font sizes.
        if (Config::get('disable_custom_font_sizes')) {
            add_theme_support('disable-custom-font-sizes');
        }

        // Add editor normalization style.
        if ($style = Config::get('editor_style')) {
            add_theme_support('editor-styles');
            add_editor_style($style);
        }

        // Use dark editor style.
        if (Config::get('dark_editor_style')) {
            add_theme_support('dark-editor-style');
        }
    }

    /**
     * Filter whether a post is able to be edited in the block editor.
     *
     * @param bool   $use_block_editor Whether the post can be edited or not.
     * @param string $post_type        The post being checked.
     *
     * @return bool
     */
    public static function useForPostType($use_block_editor, $post_type)
    {
        $use_for = Config::get('use_block_editor_for_post_type');
        return ! empty($use_for[$post_type]);
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
        return Config::get('allowed_block_types');
    }
}
