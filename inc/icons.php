<?php
/**
 * Icons
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Setup
 */
add_action('after_setup_theme', function () {
    /**
     * Setup icon manager.
     */
    app('icons', function () {
        return new Icons(config('icons'));
    });
});

/**
 * Append an icon to the navigation label. Use CSS class -icon-{icon-key}.
 *
 * @param string   $title     The menu item's title.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item. Used for padding.
 */
add_filter('nav_menu_item_title', function ($title, $item, $nav_menu, $depth) {

    /**
     * Append an icon to the navigation label. Use CSS class -icon-{icon-key}.
     */

    // Find icon key
    $key = null;
    foreach ($item->classes as $class) {
        if (preg_match('/^-icon-([\w-]+)$/', $class, $matches)) {
            $key = $matches[1];
        }
    }

    // Get icon
    if ($key) {
        $icon = app('icons')->get($key);
        if ($icon) {
            // Append to title
            $title = "$title $icon";
        }
    }

    return $title;
}, PHP_INT_MAX, 4);
