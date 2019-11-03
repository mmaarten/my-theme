<?php
/**
 * Widgets
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function register_sidebars()
{
    $args = [
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
        ] + $args
    );

    register_sidebar(
        [
            'id'          => 'sidebar-left',
            'name'        => esc_html__('Left Sidebar', 'my-theme'),
            'description' => esc_html__('Section on the left side.', 'my-theme'),
        ] + $args
    );

    register_sidebar(
        [
            'id'          => 'sidebar-right',
            'name'        => esc_html__('Right Sidebar', 'my-theme'),
            'description' => esc_html__('Section on the right side.', 'my-theme'),
        ] + $args
    );

    register_sidebar(
        [
            'id'          => 'footer',
            'name'        => esc_html__('Footer', 'my-theme'),
            'description' => esc_html__('Footer section.', 'my-theme'),
        ] + $args
    );
}
add_action('widgets_init', __NAMESPACE__ . '\register_sidebars');
