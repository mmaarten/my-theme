<?php

namespace My\Theme;

/**
 * Init
 */
add_action('after_setup_theme', function () {
    app('icons', function () {
        return new Icons(config('icons'));
    });
});

/**
 * Add an icon to the item navigation label.
 *
 * This feature can be applied by using menu item 'CSS Classes' setting in admin area.
 *
 * Usage: e.g. '-icon-my_icon_key' adds an icon with key 'my_icon_key'.
 *
 * @param string   $title     The menu item's title.
 * @param WP_Post  $item      The current menu item.
 * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
 * @param int      $depth     Depth of menu item.
 *
 * @return string
 */
add_filter('nav_menu_item_title', function ($title, $item, $nav_menu, $depth) {

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
