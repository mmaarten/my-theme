<?php
/**
 * Setup
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Setup
 */
add_action('after_setup_theme', function () {

    /**
     * Starter Content.
     */
    add_theme_support('starter-content', [
        'widgets' => [
            'sidebar-left'  => [],
            'sidebar-right' => [],
        ],
    ]);

    /**
     * Make theme available for translation.
     * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
     */
    load_theme_textdomain('my-theme', get_template_directory() . '/languages');

    /**
     * Add default posts and comments RSS feed links to head.
     * @link https://codex.wordpress.org/Automatic_Feed_Links
     */
    add_theme_support('automatic-feed-links');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable support for Post Thumbnails on posts and pages.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    /**
     * Add support for core custom logo.
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo');

    /**
     * Add image sizes.
     * @link https://developer.wordpress.org/reference/functions/add_image_size/
     */
    add_image_size('my-theme-full-width', 1920, 1080, false);
});

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @link https://developer.wordpress.com/themes/content-width/
 * @global int $content_width
 */
add_action('after_setup_theme', function () {
    $GLOBALS['content_width'] = 1110;
}, 0);

/**
 * Modify the list of image sizes that are available in the WordPress Media Library.
 *
 * @param array $sizes List of image size names.
 * @return array
 */
add_filter('image_size_names_choose', function ($sizes) {

    return $sizes + [
        'my-theme-full-width' => __('Full Width', 'my-theme'),
    ];
}, PHP_INT_MAX);
