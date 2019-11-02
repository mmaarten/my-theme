<?php
/**
 * Fire up the application.
 *
 * @package My/Theme
 */

namespace My\Theme;

// Load common helper functions.
require get_template_directory() . '/inc/common.php';

/**
 * Ensure compatible version of PHP is used.
 */
if (version_compare('5.4', phpversion(), '>=')) {
    admin_notice(
        __('Invalid PHP version. You must be using PHP 5.4 or greater.', 'my-theme'),
        'error'
    );
    return;
}

/**
 * Ensure compatible version of WordPress is used.
 */
if (version_compare('5.0', get_bloginfo('version'), '>=')) {
    admin_notice(
        __('Invalid WordPress version. You must be using WordPress 5.0 or greater.', 'my-theme'),
        'error'
    );
    return;
}

/**
 * Ensure autoloader exists.
 */
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';
if (! file_exists($autoloader)) {
    admin_notice(
        sprintf(
            __('Autoloader not found. Run <code>composer install</code> from the %s directory.', 'my-theme'),
            basename(__DIR__)
        ),
        'error'
    );
    return;
}
require $autoloader;

/**
 * Load files located inside the 'inc' directory.
 * Supports child theme overrides.
 */
inc([
    'setup.php',
    'assets.php',
    'nav-menus.php',
    'customizer.php',
    'widgets.php',
    'editor.php',
    'template-functions.php',
    'template-tags.php'
]);
