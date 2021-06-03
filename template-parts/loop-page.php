<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package My/Theme
 */

namespace My\Theme;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

    </header><!-- .entry-header -->

    <div class="post-thumbnail">

        <?php the_post_thumbnail('large'); ?>

    </div><!-- .post-thumbnail -->

    <div class="entry-content">

        <?php the_content(); ?>

        <?php

        wp_link_pages([
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'my-theme'),
            'after'  => '</div>',
        ]);

        ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">

        <?php edit_post_link(__('Edit', 'my-theme'), '<span class="edit-link">', '</span>'); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
