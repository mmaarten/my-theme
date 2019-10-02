<?php
/**
 * The left sidebar.
 *
 * @package My/Theme
 */

if (! is_active_sidebar('sidebar-left')) {
    return;
}
?>

<aside id="sidebar-left" class="widget-area col-md-3 order-first" role="complementary">

    <?php dynamic_sidebar('sidebar-left'); ?>

</aside><!-- #sidebar-left -->
