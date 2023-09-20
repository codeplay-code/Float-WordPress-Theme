<?php
/**
 * Template-article-smallest.php
 *
 * @package float
 */

?>

<li>
	<a href="<?php the_permalink(); ?>">
		<?php
		the_post_thumbnail(
			'80x80',
			array(
				'alt' => get_the_title(),
			)
		);
		?>
	</a>

	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
	<span class="float-widget-latest-date"><?php echo get_the_date(); ?></span>
	<a href="<?php the_permalink(); ?>#comments" class="float-widget-latest-comments"><?php comments_number( '0', '1', '%' ); ?></a>
</li>
