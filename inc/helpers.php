<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function get_icons()
{
    $icons = Icons::getInstance();
    return $icons->getIcons();
}

function get_icon($key, $size = null)
{
    $icons = Icons::getInstance();
    return $icons->getIcon($key, $size);
}

function add_icon($key, $svg = null)
{
    $icons = Icons::getInstance();
    $icons->AddIcon($key, $svg);
}

function html_atts($attributes)
{
    $str = '';

    foreach ($attributes as $name => $value) {
        $str .= sprintf(' %s="%s"', esc_attr($name), esc_attr($value));
    }

    return $str;
}
