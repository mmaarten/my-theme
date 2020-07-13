<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

class Blocks
{
    public function init()
    {
        add_action('after_setup_theme', [$this, 'registerBlockTypes']);
        add_action('enqueue_block_assets', [$this, 'enqueueBlockAssets']);
        add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);
        add_filter('use_block_editor_for_post_type', [$this, 'useBlockEditorForPostType'], PHP_INT_MAX, 2);
        add_filter('allowed_block_types', [$this, 'allowedBlockTypes'], PHP_INT_MAX, 2);
    }

    /**
     * Register block types.
     */
    public function registerBlockTypes()
    {
        $blocks = [
            'Button',
            'Carousel',
            'Gallery',
            'Modal',
            'OWLCarousel',
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
    public function enqueueBlockAssets()
    {
        wp_enqueue_style('my-theme-blocks', asset_path('styles/block-style.css'), [], null);
    }

    /**
     * Enqueued block assets for the editing interface.
     */
    public function enqueueBlockEditorAssets()
    {
        wp_enqueue_style('my-theme-editor', asset_path('styles/editor.css'), [], null);
    }

    /**
     * Filter whether a post is able to be edited in the block editor.
     *
     * @param bool   $use_block_editor Whether the post can be edited or not.
     * @param string $post_type        The post being checked.
     * @return bool
     */
    public function useBlockEditorForPostType($use_block_editor, $post_type)
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
    public function allowedBlockTypes($allowed_block_types, $post)
    {
        return $allowed_block_types;
    }
}
