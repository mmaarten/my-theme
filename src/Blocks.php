<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Blocks
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('enqueue_block_assets', [__CLASS__, 'enqueueBlockAssets']);
    }

    /**
     * Enqueue block assets for front-end and editing interface.
     */
    public static function enqueueBlockAssets()
    {
        wp_enqueue_style('my-theme-blocks', get_template_directory_uri() . '/dist/styles/block-style.css', [], null);
    }
}
