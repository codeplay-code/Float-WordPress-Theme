<?php
/**
 * Images.php
 *
 * @package float
 */

/**
 * Filters HTML used for post thumbnails.
 *
 * @param string       $html              The post thumbnail HTML.
 * @param int          $post_id           The post ID.
 * @param string       $post_thumbnail_id The post thumbnail ID.
 * @param string|array $size              The post thumbnail size.
 * @param string       $attr              Query string of attributes.
 *
 * @return string
 */
function float_filter_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {

	if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
		return $html;
	}

	if ( is_admin() ) {
		return $html;
	}

	// Set the width and height as half of their values to use 2x images.
	if ( '240x9999' === $size ) {
		$html = preg_replace_callback(
			'/<img(.*?)width=\"(.*?)\"(.*?)>/i',
			function( $matches ) {
				$value = ( isset( $matches[2] ) ? absint( $matches[2] / 2 ) : '' );
				return '<img' . $matches[1] . 'width="' . $value . '"' . $matches[3] . '>';
			},
			$html
		);

		$html = preg_replace_callback(
			'/<img(.*?)height=\"(.*?)\"(.*?)>/i',
			function( $matches ) {
				$value = ( isset( $matches[2] ) ? absint( $matches[2] / 2 ) : '' );
				return '<img' . $matches[1] . 'height="' . $value . '"' . $matches[3] . '>';
			},
			$html
		);
	}

	if ( '80x80' === $size ) {
		$html = str_replace( 'width="80"', 'width="40"', $html );
		$html = str_replace( 'height="80"', 'height="40"', $html );
	}

	return $html;
}
add_filter( 'post_thumbnail_html', 'float_filter_post_thumbnail_html', 10, 5 );

/**
 * Filters the maximum image width to be included in a ‘srcset’ attribute.
 *
 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '2048'.
 * @param array $size_array An array of requested width and height values.
 *
 * @return int|boolean
 */
function float_max_srcset_image_width( $max_width, $size_array ) {

	// Limit the max width for images.
	if ( 80 === $size_array[0] && 80 === $size_array[1] ) {
		$max_width = 80;
	}

	if ( 240 === $size_array[0] ) {
		$max_width = 240;
	}

	return $max_width;
}
add_filter( 'max_srcset_image_width', 'float_max_srcset_image_width', 10, 2 );

/**
 * Returns logo info as array or false if custom logo is not set.
 *
 * @return boolean|array
 */
function float_get_logo() {

	if ( false === has_custom_logo() ) {
		return false;
	}

	$logo = array();

	$custom_logo_id       = get_theme_mod( 'custom_logo' );
	$attachment_image_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
	$logo_attachment      = wp_get_attachment_metadata( $custom_logo_id );

	$logo['src'] = $attachment_image_src[0];

	if ( ! empty( $logo_attachment ) ) {
		$logo['width']  = $logo_attachment['width'];
		$logo['height'] = $logo_attachment['height'];

		$logo_is_2x = get_theme_mod( 'logo_is_2x', 0 );
		if ( $logo_is_2x ) {
			$logo['width']  = $logo_attachment['width'] / 2;
			$logo['height'] = $logo_attachment['height'] / 2;
		}
	}

	return $logo;
}
