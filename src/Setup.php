<?php
/**
 * Setup
 *
 * @package My/Theme
 */

namespace My\Theme;

class Setup
{
    public function init()
    {
        add_action('after_setup_theme', [$this, 'setup']);
        add_action('after_setup_theme', [$this, 'setContentWidth']);
        add_filter('image_size_names_choose', [$this, 'imageSizeNamesChoose'], PHP_INT_MAX);
    }

    public function setup()
    {
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
         * Enable selective refresh for widgets in customizer
         * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
         */
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Set editor colors.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes
         */
        add_theme_support('editor-color-palette', [
            [
                'name'  => __('Primary', 'my-theme'),
                'slug'  => 'primary',
                'color' => '#007bff',
            ],
            [
                'name'  => __('Secondary', 'my-theme'),
                'slug'  => 'secondary',
                'color' => '#6c757d',
            ],
            [
                'name'  => __('Light', 'my-theme'),
                'slug'  => 'light',
                'color' => '#f8f9fa',
            ],
            [
                'name'  => __('Dark', 'my-theme'),
                'slug'  => 'dark',
                'color' => '#343a40',
            ],
        ]);

        /**
         * Set editor font sizes.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-font-sizes
         */
        add_theme_support('editor-font-sizes', [
            [
                'name'      => __('Small', 'my-theme'),
                'shortName' => __('SM', 'my-theme'),
                'size'      => 16 * 0.875,
                'slug'      => 'small',
            ],
            [
                'name'      => __('Normal', 'my-theme'),
                'shortName' => __('N', 'my-theme'),
                'size'      => 16,
                'slug'      => 'normal',
            ],
            [
                'name'      => __('Large', 'my-theme'),
                'shortName' => __('LG', 'my-theme'),
                'size'      => 16 * 1.25,
                'slug'      => 'large',
            ],
        ]);

        /**
         * Add support for Block Styles.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
         */
        add_theme_support('wp-block-styles');

        /**
         * Enable align 'wide' and 'full' block settings.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
         */
        add_theme_support('align-wide');

        /**
         * Enable responsive embeds.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content
         */
        add_theme_support('responsive-embeds');

        /**
         * Disable custom colors.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-colors-in-block-color-palettes
         * @example add_theme_support('disable-custom-colors');
         */

        /**
         * Disable custom font sizes.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-custom-font-sizes
         * @example add_theme_support('disable-custom-font-sizes');
         */

        /**
         * Enable editor styles
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
         */
        add_theme_support('editor-styles');

        /**
         * Add editor style.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
         */
        add_editor_style(get_template_directory_uri() . '/dist/styles/editor-style.css');

        /**
         * Adjust the color of the UI to work on dark backgrounds.
         * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#dark-backgrounds
         * @example add_theme_support('dark-editor-style');
         */

        /**
         * Register nav menu locations.
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus([
            'top-left'     => esc_html__('Top Left', 'my-theme'),
            'top-right'    => esc_html__('Top Right', 'my-theme'),
            'main-left'    => esc_html__('Primary Left', 'my-theme'),
            'main-right'   => esc_html__('Primary Right', 'my-theme'),
            'footer-left'  => esc_html__('Footer Left', 'my-theme'),
            'footer-right' => esc_html__('Footer Right', 'my-theme'),
        ]);

        /**
         * Add image sizes.
         * @link https://developer.wordpress.org/reference/functions/add_image_size/
         * @example add_image_size('my-image-size', 800, 600, false);
         */
        add_image_size('my-theme-full-width', 1920, 1080, false);
    }

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * @link https://developer.wordpress.com/themes/content-width/
     * @global int $content_width
     */
    public function setContentWidth()
    {
        $GLOBALS['content_width'] = 1110;
    }

    /**
     * Modify the list of image sizes that are available in the WordPress Media Library.
     *
     * @param array $sizes List of image size names.
     * @return array
     */
    public function imageSizeNamesChoose($sizes)
    {
        return $sizes + [
            'my-theme-full-width' => __('Full Width', 'my-theme'),
        ];
    }
}
