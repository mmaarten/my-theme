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

namespace MyTheme;

/**
 * Register block types
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_block_type/
 *
 * @uses acf_register_block_type()
 */
function register_block_types() {

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	// Register button block.
	acf_register_block_type(
		array(
			'name'            => 'button',
			'title'           => __( 'Button', 'my-theme' ),
			'description'     => __( 'Displays a button.', 'my-theme' ),
			'render_callback' => 'my_theme_button_block',
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
 * Button block
 *
 * @uses get_fields()
 * @uses acf_esc_attr_e()
 *
 * @param array      $block The block settings and attributes.
 * @param string     $content The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id The post ID this block is saved to.
 *
 * @package MyTheme
 */
function button_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	// Get field data.
	$fields = wp_parse_args(
		get_fields(),
		array(
			'text'     => __( 'Button', 'my-theme' ),
			'link'     => '#', // Empty link does not apply button text color.
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

	// Add block type specific class.
	$wrapper['class'] = 'wp-block-' . str_replace( '/', '-', $block['name'] );

	// Apply 'HTML Anchor' setting.
	if ( ! empty( $block['anchor'] ) ) {
		$wrapper['id'] = $block['anchor'];
	}

	// Apply 'Additional CSS Class' setting.
	if ( ! empty( $block['className'] ) ) {
		$wrapper['class'] .= " {$block['className']}";
	}

	if ( ! empty( $block['align'] ) ) {
		$wrapper['class'] .= ' clearfix';
	}

	/**
	 * Button HTML attributes
	 */

	$button = array(
		'class' => 'btn',
		'role'  => 'button',
	);

	if ( $fields['outline'] ) {
		$button['class'] .= " btn-outline-{$fields['type']}";
	} else {
		$button['class'] .= " btn-{$fields['type']}";
	}

	if ( $fields['link'] ) {
		$button['href'] = esc_url( $fields['link'] );
	}

	if ( $fields['link_tab'] ) {
		$button['target'] = '_blank';
	}

	if ( $fields['size'] ) {
		$button['class'] .= " btn-{$fields['size']}";
	}

	if ( $fields['block'] ) {
		$button['class'] .= ' btn-block';
	}

	if ( $fields['toggle'] ) {
		$button['data-toggle'] = $fields['toggle'];
	}

	// Apply 'align' setting.
	if ( ! empty( $block['align'] ) ) {
		$button['class'] .= " align{$block['align']}";

		// Prevent button from stretching into parent.
		if ( 'center' === $block['align'] ) {
			$button['class'] .= ' d-table';
		}
	}

	/**
	 * Output
	 */

	?>

	<p <?php echo my_theme_html_atts( $wrapper ); ?>>
		<a <?php echo my_theme_html_atts( $button ); ?>><?php echo esc_html( $fields['text'] ); ?></a>
	</p>

	<?php
}
