<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

add_action('wp_enqueue_scripts', function () {

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
});

add_action('wp_enqueue_scripts', function () {
    $collections = [wp_scripts(), wp_styles()];
    foreach ($collections as $collection) {
        foreach ($collection->registered as $key => $asset) {
            // Check if inside theme directory.
            if (0 !== stripos($asset->src, get_template_directory_uri() . '/build/')) {
                continue;
            }
            // Apply asset.
            $data = get_asset($asset->src);
            $asset->deps = $asset->deps + $data['dependencies'];
            $asset->ver = $data['version'];
            // Update
            $collection->registered[$key] = $asset;
        }
    }
}, PHP_INT_MAX);
