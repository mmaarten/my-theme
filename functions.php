<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

/**
 * Check required PHP version.
 */
if (version_compare(PHP_VERSION, '7.0', '<')) {
    error_log(
        sprintf(
            // translators: 1: Theme name. 2: required PHP version. 3: active PHP version.
            __('%1$s requires at least PHP version %2$s. You are running version %3$s.', 'my-theme'),
            'My Theme',
            '7.0',
            PHP_VERSION
        )
    );
    return;
}

/**
 * Check required WordPress version.
 */
if (version_compare($GLOBALS['wp_version'], '5.0', '<')) {
    error_log(
        sprintf(
            // translators: 1: Theme name. 2: required WordPress version. 3: active WordPress version.
            __('%1$s requires at least WordPress version %2$s. You are running version %3$s.', 'my-theme'),
            'My Theme',
            '5.0',
            $GLOBALS['wp_version']
        )
    );
    return;
}

/**
 * Include autoloader.
 */
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!is_readable($autoloader)) {
    error_log(
        sprintf(
            // translators: 1: Theme name. 2: Composer command. 3: theme directory
            __('%1$s installation is incomplete. Run %2$s within the %3$s directory.', 'my-theme'),
            'My Theme',
            '<code>composer install</code>',
            '<code>' . str_replace(ABSPATH, '', __DIR__) . '</code>'
        )
    );
    return;
}
require $autoloader;

/**
 * Load files.
 */
array_map(function ($file) {
    $file = "inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        trigger_error(
            // translators: 1: file location.
            sprintf(__('Error locating %1$s for inclusion.', 'my-theme'), "<code>$file</code>"),
            E_USER_ERROR
        );
    }
}, [
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
]);

/**
 * Load config.
 */

use My\Theme\Container;
use My\Theme\Config;

Container::getInstance()->add('config', function () {
    $items = [];
    foreach (['assets'] as $slug) {
        $file = "config/{$slug}.php";
        if ($located = locate_template($file)) {
            $items[$slug] = require $located;
        } else {
            trigger_error(
                // translators: 1: file location.
                sprintf(__('Error locating %1$s.', 'my-theme'), "<code>$file</code>"),
                E_USER_ERROR
            );
        }
    }
    error_log(print_r($items, true));

    return new Config($items);
});
