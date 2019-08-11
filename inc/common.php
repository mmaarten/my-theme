<?php
/**
 * Common helper functions
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Include files from inside the /inc directory.
 *
 * @param string|array $files The file(s) to include.
 */
function inc( $files ) {

	foreach ( (array) $files as $file ) {

		$located = locate_template( "inc/$file" );

		if ( ! $located ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			trigger_error( sprintf( 'Error locating file <code>inc/%s</code> for inclusion.', esc_html( $file ) ), E_USER_ERROR );
		}

		include_once $located;
	}
}

/**
 * Parse HTML attributes array into a string.
 *
 * @param array $atts The attribute name-value pairs.
 *
 * @return string
 */
function html_atts( $atts ) {

	$html = '';

	foreach ( $atts as $name => $value ) {
		$html .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
	}

	return $html;
}