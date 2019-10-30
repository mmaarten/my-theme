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
 * Fire up the application.
 */
require $autoloader;

Setup::init();
Assets::init();
Navs::init();
Widgets::init();
Customizer::init();
Editor::init();

require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/template-tags.php';
