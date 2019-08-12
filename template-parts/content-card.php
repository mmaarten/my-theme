<?php
/**
 * Template part for displaying page content inside a Bootstrap card.
 *
 * @link https://getbootstrap.com/docs/4.3/components/card/
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MyTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>

	<?php the_post_thumbnail( 'large', array( 'class' => 'card-img-top' ) ); ?>

	<div class="card-body">

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="h5 card-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">

				<?php MyTheme\posted_on(); ?>

			</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-summary position-relative">

			<div class="card-text">
				<?php the_excerpt(); ?>
			</div>

			<p><a href="<?php the_permalink(); ?>" class="btn btn-primary stretched-link"><?php esc_html_e( 'Read More', 'my-theme' ); ?></a></p>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php MyTheme\entry_footer(); ?>

		</footer><!-- .entry-footer -->

	</div>

</article><!-- #post-<?php the_ID(); ?> -->
