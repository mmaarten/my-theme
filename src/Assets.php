<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

class Assets
{
    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);
    }

    /**
     * Enqueue scripts and styles.
     */
    public function enqueueScripts()
    {
        /**
         * Popper
         * @link https://popper.js.org/
         */
        wp_enqueue_script('popper-js', get_template_directory_uri() . '/dist/scripts/popper.js', [], '1.16.1');

        /**
         * Bootstrap
         * @link https://getbootstrap.com/
         */
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/dist/scripts/bootstrap.js', ['jquery'], '4.5.0', true);

        /**
         * Theme
         */
        wp_enqueue_style('my-theme-main', get_template_directory_uri() . '/dist/styles/main.css', [], MY_THEME_VERSION);
        wp_enqueue_script('my-theme-main', get_template_directory_uri() . '/dist/scripts/main.js', ['jquery'], MY_THEME_VERSION, true);

        /**
         * Comment reply
         */
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
