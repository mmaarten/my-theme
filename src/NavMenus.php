<?php
/**
 * Navigation Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

class NavMenus
{
    protected static $mods = [];

    /**
     * Initialize
     */
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_filter('wp_nav_menu_args', [__CLASS__, 'navMenuArgs'], PHP_INT_MAX, 4);
        add_filter('wp_nav_menu_objects', [__CLASS__, 'navMenuObjects'], PHP_INT_MAX, 2);
        add_filter('nav_menu_link_attributes', [__CLASS__, 'navMenuLinkAttributes'], PHP_INT_MAX, 4);
        add_filter('nav_menu_item_title', [__CLASS__, 'navMenuItemTitle'], PHP_INT_MAX, 4);
    }

    /**
     * Setup
     */
    public static function setup()
    {
       /**
        * Register nav menu locations.
        * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
        */
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
     * Filters the arguments used to display a navigation menu.
     *
     * @param array $args Array of wp_nav_menu() arguments.
     * @return array
     */
    public static function navMenuArgs($args)
    {
        // Set Bootstrap walker when Bootstrap navigation is used.
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
            $args['walker'] = new \WP_Bootstrap_Navwalker();
        }
        return $args;
    }

    public static function navMenuObjects($items, $args)
    {
        foreach ($items as &$item) {
            $item_classes = [];
            foreach ($item->classes as $class) {
                if (preg_match('/^btn($|-.+)/', $class)) {
                    self::$mods[$item->ID]['btn'][$class] = $class;
                } elseif (preg_match('/^icon-(.+)/', $class, $matches)) {
                    self::$mods[$item->ID]['icon'] = $matches[1];
                } elseif (preg_match('/^toggle-(.+)/', $class, $matches)) {
                    self::$mods[$item->ID]['toggle'] = $matches[1];
                } elseif ($class === 'nolabel') {
                    self::$mods[$item->ID]['nolabel'] = true;
                } else {
                    $item_classes[] = $class;
                }
            }
            $item->classes = $item_classes;
        }
        return $items;
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
        $mods = isset(self::$mods[$item->ID]) ? self::$mods[$item->ID] : [];

        // Make sure 'class' attribute is set.
        if (! isset($atts['class'])) {
            $atts['class'] = '';
        }

        if (!empty($mods['btn'])) {
            $btn_classes = $mods['btn'];
            // Remove 'nav-link' class
            $atts['class'] = preg_replace('/(^| )nav-link( |$)/', '', $atts['class']);
            // Add button attributes
            $atts['class'] .= ' ' . implode(' ', $btn_classes);
            $atts['role'] = 'button';
        }

        if (!empty($mods['toggle'])) {
            $atts['data-toggle'] = $mods['toggle'];
        }

        // Sanitize 'class' attribute.
        $atts['class'] = trim($atts['class']);

        return $atts;
    }

    /**
     * Nav Menu Item Title
     *
     * @param string   $title     The menu item's title.
     * @param WP_Post  $item      The current menu item.
     * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
     * @param int      $depth     Depth of menu item. Used for padding.
     */
    public static function navMenuItemTitle($title, $item, $nav_menu, $depth)
    {
        $mods = isset(self::$mods[$item->ID]) ? self::$mods[$item->ID] : [];

        // Make title available for screenreaders only.
        if (!empty($mods['nolabel'])) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }

        // Adds icon.
        if (!empty($mods['icon'])) {
            $icon = Icons::get($mods['icon']);
            $position = in_array('-icon-left', $item->classes) ? 'left' : 'right';
            if ($icon) {
                if ($position == 'left') {
                    $title = "$icon $title";
                } else {
                    $title = "$title $icon";
                }
            }
        }

        return $title;
    }
}
