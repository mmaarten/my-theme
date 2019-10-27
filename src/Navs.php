<?php
/**
 * Navigations
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Navs
{
    /**
     * Initialize
     */
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerLocations']);
        add_filter('wp_nav_menu_args', [__CLASS__, 'setDefaultWalker']);
    }

    /**
     * Register nav menu locations.
     */
    public static function registerLocations()
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

    /**
     * Set default walker
     *
     * @param array $args Array of wp_nav_menu() arguments.
     * @return array
     */
    public static function setDefaultWalker($args)
    {
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            $args['walker'] = new NavWalker();
        }

        return $args;
    }
}
