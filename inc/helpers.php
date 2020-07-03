<?php

namespace My\Theme;

/**
 * @param string $id
 * @param mixed $concrete
 * @param bool $shared
 * @return mixed
 */
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

/**
 * Registers a series of sidebars that are described as footer columns
 *
 * @param int   $amount The amount of sidebars to register.
 * @param array $args   Optional arguments for registering the sidebar.
 */
function register_footer_columns($amount, $args = [])
{
    $ordinals = [
        1 => __('First', 'my-theme'),
        2 => __('Second', 'my-theme'),
        3 => __('Thirth', 'my-theme'),
        4 => __('Fourth', 'my-theme'),
        5 => __('Fifth', 'my-theme'),
        6 => __('Sixth', 'my-theme'),
        7 => __('Seventh', 'my-theme'),
        8 => __('Eighth', 'my-theme'),
        9 => __('Ninth', 'my-theme'),
    ];

    for ($n=1; $n <= $amount; $n++) {
        register_sidebar(
            [
                'id'          => 'footer-column-' . $n,
                // translators: 1: Column number.
                'name'        => esc_html__(sprintf(__('Footer Column %1$s'), $n), 'my-theme'),
                // translators: 1: Ordinal column number.
                'description' => esc_html__(sprintf(__('%1$s column in footer section.'), $ordinals[$n]), 'my-theme'),
            ] + $args
        );
    }
}
