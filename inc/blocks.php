<?php
/**
 * Blocks
 *
 * Dependency: Advanced Custom Fields PRO
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package MyTheme
 */

/**
 * Register block types
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @uses acf_register_block_type()
 */
function my_theme_register_block_types() {

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	// Register a testimonial block.
	acf_register_block_type(
		array(
			'name'            => 'button',
			'title'           => __( 'Button', 'my-theme' ),
			'description'     => __( 'Displays a button.', 'my-theme' ),
			'render_template' => 'template-parts/block-button.php',
			'category'        => 'common',
		)
	);
}

add_action( 'acf/init', 'my_theme_register_block_types' );
