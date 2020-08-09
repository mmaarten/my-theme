<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

class Helpers
{
    /**
     * Render HTML attributes
     *
     * @param array $attributes
     * @return string
     */
    public static function htmlAtts($attributes)
    {
        $str = '';

        foreach ($attributes as $name => $value) {
            $str .= sprintf(' %s="%s"', esc_attr($name), esc_attr($value));
        }

        return $str;
    }
}
