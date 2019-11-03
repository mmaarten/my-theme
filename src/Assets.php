<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Assets
{
    public static function registerScript($handle, $src, $deps = [])
    {
        $asset = self::getAsset($src);
        $deps = $asset['dependencies'] + $deps;
        $ver  = $asset['version'];

        wp_register_script($handle, $src, $deps, $ver, true);

        if (in_array('wp-i18n', $deps)) {
            wp_set_script_translations($handle, 'my-theme', get_template_directory() . '/languages');
        }
    }

    public static function registerStyle($handle, $src, $deps = [], $media = 'all')
    {
        $asset = self::getAsset($src);
        $deps = $asset['dependencies'] + $deps;
        $ver  = $asset['version'];

        wp_register_style($handle, $src, $deps, $ver, $media);
    }

    public static function getAsset($src)
    {
        $path = self::getPath($src);
        $file = str_replace(['.js', '.css'], '.asset.php', $path);
        $file = str_replace('/build/styles/', '/build/scripts/', $file); // Assets are in /build/scripts directory.

        if (file_exists($file)) {
            $asset = require $file;
        } else {
            // Fallback.
            $asset = [
                'dependencies' => [],
                'version'      => filemtime($path),
            ];
        }

        // Dependencies are for scripts only.
        if (preg_match('/\.css$/', $src)) {
            $asset['dependencies'] = [];
        }

        return $asset;
    }

    public static function getPath($src)
    {
        $base_url = get_template_directory_uri();
        $base_path = get_template_directory();

        return str_replace($base_url, $base_path, $src);
    }
}
