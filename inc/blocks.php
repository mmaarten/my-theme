<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Fires after enqueuing block assets for both editor and front-end.
 */
function enqueue_block_assets()
{
    $theme         = wp_get_theme();
    $theme_version = $theme->get('Version');

    $css_version = filemtime(get_template_directory() . '/build/styles/block-styles.css');
    wp_enqueue_style(
        'my_theme-block-styles',
        get_template_directory_uri() . '/build/styles/block-styles.css',
        [],
        "{$theme_version}.{$css_version}"
    );
}

add_action('enqueue_block_assets', __NAMESPACE__ . '\enqueue_block_assets');
