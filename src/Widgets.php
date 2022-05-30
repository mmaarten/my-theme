<?php
/**
 * Widgets
 *
 * @package My/Theme
 */

namespace My\Theme;

class Widgets
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('widgets_init', [__CLASS__, 'registerSidebars']);
    }

    /**
     * Register widget areas
     */
    public static function registerSidebars()
    {
        $args = [
          'before_widget' => '<section id="%1$s" class="widget %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="widget-title">',
          'after_title'   => '</h2>',
        ];

        register_sidebar([
            'id'          => 'header',
            'name'        => esc_html__('Header', 'my-theme'),
            'description' => esc_html__('Header section.', 'my-theme'),
        ] + $args);

        register_sidebar([
            'id'          => 'sidebar-left',
            'name'        => esc_html__('Left Sidebar', 'my-theme'),
            'description' => esc_html__('Section on the left side.', 'my-theme'),
        ] + $args);

        register_sidebar([
            'id'          => 'sidebar-right',
            'name'        => esc_html__('Right Sidebar', 'my-theme'),
            'description' => esc_html__('Section on the right side.', 'my-theme'),
        ] + $args);

        register_sidebar([
            'id'          => 'footer',
            'name'        => esc_html__('Footer', 'my-theme'),
            'description' => esc_html__('Footer section.', 'my-theme'),
        ] + $args);
    }
}
