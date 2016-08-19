<?php

// Posts Meta Data

function responsive_post_meta_data() {
	printf( __( '%2$s<span class="%3$s"> by </span>%4$s', 'responsive' ),
		'meta-prep meta-prep-author posted',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="timestamp updated" datetime="%3$s"><span class="day">%4$s</span> %5$s</time></a>',
				 esc_url( get_permalink() ),
				 esc_attr( get_the_title() ),
				 esc_html( get_the_date('c')),
				 esc_html( get_the_date('d') ),
				 esc_html( get_the_date('M Y') )
		),
		'byline',
		sprintf( '',
				 get_author_posts_url( get_the_author_meta( 'ID' ) ),
				 sprintf( esc_attr__( 'View all posts by %s', 'responsive' ), get_the_author() ),
				 esc_attr( get_the_author() )
		)
	);
}

/* ================================================== */

// Numberic Nav for Posts Pages

function numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	echo '</ul></div>' . "\n";

}