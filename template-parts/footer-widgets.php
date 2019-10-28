<?php
/**
 * Footer widgets
 *
 * @package My/Theme
 */

$sidebars = ['footer-1', 'footer-2', 'footer-3'];

if (! array_filter($sidebars, 'is_active_sidebar')) {
    return;
}
?>

<aside class="widget-area" role="complementary">
    <div class="container">
        <div class="row">
            <div class="col-md">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
            <div class="col-md">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            <div class="col-md">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</aside><!-- .widget-area -->
