<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register a new script and apply asset data.
 *
 * @param string      $handle Name of the script. Should be unique.
 * @param string|bool $src    Full URL of the script, or path of the script relative to the WordPress root directory.
 *                            If source is set to false, script is an alias of other scripts it depends on.
 * @param array $deps         Optional. An array of registered script handles this script depends on.
 *                            Default empty array.
 */
function register_script($handle, $src, $deps = [])
{
    $asset = get_asset($src);
    $deps  = $deps + $asset['dependencies'];
    wp_register_script($handle, $src, $deps, $asset['version'], true);

    if (in_array('wp-i18n', $deps)) {
        wp_set_script_translations($handle, 'my-theme', get_template_directory() . '/languages');
    }
}

/**
 * Register a CSS stylesheet and apply asset data.
 *
 * @param string      $handle Name of the stylesheet. Should be unique.
 * @param string|bool $src    Full URL of the stylesheet,
 *                            or path of the stylesheet relative to the WordPress root directory. If source is
 *                            set to false, stylesheet is an alias of other stylesheets it depends on.
 * @param array       $deps   Optional. An array of registered stylesheet handles this stylesheet depends on.
 *                            Default empty array.
 * @param string      $media  Optional. The media for which this stylesheet has been defined.
 *                            Default 'all'. Accepts media types like 'all', 'print' and 'screen', or media queries like
 *                            '(orientation: portrait)' and '(max-width: 640px)'.
 * @return bool Whether the style has been registered. True on success, false on failure.
 */
function register_style($handle, $src, $deps = [], $media = 'all')
{
    $asset = get_asset($src);
    wp_register_style($handle, $src, $deps + $asset['dependencies'], $asset['version'], $media);
}

/**
 * Get data from .asset.php file.
 *
 * @param $src The file URL.
 * @return array
 */
function get_asset($src)
{
    // Get path to .asset.php file.
    $path = str_replace(get_template_directory_uri(), get_template_directory(), $src);
    $file = str_replace(['.js', '.css'], '.asset.php', $path);
    $file = str_replace('/build/styles/', '/build/scripts/', $file); // Assets are in /build/scripts/ directory.

    // Get data.
    if (file_exists($file)) {
        $asset = require($file);
    } else {
        // Fallback.
        $asset = [
            'dependencies' => [],
            'version'      => filemtime($path)
        ];
    }

    // Dependencies are for scripts only.
    if (preg_match('/\.css$/', $src)) {
        $asset['dependencies'] = [];
    }

    return $asset;
}
