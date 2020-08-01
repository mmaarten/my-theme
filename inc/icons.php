<?php
/**
 * Icons
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Adds an icon to the item's title.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 */
function nav_menu_item_icon($title, $item, $args, $depth)
{
    $key = null;
    foreach ($item->classes as $class) {
        if (preg_match('/^-icon-(.+)/', $class, $matches)) {
            list(, $key) = $matches;
        }
    }
    if ($key && $icon = Icons::get($key)) {
        if (in_array('-nolabel', $item->classes)) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }

        $title = "$title $icon";
    }

    return $title;
}

add_filter('nav_menu_item_title', __NAMESPACE__ . '\nav_menu_item_icon', PHP_INT_MAX, 4);
