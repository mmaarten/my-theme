<?php
/**
 * Nav Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register nav menu locations.
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'top-left'     => esc_html__('Top Left', 'my-theme'),
        'top-right'    => esc_html__('Top Right', 'my-theme'),
        'main-left'    => esc_html__('Primary Left', 'my-theme'),
        'main-right'   => esc_html__('Primary Right', 'my-theme'),
        'footer-left'  => esc_html__('Footer Left', 'my-theme'),
        'footer-right' => esc_html__('Footer Right', 'my-theme'),
    ]);
});

/**
 * Filters the arguments used to display a navigation menu.
 *
 * @param array $args Array of wp_nav_menu() arguments.
 * @return array
 */
add_filter('wp_nav_menu_args', function ($args) {

    // Set Walker
    if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
        $args['walker'] = new BootstrapNavWalker();
    }

    return $args;
}, PHP_INT_MAX);
