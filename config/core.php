<?php

return [

    /**
     * The name of the theme. Used for notices.
     * @var string
     */
    'theme_name' => wp_get_theme('my-theme')->get('Name'),

    /**
     * Minium required PHP version.
     * @var string
     */
    'php_version' => '7.0',

    /**
     * Minium required WordPress version.
     * @var string
     */
    'wp_version' => '5.0',

    /**
     * List of files to load.
     * @var array
     */
    'autoload_files' => [
        'helpers',
        'setup',
        'assets',
        'widgets',
        'nav-menus',
        'customizer',
        'editor',
        'blocks',
        'template-functions',
        'template-tags',
    ],

    /**
     * List of config files to load.
     * @var array
     */
    'autoload_config' => [
        'assets',
    ],
];
