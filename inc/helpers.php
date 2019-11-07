<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function asset_path($asset)
{
    $file = get_template_directory() . '/build/assets.json';
    if (!file_exists($file)) {
        return false;
    }

    $paths = json_decode(file_get_contents($file), true);
    if (isset($paths[$asset])) {
        return $paths[$asset];
    }

    return false;
}
