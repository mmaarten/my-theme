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

    /**
     * Popper
     */
    wp_enqueue_script('popper', asset_path('scripts/popper.js'), ['jquery'], null, true);

    /**
     * Bootstrap
     */
    wp_enqueue_script('bootstrap', asset_path('scripts/bootstrap.js'), ['jquery'], null, true);

    /**
     * Theme
     */
    wp_enqueue_style('my-theme-main', asset_path('styles/main.css'), [], null);
    wp_enqueue_script('my-theme-main', asset_path('scripts/main.js'), ['jquery'], null, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
