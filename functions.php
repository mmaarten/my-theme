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
    'template-functions',
    'template-tags',
]);

/**
 * Setup application.
 */
use My\Theme\Container;

$app = Container::getInstance();

$app->set('config', function () {
    return new My\Theme\Config([
        'assets' => require get_template_directory() . '/config/assets.php',
        'icons'  => require get_template_directory() . '/config/icons.php',
    ]);
});

$app->set('assets.manifest', function () use ($app) {
    $manifest = $app->get('config')->get('assets.manifest');
    $uri      = $app->get('config')->get('assets.uri');
    return new My\Theme\Assets\Manifest($manifest, $uri);
});

$app->set('icons', function () use ($app) {
    $icons = $app->get('config')->get('icons');
    return new My\Theme\Icons($icons);
});

$app->set('setup', function () {
    return new My\Theme\Setup();
});

$app->set('assets', function () {
    return new My\Theme\Assets();
});

$app->set('widgets', function () {
    return new My\Theme\Widgets();
});

$app->set('nav_menus', function () {
    return new My\Theme\NavMenus();
});

$app->set('blocks', function () {
    return new My\Theme\Blocks();
});

$app->set('acf', function () {
    return new My\Theme\ACF();
});

$app->get('setup')->init();
$app->get('assets')->init();
$app->get('widgets')->init();
$app->get('nav_menus')->init();
$app->get('blocks')->init();
