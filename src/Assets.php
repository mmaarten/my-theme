<?php
/**
 * Assets
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Assets
{
     /**
      * Registers a script according to `wp_register_script`, additionally loading the translations for the file.
      *
      * @param string      $handle   Name of the script. Should be unique.
      * @param string|bool $src      Full URL of the script,
      *                              or path of the script relative to the WordPress root directory.
      * @param array       $deps     Optional. An array of registered script handles this script depends on.
      *                              Default empty array.
      * @param bool        $has_i18n Optional. Whether to add a script translation call to this file. Default 'false'.
      */
    public static function registerScript($handle, $src, $deps = [], $has_i18n = false)
    {
        $asset = self::getAsset($src);
        wp_register_script($handle, $src, $deps + $asset['dependencies'], $asset['version'], true);

        if ($has_i18n && function_exists('wp_set_script_translations')) {
            wp_set_script_translations($handle, 'my-theme', get_template_directory() . '/languages');
        }
    }

    /**
     * Registers a style according to `wp_register_style`.
     *
     * @param string $handle Name of the stylesheet. Should be unique.
     * @param string $src    Full URL of the stylesheet,
     *                       or path of the stylesheet relative to the WordPress root directory.
     * @param array  $deps   Optional. An array of registered stylesheet handles this stylesheet depends on.
     *                       Default empty array.
     * @param string $media  Optional. The media for which this stylesheet has been defined.
     *                       Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like
     *                       '(orientation: portrait)' and '(max-width: 640px)'.
     */
    public static function registerStyle($handle, $src, $deps = [], $media = 'all')
    {
        $asset = self::getAsset($src);
        wp_register_style($handle, $src, $deps + $asset['dependencies'], $asset['version'], $media);
    }

    /**
     * Get path
     *
     * @param string $src Full URL of the script or stylesheet.
     * @return string
     */
    public static function getPath($src)
    {
        return str_replace(get_template_directory_uri(), get_template_directory(), $src);
    }

    /**
     * Get asset data from 'assets.php' file.
     *
     * @param string $src Full URL of the script or stylesheet.
     * @return array
     */
    public static function getAsset($src)
    {
        $path = self::getPath($src);
        $file = str_replace(['.js', '.css'], '.asset.php', $path);
        // All asset files are in the '/build/scripts/' directory.
        $file = str_replace('/build/styles/', '/build/scripts/', $file);

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
}
