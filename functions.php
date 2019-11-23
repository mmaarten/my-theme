<?php // phpcs:disable PSR1.Files.SideEffects.FoundWithSymbols

$config = require get_parent_theme_file_path('config/core.php');

/**
 * Check required PHP version.
 */
if (version_compare(PHP_VERSION, $config['php_version'], '<')) {

    function my_theme_invalid_php_version_notice()
    {
        $config = $GLOBALS['config'];

        $message = sprintf(
            // translators: 1: Theme name. 2: required PHP version. 3: active PHP version.
            __('%1$s requires at least PHP version %2$s. You are running version %3$s.', 'my-theme'),
            $config['theme_name'],
            $config['php_version'],
            PHP_VERSION
        );

        printf('<div class="notice notice-error"><p>%s</p></div>', esc_html($message));
    }
    add_action('admin_notices', 'my_theme_invalid_php_version_notice');
    return;
}

/**
 * Check required WordPress version.
 */
if (version_compare($GLOBALS['wp_version'], $config['wp_version'], '<')) {
    add_action('admin_notices', function () {
        $message = sprintf(
            // translators: 1: Theme name. 2: required WordPress version. 3: active WordPress version.
            __('%1$s requires at least WordPress version %2$s. You are running version %3$s.', 'my-theme'),
            $config['theme_name'],
            $config['wp_version'],
            $GLOBALS['wp_version']
        );
        printf('<div class="notice notice-error"><p>%s</p></div>', esc_html($message));
    });
    return;
}

/**
 * Check autoloader.
 */
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!is_readable($autoloader)) {
    error_log(
        sprintf(
            // translators: 1: Theme name. 2: Composer command. 3: theme directory
            __('%1$s installation is incomplete. Run %2$s within the %3$s directory.', 'my-theme'),
            $config['theme_name'],
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
}, $config['autoload_files']);

/**
 * Load config.
 */

use My\Theme\Container;
use My\Theme\Config;

Container::getInstance()->add('config', function () use ($config) {
    $items = ['core' => $config];
    foreach ($config['autoload_config'] as $slug) {
        $file = "config/{$slug}.php";
        if ($located = locate_template($file)) {
            $items[$slug] = require $located;
        } else {
            trigger_error(
                // translators: 1: file location.
                sprintf(__('Error locating %1$s for inclusion.', 'my-theme'), "<code>$file</code>"),
                E_USER_ERROR
            );
        }
    }
    return new Config($items);
});
