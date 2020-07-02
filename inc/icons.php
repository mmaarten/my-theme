<?php

namespace My\Theme;

/**
 * Init
 */
add_action('after_setup_theme', function () {
    // Setup icons manager.
    app('icons', function () {
        return new Icons(config('icons'));
    });
});

/**
 * Appends an icon to the menu item's title.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 *
 * @return string
 */
add_filter('nav_menu_item_title', function ($title, $item, $args, $depth) {

    $key = null;
    foreach ($item->classes as $class) {
        if (preg_match('/^-icon-(.*)/', $class, $matches)) {
            $key = $matches[1];
        }
    }

    if (! is_null($key)) {
        $icon = app('icons')->get($key);
        if ($icon) {
            $title = "$icon $title";
        }
    }

    return $title;
}, PHP_INT_MAX, 4);
