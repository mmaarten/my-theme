<?php
/**
 * Navigation Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Include WP_Bootstrap_Navwalker.
 *
 * @link https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
require get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

/**
 * Set default walker
 *
 * @param array $args Array of wp_nav_menu() arguments.
 *
 * @return array
 */
function set_default_navwalker($args)
{
    // Stop when set.
    if (! empty($args['walker'])) {
        return $args;
    }

    // Check if menu has 'nav' or 'navbar-nav' class.
    if (preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        // Set bootstrap navwalker.
        $args['walker'] = new \WP_Bootstrap_Navwalker();
    }

    return $args;
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\set_default_navwalker');

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
function nav_menu_mod_classes($items, $args)
{
    $mod_classes = &$GLOBALS['my_theme_nav_menu_mods'];

    // Loop items.
    foreach ($items as &$item) {
        $item_classes = array();

        // Loop item classes.
        foreach ($item->classes as $class) {
            if (preg_match('/^mod-(.+)/', $class, $matches)) {
                list(, $mod_class ) = $matches;

                $mod_classes[ $item->ID ][ $mod_class ] = $mod_class;
            } else {
                $item_classes[] = $class;
            }
        }

        $item->classes = $item_classes;
    }

    return $items;
}

add_filter('wp_nav_menu_objects', __NAMESPACE__ . '\nav_menu_mod_classes', 10, 2);

/**
 * Get item modifications.
 *
 * @global my_theme_nav_menu_mods
 *
 * @param WP_Post $item The menu item.
 *
 * @return array|null
 */
function get_nav_menu_mods($item)
{
    if (isset($GLOBALS['my_theme_nav_menu_mods'][ $item->ID ])) {
        return $GLOBALS['my_theme_nav_menu_mods'][ $item->ID ];
    }

    return null;
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
function nav_menu_link_attributes($atts, $item, $nav_menu, $depth)
{
    $mod_classes = get_nav_menu_mods($item);

    if (! $mod_classes) {
        return $atts;
    }

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
        $mod_classes,
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
    if (isset($mod_classes['toggle-modal'])) {
        $atts['data-toggle'] = 'modal';
    }

    // Toggle collapse.
    if (isset($mod_classes['toggle-collapse'])) {
        $atts['data-toggle'] = 'collapse';
    }

    /* ---------------------------------------------------------------------- */

    // Sanitize 'class' attribute.
    $atts['class'] = trim($atts['class']);

    return $atts;
}

add_filter('nav_menu_link_attributes', __NAMESPACE__ . '\nav_menu_link_attributes', 10, 4);
