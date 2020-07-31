<?php
/**
 * Icons
 *
 * @package My/Theme
 */

namespace My\Theme;

class Icons
{
    protected static $icons = [];

    public static function getIcons()
    {
        return self::$icons;
    }

    public static function get($key, $size = null)
    {
        // Get SVG

        if (! array_key_exists($key, self::$icons)) {
            trigger_error(sprintf('Unable to find icon %s.', $key), E_USER_WARNING);

            return null;
        }

        $svg = self::$icons[ $key ];

        // Add extra attributes to SVG element

        $atts = 'class="svg-icon" aria-hidden="true" role="img" focusable="false"';

        if ($size) {
            $atts .= sprintf(' width="%1$dpx" height="%1$dpx"', $size);
        }

        $svg = preg_replace('/^<svg /', "<svg $atts", $svg);

        // Sanitize SVG

        $svg = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
        $svg = preg_replace('/>\s*</', '><', $svg); // Remove white space between SVG tags.

        // Return

        return $svg;
    }

    public static function add($key, $svg = null)
    {
        $icons = is_array($key) ? $key : [$key => $svg];

        foreach ($icons as $key => $svg) {
            self::$icons[$key] = $svg;
        }
    }
}
