<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package MyTheme
 */

get_header();

?>

<div class="container">

	<div class="row">

		<div id="primary" class="col-md content-area">

			<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">

					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'my-theme' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>

				</header><!-- .page-header -->

				<?php

				// Start the Loop.
				while ( have_posts() ) :

					// Setup postdata.
					the_post();

					// Include the template for the content.
					get_template_part( 'template-parts/content', 'search' );

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
