<?php

namespace My\Theme;

/**
 * @param string $asset Relative path from build directory. e.g. 'scripts/main.js'.
 * @return string
 */
function asset_path($asset)
{
    static $paths = null;

    if (is_null($paths)) {
        $file = get_template_directory() . '/build/assets.json';
        $paths = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    }

    $path = isset($paths[$asset]) ? $paths[$asset] : $asset;
    return get_template_directory_uri() . '/build/' . $path;
}
