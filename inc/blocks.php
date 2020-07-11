<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Enqueue block assets for front-end and editing interface.
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('my-theme-blocks', get_template_directory_uri() . 'styles/block-style.css', [], null);
});
