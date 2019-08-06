<?php
/**
 * Setup
 *
 * @package MyTheme
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function my_theme_is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_theme_setup() {
	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on My Theme, use a find and replace
	 * to change 'my-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'my-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Register nav menu locations.
	 *
	 * Available locations for this theme:
	 * top-left, top-right, main-left, main-right, footer-left and footer-right.
	 */
	register_nav_menus(
		array(
			'top-left'     => esc_html__( 'Top Left', 'my-theme' ),
			'top-right'    => esc_html__( 'Top Right', 'my-theme' ),
			'main-left'    => esc_html__( 'Primary Left', 'my-theme' ),
			'main-right'   => esc_html__( 'Primary Right', 'my-theme' ),
			'footer-left'  => esc_html__( 'Footer Left', 'my-theme' ),
			'footer-right' => esc_html__( 'Footer Right', 'my-theme' ),
		)
	);

	/**
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo' );
}

add_action( 'after_setup_theme', 'my_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'my_theme_content_width', 1920 );
}

add_action( 'after_setup_theme', 'my_theme_content_width', 0 );
