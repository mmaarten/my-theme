<?php
/**
 * Icons
 *
 * @package My/Theme
 */

namespace My\Theme;

class Icons
{
    /**
     * Icons
     *
     * @var array
     */
    protected static $icons = [];

    /**
     * Get icons
     *
     * @return array
     */
    public static function getIcons()
    {
        return self::$icons;
    }

    /**
     * Get icon
     *
     * @param string   $key
     * @param null|int $size
     */
    public static function get($key, $size = null)
    {
        if (array_key_exists($key, self::$icons)) {
            $repl = sprintf('<svg class="svg-icon svg-icon-%s" aria-hidden="true" role="img" focusable="false" ', sanitize_html_class($key));
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

    /**
     * Add icon
     *
     * @param string|array $key
     * @param null|string  $svg
     */
    public static function add($key, $svg = null)
    {
        $icons = is_array($key) ? $key : [$key => $svg];

        foreach ($icons as $key => $svg) {
            self::$icons[$key] = $svg;
        }
    }
}
