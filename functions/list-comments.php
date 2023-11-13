<?php
/**
 * List-comments.php
 *
 * @package float
 */

if ( ! function_exists( 'float_list_comments' ) ) {

	/**
	 * Outputs template for comments and pingbacks.
	 *
	 * @param  [type] $comment [description].
	 * @param  [type] $args    [description].
	 * @param  [type] $depth   [description].
	 */
	function float_list_comments( $comment, $args, $depth ) {

		global $post;
		switch ( $comment->comment_type ) :
			case '':
			case 'comment':
			?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 38, '', 'Avatar' ); ?>

				<?php printf( '%s', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				<?php if ( $comment->user_id === $post->post_author ) : ?>
					<span class="comment-by-author"><?php esc_html_e( 'Author', 'float' ); ?></span>
				<?php endif; ?>
				<br>
				<?php // Translators: %1$s: comment date, %2$s: comment time. ?>
				<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-time"><?php printf( esc_html__( '%1$s at %2$s', 'float' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) ); ?></a>

				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'reply_text' => __( 'Reply', 'float' ),
						)
					)
				);
				?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<?php if ( '0' === $comment->comment_approved ) : ?>
				<em class="moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'float' ); ?></em>
			<?php endif; ?>

				<?php
				break;
			case 'pingback':
			case 'trackback':
			?>
		<li class="post pingback">
			<p><?php esc_html_e( 'Pingback:', 'float' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'float' ), ' ' ); ?></p>
		<?php
		endswitch;
	}
}
