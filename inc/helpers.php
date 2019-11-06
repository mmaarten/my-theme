<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function asset_path($asset)
{
    static $paths = null;

    if (is_null($paths)) {
        $file = get_template_directory() . '/build/assets.json';
        if (file_exists($file)) {
            $paths = json_decode(file_get_contents($file), true);
        } else {
            $paths = [];
        }
    }

    if (is_array($paths) && isset($paths[$asset])) {
        return get_template_directory_uri() . '/build/' . $paths[$asset];
    }

    return false;
}
