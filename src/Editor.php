<?php
/**
 * Editor
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Editor
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('enqueue_block_editor_assets', [__CLASS__, 'enqueueBlockEditorAssets']);
        add_filter('use_block_editor_for_post_type', [__CLASS__, 'useBlockEditorForPostType'], PHP_INT_MAX, 2);
        add_filter('allowed_block_types', [__CLASS__, 'allowedBlockTypes'], PHP_INT_MAX, 2);
    }

    /**
     * Enqueued block assets for the editing interface.
     *
     * @link https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
     */
    public static function enqueueBlockEditorAssets()
    {
    }

    /**
     * Filter whether a post is able to be edited in the block editor.
     *
     * @link https://developer.wordpress.org/reference/hooks/use_block_editor_for_post_type/
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
     * @link https://developer.wordpress.org/reference/hooks/allowed_block_types/
     * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
     * @param object     $post                The post resource data.
     * @return bool|array
     */
    public static function allowedBlockTypes($allowed_block_types, $post)
    {
        return $allowed_block_types;
    }
}
