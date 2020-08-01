<?php

namespace My\Theme;

class Helpers
{
    public static function htmlAtts($attributes)
    {
        $str = '';

        foreach ($attributes as $name => $value) {
            $str .= sprintf(' %s="%s"', esc_attr($name), esc_attr($value));
        }

        return $str;
    }
}
