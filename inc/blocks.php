<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register blocks.
 */
add_action('after_setup_theme', function () {
    $blocks = [
        'Button',
    ];
    foreach ($blocks as $class) {
        $class = __NAMESPACE__ . '\\BlockTypes\\' . $class;
        $instance = new $class();
        $instance->registerBlockType();
    }
});

add_action('enqueue_block_assets', function () {

    // Common.
    Assets::registerStyle(
        'my-theme-block-editor',
        get_template_directory_uri() . '/build/styles/block-editor.css',
        ['wp-edit-blocks']
    );
    Assets::registerStyle(
        'my-theme-block-style',
        get_template_directory_uri() . '/build/styles/block-style.css'
    );

    // Individual blocks
    Assets::registerScript(
        'my-theme-button-block',
        get_template_directory_uri() . '/build/scripts/block-button.js',
        [],
        true
    );
});
