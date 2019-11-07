<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Get the full asset URL with hashed filename.
 *
 * @param string $asset Relative path from build directory. e.g. 'scripts/main.js'.
 * @return bool|string
 */
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
