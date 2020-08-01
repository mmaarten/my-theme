<?php
/**
 * The template for displaying site navigation
 *
 * @package My/Theme
 */

namespace My\Theme;

?>

<nav id="main-navigation" class="navbar navbar-expand-lg navbar-light bg-light site-navigation">

    <div class="container">

        <div class="navbar-brand site-branding">

            <?php if (has_custom_logo()) : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home" itemprop="url">
                    <?php echo wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', false, ['class' => 'img-fluid']); ?>
                </a>
            <?php elseif (is_front_page() && is_home()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="url"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" itemprop="url"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php

            if (get_bloginfo('description', 'display') || is_customize_preview()) {
                printf('<p class="sr-only site-description">%s</p>', get_bloginfo('description', 'display'));
            }

            ?>

        </div><!-- .site-branding -->

        <?php if (has_nav_menu('main-left') || has_nav_menu('main-right')) : ?>
        <button class="navbar-toggler menu-toggle" type="button" data-toggle="collapse" data-target="#mainNavigationContent" aria-controls="mainNavigationContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'my-theme'); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavigationContent">

            <?php

            wp_nav_menu([
                'theme_location' => 'main-left',
                'depth'          => 2,
                'container'      => false,
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'navbar-nav mr-auto main-menu',
                'fallback_cb'    => null,
            ]);

            wp_nav_menu([
                'theme_location' => 'main-right',
                'depth'          => 2,
                'container'      => false,
                'menu_id'        => 'primary-menu',
                'menu_class'     => 'navbar-nav ml-auto main-menu',
                'fallback_cb'    => null,
            ]);

            ?>

        </div><!-- #mainNavigationContent -->

        <?php endif; ?>

    </div><!-- .container -->

</nav><!-- #main-navigation -->
