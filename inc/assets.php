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
        get_template_directory_uri() . '/build/styles/main.css',
        wp_get_theme('my-theme')->get('Version')
    );

    wp_enqueue_script(
        'my-theme-main',
        get_template_directory_uri() . '/build/scripts/main.js',
        wp_get_theme('my-theme')->get('Version')
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets');

function cache_buster($src, $handle)
{
    $base_url = get_template_directory_uri();
    $base_path = get_template_directory();

    if (0 !== stripos($src, $base_url)) {
        return $src;
    }

    if (false !== ($pos = strrpos($src, '?'))) {
        $query = substr($src, $pos + 1);
        $without_query = substr($src, 0, -strlen($query) - 1);
        $query = parse_url($query);
    } else {
        $query = [];
        $without_query = $src;
    }

    $file = str_replace($base_url, $base_path, $without_query);
    if (! file_exists($file)) {
        return $src;
    }

    $query['cache'] = filemtime($file);

    return $without_query . '?' . http_build_query($query);
}

add_filter('style_loader_src', __NAMESPACE__ . '\cache_buster', 999, 2);
add_filter('script_loader_src', __NAMESPACE__ . '\cache_buster', 999, 2);
