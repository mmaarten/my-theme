<?php
/**
 * Customizer
 *
 * @package My/Theme
 */

namespace My\Theme;

class Customizer
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('customize_preview_init', [__CLASS__, 'previewInit']);
    }

    /**
     * Register
     *
     * @param WP_Customize_Manager $customizer
     */
    public static function register($customizer)
    {
        $customizer->get_setting('blogname')->transport        = 'postMessage';
        $customizer->get_setting('blogdescription')->transport = 'postMessage';

        $customizer->selective_refresh->add_partial('blogname', [
            'selector'        => '.site-title a',
            'render_callback' => function () {
                bloginfo('name');
            },
        ]);

        $customizer->selective_refresh->add_partial('blogdescription', [
            'selector'        => '.site-description',
            'render_callback' => function () {
                bloginfo('description');
            },
        ]);
    }

    /**
     * Preview Init
     */
    public static function previewInit()
    {
        Assets::enqueueScript(
            'my-theme-customizer',
            get_theme_file_uri('build/customizer.js'),
            ['customize-preview']
        );
    }
}
