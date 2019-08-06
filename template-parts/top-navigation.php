<?php
/**
 * Header Navigation
 *
 * @package MyTheme
 */

if ( ! has_nav_menu( 'top-left' ) && ! has_nav_menu( 'top-right' ) ) {
	return;
}

?>

<nav id="top-navigation" class="d-none d-md-flex site-navigation" role="navigation">

	<div class="container d-flex">

	<?php

		wp_nav_menu(
			array(
				'theme_location' => 'top-left',
				'menu_class'     => 'nav mr-auto top-menu',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => null,
				'walker'         => new WP_Bootstrap_Navwalker(),
			)
		);

		wp_nav_menu(
			array(
				'theme_location' => 'top-right',
				'menu_class'     => 'nav ml-auto top-menu',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => null,
				'walker'         => new WP_Bootstrap_Navwalker(),
			)
		);

		?>

	</div><!-- .container -->

</nav><!-- #top-navigation -->
