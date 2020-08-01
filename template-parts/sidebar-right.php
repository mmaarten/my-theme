<?php
/**
 * The right sidebar.
 *
 * @package My/Theme
 */

namespace My\Theme;

if (! is_active_sidebar('sidebar-right')) {
    return;
}
?>

<aside id="sidebar-right" class="widget-area col-md-3 order-last" role="complementary">

    <?php dynamic_sidebar('sidebar-right'); ?>

</aside><!-- #sidebar-right -->
