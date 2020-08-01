<?php
/**
 * Customizer
 *
 * @package My/Theme
 */

namespace My\Theme;

function customize_register($customizer)
{
    $wp_customize->get_setting('blogname')->transport        = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->selective_refresh->add_partial(
        'blogname',
        array(
            'selector'        => '.site-title a',
            'render_callback' => function () {
                bloginfo('name');
            },
        )
    );

    $wp_customize->selective_refresh->add_partial(
        'blogdescription',
        array(
            'selector'        => '.site-description',
            'render_callback' => function () {
                bloginfo('description');
            },
        )
    );
}

/**
 * Enqueue scripts for the customizer preview.
 */
function customize_preview_init()
{
    wp_enqueue_script(
        'my-theme-customizer',
        get_template_directory_uri() . '/dist/scripts/customizer.js',
        ['customize-preview'],
        MY_THEME_VERSION,
        true
    );
}

add_action('customize_preview_init', __NAMESPACE__ . '\customize_preview_init');
