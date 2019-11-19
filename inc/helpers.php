<?php

namespace My\Theme;

function app(string $id = null, $concrete = null, bool $shared = null)
{
    $container = Container::getInstance();

    if (is_null($id)) {
        return $container;
    }

    if (is_null($concrete)) {
        return $container->get($id);
    }

    return $container->add($id, $concrete, $shared);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function config(string $key = null, $default = null)
{
    if (is_null($key)) {
        return app('config');
    }

    return app('config')->get($key, $default);
}

/**
 * @param string $asset
 * @return string
 */
function asset_path(string $asset)
{
    return app('assets')->getURI($asset);
}
