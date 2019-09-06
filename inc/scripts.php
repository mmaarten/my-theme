<?php
/**
 * Scripts
 *
 * @package My/Theme
 */

namespace My\Theme;

/**
 * Enqueue scripts and styles.
 */
function scripts() {

	$theme         = wp_get_theme();
	$theme_version = $theme->get( 'Version' );

	$css_version = filemtime( get_template_directory() . '/dist/styles/main.css' );
	wp_enqueue_style( 'my_theme-style', get_template_directory_uri() . '/dist/styles/main.css', array(), "{$theme_version}.{$css_version}" );

	$js_version = filemtime( get_template_directory() . '/dist/scripts/main.js' );
	wp_enqueue_script( 'my_theme-script', get_template_directory_uri() . '/dist/scripts/main.js', array( 'jquery' ), "{$theme_version}.$js_version", true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\scripts' );
