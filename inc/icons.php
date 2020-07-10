<?php

namespace My\Theme;

/**
 * Adds an icon to the menu item title.
 *
 * Use CSS class -icon-{my-icon-key}.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 */
add_filter('nav_menu_item_title', function (string $title, \WP_Post $item, \stdClass $args, int $depth) {

    $key = null;
    foreach ($item->classes as $class) {
        if (preg_match('/-icon-(.*)/', $class, $matches)) {
            $key = $matches[1];
        }
    }

    if ($key) {
        $icon = app('icons')->get($key);
        if ($icon) {
            $title = "$title $icon";
        }
    }

    return $title;
}, PHP_INT_MAX, 4);
