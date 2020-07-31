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
    public static function init() {
      add_action('after_setup_theme', [__CLASS__, 'setup']);
      add_filter('nav_menu_link_attributes', [__CLASS__, 'navMenuLinkAttributes'], PHP_INT_MAX, 4);
      add_filter('wp_nav_menu_objects', [__CLASS__, 'navMenuObjects'], PHP_INT_MAX, 2);
    }

    /**
     * Setup
     */
    public static function setup() {
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
    public static function navMenuArgs($args) {
      // Set Bootstrap walker when Bootstrap navigation is used.
      if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
          require_once get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
          $args['walker'] = new \WP_Bootstrap_Navwalker();
      }
      return $args;
    }
}
