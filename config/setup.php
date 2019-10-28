<?php
/**
 * Setup config
 *
 * @package My/Theme
 */

return [
    /**
     * Content width
     *
     * @var int
     */
    'content_width' => 1290,

    /**
     * Textdomain
     *
     * @var string
     */
    'textdomain' => 'my-theme',

    /**
     * Path to the translation files.
     *
     * @var string
     */
    'languages_path' => dirname(__FILE__) . '/languages',

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
     * HTML 5 support
     *
     * @var array
     */
    'html5' => [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ],

    /**
     * Add support for core custom logo.
     *
     * @var string
     */
    'custom_logo' => true,

    /**
     * list of custom image sizes
     *
     * @var array
     */
    'custom_image_sizes' => [
        'my-theme-full-width' => [
            'width'      => 1920,
            'height'     => 1080,
            'crop'       => false,
        ],
    ],

    /**
     * list of image sizes that are available in the WordPress Media Library.
     *
     * @var array
     */
    'image_size_names_choose' => [
        'my-theme-full-width' => __('Full Page Width', 'my-theme'),
    ],
];
