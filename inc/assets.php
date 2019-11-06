<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('my-theme-main', asset_path('styles/main.css'), [], null);
    wp_enqueue_script('my-theme-main', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});