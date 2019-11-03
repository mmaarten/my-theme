<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

function enqueue_assets()
{
    Assets::registerStyle('my-theme-main', get_template_directory_uri() . '/build/styles/main.css');
    wp_enqueue_style('my-theme-main');

    Assets::registerScript('my-theme-main', get_template_directory_uri() . '/build/scripts/main.js', ['jquery']);
    wp_enqueue_script('my-theme-main');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets');
