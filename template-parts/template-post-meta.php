<?php
/**
 * Template-post-meta.php
 *
 * @package float
 */

?>
<ul class="meta">
	<?php if ( get_theme_mod( 'author_meta', true ) ) : ?><li class="meta-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'email' ), '28', '', 'Avatar' ); ?><?php the_author(); ?></a></li><?php endif; ?><li><?php echo get_the_date(); ?></li><?php if ( has_category() ) : ?><li><?php the_category( ', ' ); ?></li><?php endif; ?><?php edit_post_link( 'Edit', '<li>', '</li>' ); ?>
</ul>
