<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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

                <section class="error-404 not-found">

                    <header class="page-header">

                        <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'my-theme'); ?></h1>

                    </header><!-- .page-header -->

                    <div class="page-content">

                        <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'my-theme'); ?></p>

                        <?php get_search_form(); ?>

                        <?php the_widget('WP_Widget_Recent_Posts'); ?>

                        <div class="widget widget_categories">

                            <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'my-theme'); ?></h2>

                            <ul>
                                <?php
                                wp_list_categories([
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ]);
                                ?>
                            </ul>

                        </div><!-- .widget -->

                        <?php
                        /* translators: %1$s: smiley */
                        $my_theme_archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'my-theme'), convert_smilies(':)')) . '</p>';
                        the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$my_theme_archive_content");

                        the_widget('WP_Widget_Tag_Cloud');
                        ?>

                    </div><!-- .page-content -->
                </section><!-- .error-404 -->

            </main><!-- #main -->

        </div><!-- #primary -->

    </div><!-- .row -->

</div><!-- .container -->

<?php

get_footer();
