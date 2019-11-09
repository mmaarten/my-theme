<?php

namespace My\Theme;

function asset_path($asset)
{
    $manifest_path = get_template_directory() . '/build/assets.json';
    $manifest = file_exists($manifest_path) ? json_decode(file_get_contents($manifest_path), true) : [];

    return isset($manifest[$asset]) ? "build/{$manifest[$asset]}" : "build/{$asset}";
}

function asset_uri($asset)
{
    return get_template_directory_uri() . '/' . asset_path($asset);
}
