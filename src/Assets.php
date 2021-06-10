<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

class Assets
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueScripts']);
    }

    /**
     * Enqueue scripts ands styles
     */
    public static function enqueueScripts()
    {
        /**
         * Popper
         * @link https://popper.js.org/
         */
        self::enqueueScript(
            'popper-js',
            get_theme_file_uri('build/popper.js')
        );

       /**
        * Bootstrap
        * @link https://getbootstrap.com/
        */
        self::enqueueScript(
            'bootstrap',
            get_theme_file_uri('build/bootstrap.js'),
            ['jquery', 'popper-js']
        );

       /**
        * Theme
        */
        self::enqueueStyle(
            'my-theme-main-style',
            get_theme_file_uri('build/main-style.css')
        );

        self::enqueueScript(
            'my-theme-main-script',
            get_theme_file_uri('build/main-script.js'),
            ['jquery', 'bootstrap']
        );

        /**
         * Comment reply
         */
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    public static function registerScript($handle, $src, $deps = [], $has_i18n = false)
    {
        $asset = self::getAsset($src);

        wp_register_script($handle, $src, $asset['dependencies'] + $deps, $asset['version'], true);

        if ($has_i18n) {
            wp_set_script_translations($handle, 'my-theme', get_template_directory() . '/languages');
        }
    }

    public static function registerStyle($handle, $src, $deps = [], $media = 'all')
    {
        $asset = self::getAsset($src);

        wp_register_style($handle, $src, $deps, $asset['version'], $media);
    }

    public static function enqueueScript($handle, $src = '', $deps = [], $has_i18n = true)
    {
        if (! wp_script_is($handle, 'registered')) {
            self::registerScript($handle, $src, $deps, $has_i18n);
        }

        wp_enqueue_script($handle);
    }

    public static function enqueueStyle($handle, $src = '', $deps = [], $media = 'all')
    {
        if (! wp_style_is($handle, 'registered')) {
            self::registerStyle($handle, $src, $deps, $media);
        }

        wp_enqueue_style($handle);
    }

    public static function getAsset($src)
    {
        $path = str_replace(WP_CONTENT_URL, WP_CONTENT_DIR, $src);
        $file = str_replace(['.js', '.css'], '.asset.php', $path);

        if (file_exists($file)) {
            return require $file;
        }

        return [
            'dependencies' => [],
            'version'      => wp_get_theme('my-theme')->version,
        ];
    }
}
