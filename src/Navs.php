<?php
/**
 * Navigation menus
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Navs
{
    private static $mods = [];

    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerNavMenus']);
        add_filter('wp_nav_menu_args', [__CLASS__, 'setDefaultNavwalker']);
        add_filter('wp_nav_menu_objects', [__CLASS__, 'mods'], 10, 2);
        add_filter('nav_menu_link_attributes', [__CLASS__, 'linkAttributes'], 10, 4);
    }

    public static function registerNavMenus()
    {
        register_nav_menus([
            'top-left'     => esc_html__('Top Left', 'my-theme'),
            'top-right'    => esc_html__('Top Right', 'my-theme'),
            'main-left'    => esc_html__('Primary Left', 'my-theme'),
            'main-right'   => esc_html__('Primary Right', 'my-theme'),
            'footer-left'  => esc_html__('Footer Left', 'my-theme'),
            'footer-right' => esc_html__('Footer Right', 'my-theme'),
        ]);
    }

    /**
     * Set default walker
     *
     * @param array $args Array of wp_nav_menu() arguments.
     * @return array
     */
    public static function setDefaultNavwalker($args)
    {
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            $args['walker'] = new NavWalker();
        }

        return $args;
    }

    /**
     * Setup modifications
     *
     * Take mod related classes out of menu item classes and
     * store them for later use.
     *
     * @global my_theme_nav_menu_mods
     *
     * @param array    $items The menu items.
     * @param stdClass $args  An object containing wp_nav_menu() arguments.
     *
     * @return array
     */
    public static function mods($items, $args)
    {
        $patterns = [
            '^btn-?',
            '^toggle-',
        ];

        // Loop items.
        foreach ($items as &$item) {
            $item_classes = array();
            // Loop item classes.
            foreach ($item->classes as $class) {
                foreach ($patterns as $pattern) {
                    if (preg_match("/$pattern/", $class)) {
                        self::$mods[ $item->ID ][ $class ] = $class;
                        break;
                    }
                }
                if (! isset(self::$mods[ $item->ID ][ $class ])) {
                    $item_classes[] = $class;
                }
            }
            $item->classes = $item_classes;
        }
        return $items;
    }

    /**
     * Modify link attributes
     *
     * @global my_theme_nav_menu_mods
     *
     * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
     * @param WP_Post  $item      The current menu item.
     * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
     * @param int      $depth     Depth of menu item.
     *
     * @return array
     */
    public static function linkAttributes($atts, $item, $nav_menu, $depth)
    {
        if (empty(self::$mods[ $item->ID ])) {
            return $atts;
        }

        $mods = self::$mods[ $item->ID ];

        // Make sure 'class' attribute is set.
        if (! isset($atts['class'])) {
            $atts['class'] = '';
        }
        /**
         * Button
         * -------------------------------------------------------------------------
         */
        // Get button classes.
        $btn_classes = array_filter(
            $mods,
            function ($class) {
                return preg_match('/^btn($|-.+)/', $class) ? true : false;
            }
        );
        if ($btn_classes) {
            // Remove 'nav-link' class.
            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);
            // Add button attributes.
            $atts['class'] .= ' ' . implode(' ', $btn_classes);
            $atts['role']   = 'button';
        }
        /**
         * Toggle
         * -------------------------------------------------------------------------
         */
        // Toggle modal.
        if (isset($mods['toggle-modal'])) {
            $atts['data-toggle'] = 'modal';
        }
        // Toggle collapse.
        if (isset($mods['toggle-collapse'])) {
            $atts['data-toggle'] = 'collapse';
        }
        /* ---------------------------------------------------------------------- */
        // Sanitize 'class' attribute.
        $atts['class'] = trim($atts['class']);
        return $atts;
    }
}
