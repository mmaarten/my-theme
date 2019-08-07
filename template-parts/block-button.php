<?php
/**
 * Template for displaying a button block
 *
 * @var array      $block The block settings and attributes.
 * @var string     $content The block inner HTML (empty).
 * @var bool       $is_preview True during AJAX preview.
 * @var int|string $post_id The post ID this block is saved to.
 *
 * @package MyTheme
 */

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

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
 * Wrapper
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
 * Button
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

<p <?php acf_esc_attr_e( $wrapper ); ?>>
	<a <?php acf_esc_attr_e( $button ); ?>><?php echo esc_html( $fields['text'] ); ?></a>
</p>
