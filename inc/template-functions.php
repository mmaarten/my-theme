<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function body_classes($classes)
{
    $include = [
        // Common.
        'singular' => is_singular(),
        'hfeed'    => ! is_singular(),
        // Browsers & devices.
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
        // Mobile.
        'mobile'   => wp_is_mobile(),
        'desktop'  => ! wp_is_mobile(),
    ];

    // Add classes.
    foreach ($include as $class => $do_include) {
        if ($do_include) {
            $classes[ $class ] = $class;
        }
    }

    // Return.
    return $classes;
}

add_filter('body_class', __NAMESPACE__ . '\body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', __NAMESPACE__ . '\pingback_header');
