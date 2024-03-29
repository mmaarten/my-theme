<?php
/**
 * Template Name: Full Width Fixed
 * Template Post Type: page
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package My/Theme
 */

get_header();

?>

<div class="container">

    <div id="primary" class="content-area">

        <main id="main" class="site-main">

        <?php

        // Start the Loop.
        while (have_posts()) :
            // Setup postdata.
            the_post();

            // Include the template for the content.
            if ('page' === get_post_type()) {
                get_template_part('template-parts/loop', 'page');
            } else {
                get_template_part('template-parts/loop', 'single');
            }

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

            // End of the Loop.
        endwhile;

        ?>

        </main><!-- #main -->

    </div><!-- #primary -->

</div><!-- .container -->

<?php

get_footer();
