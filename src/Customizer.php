<?php
/**
 * Customizer
 *
 * @package My/Theme
 */

namespace My\Theme;

final class Customizer
{
    /**
     * Initialize
     */
    public static function init()
    {
        add_action('customize_register', [__CLASS__, 'customizeRegister']);
        add_action('customize_preview_init', [__CLASS__, 'customizePreviewInit']);
    }


    /**
     * Add postMessage support for site title and description for the Theme Customizer.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public static function customizeRegister($wp_customize)
    {

        $wp_customize->get_setting('blogname')->transport        = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

        if (isset($wp_customize->selective_refresh)) {
            $wp_customize->selective_refresh->add_partial(
                'blogname',
                [
                    'selector'        => '.site-title a',
                    'render_callback' => [__CLASS__, 'customizePartialBlogName'],
                ]
            );
            $wp_customize->selective_refresh->add_partial(
                'blogdescription',
                [
                    'selector'        => '.site-description',
                    'render_callback' => [__CLASS__, 'customizePartialBlogDescription'],
                ]
            );
        }
    }


    /**
     * Render the site title for the selective refresh partial.
     *
     * @return void
     */
    public static function customizePartialBlogName()
    {
        bloginfo('name');
    }

    /**
     * Render the site tagline for the selective refresh partial.
     *
     * @return void
     */
    public static function customizePartialBlogDescription()
    {
        bloginfo('description');
    }

    /**
     * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
     */
    public static function customizePreviewInit()
    {
        wp_enqueue_script(
            'my-theme-customizer',
            get_template_directory_uri() . '/build/scripts/customizer.js',
            wp_get_theme('my-theme')->get('Version'),
            ["customize-preview"]
        );
    }
}
