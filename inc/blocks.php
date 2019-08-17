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
 */
function register_block_types() {

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( 'Function <code>acf_register_block_type</code> does not exist.', E_USER_WARNING );
		return;
	}

	// Register button block.
	acf_register_block_type(
		array(
			'name'            => 'button',
			'title'           => __( 'Button', 'my-theme' ),
			'description'     => __( 'Displays a button.', 'my-theme' ),
			'render_callback' => __NAMESPACE__ . '\button_block',
			'category'        => 'common',
			'supports'        => array(
				'anchor' => true,
				'align'  => array( 'left', 'center', 'right' ),
			),
		)
	);
}

add_action( 'acf/init', __NAMESPACE__ . '\register_block_types' );

/**
 * Filter the allowed block types for the editor.
 *
// Set limitions.
$allowed_block_types = array(
	'core/block', // Required for reusable blocks.
	'core/heading',
	'core/paragraph',
	'core/image',
	'core/list',
	'core/embed',
	'core/html',
	'core/shortcode',
	'core/template',
	'core/video',
	'core/columns',
);
 *
 * @uses acf_get_block_types()
 *
 * @param bool|array $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $post                The post resource data.
 *
 * @return bool|array
 */
function allowed_block_types( $allowed_block_types, $post ) {

	// Include our ACF block types when limitions are set.
	if ( is_array( $allowed_block_types ) && function_exists( 'acf_get_block_types' ) ) {
		$allowed_block_types = array_merge( $allowed_block_types, array_keys( acf_get_block_types() ) );
	}

	return $allowed_block_types;
}

add_filter( 'allowed_block_types', __NAMESPACE__ . 'allowed_block_types', 10, 2 );

/**
 * Filter whether a post is able to be edited in the block editor.
 *
 * @param bool    $use_block_editor Whether the post can be edited or not.
 * @param WP_Post $post             The post being checked.
 *
 * @return bool
 */
function use_block_editor_for_post( $use_block_editor, $post ) {

	return $use_block_editor;
}

add_filter( 'use_block_editor_for_post', __NAMESPACE__ . 'use_block_editor_for_post', 10, 2 );

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
 * Button block callback function
 *
 * @uses get_fields()
 * @uses acf_esc_attr_e()
 *
 * @param array      $block      The block settings and attributes.
 * @param string     $content    The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id    The post ID this block is saved to.
 */
function button_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	/**
	 * Arguments
	 */

	$args = wp_parse_args(
		get_fields(),
		array(
			'text'     => __( 'Button', 'my-theme' ),
			'link'     => '#',
			'link_tab' => false,
			'type'     => 'primary',
			'size'     => '',
			'outline'  => false,
			'block'    => false,
			'toggle'   => '',
		)
	);

	/**
	 * Wrapper HTML attributes
	 */

	$wrapper = array();

	$wrapper['class'] = 'wp-block-' . str_replace( '/', '-', $block['name'] );

	if ( ! empty( $block['anchor'] ) ) {
		$wrapper['id'] = $block['anchor'];
	}

	// Clear floats when alignment is set.
	if ( ! empty( $block['align'] ) ) {
		$wrapper['class'] .= ' clearfix';
	}

	if ( ! empty( $block['className'] ) ) {
		$wrapper['class'] .= " {$block['className']}";
	}

	/**
	 * Button HTML attributes
	 */

	$button = array(
		'class' => 'btn',
		'role'  => 'button',
	);

	if ( $args['link'] ) {
		$button['href'] = esc_url( $args['link'] );
	}

	if ( $args['link_tab'] ) {
		$button['target'] = '_blank';
	}

	if ( $args['outline'] ) {
		$button['class'] .= " btn-outline-{$args['type']}";
	} else {
		$button['class'] .= " btn-{$args['type']}";
	}

	if ( $args['size'] ) {
		$button['class'] .= " btn-{$args['size']}";
	}

	if ( $args['block'] ) {
		$button['class'] .= ' btn-block';
	}

	if ( $args['toggle'] ) {
		$button['data-toggle'] .= $args['toggle'];
	}

	if ( ! empty( $block['align'] ) ) {
		$button['class'] .= " align{$block['align']}";
		if ( ! $args['block'] ) {
			$button['class'] .= ' d-table';
		}
	}

	/**
	 * Output
	 */

	?>

	<p <?php acf_esc_attr_e( $wrapper ); ?>>

		<a <?php acf_esc_attr_e( $button ); ?>><?php echo esc_html( $args['text'] ); ?></a>

	</p>

	<?php
}
