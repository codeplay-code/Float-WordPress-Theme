<?php
/**
 * Functions.php
 *
 * @package float
 */

/**
 * Defines theme version.
 */
define( 'FLOAT_THEME_VERSION', '2.3.0' );

if ( ! function_exists( 'float_get_option' ) ) {
	/**
	 * Wrapper function around cmb2_get_option.
	 *
	 * @param  string $key     Options array key.
	 * @param  mixed  $default Optional default value.
	 * @return mixed           Option value.
	 */
	function float_get_option( $key = '', $default = false ) {

		if ( function_exists( 'cmb2_get_option' ) ) {
			return cmb2_get_option( 'float_options', $key, $default );
		}

		// Fallback to get_option if CMB2 is not loaded yet.
		$opts = get_option( 'float_options', $default );
		$val  = $default;
		if ( 'all' === $key ) {
			$val = $opts;
		} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
			$val = $opts[ $key ];
		}
		return $val;
	}
}

/**
 * Requires files.
 */
require( 'functions/theme-setup.php' );
require( 'functions/list-comments.php' );
require( 'functions/tgmpa.php' );
require( 'functions/icons.php' );
require( 'functions/images.php' );
require( 'functions/migrate-options.php' );
require( 'functions/customizer.php' );
require( 'functions/customizer-editor.php' );
require( 'functions/inline-style.php' );
require( 'functions/misc.php' );
