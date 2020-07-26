<?php
/**
 * Icons
 *
 * @package My/Theme
 */

namespace My\Theme;

class Icons
{
    private static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected $icons = [];

    private function __construct()
    {
    }

    public function getIcons()
    {
        return $this->icons;
    }

    public function getIcon($key, $size = null)
    {
        // Get SVG

        if (! array_key_exists($key, $this->icons)) {
            trigger_error(sprintf('Unable to find icon %s.', $key), E_USER_WARNING);

            return null;
        }

        $svg = $this->icons[ $key ];

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

    public function addIcon($key, $svg = null)
    {
        $icons = is_array($key) ? $key : [$key => $svg];

        foreach ($icons as $key => $svg) {
            $this->icons[$key] = $svg;
        }
    }
}
