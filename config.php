<?php
/**
 * Config
 *
 * @package My/Theme
 */

return [

    'textdomain' => 'my-theme',
    'languages_dir' => get_template_directory() . '/languages',

    /**
     * Add default posts and comments RSS feed links to head.
     *
     * @var bool
     */
    'automatic_feed_links' => true,

    /**
     * Let WordPress manage the document title.
     *
     * @var bool
     */
    'title_tag' => true,

    /**
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @var bool
     */
    'post_thumbnails' => true,

    /**
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     *
     * @var array
     */
    'html5' => [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ],

    /**
     * Add support for core custom logo.
     *
     * @var bool
     */
    'custom_logo' => true,

    /**
     * Set the content width in pixels, based on the theme's design and stylesheet.
     *
     * @var int
     */
    'content_width' => 1290,

    /**
     * Modify of the list of image sizes that are available in the WordPress Media Library.
     *
     * @var array
     */
    'image_size_names_choose' => [],

    /**
     * Editor colors.
     *
     * @var array
     */
    'editor_colors' => [
        [
            'name'  => __('Primary', 'my-theme'),
            'slug'  => 'primary',
            'color' => '#007bff',
        ],
        [
            'name'  => __('Secondary', 'my-theme'),
            'slug'  => 'secondary',
            'color' => '#6c757d',
        ],
        [
            'name'  => __('Light', 'my-theme'),
            'slug'  => 'light',
            'color' => '#f8f9fa',
        ],
        [
            'name'  => __('Dark', 'my-theme'),
            'slug'  => 'dark',
            'color' => '#343a40',
        ],
    ],

    /**
     * Editor font sizes.
     *
     * @var array
     */
    'editor_font_sizes' => [
        [
            'name'      => __('Small', 'my-theme'),
            'shortName' => __('SM', 'my-theme'),
            'size'      => 16 * 0.875, // Value of `$font-size-sm`.
            'slug'      => 'small',
        ],
        [
            'name'      => __('Normal', 'my-theme'),
            'shortName' => __('N', 'my-theme'),
            'size'      => 16, // Value of `$font-size-base`.
            'slug'      => 'normal',
        ],
        [
            'name'      => __('Large', 'my-theme'),
            'shortName' => __('LG', 'my-theme'),
            'size'      => 16 * 1.25, // Value of `$font-size-lg`.
            'slug'      => 'large',
        ],
    ],

    /**
     * Enable align 'wide' and 'full' block settings.
     *
     * @var bool
     */
    'align_wide' => true,

    /**
     * Enable responsive embeds.
     *
     * @var bool
     */
    'responsive_embeds' => true,

    /**
     * Disable custom colors.
     *
     * @var bool
     */
    'disable_custom_colors' => false,

    /**
     * Disable custom font sizes.
     *
     * @var bool
     */
    'disable_custom_font_sizes' => false,

    /**
     * Editor normalization style.
     *
     * @var string
     */
    'editor_style' => 'build/styles/editor-styles.css',

    /**
     * Use dark editor style.
     *
     * @var bool
     */
    'dark_editor_style' => false,

    /**
     * Allowed block types for the editor.
     *
     * @var bool|array
     */
    'allowed_block_types' => true,

    /**
     * Use editor for post_type.
     *
     * @var array
     */
    'use_block_editor_for_post_type' => [
        'post' => true,
        'page' => true,
    ],
];
