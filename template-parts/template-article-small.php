<?php
/**
 * Template-article-small.php
 *
 * @package float
 */

?>
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<?php get_template_part( 'template-parts/template', 'post-meta' ); ?>

<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>">
		<?php
		the_post_thumbnail(
			'240x9999',
			array(
				'alt'   => get_the_title(),
				'class' => 'alignright',
			)
		);
		?>
	</a>
<?php endif; ?>

<?php the_excerpt(); ?>
