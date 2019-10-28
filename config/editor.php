<?php
/**
 * Editor config
 *
 * @package My/Theme
 */

return [
    /**
     * Colors
     *
     * @var array
     */
    'colors' => [
        [
            'name'  => __('Primary', 'my-theme'),
            'slug'  => 'primary',
            'color' => '#007bff', // Value of `$primary`.
        ],
        [
            'name'  => __('Secondary', 'my-theme'),
            'slug'  => 'secondary',
            'color' => '#6c757d', // Value of `$secondary`.
        ],
        [
            'name'  => __('Light', 'my-theme'),
            'slug'  => 'light',
            'color' => '#f8f9fa', // Value of `$light`.
        ],
        [
            'name'  => __('Dark', 'my-theme'),
            'slug'  => 'dark',
            'color' => '#343a40', // Value of `$dark`.
        ],
    ],

    /**
     * Font sizes
     *
     * @var array
     */
    'font_sizes' => [
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
     * Set editor normalization style. (relative to theme directory)
     *
     * @var false|string
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
     * Enable/disable editor for post types.
     *
     * @var array
     */
    'use_for_post_type' => [
        'post' => true,
        'page' => true,
    ],
];
