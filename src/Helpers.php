<?php
/**
 * Helpers
 *
 * @package My/Theme
 */

namespace My\Theme;

class Helpers
{
    public static function htmlAtts($attrs)
    {
        $html = '';

        // Loop over attrs and validate data types.
        foreach ($attrs as $k => $v) {
            // String (but don't trim value).
            if (is_string($v) && ($k !== 'value')) {
                $v = trim($v);

            // Boolean
            } elseif (is_bool($v)) {
                $v = $v ? 1 : 0;

            // Object
            } elseif (is_array($v) || is_object($v)) {
                $v = json_encode($v);
            }

            // Generate HTML.
            $html .= sprintf(' %s="%s"', esc_attr($k), esc_attr($v));
        }

        // Return.
        return $html;
    }
}
