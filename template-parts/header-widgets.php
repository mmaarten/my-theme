<?php
/**
 * Header widgets
 *
 * @package MyTheme
 */

if ( ! is_active_sidebar( 'header' ) ) {
	return;
}
?>

<aside class="widget-area" role="complementary">

	<div class="container">

		<?php dynamic_sidebar( 'header' ); ?>

	</div><!-- .container -->

</aside><!-- .widget-area -->
