<?php
/**
 * Template-article.php
 *
 * @package float
 */

?>
<div class="hentry-outer">
	<div <?php post_class(); ?>>
		<div class="hentry-header">
			<?php if ( comments_open() ) : ?>
				<h1 class="h1-narrow"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<a href="<?php the_permalink(); ?>#comments" class="meta-comments"><?php comments_number( '0', '1', '%' ); ?></a>
			<?php else : ?>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/template', 'post-meta' ); ?>
		</div><!-- /hentry-header -->

		<?php if ( has_post_thumbnail() && ! get_post_meta( $post->ID, '_float_meta_hide_featured_image', true ) ) : ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>">
					<?php
					the_post_thumbnail(
						'1300x9999',
						array(
							'alt' => get_the_title(),
						)
					);
					?>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( ! get_theme_mod( 'excerpt_on_articles', false ) ) : ?>
			<?php the_content( __( 'Continue reading', 'float' ) . ' &rarr;' ); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>

		<?php if ( get_theme_mod( 'tags_on_homepage', true ) ) : ?>
			<?php the_tags( '<ul class="meta-tags"><li>', '</li><li>', '</li></ul>' ); ?>
		<?php endif; ?>
	</div><!-- /hentry -->
</div><!-- /hentry-outer -->
