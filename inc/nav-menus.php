<?php
/**
 * Navigation Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Set Bootstrap walker when Bootstrap navigation is used.
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return array
 */
function set_bootstrap_navwalker($args)
{
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
        $args['walker'] = new \WP_Bootstrap_Navwalker();
    }
    return $args;
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\set_bootstrap_navwalker', PHP_INT_MAX);

/**
 * Filters the HTML attributes applied to a menu item's anchor element.
 *
 * @param array $atts {
 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
 *
 *     @type string $title        Title attribute.
 *     @type string $target       Target attribute.
 *     @type string $rel          The rel attribute.
 *     @type string $href         The href attribute.
 *     @type string $aria_current The aria-current attribute.
 * }
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 */
function nav_menu_link_attributes($atts, $item, $args, $depth)
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
    if ($btn_class) {
        $atts['class'] = preg_replace('/(^| )nav-link( |$)/', $atts['class']);
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

add_filter('nav_menu_link_attributes', __NAMESPACE__ . '\nav_menu_link_attributes', PHP_INT_MAX, 4);
