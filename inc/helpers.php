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
 * @param int $amount
 * @param array $args
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
                'name'        => sprintf(esc_html__('Footer Column %s', 'my-theme'), $n),
                'description' => sprintf(esc_html__('%s column in footer section.', 'my-theme'), $ordinals[$n]),
            ] + $args
        );
    }
}
