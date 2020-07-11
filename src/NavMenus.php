<?php
/**
 * Nav Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

final class NavMenus
{
    /**
     * Init
     */
    public static function init()
    {
        add_filter('wp_nav_menu_args', [__CLASS__, 'navMenuArgs'], PHP_INT_MAX);
        add_filter('nav_menu_link_attributes', [__CLASS__, 'navMenuLinkAttributes'], PHP_INT_MAX, 4);
        add_filter('nav_menu_item_title', [__CLASS__, 'navMenuItemTitle'], 0, 4);
    }

    /**
     * Nav Menu Args
     *
     * @param array $args Array of wp_nav_menu() arguments.
     * @return array
     */
    public static function navMenuArgs($args)
    {
        // Set default walker.
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            $args['walker'] = new NavWalker();
        }
        return $args;
    }

    /**
     * Nav Menu Link Attributes
     *
     * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
     * @param WP_Post  $item      The current menu item.
     * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
     * @param int      $depth     Depth of menu item.
     *
     * @return array
     */
    public static function navMenuLinkAttributes($atts, $item, $nav_menu, $depth)
    {
        // Open modal on click.
        if (in_array('toggle-modal', $item->classes)) {
            $atts['data-toggle'] = 'modal';
        }

        return $atts;
    }

    /**
     * Nav Menu Item Title
     *
     * @param string   $title The menu item's title.
     * @param WP_Post  $item  The current menu item.
     * @param stdClass $args  An object of wp_nav_menu() arguments.
     * @param int      $depth Depth of menu item. Used for padding.
     */
    public static function navMenuItemTitle($title, $item, $args, $depth)
    {
        // Make item title only available for screenreaders.
        if (in_array('-sr-only', $item->classes)) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }

        // Add icon
        $icon_key = null;

        foreach ($item->classes as $class) {
            if (preg_match('/^-icon-([\w-]+)$/', $class, $matches)) {
                $icon_key = $matches[1];
            }
        }

        if ($icon_key) {
            $icon = Icons::getInstance()->get($icon_key);
            if ($icon) {
                $title = "$title $icon";
            }
        }

        return $title;
    }
}
