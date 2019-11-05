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
add_filter('wp_nav_menu_args', function ($args) {
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        $args['walker'] = new NavWalker();
    }
    return $args;
}, PHP_INT_MAX);
