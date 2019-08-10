<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MyTheme
 */

get_header();

?>

<div class="container">

	<div class="row">

		<div id="primary" class="col-md content-area">

			<main id="main" class="site-main">

			<?php

			if ( have_posts() ) :

				// Start the Loop.
				while ( have_posts() ) :

					// Setup postdata.
					the_post();

					// Include the template for the content.
					get_template_part( 'template-parts/content' );

					// End of the Loop.
				endwhile;

				MyTheme\pagination();

				else :

					// Include the template for displaying a message that posts cannot be found.
					get_template_part( 'template-parts/content', 'none' );

			endif;

				?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<?php get_template_part( 'template-parts/sidebar', 'left' ); ?>
		<?php get_template_part( 'template-parts/sidebar', 'right' ); ?>

	</div><!-- .row -->

</div><!-- .container -->

<?php

get_footer();
