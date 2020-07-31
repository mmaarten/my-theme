<?php

namespace My\Theme;

/**
 * Filters the arguments used to display a navigation menu.
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return array
 */
public static function nav_menu_args($args)
{
    // Set Bootstrap walker when Bootstrap navigation is used.
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
        $args['walker'] = new \WP_Bootstrap_Navwalker();
    }
    return $args;
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\nav_menu_args', PHP_INT_MAX);
