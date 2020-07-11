<?php

/**
 * Check required PHP version.
 */
if (version_compare(PHP_VERSION, '5.6', '<')) {
    error_log(
        sprintf(
            // translators: 1: Theme name. 2: required PHP version. 3: active PHP version.
            __('%1$s requires at least PHP version %2$s. You are running version %3$s.', 'my-theme'),
            'My Theme',
            '5.6',
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
require_once get_template_directory() . '/inc/constants.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Init
 */
My\Theme\Setup::init();
My\Theme\Assets::init();
My\Theme\Widgets::init();
My\Theme\NavMenus::init();
My\Theme\Editor::init();
My\Theme\Blocks::init();
My\Theme\ACF::init();
