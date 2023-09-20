<?php
/**
 * Comments.php
 *
 * @package float
 */

?>

<div id="comments" class="comments">
	<?php if ( post_password_required() ) : ?>
		<p><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'float' ); ?></p>
	</div><!-- /comments -->
		<?php return; ?>
	<?php endif; ?>

	<h2 class="comments-title">
		<?php comments_number( __( 'No Comments', 'float' ), __( 'One Comment', 'float' ), __( '% Comments', 'float' ) ); ?>
	</h2>

	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'float_list_comments' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<p>
				<?php previous_comments_link( '&larr; ' . __( 'Older Comments', 'float' ) ); ?>
				<?php next_comments_link( __( 'Newer Comments', 'float' ) . ' &rarr;' ); ?>
			</p>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
		<p><?php esc_html_e( 'Comments are closed.', 'float' ); ?></p>
	<?php endif; ?>

	<?php
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$defaults = array(
		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' => '<label for="author">' . __( 'Name', 'float' ) . ( $req ? ' <em>(' . __( 'required', 'float' ) . ')</em>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />',

			'email'  => '<label for="email">' . __( 'Email', 'float' ) . ( $req ? ' <em>(' . __( 'required', 'float' ) . ')</em>' : '' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />',

			'url'    => '<label for="url">' . __( 'Website', 'float' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /><!-- #<span class="hiddenSpellError" pre="">form-section-url</span> .form-section -->',
		) ),

		'comment_field' => '<label for="comment">' . __( 'Comment', 'float' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>',

		'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as', 'float' ) . ' <a href="%1$s">%2$s</a>. <a href="%3$s">' . __( 'Log out?', 'float' ) . '</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',

		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'title_reply'          => __( 'Leave a Reply', 'float' ),
		// Translators: %s: reply to username.
		'title_reply_to'       => __( 'Leave a Reply to %s', 'float' ),
		'cancel_reply_link'    => __( 'Cancel reply', 'float' ),
		'label_submit'         => __( 'Submit', 'float' ),
	);

	comment_form( $defaults );
	?>
</div><!-- /comments -->
