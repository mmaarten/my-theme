<?php
/**
 * Common
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Display a message on the admin pages.
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
 * @param string $message
 * @param string $type
 */
function admin_notice($message, $type = 'info')
{
    add_action('admin_notices', function () use ($message, $type) {
        printf(
            '<div class="notice notice-%1$s"><p><strong>%2$s:</strong> %3$s</p></div>',
            sanitize_html_class($type),
            esc_html__('My Theme', 'my-theme'),
            $message
        );
    });
}

/**
 * Load files located inside the 'inc' directory. Supports child theme overrides.
 *
 * @param string|array $files
 */
function inc($files)
{
    foreach ((array) $files as $file) {
        $file = "inc/$file";
        if (!locate_template($file, true, true)) {
            trigger_error(
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'my-theme'), $file),
                E_USER_ERROR
            );
        }
    }
}
