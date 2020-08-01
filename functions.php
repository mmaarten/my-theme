<?php

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
 * Load constants
 */
require_once get_theme_file_path('inc/constants.php');

/**
 * Init classes
 */
array_map(function ($class) {
    $child_ns = apply_filters('my_theme_child_ns', null);
    $class = $child_ns && class_exists("$child_ns\\$class") ? "$child_ns\\$class" : "My\Theme\\$class";
    call_user_func([$class, 'init']);
}, [
    'Setup',
    'Assets',
    'Widgets',
    'NavMenus',
    'Customizer',
    'Blocks',
    'ACF',
    'Breadcrumbs',
    'LoginForm',
    'Hooks',
]);
