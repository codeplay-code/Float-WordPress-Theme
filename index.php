<?php
/**
 * Index.php
 *
 * @package float
 */

get_header(); ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<?php get_template_part( 'template-parts/template', 'article' ); ?>
<?php endwhile; ?>

<?php float_pagination(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
