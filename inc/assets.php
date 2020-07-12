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
    wp_enqueue_script('popper', asset_path('scripts/popper.js'), [], null);

    /**
     * Bootstrap
     * @link https://getbootstrap.com/
     */
    wp_enqueue_script('bootstrap', asset_path('scripts/bootstrap.js'), ['jquery'], null, true);

    /**
     * OWL Carousel
     * @link https://owlcarousel2.github.io/OwlCarousel2/
     */
    wp_register_script('owl-carousel', asset_path('scripts/owl-carousel.js'), ['jquery'], null, true);
    wp_register_style('owl-carousel', asset_path('styles/owl-carousel.css'), [], null);

    /**
     * Fancy Box
     * @link http://fancyapps.com/fancybox/3/
     */
    wp_register_script('fancybox', asset_path('scripts/fancybox.js'), ['jquery'], null, true);
    wp_register_style('fancybox', asset_path('styles/fancybox.css'), [], null);

    /**
     * jQuery UI Theme
     * @link https://jqueryui.com/themeroller/
     */
    wp_register_style('jquery-ui-theme', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', [], '1.12.1');

    /**
     * Google Maps
     */
    $src = add_query_arg('key', config('google_maps_api_key'), 'https://maps.googleapis.com/maps/api/js');
    wp_register_script('google-maps', $src, [], false, true);

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
