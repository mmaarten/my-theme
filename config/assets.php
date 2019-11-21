<?php

return [
    /**
     * This theme uses cachebusting. A manifest file is generated containing
     * hashed filenames.
     * @var string
     */
    'manifest' => get_theme_file_path('build/assets.json'),

    /**
     * The URL to the assets directory.
     * @var string
     */
    'uri' => get_theme_file_uri('build'),
];
