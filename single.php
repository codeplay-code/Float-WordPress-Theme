<?php
/**
 * Single.php
 *
 * @package float
 */

get_header(); ?>

<div class="hentry-outer">
	<div <?php post_class(); ?>>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<div class="hentry-header">
				<?php if ( comments_open() ) : ?>
					<h1 class="h1-narrow"><?php the_title(); ?></h1>
					<a href="<?php the_permalink(); ?>#comments" class="meta-comments"><?php comments_number( '0', '1', '%' ); ?></a>
				<?php else : ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>

				<?php get_template_part( 'template-parts/template', 'post-meta' ); ?>
			</div><!-- /hentry-header -->

			<?php if ( has_post_thumbnail() && ! get_post_meta( $post->ID, '_float_meta_hide_featured_image', true ) ) : ?>
				<div class="featured-image">
					<?php
					the_post_thumbnail(
						'1300x9999',
						array(
							'alt' => get_the_title(),
						)
					);
					?>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<p class="float-pages">' . __( 'Pages:', 'float' ),
					'after'  => '</p>',
				)
			);
			?>

			<?php the_tags( '<ul class="meta-tags"><li>', '</li><li>', '</li></ul>' ); ?>

			<?php if ( get_theme_mod( 'display_author_bio', true ) ) : ?>
				<div class="author-bio">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '56', '', 'Avatar' ); ?>
					<h3><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></h3>
					<?php wp_kses_post( wpautop( the_author_meta( 'description' ) ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( is_singular( 'post' ) ) : ?>
				<?php float_related_posts(); ?>
			<?php endif; ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div><!-- /hentry -->
</div><!-- /hentry-outer -->

<ul class="page-navi">
	<li class="page-navi-prev"><?php previous_post_link( '%link', __( 'Previous', 'float' ) ); ?></li>
	<li class="page-navi-next"><?php next_post_link( '%link', __( 'Next', 'float' ) ); ?></li>
</ul>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
