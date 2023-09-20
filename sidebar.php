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

	<p class="copyright"><a href="https://themeforest.net/item/float-responsive-blog-theme/2635174?ref=mytheme">Float WordPress Theme</a><br> <a href="https://wordpress.org/"><?php esc_html_e( 'Proudly powered by WordPress', 'float' ); ?></a><br> Copyright &copy; <?php echo absint( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
</aside>
