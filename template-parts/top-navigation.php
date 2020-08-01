<?php
/**
 * Header Navigation
 *
 * @package My/Theme
 */

namespace My\Theme;

if (! has_nav_menu('top-left') && ! has_nav_menu('top-right')) {
    return;
}

?>

<nav id="top-navigation" class="d-none d-lg-flex site-navigation" role="navigation">

    <div class="container d-flex">

    <?php

        wp_nav_menu([
            'theme_location' => 'top-left',
            'menu_class'     => 'nav mr-auto top-menu',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => null,
        ]);

        wp_nav_menu([
            'theme_location' => 'top-right',
            'menu_class'     => 'nav ml-auto top-menu',
            'container'      => false,
            'depth'          => 1,
            'fallback_cb'    => null,
        ]);

        ?>

    </div><!-- .container -->

</nav><!-- #top-navigation -->
