<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Enqueue block assets
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('my-theme-blocks', asset_path('styles/block-style.css'), [], null);
});
