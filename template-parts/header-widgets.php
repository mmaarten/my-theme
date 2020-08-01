<?php
/**
 * Header widgets
 *
 * @package My/Theme
 */

namespace My\Theme;

if (! is_active_sidebar('header')) {
    return;
}
?>

<aside class="widget-area" role="complementary">

    <div class="container">

        <?php dynamic_sidebar('header'); ?>

    </div><!-- .container -->

</aside><!-- .widget-area -->
