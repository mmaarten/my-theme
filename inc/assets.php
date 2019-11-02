<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

add_action('wp_enqueue_scripts', function () {
    Assets::registerStyle(
        'my-theme-main',
        get_template_directory_uri() . '/build/styles/main.css'
    );

    Assets::registerScript(
        'my-theme-main',
        get_template_directory_uri() . '/build/scripts/main.js',
        ['jquery']
    );

    wp_enqueue_style('my-theme-main');
    wp_enqueue_script('my-theme-main');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
