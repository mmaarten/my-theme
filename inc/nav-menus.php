<?php
/**
 * Navigation menus
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Set default walker
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return array
 */
function set_default_navwalker($args)
{
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        $args['walker'] = new NavWalker();
    }
    return $args;
}
add_filter('wp_nav_menu_args', __NAMESPACE__ . '\set_default_navwalker', PHP_INT_MAX);
