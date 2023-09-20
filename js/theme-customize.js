( function( $ ) {

	wp.customize( 'color_link', function( value ) {
		value.bind( function( newval ) {
			$('a, aside a:hover, .main h1 a:hover').css('color', newval);
		} );
	} );

	wp.customize( 'color_tags', function( value ) {
		value.bind( function( newval ) {
			$('.meta-tags li a').css('background-color', newval);
		} );
	} );

	wp.customize( 'color_comments_bubble', function( value ) {
		value.bind( function( newval ) {
			$('.meta-comments, .float-related-posts .float-widget-latest-comments').css('background-color', newval);
			$('.meta-comments:after, .float-related-posts .float-widget-latest-comments:after').css({
				'border-top-color': newval,
				'border-right-color': newval
			});
		} );
	} );

	wp.customize( 'color_separator', function( value ) {
		value.bind( function( newval ) {
			$('.meta li:after, .float-nav-ul > li > a:after, .meta-separator').css('color', newval);
		} );
	} );

} )( jQuery );
