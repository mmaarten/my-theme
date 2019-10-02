<?php
/**
 * Common helper functions
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Include files from inside the /inc directory.
 *
 * @param string|array $files The file(s) to include.
 */
function inc($files)
{
    foreach ((array) $files as $file) {
        $located = locate_template("inc/$file");

        if (! $located) {
            trigger_error(
                sprintf('Error locating file <code>inc/%s</code> for inclusion.', esc_html($file)),
                E_USER_ERROR
            );
        }

        include_once $located;
    }
}
