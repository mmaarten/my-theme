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
     * Owl Carousel
     * @link https://owlcarousel2.github.io/OwlCarousel2/
     */
    wp_register_script(
        'owl-carousel',
        get_template_directory_uri() . '/dist/scripts/owl-carousel.js',
        [],
        '2.3.4',
        true
    );

    wp_register_style(
        'owl-carousel',
        get_template_directory_uri() . '/dist/styles/owl-carousel.css',
        [],
        '2.3.4'
    );

    wp_register_style(
        'owl-carousel-theme',
        get_template_directory_uri() . '/dist/styles/owl-carousel-theme.css',
        [],
        MY_THEME_VERSION
    );

    /**
     * Fancybox
     * @link http://fancyapps.com/fancybox/3/
     */
    wp_register_script(
        'fancybox',
        get_template_directory_uri() . '/dist/scripts/fancybox.js',
        [],
        '3.5.7',
        true
    );

    wp_register_style(
        'fancybox',
        get_template_directory_uri() . '/dist/styles/fancybox.css',
        [],
        '3.5.7'
    );

    /**
     * jQuery UI Theme
     * @link https://jqueryui.com/themeroller/
     */
    wp_register_style(
        'jquery-ui-theme',
        'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        [],
        '1.12.1'
    );

    /**
     * Popper
     * @link https://popper.js.org/
     */
    wp_register_script(
        'popper-js',
        get_template_directory_uri() . '/dist/scripts/popper.js',
        [],
        '1.16.1',
        true
    );

    /**
     * Bootstrap
     * @link https://getbootstrap.com/
     */
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/dist/scripts/bootstrap.js',
        ['jquery', 'popper-js'],
        '4.5.0',
        true
    );

    /**
     * Theme
     */
    wp_enqueue_style(
        'my-theme-main',
        get_template_directory_uri() . '/dist/styles/main.css',
        [],
        MY_THEME_VERSION
    );

    wp_enqueue_script(
        'my-theme-main',
        get_template_directory_uri() . '/dist/scripts/main.js',
        ['jquery'],
        MY_THEME_VERSION,
        true
    );

    /**
     * Comment reply
     */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});
