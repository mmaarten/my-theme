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
     * @link https://popper.js.org/
     */
    wp_enqueue_script('popper-js', asset_path('scripts/popper.js'), [], '1.16.1');

    /**
     * Bootstrap
     * @link https://getbootstrap.com/
     */
    wp_enqueue_script('bootstrap', asset_path('scripts/bootstrap.js'), ['jquery'], '4.5.0', true);

    /**
     * Theme
     */
    wp_enqueue_style('my-theme-main', asset_path('styles/main.css'), [], null);
    wp_enqueue_script('my-theme-main', asset_path('scripts/main.js'), ['jquery'], null, true);

    /**
     * Comment reply
     */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
