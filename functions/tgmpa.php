<?php
/**
 * Tgmpa.php
 *
 * @package float
 */

/**
 * Requires TGM Plugin Activation library.
 */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

if ( ! function_exists( 'float_tgmpa_register' ) ) {
	/**
	 * Registers TGM Plugin Activation library.
	 */
	function float_tgmpa_register() {

		$plugins = array(
			array(
				'name'     => 'Float Plugin',
				'slug'     => 'float-plugin',
				'source'   => get_template_directory() . '/lib/float-plugin-1.5.0.zip',
				'required' => true,
				'version'  => '1.5.0',
			),
			array(
				'name'     => 'Envato Market',
				'slug'     => 'envato-market',
				'source'   => get_template_directory() . '/lib/envato-market-2.0.10.zip',
				'required' => true,
				'version'  => '2.0.10',
			),
			array(
				'name'     => 'CMB2',
				'slug'     => 'cmb2',
				'required' => true,
			),
		);

		$config = array(
			'id'           => 'float-tgmpa-required-plugins',
			'menu'         => 'float-install-required-plugins',
			'has_notices'  => true,
			'dismissable'  => false,
			'is_automatic' => true,
		);

		tgmpa( $plugins, $config );
	}
}
add_action( 'tgmpa_register', 'float_tgmpa_register' );
