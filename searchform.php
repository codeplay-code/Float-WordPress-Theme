<?php
/**
 * Searchform.php
 *
 * @package float
 */

?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="s"><?php esc_html_e( 'Search', 'float' ); ?></label>
	<input type="text" name="s" class="s" id="s" placeholder="<?php esc_html_e( 'Search', 'float' ); ?>&hellip;" value="<?php printf( get_search_query() ); ?>">
	<button class="searchsubmit"><span class="screen-reader-text"><?php esc_html_e( 'Search', 'float' ); ?></span><?php float_inline_svg( 'search' ); ?></button>
</form>
