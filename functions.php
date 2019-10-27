<?php
/**
 * Boot
 *
 * @package My/Theme
 */

namespace My\Theme;

$theme = wp_get_theme('my-theme');

/**
 * Check PHP version.
 */
$php_version = '5.4.0';
if (version_compare(PHP_VERSION, $php_version, '<')) {
    error_log(
        sprintf(
            // translators: %1$s Theme name, %2$s PHP version.
            __('%1$s requires at least PHP version %2$s.', 'my-theme'),
            $theme->get('Name'),
            $php_version
        )
    );
    return;
}

/**
 * Check WordPress version.
 */
$wp_version = '5.0.0';
if (! isset($GLOBALS['wp_version']) || version_compare($GLOBALS['wp_version'], $wp_version, '<')) {
    error_log(
        sprintf(
            // translators: %1$s Theme name, %2$s WordPress version.
            __('%1$s requires at least WordPress version %2$s.', 'my-theme'),
            $theme->get('Name'),
            $wp_version
        )
    );
    return;
}

/**
 * Check build.
 */
$build_file = dirname(__FILE__) . '/build/styles/main.css';
if (! is_readable($build_file)) {
    error_log(
        sprintf(
            // translators: %1$s Plugin name, %2$s Code to run.
            __('%1$s installation is not complete. Run %2$s', 'my-theme'),
            $theme->get('Name'),
            '<code>npm run build</code>'
        )
    );
    return;
}

/**
 * Check autoloader.
 */
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';
if (! is_readable($autoloader)) {
    error_log(
        sprintf(
            // translators: %1$s Theme name, %2$s Code to run.
            __('%1$s installation is not complete. Run %2$s', 'my-theme'),
            $theme->get('Name'),
            '<code>composer install</code>'
        )
    );
    return;
}

/**
 * Check required plugins.
 *
 * @example
$plugins = [
    'advanced-custom-fields/acf.php' => __('Advanced Custom Fields', 'my-theme'),
];
 *
 */
$plugins = [];
if ($plugins) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    $active_plugins = array_filter(array_keys($plugins), 'is_plugin_active');
    $inactive_plugins = array_diff_key($plugins, array_flip($active_plugins));
    if ($inactive_plugins) {
        $message = sprintf(
            // translators: %1$s Theme name, %2$s List of plugins.
            __('%1$s requires following plugins: %2$s.', 'my-theme'),
            $theme->get('Name'),
            implode(', ', $inactive_plugins)
        );
        trigger_error($message, is_admin() ? E_USER_WARNING : E_USER_ERROR);
        return;
    }
}

/**
 * Fire up the application.
 */
require $autoloader;

$includes = [
    'setup.php',
    'assets.php',
    'nav-menus.php',
    'widgets.php',
    'customizer.php',
    'editor.php',
    'template-functions.php',
    'template-tags.php',
];

foreach ($includes as $file) {
    $located = locate_template("inc/$file");
    if (! $located) {
        trigger_error(
            sprintf(
                // translators: %1$s Path to file.
                __('Unable to locate file %1$s for inclusion.', 'my-theme'),
                sprintf('<code>inc/%s</code>', esc_html($file))
            ),
            E_USER_ERROR
        );
    }
}
