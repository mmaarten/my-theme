<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My/Theme
 */

namespace My\Theme;

get_header();

?>

<div class="container">

    <div class="row">

        <div id="primary" class="col-md content-area">

            <main id="main" class="site-main">

            <?php if (have_posts()) : ?>
                <header class="page-header">

                    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
                    <?php the_archive_description('<div class="page-description">', '</div>'); ?>

                </header><!-- .page-header -->

                <?php

                // Start the Loop.
                while (have_posts()) :
                    // Setup postdata.
                    the_post();

                    // Include the template for the content.
                    get_template_part('template-parts/content');

                    // End of the Loop.
                endwhile;

                Templates::pagination();
            else :
                // Include the template for displaying a message that posts cannot be found.
                get_template_part('template-parts/content', 'none');
            endif;

            ?>

            </main><!-- #main -->

        </div><!-- #primary -->

        <?php get_template_part('template-parts/sidebar', 'left'); ?>
        <?php get_template_part('template-parts/sidebar', 'right'); ?>

    </div><!-- .row -->

</div><!-- .container -->

<?php

get_footer();
