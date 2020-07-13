<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * @param string $id
 * @param mixed $concrete
 * @param bool $shared
 * @return mixed
 */
function app($key = null, $value = null, $shared = true)
{
    $container = Container::getInstance();

    if (is_null($key)) {
        return $container;
    }

    if (is_null($value)) {
        return $container->get($key);
    }

    return $container->add($key, $value, $shared);
}

/**
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function config($key, $default = null)
{
    return app('config')->get($key, $default);
}

/**
 * @param string $key
 * @param int    $size
 * @return string
 */
function icon($key, $size = null)
{
    return app('icons')->get($key, $size);
}
