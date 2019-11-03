<?php
/**
 * Customizer
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport        = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            [
                'selector'        => '.site-title a',
                'render_callback' => function () {
                    bloginfo('name');
                },
            ]
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            [
                'selector'        => '.site-description',
                'render_callback' => function () {
                    bloginfo('description');
                },
            ]
        );
    }
}
add_action('customize_register', __NAMESPACE__ . '\customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customize_preview_script()
{
    wp_enqueue_script(
        'my-theme-customizer',
        get_template_directory_uri() . '/build/scripts/customizer.js',
        ['customize-preview']
    );
}
add_action('customize_preview_init', __NAMESPACE__ . '\customize_preview_script');
