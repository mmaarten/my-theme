<?php
/**
 * Footer widgets
 *
 * @package My/Theme
 */

namespace My\Theme;

if (! is_active_sidebar('footer')) {
    return;
}
?>

<aside id="footer-widgets" class="widget-area" role="complementary">

    <div class="container">

        <?php dynamic_sidebar('footer'); ?>

    </div><!-- .container -->

</aside><!-- .widget-area -->
