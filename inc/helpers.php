<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

function html_atts($attributes)
{
    $str = '';

    foreach ($attributes as $name => $value) {
        $str .= sprintf(' %s="%s"', esc_attr($name), esc_attr($value));
    }

    return $str;
}
