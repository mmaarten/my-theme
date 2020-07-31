<?php
/**
 * The template for displaying author pages
 *
 * @link https://codex.wordpress.org/Author_Templates/
 *
 * @package My/Theme
 */

get_header();

?>

<div class="container">

    <div class="row">

        <div id="primary" class="col-md content-area">

            <main id="main" class="site-main">

            <?php if (have_posts()) : ?>
                <header class="page-header">

                    <h1 class="page-title">
                        <?php
                        /**
                         * Queue the first post, that way we know what author
                         * we're dealing with (if that is the case).
                         *
                         * We reset this later so we can run the loop properly
                         * with a call to rewind_posts().
                         */
                        the_post();

                        // Translators: %s: The name of the author.
                        printf(esc_html__('All posts by %s', 'my-theme'), get_the_author());

                        ?>
                    </h1>

                    <?php if (get_the_author_meta('description')) : ?>
                    <div class="page-description"><?php the_author_meta('description'); ?></div>
                    <?php endif; ?>

                </header><!-- .page-header -->

                <?php
                /**
                 * Since we called the_post() above, we need to rewind
                 * the loop back to the beginning that way we can run
                 * the loop properly, in full.
                 */
                rewind_posts();

                // Start the Loop.
                while (have_posts()) :
                    // Setup postdata.
                    the_post();

                    // Include the template for the content.
                    get_template_part('template-parts/content');

                    // End of the Loop.
                endwhile;

                My\Theme\Templates::pagination();
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
