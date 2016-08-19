<?php 

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
        'exclude_tree'       => '',
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
        'include'            => '',
        'hierarchical'       => 0,
        'title_li'           => __( '' ),
        'show_option_none'   => __( 'No Courses' ),
        'number'             => null,
        'echo'               => 1,
        'depth'              => 0,
        'current_category'   => 0,
        'pad_counts'         => 0,
        'taxonomy'           => 'course_featured',
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