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
add_action('after_setup_theme', function () {
    // List of block type class names to register.
    $blocks = [
        'Sample',
    ];
    foreach ($blocks as $class) {
        $class = __NAMESPACE__ . '\\BlockTypes\\' . $class;
        $instance = new $class();
        $instance->registerBlockType();
    }
}, 10, 2);

/**
 * Register block assets
 */
add_action('init', function () {
    // Common
    register_style(
        'my-theme-block-editor',
        get_template_directory_uri() . '/build/styles/block-editor.css',
        ['wp-edit-blocks']
    );
    register_style(
        'my-theme-block-style',
        get_template_directory_uri() . '/build/styles/block-style.css'
    );

    /**
     * Individual blocks
     * @example
    register_script(
        'my-theme-block-sample',
        get_template_directory_uri() . '/build/scripts/block-sample.js'
    );
     */
});
