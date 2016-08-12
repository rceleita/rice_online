<?php 

function frontend_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('custom_scripts', get_stylesheet_directory_uri() . '/scripts/script.js');
}

add_action('wp_enqueue_scripts', 'frontend_scripts');

// Display Child Pages


/* ================================================== */

//List Categories
class ListCategories{
  static function list_categories($atts, $content = null) {
    $atts = shortcode_atts(
      array(
        'show_option_all'    => '',
        'orderby'            => 'name',
        'order'              => 'ASC',
        'style'              => 'list',
        'show_count'         => 0,
        'hide_empty'         => 1,
        'use_desc_for_title' => 1,
        'child_of'           => 0,
        'feed'               => '',
        'feed_type'          => '',
        'feed_image'         => '',
        'exclude'            => '',
        'exclude_tree'       => '23,35,27,31,42',
        'include'            => '',
        'hierarchical'       => 0,
        'title_li'           => __( '' ),
        'show_option_none'   => __( 'No Courses' ),
        'number'             => null,
        'echo'               => 1,
        'depth'              => 0,
        'current_category'   => 0,
        'pad_counts'         => 0,
        'taxonomy'           => 'category_courses',
        'walker'             => null
      ), $atts
    );

    ob_start();
    wp_list_categories($atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
}

add_shortcode( 'categories', array('ListCategories', 'list_categories') );

/* ================================================== */

//Featured Course Category
class FeaturedCourse{
  static function featured_category($atts, $content = null) {
    $atts = shortcode_atts(
      array(
        'show_option_all'    => '',
        'orderby'            => 'name',
        'order'              => 'ASC',
        'style'              => '',
        'show_count'         => 0,
        'hide_empty'         => 1,
        'use_desc_for_title' => 1,
        'child_of'           => 0,
        'feed'               => '',
        'feed_type'          => '',
        'feed_image'         => '',
        'exclude'            => '',
        'exclude_tree'       => '',
        'include'            => '42',
        'hierarchical'       => 0,
        'title_li'           => __( '' ),
        'show_option_none'   => __( 'No Courses' ),
        'number'             => null,
        'echo'               => 1,
        'depth'              => 0,
        'current_category'   => 0,
        'pad_counts'         => 0,
        'taxonomy'           => 'category_courses',
        'walker'             => null
      ), $atts
    );

    ob_start();
    wp_list_categories($atts);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }
}

add_shortcode( 'listfeatured', array('FeaturedCourse', 'featured_category') );

/* ================================================== */

/* CUSTOM POST TYPES */

add_action('init', 'custom_register');

function custom_register() {
	$labels = array(
		'name'               => _x( 'Courses', 'post type general name' ),
		'singular_name'      => _x( 'Course', 'post type singular name' ),
		'menu_name'          => _x( 'Courses', 'admin menu' ),
		'name_admin_bar'     => _x( 'Courses', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'course' ),
		'add_new_item'       => __( 'Add New Course' ),
		'new_item'           => __( 'New Course' ),
		'edit_item'          => __( 'Edit Course' ),
		'view_item'          => __( 'View Course' ),
		'all_items'          => __( 'All Courses' ),
		'search_items'       => __( 'Search Courses' ),
		'parent_item_colon'  => __( 'Parent Courses:' ),
		'not_found'          => __( 'No courses found.' ),
		'not_found_in_trash' => __( 'No courses found in Trash.' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'course' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'categories', 'custom-fields' ),
		'taxonomies' 		 => array('post_tag')
	);

	register_post_type( 'course', $args );

    $labels = array(
		'name'              => _x( 'Course Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Categories' ),
		'all_items'         => __( 'All Course Categories' ),
		'parent_item'       => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item'         => __( 'Edit Category' ),
		'update_item'       => __( 'Update Category' ),
		'add_new_item'      => __( 'Add New Category' ),
		'new_item_name'     => __( 'New Category Name' ),
		'menu_name'         => __( 'Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'Category' ),
	);

	register_taxonomy( 'category_courses', array( 'course' ), $args );

}

/* ================================================== */

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

/* ================================================== */

// Featured Post

function quick_info_shorty( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'featured-course'      // Add the *default category id
    ), $atts ) );

    $posts = get_posts( array(
        'posts_per_page' 	=> 1,
        'post_status'    	=> 'publish',
        'post_type'			=> 'course',
        'taxonomy'			=> $id
    ) );

    $return = '';
    $return .= '<div class="featured-course">';

    foreach ( $posts as $post ) {

        $permalink 		= get_permalink($post->ID);
        $thumb 			= get_post_thumbnail_id($post->ID);
		$img_url 		= wp_get_attachment_url( $thumb,'full');
		$content 		= get_the_excerpt($post->ID);
		$enroll 		= get_post_meta($post->ID, 'Enroll Now', true);
		$start 			= get_post_meta($post->ID, 'Course Start', true);
		$length 		= get_post_meta($post->ID, 'Course Length', true);
		$time 			= get_post_meta($post->ID, 'Time Requirement', true);

        $return .= '<div class="content"><h6>' . do_shortcode('[listfeatured orderby=count]') . '</h6>';
        $return .= '<h4><a class="item" href="' . $permalink . '">' . apply_filters( 'the_title', $post->post_title ) . '</a></h4>';
        $return .= '<div class="divider"></div>';
        $return .= '<p class="excerpt">' . $content . '</p>';
        $return .= '<a class="button green large enroll" href="' . $enroll . '">Enroll Now</a></div>';
        $return .= '<div class="thumbnail"><a class="item" href="' . $permalink . '"><img src="' . $img_url . '" ></a>';
        $return .= '<div class="info start"><span>Class Start:</span>' . $start . '</div>'; 
        $return .= '<div class="info length"><span>Course Length:</span>' . $length . '</div>'; 
        $return .= '<div class="info time"><span>Required:</span>' . $time . ' HRS Per Week</div>'; 
    } 

	$return .= '</div></div>';
	return $return;
}
add_shortcode( 'featured_course', 'quick_info_shorty' ); 


/* ================================================== */

// Featured Posts (Homepage)

function quick_info_featured( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'featured-course'      // Add the *default category id
    ), $atts ) );

    $posts = get_posts( array(
        'posts_per_page' 	=> 4,
        'post_status'    	=> 'publish',
        'post_type'			=> 'course',
        'taxonomy'			=> $id
    ) );

    $return = '';

    foreach ( $posts as $post ) {

        $permalink 		= get_permalink($post->ID);
        $thumb 			= get_post_thumbnail_id($post->ID);
		$img_url 		= wp_get_attachment_url( $thumb,'full');


        $return .= '<div class="su-column su-column-size-1-4"><div class="su-column-inner su-clearfix">';
        $return .= '<a class="item" href="' . $permalink . '"><img src="' . $img_url . '" >';
        //$return .= '<h6>' . $category . '</h6>';
        $return .= '<h4>' . apply_filters( 'the_title', $post->post_title ) . '</h4>';
        $return .= '<p class="learn"><i class="fa fa-file-text-o"></i> Learn More</p></a>';
        $return .= '</div></div>';
    } 

	return $return;
}
add_shortcode( 'featured_course_carousel', 'quick_info_featured' ); 

// Widgets

// Creating the widget 
class rol_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'rol_widget', 

// Widget name will appear in UI
__('Rice Online Widget', 'rol_widget_domain'), 

// Widget description
array( 'description' => __( 'Rice Online Learning Related Courses', 'rol_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance['title'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ( ! empty( $title ) )
	echo $args['before_title'] . $title . $args['after_title'];

	// This is where you run the code and display the output

	$posts = get_posts( array(
	    'posts_per_page' 	=> 4,
	    'post_status'    	=> 'publish',
	    'post_type'			=> 'course',
	    'taxonomy'			=> 'field-of-study'
	) );

	$return = '';

	foreach ( $posts as $post ) {

	    $permalink 		= get_permalink($post->ID);
	    $thumb 			= get_post_thumbnail_id($post->ID);
		$img_url 		= wp_get_attachment_url( $thumb,'full');


	    $return .= '<div class="su-column su-column-size-1-4"><div class="su-column-inner su-clearfix">';
	    $return .= '<a class="item" href="' . $permalink . '"><img src="' . $img_url . '" >';
	    //$return .= '<h6>' . $category . '</h6>';
	    $return .= '<h4>' . apply_filters( 'the_title', $post->post_title ) . '</h4>';
	    $return .= '<p class="learn"><i class="fa fa-file-text-o"></i> Learn More</p></a>';
	    $return .= '</div></div>';
	} 

	echo($return);

	echo __( $output, 'rol_widget_domain' );
	echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}
	else {
		$title = __( 'New title', 'rol_widget_domain' );
	}
	// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
}
} // Class rol_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'rol_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

?>