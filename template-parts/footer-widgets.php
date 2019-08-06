<?php
/**
 * Footer widgets
 *
 * @package MyTheme
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}
?>

<aside class="widget-area" role="complementary">

	<div class="container">

		<?php dynamic_sidebar( 'footer' ); ?>

	</div><!-- .container -->

</aside><!-- .widget-area -->
