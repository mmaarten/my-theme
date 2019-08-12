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

	// Register heading block.
	acf_register_block_type(
		array(
			'name'            => 'heading',
			'title'           => __( 'Heading', 'my-theme' ),
			'description'     => __( 'Displays a heading.', 'my-theme' ),
			'render_callback' => __NAMESPACE__ . '\heading_block',
			'category'        => 'common',
			'supports'        => array(
				'anchor' => true,
				'align'  => array( 'left', 'center', 'right', 'wide', 'full' ),
			),
		)
	);

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

	// Register post block.
	acf_register_block_type(
		array(
			'name'            => 'post',
			'title'           => __( 'Post', 'my-theme' ),
			'description'     => __( 'Displays a post.', 'my-theme' ),
			'render_callback' => __NAMESPACE__ . '\post_block',
			'category'        => 'common',
			'supports'        => array(
				'anchor' => true,
				'align'  => array( 'wide', 'full' ),
			),
		)
	);

	// Register gallery block.
	acf_register_block_type(
		array(
			'name'            => 'gallery',
			'title'           => __( 'Gallery', 'my-theme' ),
			'description'     => __( 'Displays an image gallery.', 'my-theme' ),
			'render_callback' => __NAMESPACE__ . '\gallery_block',
			'category'        => 'common',
			'supports'        => array(
				'anchor' => true,
				'align'  => array( 'wide', 'full' ),
			),
		)
	);
}

add_action( 'acf/init', __NAMESPACE__ . '\register_block_types' );

/**
 * Heading block callback function
 *
 * @uses get_fields()
 * @uses acf_esc_attr_e()
 *
 * @param array      $block      The block settings and attributes.
 * @param string     $content    The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id    The post ID this block is saved to.
 */
function heading_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	/**
	 * Arguments
	 */

	$defaults = array(
		'text'  => __( 'Heading', 'my-theme' ),
		'type'  => 'h2',
		'color' => '',
	);

	$args = wp_parse_args( get_fields(), $defaults );

	$tag = $defaults['type'];

	if ( preg_match( '/^h\d{1,6}$/', $args['type'] ) ) {
		$tag = $args['type'];
	}

	/**
	 * Wrapper HTML attributes
	 */

	$wrapper = array(
		'class' => 'wp-block-' . str_replace( '/', '-', $block['name'] ),
	);

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
	 * Heading HTML attributes
	 */

	$heading = array( 'class' => 'heading' );

	if ( $args['color'] ) {
		$heading['class'] .= " text-{$args['color']}";
	}

	/**
	 * Output
	 */

	?>

	<div <?php acf_esc_attr_e( $wrapper ); ?>>

		<?php

		printf( '<%s %s>', esc_html( $tag ), acf_esc_attr( $heading ) );

		echo esc_html( $args['text'] );

		if ( trim( $args['text_2'] ) ) {
			printf( ' <small>%s</small>', esc_html( $args['text_2'] ) );
		}

		printf( '</%s>', esc_html( $tag ) );

		?>

	</div>

	<?php
}

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

	$wrapper = array(
		'class' => 'wp-block-' . str_replace( '/', '-', $block['name'] ),
	);

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

/**
 * Post block callback function
 *
 * @uses get_fields()
 * @uses acf_esc_attr_e()
 *
 * @param array      $block      The block settings and attributes.
 * @param string     $content    The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id    The post ID this block is saved to.
 */
function post_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	/**
	 * Arguments
	 */

	$args = wp_parse_args(
		get_fields(),
		array(
			'post'     => 0,
			'template' => '',
		)
	);

	/**
	 * Wrapper HTML attributes
	 */

	$wrapper = array(
		'class' => 'wp-block-' . str_replace( '/', '-', $block['name'] ),
	);

	if ( ! empty( $block['anchor'] ) ) {
		$wrapper['id'] = $block['anchor'];
	}

	if ( ! empty( $block['align'] ) ) {
		$wrapper['class'] .= " align{$block['align']}";
	}

	if ( ! empty( $block['className'] ) ) {
		$wrapper['class'] .= " {$block['className']}";
	}

	/**
	 * Output
	 */

	$the_query = new \WP_Query(
		array(
			'p'              => $args['post'],
			'post_status'    => 'publish',
			'posts_per_page' => 1,
		)
	);

	?>

	<div <?php acf_esc_attr_e( $wrapper ); ?>>

		<?php

		if ( $the_query->have_posts() ) {

			while ( $the_query->have_posts() ) {

				$the_query->the_post();

				get_template_part( 'template-parts/content', $args['template'] );
			}

			wp_reset_postdata();

		} else {

			printf( '<div class="alert alert-info">%s</div>', esc_html__( 'Post not found.', 'my-theme' ) );

		}

		?>

	</div>

	<?php
}

/**
 * Gallery block callback function
 *
 * @uses get_fields()
 * @uses acf_esc_attr_e()
 *
 * @param array      $block      The block settings and attributes.
 * @param string     $content    The block inner HTML (empty).
 * @param bool       $is_preview True during AJAX preview.
 * @param int|string $post_id    The post ID this block is saved to.
 */
function gallery_block( $block, $content = '', $is_preview = false, $post_id = 0 ) {

	static $instance = 0;

	$instance++;

	/**
	 * Arguments
	 */

	$args = wp_parse_args(
		get_fields(),
		array(
			'ids'     => array(),
			'size'    => '',
			'columns' => 3,
			'link'    => '',
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	);

	if ( ! $args['ids'] ) {
		return;
	}

	$attachments = get_posts(
		array(
			'post__in'       => (array) $args['ids'],
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'post_mime_type' => 'images',
			'orderby'        => $args['orderby'],
			'order'          => $args['order'],
		)
	);

	if ( ! $attachments ) {
		return;
	}

	/**
	 * Wrapper HTML attributes
	 */

	$wrapper = array(
		'class' => 'wp-block-' . str_replace( '/', '-', $block['name'] ),
	);

	if ( ! empty( $block['anchor'] ) ) {
		$wrapper['id'] = $block['anchor'];
	}

	if ( ! empty( $block['align'] ) ) {
		$wrapper['class'] .= " align{$block['align']}";
	}

	if ( ! empty( $block['className'] ) ) {
		$wrapper['class'] .= " {$block['className']}";
	}

	/**
	 * Gallery HTML attributes
	 */

	$gallery = array(
		'id'    => "gallery-$instance",
		'class' => 'gallery',
	);

	$columns = is_array( $args['columns'] ) ? $args['columns'] : array( 'xs' => $args['columns'] );

	foreach ( array( 'xs', 'sm', 'md', 'lg', 'xl' ) as $breakpoint ) {

		if ( ! isset( $columns[ $breakpoint ] ) ) {
			continue;
		}

		$value = intval( $columns[ $breakpoint ] );

		if ( ! $value ) {
			continue;
		}

		$slug = 'xs' === $breakpoint ? '' : " -$breakpoint";

		$gallery['class'] .= " gallery-columns$slug-$value";
	}

	if ( $args['size'] ) {
		$gallery['class'] .= ' gallery-size-' . sanitize_html_class( $args['size'] );
	}

	/**
	 * Output
	 */

	echo '<div ' . acf_esc_attr( $wrapper ) . '>';

	echo '<div ' . acf_esc_attr( $gallery ) . '>';

	foreach ( $attachments as $attachment ) {

		$atts = trim( $attachment->post_excerpt ) ? array( 'aria-describedby' => "{$gallery['id']}-{$attachment->ID}" ) : '';

		$image_meta = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}

		$icon = array(
			'class' => 'gallery-icon',
		);

		if ( $orientation ) {
			$icon['class'] .= " $orientation";
		}

		echo '<figure class="gallery-item">';

		echo '<div ' . acf_esc_attr( $icon ) . '>';

		if ( 'file' === $args['link'] ) {

			echo wp_get_attachment_link( $id, $atts['size'], false, false, false, $atts );

		} elseif ( 'none' === $args['link'] ) {

			echo wp_get_attachment_image( $id, $atts['size'], false, $atts );

		} else {

			echo wp_get_attachment_link( $id, $atts['size'], true, false, false, $atts );
		}

		echo '</div><!-- .gallery-icon -->';

		if ( trim( $attachment->post_excerpt ) ) {

			printf(
				'<figcaption class="wp-caption-text gallery-caption" id="%s">%s</figcaption>',
				esc_attr( "{$gallery['id']}-{$attachment->ID}" ),
				esc_html( $attachment->post_excerpt )
			);
		}

		echo '</figure><!-- gallery-item -->';

	}

	echo '</div><!-- .gallery -->';

	echo '</div>';
}
