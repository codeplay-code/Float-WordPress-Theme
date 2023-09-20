<?php
/**
 * Inline-style.php
 *
 * @package float
 */

/**
 * Returns selected font to use in Google Webfont import and custom CSS.
 *
 * @param  string $type CSS font stack or font families for Google import script.
 * @return string|array A string or an array for CSS font family or Google import.
 */
function float_get_the_fonts( $type ) {

	$option_font_headers = get_theme_mod( 'font_headers', 16 );
	$option_font_body    = get_theme_mod( 'font_body', 11 );

	// Check if the font options are set, else return false.
	if ( is_numeric( $option_font_headers ) && is_numeric( $option_font_headers ) ) {
		$fonts = float_get_font_options( true );

		$font_stacks = array(
			'serif'      => 'Georgia,serif',
			'sans-serif' => 'Arial,sans-serif',
		);

		// Get font families.
		$font_headers = $fonts[ $option_font_headers ][0];
		$font_body    = $fonts[ $option_font_body ][0];

		// Get font stacks.
		$css_font_stack_headers = $font_stacks[ $fonts[ $option_font_headers ][1] ];
		$css_font_stack_body    = $font_stacks[ $fonts[ $option_font_body ][1] ];

		if ( 'google' === $type ) {
			if ( $option_font_headers !== $option_font_body ) {
				$return = array(
					'header' => $font_headers,
					'body'   => $font_body,
				);
			} elseif ( $option_font_headers === $option_font_body ) {
				$return = $font_headers;
			}
		} elseif ( 'css' === $type ) {
			$return = array(
				'header' => '"' . $font_headers . '",' . $css_font_stack_headers,
				'body'   => '"' . $font_body . '",' . $css_font_stack_body,
			);
		}

		return $return;
	} else {
		return false;
	}
}

/**
 * Imports the selected fonts from Google Fonts.
 */
function float_import_fonts_from_google_fonts() {

	$fonts_url = float_get_google_fonts_url();

	if ( $fonts_url ) {
		wp_enqueue_style( 'google-webfonts', $fonts_url, '', FLOAT_THEME_VERSION, 'screen' );
	}
}
add_action( 'wp_enqueue_scripts', 'float_import_fonts_from_google_fonts' );
add_action( 'enqueue_block_editor_assets', 'float_import_fonts_from_google_fonts' );

/**
 * Builds the URL for Google Fonts.
 *
 * @return void
 */
function float_get_google_fonts_url() {

	$fonts = float_get_the_fonts( 'google' );

	if ( false === $fonts ) {
		return;
	}

	if ( is_array( $fonts ) ) {
		$fonts = implode( ':400,400i,700,700i|', $fonts ) . ':400,400i,700,700i';
	} else {
		$fonts = $fonts . ':400,400i,700,700i';
	}

	// Replace dashes in font family.
	$fonts = str_replace( ' ', '+', $fonts );

	return esc_url_raw( '//fonts.googleapis.com/css?family=' . $fonts . '&display=swap' );
}

/**
 * Adds custom inline CSS to the head.
 */
function float_get_inline_style() {

	$sidebar_position      = get_theme_mod( 'sidebar_position', 'sidebar-right' );
	$link_color            = get_theme_mod( 'color_link', '#da340a' );
	$color_tags            = get_theme_mod( 'color_tags', '#da340a' );
	$color_comments_bubble = get_theme_mod( 'color_comments_bubble', '#da340a' );
	$color_separator       = get_theme_mod( 'color_separator', '#da340a' );
	$hentry_background     = get_theme_mod( 'hentry_background', '1' );
	$line_background       = get_theme_mod( 'line_background', '1' );
	$color_scheme          = get_theme_mod( 'color_scheme', 'float-dark' );

	// If color scheme is dark, use images for dark background.
	$hentry_background = ( 'float-light' === $color_scheme ? $hentry_background . '-dark' : $hentry_background );

	$get_the_fonts = float_get_the_fonts( 'css' );
	if ( $get_the_fonts && ! empty( $get_the_fonts['body'] ) && ! empty( $get_the_fonts['header'] ) ) {
		$font_family_body    = $get_the_fonts['body'];
		$font_family_headers = $get_the_fonts['header'];
	}

	ob_start();
	?>

	body {font-family:<?php echo wp_kses( $font_family_body, array( '\"' ) ); ?>;}
	<?php if ( $font_family_body !== $font_family_headers ) : ?>
		h1, h2, h3, button, .logo, .float-nav-ul > li > a, .float-nav-ul > li > button, .button, #submit, .wpcf7-submit, blockquote p {font-family:<?php echo wp_kses( $font_family_headers, array( '\"' ) ); ?>}
	<?php endif; ?>
	<?php if ( ! empty( $hentry_background ) ) : ?>
		.hentry-outer, body {background-image:url(<?php echo esc_url( get_template_directory_uri() . '/images/hentry-' . $hentry_background ); ?>.png); <?php echo ( strpos( $hentry_background, '3' ) !== false ) ? 'background-position:50% -128px;' : ''; ?>}
	<?php endif; ?>
	<?php if ( ! empty( $line_background ) ) : ?>
		.meta, .author-bio, .float-related-posts {background-image:url(<?php echo esc_url( get_template_directory_uri() . '/images/line-horizontal-' . $line_background ); ?>.png);}
	<?php endif; ?>
	a, aside a:hover, .main h1 a:hover {color:<?php echo esc_attr( $link_color ); ?>;}
	.meta-comments, .float-related-posts .float-widget-latest-comments {background-color:<?php echo esc_attr( $color_comments_bubble ); ?>;}
	.meta-comments:after, .float-related-posts .float-widget-latest-comments:after {border-top-color:<?php echo esc_attr( $color_comments_bubble ); ?>;border-right-color:<?php echo esc_attr( $color_comments_bubble ); ?>;}
	.meta li:after, .float-nav-ul > li:after, .meta-separator {color:<?php echo esc_attr( $color_separator ); ?>;}
	.meta-tags li a {background-color:<?php echo esc_attr( $color_tags ); ?>;}
	<?php if ( 'sidebar-left' === $sidebar_position ) : ?>
		@media screen and (min-width:800px) { .main {float:right;} aside {float:left;} }
	<?php endif; ?>

	<?php
	$css = ob_get_clean();

	return preg_replace( '/\s+/S', ' ', $css );
}
