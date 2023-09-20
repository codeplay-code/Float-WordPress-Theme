<?php
/**
 * Search.php
 *
 * @package float
 */

get_header(); ?>

<div class="hentry-outer">
	<div class="hentry">
		<div class="hentry-header">
			<?php if ( have_posts() ) : ?>
				<h1><?php printf( '<span>' . esc_html__( 'Search Results', 'float' ) . ' &ldquo;</span>%s<span>&rdquo;</span>', '' . get_search_query() . '' ); ?></h1>
			<?php else : ?>
				<h1><?php esc_html_e( 'Nothing Found', 'float' ); ?></h1>
			<?php endif; ?>
		</div><!-- /hentry-header -->

		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/template', 'article-small' ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'float' ); ?></p>
		<?php endif; ?>
	</div><!-- /hentry -->
</div><!-- /hentry-outer -->

<?php float_pagination(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
