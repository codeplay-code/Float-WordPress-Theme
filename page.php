<?php
/**
 * Page.php
 *
 * @package float
 */

get_header(); ?>

<div class="hentry-outer">
	<div <?php post_class(); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="hentry-header">
				<h1><?php the_title(); ?></h1>
			</div><!-- /hentry-header -->

			<?php the_content(); ?>

			<?php
			wp_link_pages( array(
				'before' => '<p class="float-pages">' . __( 'Pages:', 'float' ),
				'after'  => '</p>',
			) );
			?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>

			<?php endwhile; ?>
		</div><!-- /hentry -->
	</div><!-- /hentry-outer -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
