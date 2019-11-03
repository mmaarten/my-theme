<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

function enqueue_assets()
{
    wp_enqueue_style(
        'my-theme-main',
        get_template_directory_uri() . '/build/styles/main.css'
    );

    wp_enqueue_script(
        'my-theme-main',
        get_template_directory_uri() . '/build/scripts/main.js',
        ['jquery'],
        false,
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets');

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\apply_asset_data', PHP_INT_MAX);
