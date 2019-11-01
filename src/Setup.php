<?php
/**
 * Setup
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Setup
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_action('after_setup_theme', [__CLASS__, 'contentWidth'], 0);
        add_filter('image_size_names_choose', [__CLASS__, 'imageSizeNamesChoose']);
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public static function setup()
    {
        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
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
         * Switch default core markup to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ]);

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo');

        /**
         * Add custom image sizes.
         *
         * @example add_image_size('my-theme-sample', 800, 600, false);
         */
    }

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * @global int $content_width
     */
    public static function contentWidth()
    {
        $GLOBALS['content_width'] = 1110;
    }

    /**
     * Modify the list of image sizes that are available in the WordPress Media Library.
     *
     * @param array $sizes List of image size names.
     *
     * @return array
     */
    public static function imageSizeNamesChoose($sizes)
    {
        return $sizes;
    }
}
