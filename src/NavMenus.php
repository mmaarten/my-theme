<?php
/**
 * Nav Menus
 *
 * @package My/Theme
 */

namespace My\Theme;

class NavMenus
{
    public function init()
    {
        add_action('after_setup_theme', [$this, 'registerNavMenus']);
        add_filter('wp_nav_menu_args', [$this, 'setWalker'], PHP_INT_MAX);
        add_filter('nav_menu_link_attributes', [$this, 'navMenuLinkAttributes'], PHP_INT_MAX, 4);
        add_filter('nav_menu_item_title', [$this, 'navMenuItemTitle'], PHP_INT_MAX, 4);
    }

    /**
     * Register nav menu locations.
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    public function registerNavMenus()
    {
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
     * Set Walker
     *
     * @param array $args Array of wp_nav_menu() arguments.
     * @return array
     */
    public function setWalker($args)
    {
        if (empty($args['walker']) && preg_match('/(^| )(nav|navbar-nav)( |$)/', $args['menu_class'])) {
            $args['walker'] = new NavWalker();
        }
        return $args;
    }

    /**
     * Nav Menu Link Attributes
     *
     * @param array    $atts      The HTML attributes applied to the menu item's <a> element.
     * @param WP_Post  $item      The current menu item.
     * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
     * @param int      $depth     Depth of menu item.
     *
     * @return array
     */
    public function navMenuLinkAttributes($atts, $item, $nav_menu, $depth)
    {
        /**
         * Use CSS class toggle-modal to open modal on click.
         */
        if (in_array('toggle-modal', $item->classes)) {
            $atts['data-toggle'] = 'modal';
        }

        return $atts;
    }

    /**
     * Nav Menu Item Title
     *
     * @param string   $title     The menu item's title.
     * @param WP_Post  $item      The current menu item.
     * @param stdClass $nav_menu  An object of wp_nav_menu() arguments.
     * @param int      $depth     Depth of menu item. Used for padding.
     */
    public function navMenuItemTitle($title, $item, $nav_menu, $depth)
    {
        /**
         * Make title only available for screenreaders. Use CSS class -sr-only.
         */
        if (in_array('-sr-only', $item->classes)) {
            $title = sprintf('<span class="sr-only">%s</span>', $title);
        }

        /**
         * Append an icon to the navigation label. Use CSS class -icon-{icon-key}.
         */

        // Find icon key
        $icon_key = null;
        foreach ($item->classes as $class) {
            if (preg_match('/^-icon-([\w-]+)$/', $class, $matches)) {
                $icon_key = $matches[1];
            }
        }

        // Get icon
        if ($icon_key) {
            $icon = app('icons')->get($icon_key);
            if ($icon) {
                // Append to title
                $title = "$title $icon";
            }
        }

        return $title;
    }
}
