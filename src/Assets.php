<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Assets
{
    public static function init()
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueAssets']);
        add_filter('style_loader_src', [__CLASS__, 'cacheBuster'], PHP_INT_MAX, 2);
        add_filter('script_loader_src', [__CLASS__, 'cacheBuster'], PHP_INT_MAX, 2);
    }

    public static function enqueueAssets()
    {
        wp_enqueue_style(
            'my-theme-main',
            get_template_directory_uri() . '/build/styles/main.css',
            [],
            wp_get_theme('my-theme')->get('Version')
        );

        wp_enqueue_script(
            'my-theme-main',
            get_template_directory_uri() . '/build/scripts/main.js',
            ['jquery'],
            wp_get_theme('my-theme')->get('Version')
        );

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    /**
     * Cache buster
     *
     * During build process a hash is added to the asset filename.
     * Therefore we need to replace the registered filename with the actual filename.
     * The mapping is described in /build/assets.json
     *
     * @param $src The file URL.
     * @param $handle The handle.
     * @return string
     */
    public static function cacheBuster($src, $handle)
    {
        $base_url = get_template_directory_uri() . '/build/';

        // Check if theme file.
        if (0 !== stripos($src, $base_url)) {
            return $src;
        }

        // Get query out of $src
        if (strpos($src, '?')) {
            list($without_query, $query) = explode('?', $src);
        } else {
            $without_query = $src;
            $query = '';
        }

        // Get map

        $assets_file = file_get_contents(get_template_directory_uri() . '/build/assets.json');

        if (! file_exists($assets_file)) {
            return $src;
        }

        $map = json_decode($assets_file, true);

        //

        $asset_path = substr($without_query, strlen($base_url));

        if (! isset($map[$asset_path])) {
            return $src;
        }

        return $base_url . $map[$asset_path] . '?' . $query;
    }
}
