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
     *
     * @link https://popper.js.org/
     */
    wp_enqueue_script('popper', get_template_directory_uri() . '/dist/scripts/popper.js', ['jquery'], '1.16.1', true);

    /**
     * Bootstrap
     *
     * @link https://getbootstrap.com/
     */
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/dist/scripts/bootstrap.js', ['jquery', 'popper'], '4.5.0', true);

    /**
     * Theme
     */
    wp_enqueue_style('my-theme-main', get_template_directory_uri() . '/dist/styles/main.css', [], MY_THEME_VERSION);
    wp_enqueue_script('my-theme-main', get_template_directory_uri() . '/dist/scripts/main.js', ['jquery'], MY_THEME_VERSION, true);

    /**
     * Comment Reply
     */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
