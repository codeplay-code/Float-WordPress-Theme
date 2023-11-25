<?php
/**
 * Misc.php
 *
 * @package float
 */

/**
 * Adds a class to the body tag.
 *
 * @param  array $classes Classes.
 * @return array
 */
function float_body_class( $classes ) {

	$scheme    = get_theme_mod( 'color_scheme', 'float-dark' );
	$classes[] = $scheme;

	return $classes;
}
add_filter( 'body_class', 'float_body_class' );

if ( ! function_exists( 'float_excerpt_more' ) ) {
	/**
	 * Customizes the excerpt.
	 *
	 * @param  string $more More.
	 * @return string
	 */
	function float_excerpt_more( $more ) {
		return '<span class="excerpt-ellipsis">&hellip;</span>';
	}
	add_filter( 'excerpt_more', 'float_excerpt_more' );
}

if ( ! function_exists( 'float_pagination' ) ) {
	/**
	 * Displays a paginated navigation to next/previous set of posts, when applicable.
	 */
	function float_pagination() {

		$pagination = get_the_posts_pagination( array(
			'mid_size'           => 1,
			'prev_next'          => true,
			'screen_reader_text' => __( 'Choose page', 'float' ),
		) );

		if ( $pagination ) {
			echo wp_kses_post( $pagination );
		}
	}
}

if ( ! function_exists( 'float_shortcode_atts_caption' ) ) {
	/**
	 * Removes the added 10px width from captions.
	 *
	 * @param  array $attrs Attributes.
	 * @return array
	 */
	function float_shortcode_atts_caption( $attrs ) {
		if ( ! empty( $attrs['width'] ) ) {
			$attrs['width'] -= 10;
		}
		return $attrs;
	}
	add_filter( 'shortcode_atts_caption', 'float_shortcode_atts_caption' );
}

if ( ! function_exists( 'float_related_posts' ) ) {
	/**
	 * Displays related posts.
	 */
	function float_related_posts() {

		$number = get_theme_mod( 'related_posts_number', 3 );
		if ( 0 === $number ) {
			return;
		}

		$categories   = get_the_category( get_the_ID() );
		$category_ids = wp_list_pluck( $categories, 'term_id' );

		$args = array(
			'category__in'           => $category_ids,
			'post__not_in'           => array( get_the_ID() ),
			'posts_per_page'         => $number,
			'meta_key'               => '_thumbnail_id', // phpcs:ignore slow query ok.
			'no_found_rows'          => true,
			'update_post_term_cache' => false,
		);

		$my_query = new WP_Query( $args );

		$title = get_theme_mod( 'related_posts_title' );
		?>

		<?php if ( $my_query->have_posts() ) : ?>
			<section class="float-related-posts float-widget-latest">
				<?php if ( ! empty( $title ) ) : ?>
					<h3><?php echo esc_html( $title ); ?></h3>
				<?php endif; ?>

				<?php if ( $my_query->have_posts() ) : ?>
					<ul>
						<?php while ( $my_query->have_posts() ) : ?>
							<?php $my_query->the_post(); ?>
							<?php get_template_part( 'template-parts/template', 'article-smallest' ); ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</section>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		<?php
	}
}
