<?php

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
