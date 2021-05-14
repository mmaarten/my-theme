<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

class Helpers
{
    public static function htmlAtts($attributes)
    {
        $str = '';

        foreach ($attributes as $key => $value) {
            $str .= sprintf(' %1$s="%2$s"', $key, esc_attr($value));
        }

        return $str;
    }
}
