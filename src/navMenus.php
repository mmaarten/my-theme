<?php
/**
 * Navigation Menus
 *
 * @package My\Theme
 */

namespace My\Theme;

class NavMenus
{
    protected static $mods = [];

    public static function init()
    {
        add_filter('wp_nav_menu_args', [__CLASS__, 'setBootstrapNavwalker'], PHP_INT_MAX);
        add_filter('wp_get_nav_menu_items', [__CLASS__, 'navMenuItems'], PHP_INT_MAX, 2);
        add_filter('nav_menu_link_attributes', [__CLASS__, 'navMenuLinkAttributes'], PHP_INT_MAX, 4);
        add_filter('nav_menu_item_title', [__CLASS__, 'navMenuItemTitle'], PHP_INT_MAX, 4);
    }

    public static function setBootstrapNavwalker($args)
    {
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
            $args['walker'] = new \WP_Bootstrap_Navwalker();
        }
        return $args;
    }

    public static function navMenuItems($items, $args)
    {
        if (is_admin()) {
            return $items;
        }

        // Get specific CSS classes out if item and store them for later use.
        foreach ($items as &$item) {
            $item_classes = [];
            foreach ($item->classes as $class) {
                if (preg_match('/^btn($|-.+)/', $class)) {
                    self::$mods[$item->ID]['btn'][$class] = $class;
                } elseif (preg_match('/^icon-(.+)/', $class, $matches)) {
                    self::$mods[$item->ID]['icon'] = $matches[1];
                } elseif ($class == 'nolabel') {
                    self::$mods[$item->ID]['nolabel'] = true;
                } elseif (preg_match('/^toggle-(.+)/', $class, $matches)) {
                    self::$mods[$item->ID]['toggle'] = $matches[1];
                } else {
                    $item_classes[] = $class;
                }
            }
            $item->classes = $item_classes;
        }

        return $items;
    }

    public static function navMenuLinkAttributes($atts, $item, $args, $depth)
    {
        $mods = isset(self::$mods[$item->ID]) ? self::$mods[$item->ID] : [];

        // Make sure class attribute is set.
        if (! isset($atts['class'])) {
            $atts['class'] = '';
        }

        // Create button
        if (! empty($mods['btn'])) {
            $btn_classes = $mods['btn'];
            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);
            $atts['class'] .= ' ' . implode(' ', $btn_classes);
            $atts['role'] = 'button';
        }

        // Toggle
        if (! empty($mods['toggle'])) {
            $atts['data-toggle'] = $mods['toggle'];
        }

        // Sanitize class attribute
        $atts['class'] = trim($atts['class']);

        return $atts;
    }

    /**
     * Filters the item's title.
     *
     * @param string   $title The menu item's title.
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    public static function navMenuItemTitle($title, $item, $args, $depth)
    {
        $mods = isset(self::$mods[$item->ID]) ? self::$mods[$item->ID] : [];

        // Hides title
        if (! empty($mods['nolabel'])) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }

        // Adds icon
        if (! empty($mods['icon'])) {
            $key = $mods['icon'];
            if ($icon = Icons::get($key)) {
                $title = "$title $icon";
            }
        }

        return $title;
    }
}
