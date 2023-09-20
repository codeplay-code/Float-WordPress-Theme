<?php
/**
 * Customizer.php
 *
 * @package float
 */

/**
 * Adds customizer sections, settings, and controls.
 *
 * @param  WP_Customize_Manager $wp_customize Instance of the WP_Customize_Manager class.
 */
function float_customize_register( $wp_customize ) {

	$wp_customize->add_setting( 'logo_is_2x', array(
		'default'           => false,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'logo_is_2x', array(
		'label'    => __( 'Logo is high pixel density. Display the logo width and height halved.', 'float' ),
		'section'  => 'title_tagline',
		'settings' => 'logo_is_2x',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_panel( 'float_panel', array(
		'priority'       => 800,
		'theme_supports' => '',
		'title'          => __( 'Float', 'float' ),
	) );

	// Float Settings.
	$wp_customize->add_section( 'float', array(
		'panel'    => 'float_panel',
		'title'    => 'General Settings',
		'priority' => 0,
	) );

	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'float-dark',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'       => __( 'Choose the theme', 'float' ),
		'description' => __( 'Are you using a light or dark background? This setting affects text colors used on the navigation, sidebar etc.', 'float' ),
		'section'     => 'float',
		'settings'    => 'color_scheme',
		'type'        => 'radio',
		'choices'     => array(
			'float-light' => __( 'Light', 'float' ),
			'float-dark'  => __( 'Dark', 'float' ),
		),
	) );

	$wp_customize->add_setting( 'sidebar_position', array(
		'default'           => 'sidebar-right',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'sidebar_position', array(
		'label'    => __( 'Sidebar position', 'float' ),
		'section'  => 'float',
		'settings' => 'sidebar_position',
		'type'     => 'radio',
		'choices'  => array(
			'sidebar-left'  => __( 'Left', 'float' ),
			'sidebar-right' => __( 'Right', 'float' ),
		),
	) );

	$wp_customize->add_setting( 'hentry_background', array(
		'default'           => '1',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'hentry_background', array(
		'label'       => __( 'Post background', 'float' ),
		'description' => __( 'Choose the background pattern used around the post, and on the top of the page.', 'float' ),
		'section'     => 'float',
		'settings'    => 'hentry_background',
		'type'        => 'select',
		'choices'     => array(
			''  => __( 'None', 'float' ),
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting( 'line_background', array(
		'default'           => '1',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'line_background', array(
		'label'       => __( 'Line style', 'float' ),
		'description' => __( 'Choose the style for the line used in the meta data and author bio.', 'float' ),
		'section'     => 'float',
		'settings'    => 'line_background',
		'type'        => 'select',
		'choices'     => array(
			''  => __( 'None', 'float' ),
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting( 'display_author_bio', array(
		'default'           => true,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'display_author_bio', array(
		'label'       => __( 'Display author bio', 'float' ),
		'description' => __( 'Display author bio in posts. Set bio in Users > Your Profile.', 'float' ),
		'section'     => 'float',
		'settings'    => 'display_author_bio',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'author_meta', array(
		'default'           => true,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'author_meta', array(
		'label'       => __( 'Display author name in post meta', 'float' ),
		'description' => __( 'Display author name below the post title, in the post meta.', 'float' ),
		'section'     => 'float',
		'settings'    => 'author_meta',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'category_display', array(
		'default'           => false,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'category_display', array(
		'label'       => __( 'How to display posts in archives', 'float' ),
		'description' => __( 'Display posts in archives like on the homepage.', 'float' ),
		'section'     => 'float',
		'settings'    => 'category_display',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'tags_on_homepage', array(
		'default'           => true,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'tags_on_homepage', array(
		'label'       => __( 'Show tags on homepage', 'float' ),
		'description' => __( 'Show the tags of the posts also on the homepage.', 'float' ),
		'section'     => 'float',
		'settings'    => 'tags_on_homepage',
		'type'        => 'checkbox',
	) );

	$wp_customize->add_setting( 'related_posts_number', array(
		'default'           => '3',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'related_posts_number', array(
		'label'       => __( 'Number of related posts', 'float' ),
		'description' => __( 'Selected number of related posts will be displayed below the post.', 'float' ),
		'section'     => 'float',
		'settings'    => 'related_posts_number',
		'type'        => 'select',
		'choices'     => array(
			'0' => '0',
			'1' => '1',
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
	) );

	$wp_customize->add_setting( 'related_posts_title', array(
		'default'           => 'Related Posts',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'related_posts_title', array(
		'label'    => __( 'Related posts title', 'float' ),
		'section'  => 'float',
		'settings' => 'related_posts_title',
		'type'     => 'text',
	) );

	$wp_customize->add_section( 'float_fonts', array(
		'panel'    => 'float_panel',
		'title'    => 'Fonts',
		'priority' => 0,
	) );

	$wp_customize->add_setting( 'font_headers', array(
		'default'           => '16',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'font_headers', array(
		'label'    => __( 'Header Font', 'float' ),
		'section'  => 'float_fonts',
		'settings' => 'font_headers',
		'type'     => 'select',
		'choices'  => float_get_font_options( false ),
	) );

	$wp_customize->add_setting( 'font_body', array(
		'default'           => '11',
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'font_body', array(
		'label'    => __( 'Body Font', 'float' ),
		'section'  => 'float_fonts',
		'settings' => 'font_body',
		'type'     => 'select',
		'choices'  => float_get_font_options( false ),
	) );

	// Colors.
	$colors[] = array(
		'slug'      => 'color_link',
		'default'   => '#da340a',
		'label'     => __( 'Link color', 'float' ),
		'transport' => 'refresh',
	);

	$colors[] = array(
		'slug'      => 'color_tags',
		'default'   => '#da340a',
		'label'     => __( 'Tags color', 'float' ),
		'transport' => 'postMessage',
	);

	$colors[] = array(
		'slug'      => 'color_comments_bubble',
		'default'   => '#da340a',
		'label'     => __( 'Comments bubble color', 'float' ),
		'transport' => 'refresh',
	);

	$colors[] = array(
		'slug'      => 'color_separator',
		'default'   => '#da340a',
		'label'     => __( 'Menu and meta separator color', 'float' ),
		'transport' => 'refresh',
	);

	// Add settings and controls for each color.
	foreach ( $colors as $color ) {

		$wp_customize->add_setting(
			$color['slug'], array(
				'default'           => $color['default'],
				'type'              => 'theme_mod',
				'transport'         => $color['transport'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			$color['slug'],
			array(
				'label'    => $color['label'],
				'section'  => 'colors',
				'settings' => $color['slug'],
			)
		) );
	}

	$wp_customize->add_setting( 'social_icons_in_color', array(
		'default'           => true,
		'type'              => 'theme_mod',
		'transport'         => 'refresh',
		'sanitize_callback' => 'float_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'social_icons_in_color', array(
		'label'    => __( 'Display social icons in color', 'float' ),
		'section'  => 'colors',
		'settings' => 'social_icons_in_color',
		'type'     => 'checkbox',
	) );
}
add_action( 'customize_register', 'float_customize_register' );

/**
 * Enqueues script used by the customizer.
 */
function float_customizer_scripts() {

	wp_enqueue_script(
		'float-theme-customize',
		get_template_directory_uri() . '/js/theme-customize.js',
		array( 'jquery', 'customize-preview' ),
		FLOAT_THEME_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'float_customizer_scripts' );

/**
 * Returns font options.
 *
 * @param  boolean $full_stack Include full font stack.
 * @return array   Array of font options
 */
function float_get_font_options( $full_stack = false ) {

	$fonts = array(
		'1'  => array( 'Alegreya', 'serif' ),
		'2'  => array( 'Alegreya Sans', 'sans-serif' ),
		'3'  => array( 'Archivo Narrow', 'sans-serif' ),
		'4'  => array( 'Bitter', 'serif' ),
		'5'  => array( 'Cabin', 'sans-serif' ),
		'6'  => array( 'Chivo', 'sans-serif' ),
		'7'  => array( 'Fira Sans', 'sans-serif' ),
		'8'  => array( 'Gentium Book Basic', 'serif' ),
		'9'  => array( 'IBM Plex Sans', 'sans-serif' ),
		'10' => array( 'IBM Plex Serif', 'serif' ),
		'11' => array( 'Karla', 'sans-serif' ),
		'12' => array( 'Lato', 'sans-serif' ),
		'13' => array( 'Lora', 'serif' ),
		'14' => array( 'Noto Sans', 'sans-serif' ),
		'15' => array( 'Noto Serif', 'serif' ),
		'16' => array( 'Oswald', 'sans-serif' ),
		'17' => array( 'Poppins', 'sans-serif' ),
		'18' => array( 'PT Sans', 'sans-serif' ),
		'19' => array( 'PT Serif', 'serif' ),
		'20' => array( 'Roboto Condensed', 'sans-serif' ),
		'21' => array( 'Roboto Slab', 'serif' ),
		'22' => array( 'Source Sans Pro', 'sans-serif' ),
	);

	if ( true === $full_stack ) {
		return $fonts;
	} else {
		$return = array();
		foreach ( $fonts as $key => $value ) {
			$return[ $key ] = $value[0];
		}
		return $return;
	}
}

/**
 * Checkbox Sanitization Callback
 *
 * @param  boolean $input Input.
 * @return boolean
 */
function float_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true === $input ) ? true : false );
}
