<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

			// Start the Loop.
			while ( have_posts() ) :

				// Setup postdata.
				the_post();

				// Include the template for the content.
				get_template_part( 'template-parts/content', 'single' );

				my_theme_post_nav();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				// End of the Loop.
			endwhile;

			?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<?php get_template_part( 'template-parts/sidebar', 'left' ); ?>
		<?php get_template_part( 'template-parts/sidebar', 'right' ); ?>

	</div><!-- .row -->

</div><!-- .container -->

<?php

get_footer();
