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
     * Initialize
     */
    public static function init()
    {
        add_action('enqueue_block_assets', [__CLASS__, 'enqueueAssets']);
    }

    /**
     * Fires after enqueuing block assets for both editor and front-end.
     */
    public static function enqueueAssets()
    {
        wp_enqueue_style(
            'my-theme-blocks',
            get_template_directory_uri() . '/build/styles/blocks.css',
            wp_get_theme('my-theme')->get('Version')
        );
    }
}
