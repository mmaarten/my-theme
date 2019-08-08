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

/**
 * Register widget areas described as footer columns.
 *
 * @param int   $amount The amount of sidebars to register.
 * @param array $args   Arguments for function register_sidebar.
 */
function my_theme_register_footer_columns( $amount, $args = array() ) {

	$ordinals = array(
		1 => __( 'first', 'my-theme' ),
		2 => __( 'second', 'my-theme' ),
		3 => __( 'thirth', 'my-theme' ),
		4 => __( 'fourth', 'my-theme' ),
		5 => __( 'fifth', 'my-theme' ),
		6 => __( 'sixth', 'my-theme' ),
		7 => __( 'seventh', 'my-theme' ),
		8 => __( 'eighth', 'my-theme' ),
		9 => __( 'ninth', 'my-theme' ),
	);

	for ( $n = 1; $n <= $amount; $n++ ) {
		register_sidebar(
			array(
				'id'          => "footer-column-$n",
				// translators: %d: column number.
				'name'        => sprintf( esc_html__( 'Footer Column %d', 'my-theme' ), $n ),
				// translators: %s: column number (ordinal).
				'description' => sprintf( esc_html__( '%s column in footer section.', 'my-theme' ), ucfirst( $ordinals[ $n ] ) ),
			) + $args
		);
	}
}
