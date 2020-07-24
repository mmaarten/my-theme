<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function add_icon($key, $svg = null)
{
    $icons = Icons::getInstance();
    $icons->add($key, $svg);
}

function get_icon($key, $size = null)
{
    $icons = Icons::getInstance();
    return $icons->get($key, $size);
}

function get_icons()
{
    $icons = Icons::getInstance();
    return $icons->getIcons();
}

/**
 * Register a series of sidebars described as footer columns.
 *
 * @param int   $amount The amount of sidebars to register.
 * @param array $args   Extra arguments for register_sidebar function.
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
                // translators: %s: column number
                'name'        => sprintf(esc_html__('Footer Column %s', 'my-theme'), $n),
                // translators: %s: column ordinal number
                'description' => sprintf(esc_html__('%s column in footer section.', 'my-theme'), $ordinals[$n]),
            ] + $args
        );
    }
}
