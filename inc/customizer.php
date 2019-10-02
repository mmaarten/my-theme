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
                'render_callback' => __NAMESPACE__ . '\customize_partial_blogname',
            ]
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            [
                'selector'        => '.site-description',
                'render_callback' => __NAMESPACE__ . '\customize_partial_blogdescription',
            ]
        );
    }
}

add_action('customize_register', __NAMESPACE__ . '\customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customize_preview_js()
{
    $theme = wp_get_theme();
    wp_enqueue_script(
        'my_theme-customizer',
        get_template_directory_uri() . '/dist/scripts/customizer.js',
        ["customize-preview"],
        $theme->get('Version'),
        true
    );
}

add_action('customize_preview_init', __NAMESPACE__ . '\customize_preview_js');
