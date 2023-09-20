<?php
/**
 * Template Name: Archive
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

			<h2><?php esc_html_e( 'Monthly Archives', 'float' ); ?></h2>

			<div class="custom-archive">
				<?php
				$limit = 0;
				$year_prev = null;

				global $wpdb;
				$months = $wpdb->get_results( "SELECT DISTINCT MONTH( post_date ) AS month, YEAR( post_date ) AS year, COUNT( id ) as post_count FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date ASC" );
				?>
				<?php foreach ( $months as $month ) : ?>
					<?php $year_current = $month->year; ?>
					<?php if ( $year_current !== $year_prev ) : ?>
						<strong><a href="<?php echo esc_url( home_url() ); ?>/<?php echo absint( $month->year ); ?>/"><?php echo absint( $month->year ); ?></a></strong>
					<?php endif; ?>

					<a href="<?php echo esc_url( home_url() ); ?>/<?php echo absint( $month->year ); ?>/<?php echo absint( date( 'm', mktime( 0, 0, 0, $month->month, 1, $month->year ) ) ); ?>"><span><?php echo esc_html( date( 'F', mktime( 0, 0, 0, $month->month, 1, $month->year ) ) ); ?></span></a>

					<?php
					$year_prev = $year_current;

					if ( ++$limit >= 18 ) {
						break;
					}
					?>
				<?php endforeach; ?>
			</div>

			<div class="one_half">
				<?php
				$wp_query_args = array(
					'posts_per_page'         => 10,
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
				);

				$wp_query_posts = new WP_Query( $wp_query_args );
				?>
				<?php if ( $wp_query_posts->have_posts() ) : ?>
					<h2><?php esc_html_e( 'Last 10 Posts', 'float' ); ?></h2>

					<ul>
					<?php while ( $wp_query_posts->have_posts() ) : $wp_query_posts->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
			</div>

			<div class="one_half last">
				<h2><?php esc_html_e( 'Categories', 'float' ); ?></h2>

				<ul>
					<?php wp_list_categories( 'title_li=' ); ?>
				</ul>

				<h2><?php esc_html_e( 'Tags', 'float' ); ?></h2>

				<ul>
					<?php $get_tags = get_tags(); ?>
					<?php foreach ( $get_tags as $get_tag ) : ?>
						<?php $tag_link = get_tag_link( $get_tag->term_id ); ?>
						<li><a href="<?php echo esc_url( $tag_link ); ?>"><?php echo esc_html( $get_tag->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div><div class="clear"></div>

			<?php endwhile; ?>
		</div><!-- /hentry -->
	</div><!-- /hentry-outer -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
