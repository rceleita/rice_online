<?php

// Featured Post

function quick_info_shorty( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'course_featured'
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
		$enroll 		= get_field('enroll', $post->ID);
		$start          = get_field('course_start', $post->ID);
		$length 		= get_field('course_length', $post->ID);
		$time 			= get_field('time_requirement', $post->ID);

        if($start != ''){
            $start      = date("M j, Y", strtotime($start));
        }

        $return .= '<div class="content"><h6>Featured Course</h6>';
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

// Featured Posts Carousel

function quick_info_featured( $atts ) {
    extract( shortcode_atts( array(
        'id' => 'course_featured'
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
        $return .= '<h4>' . apply_filters( 'the_title', $post->post_title ) . '</h4>';
        $return .= '<p class="learn"><i class="fa fa-file-text-o"></i> Learn More</p></a>';
        $return .= '</div></div>';
    } 

	return $return;
}
add_shortcode( 'featured_course_carousel', 'quick_info_featured' ); 