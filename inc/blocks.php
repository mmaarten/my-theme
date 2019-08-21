<?php
/**
 * Blocks
 *
 * Dependency: Advanced Custom Fields pro
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Register block types
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
 *
 * @uses acf_register_block_type()
 *
 * @example
acf_register_block_type(
	array(
		'name'            => 'my-block',
		'title'           => __( 'My Block', 'my-theme' ),
		'description'     => __( 'Displays my block.', 'my-theme' ),
		'render_callback' => __NAMESPACE__ . '\my_block',
		'category'        => 'common',
		'supports'        => array(
			'anchor' => true,
			'align'  => array( 'wide', 'full' ),
		),
	)
);
 */
function register_block_types() {

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( 'Function <code>acf_register_block_type</code> does not exist.', E_USER_WARNING );
		return;
	}
}

add_action( 'acf/init', __NAMESPACE__ . '\register_block_types' );

/**
 * Enqueue block assets for both editor and front-end.
 *
// Dequeue WordPress front-end stylesheet
wp_dequeue_style( 'wp-block-library' );
 */
function enqueue_block_assets() {

	if ( ! is_admin() ) {
		$theme         = wp_get_theme();
		$theme_version = $theme->get( 'Version' );

		$css_version = filemtime( get_template_directory() . '/dist/styles/blocks.css' );
		wp_enqueue_style( 'my_theme-blocks', get_template_directory_uri() . '/dist/styles/blocks.css', array(), "{$theme_version}.{$css_version}" );
	}
}

add_action( 'enqueue_block_assets', __NAMESPACE__ . '\enqueue_block_assets' );

/**
 * My Block Callback Function.
 *
 * @link https://owlcarousel2.github.io/OwlCarousel2/
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/#examples
 *
 * @uses get_fields()
 * @uses acf_esc_attr()
 *
 * @param array      $block      The block settings and attributes.
 * @param string     $content    The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id    The post ID this block is saved to.
 */
function my_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	/**
	 * Arguments
	 * -------------------------------------------------------------------------
	 */

	$args = wp_parse_args(
		get_fields(),
		array(
			'my_field' => '',
		)
	);

	/**
	 * Wrapper HTML attributes
	 * -------------------------------------------------------------------------
	 */

	$wrapper = array();

	// Add block specific class.
	$wrapper['class'] = 'wp-block-' . str_replace( '/', '-', $block['name'] );

	// Apply 'align' setting.
	if ( ! empty( $block['align'] ) ) {
		$wrapper['class'] .= " align{$block['align']}";
	}

	// Apply 'custom CSS classes' setting.
	if ( ! empty( $block['className'] ) ) {
		$wrapper['class'] .= " {$block['className']}";
	}

	// Apply 'anchor' setting.
	if ( ! empty( $block['anchor'] ) ) {
		$wrapper['id'] = $block['anchor'];
	}

	/**
	 * Output
	 * -------------------------------------------------------------------------
	 */

	echo '<div ' . acf_esc_attr( $wrapper ) . '>';

	echo '</div>';
}
