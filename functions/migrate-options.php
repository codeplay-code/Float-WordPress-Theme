<?php
/**
 * Migrate-options.php
 *
 * @package float
 */

if ( ! function_exists( 'of_get_option' ) ) {
	/**
	 * Loads default options for Options Framework plugin.
	 *
	 * @param string $name Option name.
	 * @param string $default Default option value.
	 */
	function of_get_option( $name, $default = false ) {

		$optionsframework_settings = get_option( 'optionsframework' );
		$option_name = $optionsframework_settings['id'];

		if ( get_option( $option_name ) ) {
			$options = get_option( $option_name );
		}

		if ( isset( $options[ $name ] ) ) {
			return $options[ $name ];
		} else {
			return $default;
		}
	}
}

/**
 * Migrates options from Options Framework.
 */
function float_migrate_options() {

	// Check if the options have already been migrated.
	if ( ! empty( get_option( 'float_options_migrated' ) ) ) {
		return;
	}

	// Migrate logo option to theme mod.
	if ( ! empty( of_get_option( 'logo' ) ) ) {
		$logo_url = of_get_option( 'logo' );
		$logo_id  = attachment_url_to_postid( $logo_url );

		if ( ! empty( $logo_id ) ) {
			set_theme_mod( 'custom_logo', $logo_id );
		}
	}

	// Migrate options to theme mods.
	$of_options = array(
		'sidebar'        => 'sidebar_position',
		'link_color'     => 'color_link',
		'tags_color'     => 'color_tags',
		'comments_color' => 'color_comments_bubble',
	);

	foreach ( $of_options as $key => $value ) {
		if ( ! empty( of_get_option( $key ) ) ) {
			set_theme_mod( $value, of_get_option( $key ) );
		}
	}

	// Migrate rest of Options Framework options to CMB2 options.
	$float_options = array();

	// Text fields, textareas and selects.
	$text_options = array(
		'analytics' => 'analytics',
	);

	foreach ( $text_options as $key => $value ) {
		if ( ! empty( of_get_option( $key ) ) ) {
			$float_options[ $value ] = of_get_option( $key );
		}
	}

	if ( ! empty( $float_options ) ) {
		$update_option = update_option( 'float_options', $float_options );
	}

	// Migrates existing custom CSS to the core option added in WordPress 4.7.
	// https://make.wordpress.org/core/2016/11/26/extending-the-custom-css-editor/.
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$css = of_get_option( 'custom_css' );
		if ( ! empty( $css ) ) {
			$core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$return = wp_update_custom_css_post( $core_css . $css );
		}
	}

	// Migrates social link options to a menu.
	$links = array(
		'bandcamp'   => 'Bandcamp',
		'dribbble'   => 'Dribbble',
		'facebook'   => 'Facebook',
		'flickr'     => 'Flickr',
		'goodreads'  => 'Goodreads',
		'google'     => 'Google+',
		'instagram'  => 'Instagram',
		'itunes'     => 'iTunes',
		'lastfm'     => 'Last.fm',
		'linkedin'   => 'LinkedIn',
		'pinterest'  => 'Pinterest',
		'quora'      => 'Quora',
		'soundcloud' => 'SoundCloud',
		'tumblr'     => 'Tumblr',
		'twitter'    => 'Twitter',
		'vimeo'      => 'Vimeo',
		'vk'         => 'VK',
		'youtube'    => 'YouTube',
	);

	$social_links = array();

	foreach ( $links as $slug => $title ) {
		if ( ! empty( of_get_option( $slug ) ) ) {
			$social_links[] = array(
				'url'   => of_get_option( $slug ),
				'title' => $title,
			);
		}
	}

	$menu_name = 'Social';

	$menu_exists = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu_exists && ! empty( $social_links ) ) {

		// If it doesn't exist, let's create it.
		$menu_id = wp_create_nav_menu( $menu_name );

		foreach ( $social_links as $social_link ) {
			wp_update_nav_menu_item( $menu_id, 0, array(
				'menu-item-title'  => $social_link['title'],
				'menu-item-url'    => $social_link['url'],
				'menu-item-status' => 'publish',
				'menu-item-type'   => 'custom',
			) );
		}
	}

	// Convert meta keys.
	$meta_values = array(
		'custom_meta_featured' => '_float_meta_hide_featured_image',
	);

	global $wpdb;
	foreach ( $meta_values as $from => $to ) {

		$update = $wpdb->query(
			$wpdb->prepare(
			"
			UPDATE $wpdb->postmeta
			SET `meta_key` = %s
			WHERE `meta_key` = %s
			",
			array( $to, $from )
			)
		);
	}

	update_option( 'float_options_migrated', 1 );
}
add_action( 'admin_init', 'float_migrate_options' );
