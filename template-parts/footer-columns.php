<?php
/**
 * Footer columns
 *
 * @package My/Theme
 */

namespace My\Theme;

if (! array_filter(['footer-column-1', 'footer-column-2', 'footer-column-3'], 'is_active_sidebar')) {
    return;
}
?>

<aside id="footer-columns" class="widget-area" role="complementary">

    <div class="container">

        <div class="row">

            <div class="col-md">

                <?php dynamic_sidebar('footer-column-1'); ?>

            </div>

            <div class="col-md">

                <?php dynamic_sidebar('footer-column-2'); ?>

            </div>

            <div class="col-md">

                <?php dynamic_sidebar('footer-column-3'); ?>

            </div>

        </div><!-- .row -->

    </div><!-- .container -->

</aside><!-- .widget-area -->
