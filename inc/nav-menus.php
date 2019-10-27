<?php
/**
 * Navigation menus
 *
 * @package My/Theme
 */

namespace My\Theme;

function register_nav_menu_locations()
{
    register_nav_menus(
        [
            'top-left'     => esc_html__('Top Left', 'my-theme'),
            'top-right'    => esc_html__('Top Right', 'my-theme'),
            'main-left'    => esc_html__('Primary Left', 'my-theme'),
            'main-right'   => esc_html__('Primary Right', 'my-theme'),
            'footer-left'  => esc_html__('Footer Left', 'my-theme'),
            'footer-right' => esc_html__('Footer Right', 'my-theme'),
        ]
    );
}

add_action('after_setup_theme', __NAMESPACE__ . '\register_nav_menu_locations');

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

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\set_default_navwalker');
