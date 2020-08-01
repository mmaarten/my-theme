<?php

namespace My\Theme;

class NavMenus
{
    public static function init()
    {
        add_filter('wp_nav_menu_args', [__CLASS__, 'setBootstrapNavwalker'], PHP_INT_MAX);
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

    public static function navMenuLinkAttributes($atts, $item, $args, $depth)
    {
        // Make sure class attribute is set.
        if (! isset($atts['class'])) {
            $atts['class'] = '';
        }

        // Create button
        $btn_classes = [];
        foreach ($item->classes as $class) {
            if (preg_match('/^-(btn(?:$|-.+))/', $class, $matches)) {
                list (, $btn_class) = $matches;
                $btn_classes[$btn_class] = $btn_class;
            }
        }
        if ($btn_classes) {
            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);
            $atts['class'] .= ' ' . implode(' ', $btn_classes);
            $atts['role'] = 'button';
        }

        // Toggle modal
        if (in_array('toggle-modal', $item->classes)) {
            $atts['data-toggle'] = 'modal';
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
}
