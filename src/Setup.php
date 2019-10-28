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
         * If you're building a theme based on My Theme, use a find and replace
         * to change 'my-theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain(Config::get('textdomain', 'setup'), Config::get('languages_path', 'setup'));

        // Add default posts and comments RSS feed links to head.
        if (Config::get('automatic_feed_links', 'setup')) {
            add_theme_support('automatic-feed-links');
        }


        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        if (Config::get('title_tag', 'setup')) {
            add_theme_support('title-tag');
        }

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        if (Config::get('post_thumbnails', 'setup')) {
            add_theme_support('post-thumbnails');
        }

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', Config::get('html5', 'setup'));

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        if (Config::get('custom_logo', 'setup')) {
            add_theme_support('custom-logo');
        }

        /**
         * Add custom image sizes.
         */

        $image_sizes = Config::get('custom_image_sizes', 'setup');
        if (is_array($image_sizes)) {
            foreach ($image_sizes as $slug => $size) {
                $size = wp_parse_args($size, ['width' => 0, 'height' => 0, 'crop' => false]);
                add_image_size($slug, $size['width'], $size['height'], $size['crop']);
            }
        }
    }

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * @global int $content_width
     */
    public static function contentWidth()
    {
        $GLOBALS['content_width'] = Config::get('content_width', 'setup');
    }

    /**
     * Modify of the list of image sizes that are available in the WordPress Media Library.
     *
     * @param array $sizes List of image size names.
     *
     * @return array
     */
    public static function imageSizeNamesChoose($sizes)
    {
        $my_sizes = Config::get('image_size_names_choose', 'setup');
        if (is_array($my_sizes)) {
            $sizes = array_merge($sizes, $my_sizes);
        }

        return $sizes;
    }
}
