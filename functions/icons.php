<?php
/**
 * Icons.php
 *
 * @package float
 */

/**
 * Outputs SVG icon inline.
 * If the icons does not exist, falls back to a default icon.
 *
 * @param string $icon     Icon slug.
 * @param string $classes  CSS classes.
 */
function float_inline_svg( $icon = 'fallback', $classes = 'float-svg-icon' ) {

	$icon_path = get_template_directory() . '/images/svg/' . $icon . '.svg';

	// Use the default icon, if the wanted icon is not found.
	if ( ! file_exists( $icon_path ) ) {
		$icon_path = get_template_directory() . '/images/svg/fallback.svg';
	}

	if ( file_exists( $icon_path ) ) {
		ob_start();
		include $icon_path;
		$file_contents = ob_get_clean();

		$file_contents = str_replace( '<svg ', '<svg class="' . $classes . '" ', $file_contents );

		echo wp_kses( $file_contents, float_get_wp_kses_allowed_html( 'svg' ) );
	}
}

/**
 * Returns HTML for inline SVG icon.
 *
 * @param string $icon     Icon slug.
 * @param string $classes  CSS classes.
 */
function float_get_inline_svg( $icon = 'fallback', $classes = 'float-svg-icon' ) {

	ob_start();
	float_inline_svg( $icon, $classes );
	$html = ob_get_clean();

	return $html;
}

if ( ! function_exists( 'float_get_wp_kses_allowed_html' ) ) {
	/**
	 * Returns allowed HTML for wp_kses functions.
	 *
	 * @param  string $type Type.
	 * @return array
	 */
	function float_get_wp_kses_allowed_html( $type ) {

		$allowed_tags = array();

		$kses_defaults = wp_kses_allowed_html( 'post' );

		if ( 'svg' === $type ) {
			$svg_args = array(
				'svg'   => array(
					'class'           => true,
					'aria-hidden'     => true,
					'aria-labelledby' => true,
					'role'            => true,
					'xmlns'           => true,
					'xmlns:xlink'     => true,
					'version'         => true,
					'width'           => true,
					'height'          => true,
					'viewbox'         => true,
					'viewBox'         => true,
				),
				'g'     => array( 'fill' => true ),
				'title' => array( 'title' => true ),
				'path'  => array(
					'd'    => true,
					'fill' => true,
					'id'   => true,
				),
				'use'   => array(
					'href'      => true,
					'transform' => true,
					'class'     => true,
				),
			);

			$allowed_tags = array_merge( $kses_defaults, $svg_args );
		}

		$allowed_tags = apply_filters( 'float_filter_get_wp_kses_allowed_html', $allowed_tags, $type );

		return $allowed_tags;
	}
}
