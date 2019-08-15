<?php
/**
 * Footer Navigation
 *
 * @package MyTheme
 */

if ( ! has_nav_menu( 'footer-left' ) && ! has_nav_menu( 'footer-right' ) ) {
	return;
}

?>

<nav id="footer-navigation" class="site-navigation" role="navigation">

	<div class="container d-md-flex">

	<?php

		wp_nav_menu(
			array(
				'theme_location' => 'footer-left',
				'menu_class'     => 'nav flex-column flex-md-row mr-md-auto footer-menu',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => null,
			)
		);

		wp_nav_menu(
			array(
				'theme_location' => 'footer-right',
				'menu_class'     => 'nav flex-column flex-md-row ml-md-auto footer-menu',
				'container'      => false,
				'depth'          => 1,
				'fallback_cb'    => null,
			)
		);

		?>

	</div><!-- .container -->

</nav><!-- #footer-navigation -->
