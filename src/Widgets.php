<?php
/**
 * Widgets
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Widgets
{
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'setup']);
        add_action('widgets_init', [__CLASS__, 'registerSidebars']);
    }

    /**
     * Setup
     */
    public static function setup()
    {
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }

    /**
     * Register widget areas
     */
    public static function registerSidebars()
    {
        $defaults = [
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ];

        register_sidebar(
            [
                'id'          => 'header',
                'name'        => esc_html__('Header', 'my-theme'),
                'description' => esc_html__('Header section.', 'my-theme'),
            ] + $defaults
        );

        register_sidebar(
            [
                'id'          => 'sidebar-left',
                'name'        => esc_html__('Left Sidebar', 'my-theme'),
                'description' => esc_html__('Section on the left side.', 'my-theme'),
            ] + $defaults
        );

        register_sidebar(
            [
                'id'          => 'sidebar-right',
                'name'        => esc_html__('Right Sidebar', 'my-theme'),
                'description' => esc_html__('Section on the right side.', 'my-theme'),
            ] + $defaults
        );

        self::registerFooterColumns(3, $defaults);
    }

    /**
     * Register footer columns
     *
     * @param int   $amount The amount of sidebars to register.
     * @param array $args   Optional arguments for `register_sidebar` function.
     */
    public static function registerFooterColumns($amount, $args = [])
    {
        $ordinals = [
            1  => __('First', 'my-theme'),
            2  => __('Second', 'my-theme'),
            3  => __('Third', 'my-theme'),
            4  => __('Fourth', 'my-theme'),
            5  => __('Fifth', 'my-theme'),
            6  => __('Sixth', 'my-theme'),
            7  => __('Seventh', 'my-theme'),
            8  => __('Eighth', 'my-theme'),
            9  => __('Ninth', 'my-theme'),
            10 => __('Tenth', 'my-theme'),
            11 => __('Eleventh', 'my-theme'),
            12 => __('Twelfth', 'my-theme'),
        ];

        for ($n = 1; $n <= $amount; $n++) {
            register_sidebar(
                [
                    'id'          => "footer-$n",
                    'name'        => sprintf(
                        // translators: %1$s Column number
                        esc_html__('Footer Column %1$s', 'my-theme'),
                        $n
                    ),
                    'description' => sprintf(
                        // translators: %1$s Column ordinal number
                        esc_html__('%1$s column in footer section.', 'my-theme'),
                        $ordinals[$n]
                    ),
                ] + $args
            );
        }
    }
}
