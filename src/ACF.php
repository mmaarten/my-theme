<?php
/**
 * Advanced Custom Fields
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package My/Theme
 */

namespace My\Theme;

class ACF
{
    /**
     * Init
     */
    public static function init()
    {
        add_action('acf/init', [__CLASS__, 'addOptionsPage']);
    }

    /**
     * Add options page
     */
    public static function addOptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title'  => __('Site Options', 'my-theme'),
                'menu_title'  => __('Site Options', 'my-theme'),
                'menu_slug'   => 'theme-options',
                'capability'  => 'manage_options',
                'parent_slug' => null,
            ]);
        }
    }
}
