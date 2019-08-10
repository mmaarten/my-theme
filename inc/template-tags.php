<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MyTheme
 */

namespace MyTheme;

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'my-theme' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Byline.

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'my-theme' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'my-theme' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'my-theme' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'my-theme' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'my-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'my-theme' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'my-theme' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
		?>

			<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail(
				'post-thumbnail',
				array(
					'alt' => the_title_attribute(
						array(
							'echo' => false,
						)
					),
				)
			);
			?>
		</a>

			<?php
		endif; // End is_singular().
}

/**
 * Display pagination for the posts.
 *
 * @param array $args Arguments for the paginate_links function.
 */
function pagination( $args = array() ) {

	if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'mid_size'           => 2,
			'prev_next'          => true,
			'prev_text'          => __( '&laquo;', 'my-theme' ),
			'next_text'          => __( '&raquo;', 'my-theme' ),
			'screen_reader_text' => __( 'Posts navigation', 'my-theme' ),
			'type'               => 'array',
			'current'            => max( 1, get_query_var( 'paged' ) ),
		)
	);

	$links = paginate_links( $args );

	?>

	<nav class="pagination-nav" aria-label="<?php echo esc_attr( $args['screen_reader_text'] ); ?>">

		<ul class="pagination">

		<?php foreach ( $links as $key => $link ) : ?>

			<li class="page-item<?php echo strpos( $link, 'current' ) ? ' active' : ''; ?>">
				<?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</li><!-- .page-item -->

			<?php endforeach; ?>

		</ul><!-- .pagination -->

	</nav><!-- .pagination-nav -->

	<?php
}

/**
 * Display navigation to next/previous post when applicable.
 */
function post_nav() {

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<nav class="container navigation post-navigation">

		<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'my-theme' ); ?></h2>

		<div class="row nav-links justify-content-between">

		<?php

		if ( get_previous_post_link() ) {
			previous_post_link( '<span class="nav-previous">%link</span>', _x( '&laquo; %title', 'Previous post link', 'my-theme' ) );
		}

		if ( get_next_post_link() ) {
			next_post_link( '<span class="nav-next">%link</span>', _x( '%title &raquo;', 'Next post link', 'my-theme' ) );
		}

		?>

		</div><!-- .nav-links -->

	</nav><!-- .navigation -->

	<?php
}

/**
 * Breadcrumb navigation
 *
 * Dependency: Breadcrumb NavXT
 *
 * @uses bcn_display_list()
 *
 * @link https://wordpress.org/plugins/breadcrumb-navxt/
 *
 * @param string $before The HTML to render before the navigation.
 * @param string $after  The HTML to render after the navigation.
 */
function breadcrumb_nav( $before = '', $after = '' ) {

	// Check Dependency.
	if ( ! function_exists( 'bcn_display_list' ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( 'function `bcn_display_list` does not exist.', E_USER_WARNING );

		return;
	}

	// Get items. Arguments: return, linked, reverse and force.
	$items = bcn_display_list( true, true, false, false );

	// Stop when no items.
	if ( ! trim( $items ) ) {
		return;
	}

	// Add CSS classes.
	$items = str_replace( '<li class="', '<li class="breadcrumb-item ', $items );
	$items = preg_replace( '/class="(.*?)current-item(.*?)"/', 'class="$1active$2"', $items );

	// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

	?>

	<?php echo $before; ?>

		<nav class="breadcrumb-nav" aria-label="breadcrumb">

			<ol class="breadcrumb">

			<?php echo $items; ?>

			</ol><!-- .breadcrumb -->

		</nav><!-- .breadcrumb-nav -->

		<?php echo $after; ?>

		<?php

		// phpcs:enable
}

/**
 * Display image gallery
 *
 * @param array $args The arguments.
 */
function gallery( $args = array() ) {

	static $instance = 0;

	$instance++;

	$args = wp_parse_args(
		$args,
		array(
			'ids'        => array(),
			'size'       => 'thumbnail',
			'link'       => '',
			'columns'    => 3,
			'orderby'    => 'menu_order',
			'order'      => 'DESC',
		)
	);

	$attachments = get_posts(
		array(
			'post__in'       => $args['ids'],
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'post_mime_type' => 'image',
			'orderby'        => $args['orderby'],
			'order'          => $args['order'],
		)
	);

	if ( ! $attachments ) {
		return;
	}

	$gallery_id = "gallery-$instance";

	$gallery = array(
		'id'    => $gallery_id,
		'class' => sprintf( 'gallery gallery-size-%s', sanitize_html_class( $args['size'] ) ),
	);

	$columns = is_array( $args['columns'] ) ? $args['columns'] : array( 'xs' => $args['columns'] );

	foreach ( array( 'xs', 'sm', 'md', 'lg', 'xl' ) as $breakpoint ) {

		if ( empty( $columns[ $breakpoint ] ) ) {
			continue;
		}

		$value = intval( $columns[ $breakpoint ] );
		$slug  = 'xs' === $breakpoint ? '' : "-$breakpoint";

		$gallery['class'] .= " gallery-columns$slug-$value";
	}

	echo '<' . html_atts( $gallery ) . '>';

	foreach ( $attachments as $attachment ) {

		$attr = trim( $attachment->post_excerpt ) ? array( 'aria-describedby' => "$gallery_id-{$attachment->ID}" ) : '';

		echo '<figure class="gallery-item">';

		echo '<div class="gallery-icon">';

		if ( 'file' === $args['link'] ) {

			echo wp_get_attachment_link( $attachment, $args['size'], false, false, false, $attr );

		} elseif ( 'none' === $args['link'] ) {

			echo wp_get_attachment_image( $attachment, $args['size'], false, $attr );

		} elseif ( 'lightbox' === $args['link'] ) {

			list( $linked ) = (array) wp_get_attachment_image_src( $attachment, 'theme-full-width' );

			printf(
				'<a href="%s" data-fancybox="%s" data-caption="%s">%s</a>',
				esc_url( $linked ),
				esc_attr( $gallery_id ),
				esc_attr( $attachment->post_excerpt ), // TODO : Don't use attribute for caption.
				wp_get_attachment_image( $attachment, $args['size'], false, $attr )
			);

		} else {

			echo wp_get_attachment_link( $attachment, $args['size'], true, false, false, $attr );
		}

		echo '</div><!-- .gallery-icon -->';

		if ( trim( $attachment->post_excerpt ) ) {

			printf(
				'<figcaption class="wp-caption-text gallery-caption" id="%s-%s">%s</figcaption>',
				esc_attr( $gallery_id ),
				esc_attr( $attachment->ID ),
				esc_html( $attachment->post_excerpt )
			);
		}

		echo '</figure><!-- .gallery-item -->';
	}

	echo '</div><!-- .gallery -->';
}
