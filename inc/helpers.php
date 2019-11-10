<?php

namespace My\Theme;

/**
 * @param string $asset
 * @return string
 */
function asset_path($asset)
{
    static $manifest = null;

    if (is_null($manifest)) {
        $manifest_path = get_template_directory() . '/build/assets.json';
        $manifest = file_exists($manifest_path) ? json_decode(file_get_contents($manifest_path), true) : [];
    }

    $path = isset($manifest[$asset]) ? $manifest[$asset] : $asset;

    return get_theme_file_uri("build/$path");
}
