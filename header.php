<?php
/**
 * Header.php
 *
 * @package float
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header role="banner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?php $logo = float_get_logo(); ?>

			<?php if ( $logo ) : ?>
				<img src="<?php echo esc_url( $logo['src'] ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $logo['width'] ); ?>" height="<?php echo esc_attr( $logo['height'] ); ?>" class="logo-img">
			<?php else : ?>
				<span class="logo-text"><?php bloginfo( 'name' ); ?></span>
			<?php endif; ?>
		</a>

		<button type="button" class="float-nav-toggle" aria-expanded="false"><span class="float-nav-toggle-text"><?php echo esc_html( _x( 'Menu', 'Mobile menu button text (for screen readers)', 'float' ) ); ?></span></button>

		<?php
		wp_nav_menu(
			array(
				'container'       => 'nav',
				'container_class' => 'float-nav',
				'menu_class'      => 'float-nav-ul no-js',
				'theme_location'  => 'primary',
				'fallback_cb'     => false,
				'item_spacing'    => 'discard',
				'depth'           => 2,
			)
		);
		?>
	</header>

	<div class="wrapper">
		<div class="main">
