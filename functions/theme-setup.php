<?php
/**
 * Theme-setup.php
 *
 * @package float
 */

/**
 * Sets content width.
 *
 * @var integer
 */
if ( ! isset( $content_width ) ) {
	$content_width = 530;
}

/**
 * After setup theme.
 */
function float_after_setup_theme() {

	load_theme_textdomain( 'float', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );

	// Disable block widgets.
	remove_theme_support( 'widgets-block-editor' );

	$defaults = array(
		'default-color'          => '#171C20',
		'default-image'          => get_template_directory_uri() . '/images/background-1.jpg',
		'default-repeat'         => 'repeat',
		'default-position-x'     => 'center',
		'default-position-y'     => 'top',
		'default-size'           => 'auto',
		'default-attachment'     => 'scroll',
		'wp-head-callback'       => 'float_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $defaults );

	add_theme_support( 'custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Enables navigation.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'float' ),
	) );

	set_post_thumbnail_size( 40, 40, true );
	add_image_size( '80x80', 80, 80, true );
	add_image_size( '240x9999', 240, 9999 );
	add_image_size( '1300x9999', 1300, 9999 );
}
add_action( 'after_setup_theme', 'float_after_setup_theme' );

/**
 * Enqueues styles and scripts.
 */
function float_enqueue_styles_scripts() {

	wp_enqueue_style( 'float-style', get_stylesheet_uri(), '', FLOAT_THEME_VERSION );
	$custom_css = float_get_inline_style();
	wp_add_inline_style( 'float-style', $custom_css );

	wp_enqueue_script( 'float-scripts', get_template_directory_uri() . '/js/scripts.js', false, FLOAT_THEME_VERSION, false );

	// Add 'js' class to the HTML element.
	wp_add_inline_script( 'float-scripts', "var h = document.getElementsByTagName('html')[0];h.classList.add('js');" );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Do not load Contact Form 7 CSS and JS if not on a single post/page and the shortcode is not used.
	if ( ! is_singular() || ( is_singular() && ! has_shortcode( get_the_content(), 'contact-form-7' ) ) ) {
		wp_dequeue_script( 'contact-form-7' );
		wp_deregister_style( 'contact-form-7' );
	}

	wp_enqueue_script( 'html5shiv', '//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', false, '3.7.3', false );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 10' );

	wp_enqueue_script( 'respond', '//oss.maxcdn.com/respond/1.4.2/respond.min.js', false, '1.4.2', false );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 10' );
}
add_action( 'wp_enqueue_scripts', 'float_enqueue_styles_scripts' );

/**
 * Filters the archive title.
 *
 * @param  string $title Title.
 * @return string        Archive title to be displayed.
 */
function float_get_the_archive_title( $title ) {

	if ( is_day() ) {
		$title = sprintf( __( 'Daily Archives', 'float' ) . ' <span>&#8250; %s', get_the_date() ) . '</span>';
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Monthly Archives', 'float' ) . ' <span>&#8250; %s', get_the_date( 'F Y' ) ) . '</span>';
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Yearly Archives', 'float' ) . ' <span>&#8250; %s', get_the_date( 'Y' ) ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives', 'float' ) . ' <span>&#8250; ' . single_tag_title( '', false ) . '</span>';
	} else {
		$title = __( 'Archives', 'float' ) . ' <span>&#8250; ' . single_cat_title( '', false ) . '</span>';
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'float_get_the_archive_title' );

/**
 * Registers widget areas.
 */
function float_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'float' ),
		'id'            => 'primary-widget-area',
		'description'   => __( 'The widget area in the sidebar', 'float' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'float_widgets_init' );

/**
 * Adds custom background CSS to the html element instead of body element.
 * https://developer.wordpress.org/reference/functions/_custom_background_cb/
 *
 * @return void
 */
function float_custom_background_cb() {

	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( get_theme_support( 'custom-background', 'default-color' ) === $color ) {
		$color = false;
	}

	if ( ! $background && ! $color ) {
		if ( is_customize_preview() ) {
			echo '<style type="text/css" id="custom-background-css"></style>';
		}
		return;
	}

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = ' background-image: url("' . esc_url_raw( $background ) . '");';

		// Background Position.
		$position_x = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		$position_y = get_theme_mod( 'background_position_y', get_theme_support( 'custom-background', 'default-position-y' ) );

		if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
			$position_x = 'left';
		}

		if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
			$position_y = 'top';
		}

		$position = " background-position: $position_x $position_y;";

		// Background Size.
		$size = get_theme_mod( 'background_size', get_theme_support( 'custom-background', 'default-size' ) );

		if ( ! in_array( $size, array( 'auto', 'contain', 'cover' ), true ) ) {
			$size = 'auto';
		}

		$size = " background-size: $size;";

		// Background Repeat.
		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );

		if ( ! in_array( $repeat, array( 'repeat-x', 'repeat-y', 'repeat', 'no-repeat' ), true ) ) {
			$repeat = 'repeat';
		}

		$repeat = " background-repeat: $repeat;";

		// Background Scroll.
		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );

		if ( 'fixed' !== $attachment ) {
			$attachment = 'scroll';
		}

		$attachment = " background-attachment: $attachment;";

		$style .= $image . $position . $size . $repeat . $attachment;
	}
	?>
	<style type="text/css" id="custom-background-css">
	html { <?php echo trim( $style ); ?> }
	</style>
	<?php
}
