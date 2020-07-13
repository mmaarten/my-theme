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
function app($key = null, $value = null, $shared = false)
{
    $container = Container::getInstance();

    if (is_null($key)) {
        return $container;
    }

    if (is_null($value)) {
        return $container->get($key);
    }

    return $container->set($key, $value, $shared);
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
 * @param string $asset
 * @return string
 */
function asset_path($asset)
{
    return app('assets.manifest')->getURI($asset);
}

/**
 * @param array $attributes
 * @return string
 */
function html_atts($attributes)
{
    $str = '';

    foreach ($attributes as $name => $value) {
        $str .= sprintf(' %s="%s"', esc_attr($name), esc_attr($value));
    }

    return $str;
}

/**
 * @example
 * breakpoint_classes(['xs' => 1, 'sm' => 2], 'prefix');
 * returns
 * prefix-1 prefix-sm-2
 *
 * @param array $data
 * @param string $prefix
 * @return string
 */
function breakpoint_classes($data, $prefix = '')
{
    $breakpoints = ['xs', 'sm', 'md', 'lg', 'xl'];
    $classes = [];
    foreach ($breakpoints as $breakpoint) {
        $infix = $breakpoint === 'xs' ? '' : "$breakpoint-";
        if (isset($data[$breakpoint])) {
            $value = $data[$breakpoint];
            $classes[] = "{$prefix}-{$infix}{$value}";
        }
    }

    return implode(' ', $classes);
}
