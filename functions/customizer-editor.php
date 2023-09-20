<?php
/**
 * Customizer-editor.php
 *
 * @package float
 */

/**
 * Adds custom inline CSS to the Gutenberg editor.
 */
function float_get_inline_style_gutenberg() {

	$link_color = get_theme_mod( 'color_link', '#da340a' );

	$get_the_fonts = float_get_the_fonts( 'css' );
	if ( $get_the_fonts && ! empty( $get_the_fonts['body'] ) && ! empty( $get_the_fonts['header'] ) ) {
		$font_family_body    = $get_the_fonts['body'];
		$font_family_headers = $get_the_fonts['header'];
	}

	ob_start();
	?>

	.editor-styles-wrapper {font-family:<?php echo wp_kses( $font_family_body, array( '\"' ) ); ?> !important;}

	<?php if ( $font_family_body !== $font_family_headers ) : ?>
		.editor-post-title__block .editor-post-title__input, .wp-block-heading h1, .wp-block-heading h2, .wp-block-heading h3, .editor-styles-wrapper blockquote p {font-family:<?php echo wp_kses( $font_family_headers, array( '\"' ) ); ?>}
	<?php endif; ?>

	.editor-styles-wrapper a {color:<?php echo esc_attr( $link_color ); ?>;}

	<?php
	$css = ob_get_clean();

	return preg_replace( '/\s+/S', ' ', $css );
}

/**
 * Adds inline styles for Gutenberg editor.
 */
function float_enqueue_styles_scripts_gutenberg() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'float-editor-customizer-styles', false, FLOAT_THEME_VERSION, 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'float-editor-customizer-styles' );

	wp_add_inline_style( 'float-editor-customizer-styles', float_get_inline_style_gutenberg() );
}
add_action( 'enqueue_block_editor_assets', 'float_enqueue_styles_scripts_gutenberg' );
