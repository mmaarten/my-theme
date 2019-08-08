<?php
/**
 * Hero image
 *
 * Dependency: Advanced Custom Fields
 *
 * @link https://www.advancedcustomfields.com/
 *
 * @package MyTheme
 */

/**
 * Display hero image
 *
 * @uses get_field()
 * @uses acf_esc_attr_e()
 *
 * @param array $args The arguments.
 */
function my_theme_hero_image( $args = array() ) {

	if ( ! function_exists( 'get_field' ) || ! get_field( 'hero_image_enable' ) ) {
		return;
	}

	$args = wp_parse_args( $args, array( 'fluid' => true ) );

	$title = get_field( 'hero_image_title' );
	$text  = get_field( 'hero_image_text' );
	$image = get_field( 'hero_image_image' );

	list( $image_url ) = (array) wp_get_attachment_image_src( $image, 'theme-full-width' );

	$atts = array(
		'id'    => 'hero-image',
		'class' => 'jumbotron',
	);

	if ( $args['fluid'] ) {
		$atts['class'] .= ' jumbotron-fluid';
	}

	if ( $image_url ) {
		$atts['class'] .= ' bg-cover bg-center';
		$atts['style']  = sprintf( 'background-image:url(%s);', esc_url( $image_url ) );
	}

	?>

	<div <?php acf_esc_attr_e( $atts ); ?>>

		<?php if ( $args['fluid'] ) : ?>
		<div class="container">
		<?php endif; ?>

			<?php if ( $title ) : ?>

			<h1 class="display-4"><?php echo esc_html( $title ); ?></h1>

			<?php endif; ?>

			<?php if ( $text ) : ?>

			<div class="lead">

				<?php echo $text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

			</div><!-- .lead -->

			<?php endif; ?>

		<?php if ( $args['fluid'] ) : ?>
		</div><!-- .container -->
		<?php endif; ?>

	</div><!-- #hero-image -->

	<?php
}

/**
 * Add hero image fields
 *
 * @uses acf_add_local_field_group()
 * @uses acf_add_local_field()
 */
function my_theme_hero_image_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) || ! function_exists( 'acf_add_local_field' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'my_theme_hero_image',
			'title'                 => __( 'Hero Image', 'my-theme' ),
			'fields'                => array(),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'acf_after_title',
			'style'                 => 'seamless',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	acf_add_local_field(
		array(
			'key'               => 'my_theme_hero_image_title',
			'label'             => __( 'Title', 'my-theme' ),
			'name'              => 'hero_title',
			'type'              => 'text',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'default_value'     => '',
			'placeholder'       => '',
			'prepend'           => '',
			'append'            => '',
			'maxlength'         => '',
			'parent'            => 'my_theme_hero_image',
		)
	);

	acf_add_local_field(
		array(
			'key'               => 'my_theme_hero_image_text',
			'label'             => __( 'Text', 'my-theme' ),
			'name'              => 'hero_text',
			'type'              => 'wysiwyg',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'default_value'     => '',
			'tabs'              => 'visual',
			'toolbar'           => 'basic',
			'media_upload'      => 0,
			'delay'             => 0,
			'parent'            => 'my_theme_hero_image',
		)
	);

	acf_add_local_field(
		array(
			'key'               => 'my_theme_hero_image_image',
			'label'             => __( 'Image', 'my-theme' ),
			'name'              => 'hero_image',
			'type'              => 'image',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'return_format'     => 'id',
			'preview_size'      => 'medium',
			'library'           => 'all',
			'min_width'         => '',
			'min_height'        => '',
			'min_size'          => '',
			'max_width'         => '',
			'max_height'        => '',
			'max_size'          => '',
			'mime_types'        => '',
			'parent'            => 'my_theme_hero_image',
		)
	);

	acf_add_local_field(
		array(
			'key'               => 'my_theme_hero_image_enable',
			'label'             => __( 'Enable', 'my-theme' ),
			'name'              => 'hero_enable',
			'type'              => 'true_false',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => array(
				'width' => '',
				'class' => '',
				'id'    => '',
			),
			'message'           => '',
			'default_value'     => 0,
			'ui'                => 0,
			'ui_on_text'        => '',
			'ui_off_text'       => '',
			'parent'            => 'my_theme_hero_image',
		)
	);
}

add_action( 'acf/init', 'my_theme_hero_image_fields' );
