<?php
/**
 * Blocks
 *
 * @package My/Theme
 */

namespace My\Theme;

class Blocks
{
    /**
     * Initialize block library features.
     */
    public static function init()
    {
        add_action('after_setup_theme', [__CLASS__, 'registerBlocks']);
        add_action('after_setup_theme', [__CLASS__, 'registerBlockAssets']);
    }

    /**
     * Register blocks.
     */
    public static function registerBlocks()
    {
        $blocks = [
            'Button',
        ];
        foreach ($blocks as $class) {
            $class = __NAMESPACE__ . '\\BlockTypes\\' . $class;
            $instance = new $class();
            $instance->registerBlockType();
        }
    }

    /**
     * Register block assets.
     */
    public static function registerBlockAssets()
    {
        // Common.
        Assets::registerStyle(
            'my-theme-block-editor',
            get_template_directory_uri() . '/build/styles/block-editor.css',
            ['wp-edit-blocks']
        );
        Assets::registerStyle(
            'my-theme-block-style',
            get_template_directory_uri() . '/build/styles/block-style.css'
        );

        // Individual blocks
        Assets::registerScript(
            'my-theme-button-block',
            get_template_directory_uri() . '/build/scripts/block-button.js',
            [],
            true
        );
    }
}
