<?php
/**
 * Jetpack
 *
 * @link https://jetpack.com/
 *
 * @package My/Theme
 */

namespace My\Theme;

class Jetpack
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
    }

    /**
     * Setup
     */
    public static function setup()
    {
        /**
         * Enabling Infinite Scroll
         *
         * @link https://jetpack.com/support/infinite-scroll/
         */
        add_theme_support('infinite-scroll', [
            'container' => 'main',
            'footer'    => 'page',
            'render' => [__CLASS__, 'renderInfiniteScroll'],
        ]);

        // Add theme support for Responsive Videos.
        add_theme_support('jetpack-responsive-videos');
    }

    /**
     * Render infinite scroll
     */
    public static function renderInfiniteScroll()
    {
        // Start the Loop.
        while (have_posts()) :
            // Setup postdata.
            the_post();

            // Include the template for the content.
            if (is_search()) {
                get_template_part('template-parts/loop', 'search');
            } else {
                get_template_part('template-parts/loop', get_post_type());
            }

            // End of the Loop.
        endwhile;
    }
}
