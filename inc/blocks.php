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
        'Button',
        'Modal',
        'Carousel',
        'Gallery',
        'OWLCarousel',
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
    wp_enqueue_style('my-theme-blocks', asset_path('styles/block-style.css'), [], null);
});
