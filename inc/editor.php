<?php

namespace My\Theme;

/**
 * Enqueued block assets for the editing interface.
 *
 * @link https://developer.wordpress.org/reference/hooks/enqueue_block_editor_assets/
 * @example wp_enqueue_style('my-theme-editor', asset_path('dist/styles/editor.css'), [], null);
 * @example wp_enqueue_script('my-theme-editor', asset_path('dist/scripts/editor.js'), [], null);
 */
add_action('enqueue_block_editor_assets', function () {
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
