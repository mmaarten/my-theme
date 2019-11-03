<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function get_asset($src)
{
    // Get $src directory path.
    $base_url = get_template_directory_uri();
    $base_path = get_template_directory();

    if (0 !== strpos($src, "$base_url/build/")) {
        return false;
    }

    $src_path = str_replace($base_url, $base_path, $src);

    // Get asset file.
    $asset_file = str_replace(['.js', '.css'], '.asset.php', $src_path);
    $asset_file = str_replace('/build/styles/', '/build/scripts/', $asset_file);

    // Get asset data.
    if (file_exists($asset_file)) {
        $asset = require $asset_file;
    } else {
        // Fallback.
        $asset = [
            'dependencies' => [],
            'version'      => filemtime($src_path),
        ];
    }

    // Dependencies are for scripts only.
    if (preg_match('/\.css$/', $src)) {
        $asset['dependencies'] = [];
    }

    return $asset;
}
