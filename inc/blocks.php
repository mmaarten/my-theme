<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register block types.
 */
function register_block_types()
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

add_action('after_setup_theme', __NAMESPACE__ . '\register_block_types', 0);

/**
 * Enqueue block assets for front-end and editing interface.
 */
function enqueue_block_assets()
{
    wp_enqueue_style('my-theme-blocks', get_template_directory_uri() . '/dist/styles/blocks.css', [], MY_THEME_VERSION);

    /**
     * Disable WordPress front-end styling
     * @example wp_dequeue_style('wp-block-library');
     */
}

add_action('enqueue_block_assets', __NAMESPACE__ . '\enqueue_block_assets');

/**
 * Enqueued block assets for the editing interface.
 */
function enqueue_block_editor_assets()
{
    wp_enqueue_style('my-theme-editor', get_template_directory_uri() . '/dist/styles/editor.css', [], MY_THEME_VERSION);
}

add_action('enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_block_editor_assets');

/**
 * Filter whether a post is able to be edited in the block editor.
 *
 * @param bool   $use_block_editor Whether the post can be edited or not.
 * @param string $post_type        The post being checked.
 * @return bool
 */
function use_block_editor_for_post_type($use_block_editor, $post_type)
{
    return $use_block_editor;
}

add_filter('use_block_editor_for_post_type', __NAMESPACE__ . '\use_block_editor_for_post_type', PHP_INT_MAX, 2);

/**
 * Filter the allowed block types for the editor.
 *
 * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $post                The post resource data.
 * @return bool|array
 */
function allowed_block_types($allowed_block_types, $post)
{
    return $allowed_block_types;
}

add_filter('allowed_block_types', __NAMESPACE__ . '\allowed_block_types', PHP_INT_MAX, 2);
