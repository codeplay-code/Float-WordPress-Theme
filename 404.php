<?php
/**
 * 404.php
 *
 * @package float
 */

get_header(); ?>

	<div class="hentry-outer">
		<div class="hentry">
			<div class="hentry-header">
				<h1><?php esc_html_e( 'Not Found', 'float' ); ?></h1>
			</div><!-- /hentry-header -->

			<p><?php esc_html_e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'float' ); ?></p>
		</div><!-- /hentry -->
	</div><!-- /hentry-outer -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
