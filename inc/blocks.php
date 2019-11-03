<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register block types
 */
function register_block_types()
{
    // List of block type class names.
    $blocks = [
        'Sample',
    ];
    foreach ($blocks as $class) {
        $class = __NAMESPACE__ . '\\BlockTypes\\' . $class;
        $instance = new $class();
        $instance->registerBlockType();
    }
}
add_action('after_setup_theme', __NAMESPACE__ . '\register_block_types', 10, 2);

/**
 * Register block assets
 */
function register_block_assets()
{
    // Common
    Assets::registerStyle(
        'my-theme-block-editor',
        get_template_directory_uri() . '/build/styles/block-editor.css',
        ['wp-edit-blocks']
    );
    Assets::registerStyle(
        'my-theme-block-style',
        get_template_directory_uri() . '/build/styles/block-style.css'
    );

    /**
     * Individual blocks
     * @example
    Assets::registerScript(
        'my-theme-block-sample',
        get_template_directory_uri() . '/build/scripts/block-sample.js'
    );
     */

    Assets::registerScript(
        'my-theme-block-sample',
        get_template_directory_uri() . '/build/scripts/block-sample.js'
    );
}
add_action('enqueue_block_assets', __NAMESPACE__ . '\register_block_assets');
