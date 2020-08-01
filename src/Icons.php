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
        if (array_key_exists($key, self::$icons)) {
            $repl = '<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" ';
            if ($size) {
                $repl .= sprintf('width="%1$dpx" height="%1$dpx" ', $size);
            }
            $svg  = preg_replace('/^<svg /', $repl, trim(self::$icons[$key])); // Add extra attributes to SVG code.
            $svg  = preg_replace("/([\n\t]+)/", ' ', $svg); // Remove newlines & tabs.
            $svg  = preg_replace('/>\s*</', '><', $svg);    // Remove whitespace between SVG tags.
            return $svg;
        }

        return null;
    }

    public static function add($key, $svg = null)
    {
        $icons = is_array($key) ? $key : [$key => $svg];

        foreach ($icons as $key => $svg) {
            self::$icons[$key] = $svg;
        }
    }
}
