<?php
/**
 * Blocks
 *
 * @package My\Theme
 */

namespace My\Theme;

class Blocks
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerBlockTypes'], 0);
        add_action('enqueue_block_assets', [__CLASS__, 'enqueueBlockAssets']);
        add_action('enqueue_block_editor_assets', [__CLASS__, 'enqueueBlockEditorAssets']);
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'useBlockEditorForPostType'], PHP_INT_MAX, 2);
        add_filter('allowed_block_types', [__CLASS__, 'allowedBlockTypes'], PHP_INT_MAX, 2);
    }

    /**
     * Register block types.
     */
    public static function registerBlockTypes()
    {
        $blocks = [
          'Buttons',
          'Carousel',
          'Modal',
          'Spacer',
        ];
        foreach ($blocks as $block) {
            $classname = __NAMESPACE__ . '\\BlockTypes\\' . $block;
            $instance = new $classname;
            $instance->registerBlockType();
        }
    }

    /**
     * Enqueue block assets for front-end and editing interface.
     */
    public static function enqueueBlockAssets()
    {
        wp_enqueue_style(
            'my-theme-blocks',
            get_template_directory_uri() . '/dist/styles/blocks.css',
            [],
            MY_THEME_VERSION
        );

        /**
         * Disable WordPress front-end styling
         */
        // wp_dequeue_style('wp-block-library');
    }

    /**
     * Enqueued block assets for the editing interface.
     */
    public static function enqueueBlockEditorAssets()
    {
        wp_enqueue_style(
            'my-theme-editor',
            get_template_directory_uri() . '/dist/styles/editor.css',
            [],
            MY_THEME_VERSION
        );
    }

    /**
     * Filter whether a post is able to be edited in the block editor.
     *
     * @param bool   $use_block_editor Whether the post can be edited or not.
     * @param string $post_type        The post being checked.
     * @return bool
     */
    public static function useBlockEditorForPostType($use_block_editor, $post_type)
    {
        return $use_block_editor;
    }

    /**
     * Filter the allowed block types for the editor.
     *
     * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
     * @param object     $post                The post resource data.
     * @return bool|array
     */
    public static function allowedBlockTypes($allowed_block_types, $post)
    {
        return $allowed_block_types;
    }
}
