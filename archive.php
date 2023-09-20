<?php
/**
 * Archive.php
 *
 * @package float
 */

get_header(); ?>

<?php if ( ! get_theme_mod( 'category_display', false ) ) : ?>
	<div class="hentry-outer">
		<div class="hentry">
			<div class="hentry-header">
				<?php the_archive_title( '<h1>', '</h1>' ); ?>
			</div><!-- /hentry-header -->

			<?php if ( ( is_category() || is_tag() ) && ! is_paged() && ! empty( term_description() ) ) : ?>
				<div class="ingress"><?php echo term_description(); ?></div>
			<?php endif; ?>

			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<?php get_template_part( 'template-parts/template', 'article-small' ); ?>
			<?php endwhile; ?>
		</div><!-- /hentry -->
	</div><!-- /hentry-outer -->

<?php else : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/template', 'article' ); ?>
	<?php endwhile; ?>
<?php endif; ?>

<?php float_pagination(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
