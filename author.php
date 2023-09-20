<?php
/**
 * Author.php
 *
 * @package float
 */

get_header();

$curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );

$author_description = get_the_author_meta( 'description', $curauth->ID );

if ( function_exists( 'float_plugin_get_user_social_links' ) ) {
	$author_social_links = float_plugin_get_user_social_links( $curauth->ID );
}
?>

<div class="hentry-outer">
	<div <?php post_class(); ?>>
		<div class="hentry-header">
			<h1><?php esc_html_e( 'Author', 'float' ); ?> <span>&#8250; <?php the_author_meta( 'display_name', $curauth->ID ); ?></span></h1>
		</div><!-- /hentry-header -->

		<?php if ( ! empty( $author_social_links ) && ! is_paged() ) : ?>
			<?php $colored = get_theme_mod( 'social_icons_in_color', true ); ?>
			<ul class="float-social-menu <?php echo ( true === $colored ? 'float-social-menu-color' : 'float-social-menu-grayscale' ); ?>">
				<?php foreach ( $author_social_links as $service => $url ) : ?>
					<li><a href="<?php echo esc_url( $url ); ?>" class="float-social-icon float-social-icon-<?php echo esc_attr( $service ); ?>"><?php float_inline_svg( $service ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $author_description && ! is_paged() ) : ?>
			<div class="ingress"><?php echo wp_kses_post( wpautop( $author_description ) ); ?></div>
		<?php endif; ?>

		<?php // Translators: %s: author name. ?>
		<h2><?php printf( esc_html__( 'Posts by %s', 'float' ), esc_html( get_the_author_meta( 'display_name', $curauth->ID ) ) ); ?></h2>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/template', 'article-small' ); ?>
		<?php endwhile; ?>
	</div><!-- /hentry -->
</div><!-- /hentry-outer -->

<?php float_pagination(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
