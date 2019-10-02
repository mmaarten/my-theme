<?php
/**
 * Theme functions and definitions
 *
 * @package My/Theme
 */

/**
 * Check autoloader.
 */

$autoloader = dirname(__FILE__) . '/vendor/autoload.php';

if (! is_readable($autoloader)) {
    trigger_error(
        sprintf(
            // translators: %1$s Code to run.
            __('Autoloader not found. Run %1$s', 'my-theme'),
            '<code>composer install</code>'
        ),
        E_USER_WARNING
    );
    return;
}

/**
 * Check build.
 */

$build_file = dirname(__FILE__) . '/build/styles/style.css';

if (! is_readable($build_file)) {
    trigger_error(
        sprintf(
            // translators: %1$s Code to run.
            __('Not build. Run %1$s', 'my-theme'),
            '<code>npm install</code>'
        ),
        E_USER_WARNING
    );
    return;
}

/**
 * Fire up the application.
 */

// Include autoloader.
require $autoloader;

// Load common helper functions.
require get_template_directory() . '/inc/common.php';

// Include files from inside the /inc directory.
\My\Theme\inc(
    [
        'setup.php',              // Set up theme defaults and register support for features.
        'nav-menus.php',          // Custom navigation menu functions.
        'widgets.php',            // Register widget areas.
        'assets.php',             // Enqueue scripts and styles.
        'template-tags.php',      // Custom template tags for this theme.
        'template-functions.php', // Functions which enhance the theme by hooking into WordPress.
        'customizer.php',         // Customizer additions.
        'editor.php',             // Custom editor features.
    ]
);
