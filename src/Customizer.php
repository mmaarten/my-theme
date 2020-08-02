<?php
/**
 * Customizer
 *
 * @package My\Theme
 */

namespace My\Theme;

class Customizer
{
    public static function init()
    {
        add_action('customize_preview_init', [__CLASS__, 'previewInit']);
    }

    public static function register($customizer)
    {
        $customizer->get_setting('blogname')->transport        = 'postMessage';
        $customizer->get_setting('blogdescription')->transport = 'postMessage';

        $customizer->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => function () {
                    bloginfo('name');
                },
            )
        );

        $customizer->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => function () {
                    bloginfo('description');
                },
            )
        );
    }

    public static function previewInit()
    {
        wp_enqueue_script(
            'my-theme-customizer',
            get_template_directory_uri() . '/dist/scripts/customizer.js',
            ['customize-preview'],
            MY_THEME_VERSION,
            true
        );
    }
}
