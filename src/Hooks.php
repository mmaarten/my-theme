<?php
/**
 * Hooks
 *
 * @package My/Theme
 */

namespace My\Theme;

class Hooks
{
    /**
     * Init
     */
    public static function init()
    {
        add_filter('body_class', [__CLASS__, 'bodyClass'], PHP_INT_MAX);
        add_action('wp_head', [__CLASS__, 'pingback']);
    }

    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    public static function bodyClass($classes)
    {
        $include = [
            'singular' => is_singular(),
            'hfeed'    => ! is_singular(),
            'iphone'   => $GLOBALS['is_iphone'],
            'chrome'   => $GLOBALS['is_chrome'],
            'safari'   => $GLOBALS['is_safari'],
            'ns4'      => $GLOBALS['is_NS4'],
            'opera'    => $GLOBALS['is_opera'],
            'mac-ie'   => $GLOBALS['is_macIE'],
            'win-ie'   => $GLOBALS['is_winIE'],
            'gecko'    => $GLOBALS['is_gecko'],
            'lynx'     => $GLOBALS['is_lynx'],
            'ie'       => $GLOBALS['is_IE'],
            'edge'     => $GLOBALS['is_edge'],
            'mobile'   => wp_is_mobile(),
            'desktop'  => ! wp_is_mobile(),
        ];

        // Add classes.
        foreach ($include as $class => $append) {
            if ($append) {
                $classes[$class] = $class;
            }
        }

        // Return.
        return $classes;
    }

    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     *
     * @link https://developer.wordpress.org/reference/functions/bloginfo/
     */
    public static function pingback()
    {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }
}
