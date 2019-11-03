<?php
/**
 * Fire up the application.
 *
 * @package My/Theme
 */

defined('ABSPATH') || exit;

/**
 * Check PHP version.
 */
if (version_compare(PHP_VERSION, '5.6.0', '<')) {
    error_log(
        sprintf(
            // translators: 1: PHP version.
            __('My Theme requires at least PHP version 5.6.0. You are running version %1$s.', 'my-theme'),
            PHP_VERSION
        )
    );
    return;
}

/**
 * Check WordPress version.
 */
if (version_compare($GLOBALS['wp_version'], '5.0.0', '<')) {
    error_log(
        sprintf(
            // translators: 1: WordPress version.
            __('My Theme requires at least WordPress version 5.0.0. You are running version %1$s.', 'my-theme'),
            $GLOBALS['wp_version']
        )
    );
    return;
}

/**
 * Check autoloader.
 */
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!is_readable($autoloader)) {
    error_log(
        sprintf(
            // translators: 1: Composer command. 2: theme directory
            __('My Theme installation is incomplete. Run %1$s within the %2$s directory.', 'my-theme'),
            '<code>composer install</code>',
            '<code>' . str_replace(ABSPATH, '', __DIR__) . '</code>'
        )
    );
    return;
}
require $autoloader;

/**
 * Required files.
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
    'template-functions',
    'template-tags',
]);
