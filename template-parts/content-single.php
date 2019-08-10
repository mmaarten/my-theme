<?php
/**
 * Template part for displaying page content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MyTheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">

			<?php MyTheme\posted_on(); ?>

		</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php MyTheme\post_thumbnail(); ?>

	<div class="entry-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php MyTheme\entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
