<?php
/**
 * Attachments
 *
 * @package MyTheme
 */

/**
 * Get size information for all currently-registered image sizes.
 *
 * @link https://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes#Examples
 *
 * @global $_wp_additional_image_sizes
 *
 * @return array $sizes Data for all currently-registered image sizes.
 */
function my_theme_get_image_sizes() {

	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $size ) {
		if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ), true ) ) {
			$sizes[ $size ]['width']  = get_option( "{$size}_size_w" );
			$sizes[ $size ]['height'] = get_option( "{$size}_size_h" );
			$sizes[ $size ]['crop']   = (bool) get_option( "{$size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
			$sizes[ $size ] = array(
				'width'  => $_wp_additional_image_sizes[ $size ]['width'],
				'height' => $_wp_additional_image_sizes[ $size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $size ]['crop'],
			);
		}
	}

	return $sizes;
}

/**
 * Display an attachment image that covers the registered image size dimensions.
 *
 * @param int    $attachment_id The attachment id.
 * @param string $size          The registered image size.
 */
function my_theme_attachment_image_cover( $attachment_id, $size = 'large' ) {

	$sizes = my_theme_get_image_sizes();

	if ( ! isset( $sizes[ $size ] ) ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( sprintf( 'Image size <code>%s</code> does not exist.', esc_html( $size ) ), E_USER_WARNING );
		return false;
	}

	list( $image_url ) = (array) wp_get_attachment_image_src( $attachment_id, $size );

	if ( ! $image_url ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
		trigger_error( sprintf( 'Unable to get image url of attachment with ID <code>%s</code>.', esc_html( $attachment_id ) ), E_USER_WARNING );
		return false;
	}

	$ratio = ( $sizes[ $size ]['height'] / $sizes[ $size ]['width'] ) * 100;

	?>

	<div class="cover-image cover-image-<?php echo esc_attr( $size ); ?> bg-cover bg-center" style="<?php printf( 'background-image:url(%s);padding-top:%d%%;', esc_url( $image_url ), esc_attr( $ratio ) ); ?>">

		<?php echo wp_get_attachment_image( $attachment_id, $size, false, array( 'class' => 'd-none' ) ); ?>

	</div><!-- .cover-image -->

	<?php
}
