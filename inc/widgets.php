<?php
/**
 * Widgets
 *
 * @package MyTheme
 */

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_theme_widgets_init() {

	$defaults = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array(
			'id'            => 'header',
			'name'          => esc_html__( 'Header', 'my-theme' ),
			'description'   => esc_html__( 'Header section.', 'my-theme' ),
		) + $defaults
	);

	register_sidebar(
		array(
			'id'            => 'sidebar-left',
			'name'          => esc_html__( 'Left Sidebar', 'my-theme' ),
			'description'   => esc_html__( 'Section on the left side.', 'my-theme' ),
		) + $defaults
	);

	register_sidebar(
		array(
			'id'            => 'sidebar-right',
			'name'          => esc_html__( 'Right Sidebar', 'my-theme' ),
			'description'   => esc_html__( 'Section on the right side.', 'my-theme' ),
		) + $defaults
	);

	register_sidebar(
		array(
			'id'            => 'footer',
			'name'          => esc_html__( 'Footer', 'my-theme' ),
			'description'   => esc_html__( 'Footer section.', 'my-theme' ),
		) + $defaults
	);
}

add_action( 'widgets_init', 'my_theme_widgets_init' );
