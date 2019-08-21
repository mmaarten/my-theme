<?php
/**
 * Template part for displaying a card
 *
 * @link https://getbootstrap.com/docs/4.0/components/card/
 *
 * @package MyTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card mb-3' ); ?>>

	<?php the_post_thumbnail( 'my-theme-card', array( 'class' => 'card-img-top' ) ); ?>

	<div class="card-body">

		<?php the_title( '<h2 class="h5 card-title entry-title">', '</h2>' ); ?>

		<?php if ( get_the_excerpt() ) : ?>

		<div class="card-text entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .card-text -->

		<?php endif; ?>

		<p class="mb-0">
			<a href="<?php the_permalink(); ?>" class="btn btn-primary stretched-link"><?php esc_html_e( 'Read More', 'my-theme' ); ?></a>
		</p>

	</div><!-- .card-body -->

</article><!-- #post-<?php the_ID(); ?> -->
