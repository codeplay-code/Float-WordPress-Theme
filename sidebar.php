<?php
/**
 * Sidebar.php
 *
 * @package float
 */

?>
</div><!-- /main -->

<aside>
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	<?php endif; ?>

	<?php
	$copyright_text = '<a href="https://themeforest.net/item/float-responsive-blog-theme/2635174?ref=mytheme">Float WordPress Theme</a><br> <a href="https://wordpress.org/">' . esc_html__( 'Proudly powered by WordPress', 'float' ) . '</a><br> Copyright &copy; ' . absint( date( 'Y' ) ) . ' <a href="' . esc_url( home_url( '/' ) ) . ' ">' . get_bloginfo( 'name' ) . '</a>';
	?>

	<p class="copyright"><?php echo wp_kses_post( apply_filters( 'float_filter_copyright_text', $copyright_text ) ); ?></p>
</aside>
