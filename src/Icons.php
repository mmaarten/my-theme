<?php

namespace My\Theme;

class Icons
{
    protected $icons = [];

    public function __construct($icons = [])
    {
        $this->add($icons);
    }

    public function getIcons()
    {
        return $this->icons;
    }

    public function add($key, $svg = null)
    {
        $icons = is_array($key) ? $key : [$key => $svg];

        foreach ($icons as $key => $svg) {
            $this->icons[$key] = $svg;
        }
    }

    public function remove($key, $svg)
    {
        unset($this->icons[$key]);
    }

    public function get($key, $size = null)
    {
        if (array_key_exists($key, $this->icons)) {
            $svg = $this->icons[$key];

            // Add extra attributes to SVG element
            $atts = sprintf('class="svg-icon icon-%s" aria-hidden="true" role="img" focusable="false"', esc_attr($key));

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
        return null;
    }
}
