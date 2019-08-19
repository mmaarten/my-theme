<?php
/**
 * Template part for displaying a carousel item
 *
 * @link https://getbootstrap.com/docs/4.0/components/carousel/
 *
 * @package MyTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( 'attachment' === get_post_type() ) : ?>

		<?php echo wp_get_attachment_image( get_the_ID(), 'my-theme-carousel' ); ?>

	<?php else : ?>

		<?php the_post_thumbnail( 'my-theme-carousel' ); ?>

	<?php endif; ?>

	<div class="carousel-caption d-none d-md-block">

		<?php the_title( '<h5>', '</h5>' ); ?>

		<?php the_excerpt(); ?>

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
