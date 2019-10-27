<?php
/**
 * Setup
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function setup()
{
    /**
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on My Theme, use a find and replace
     * to change 'my-theme' to the name of your theme in all the template files.
     */
    load_theme_textdomain('my-theme', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /**
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /**
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]
    );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo');

    // Add custom image sizes.
    add_image_size('my-theme-full-width', 1920, 1080);
}

add_action('after_setup_theme', __NAMESPACE__ . '\setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function content_width()
{
    $GLOBALS['content_width'] = apply_filters('my_theme/content_width', 1100);
}

add_action('after_setup_theme', __NAMESPACE__ . '\content_width', 0);

/**
 * Modify of the list of image sizes that are available in the WordPress Media Library.
 *
 * @param array $sizes List of image size names.
 *
 * @return array
 */
function image_size_names_choose($sizes)
{
    return $sizes + [
        'my-theme-full-width' => __('Full Page Width', 'my-theme'),
    ];
}

add_filter('image_size_names_choose', __NAMESPACE__ . '\image_size_names_choose');
