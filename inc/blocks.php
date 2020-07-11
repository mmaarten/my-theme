<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register block types.
 */
add_action('after_setup_theme', function () {
    $blocks = [
        //'Sample',
    ];
    foreach ($blocks as $block) {
        $classname = __NAMESPACE__ . '\\BlockTypes\\' . $block;
        $instance = new $classname;
        $instance->registerBlockType();
    }
});

/**
 * Enqueue block assets for front-end and editing interface.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('my-theme-blocks', get_template_directory_uri() . '/dist/styles/block-style.css', [], MY_THEME_VERSION);
});
