<?php 

add_action('init', 'custom_register');

function custom_register() {
	$labels = array(
		'name'               => _x( 'Courses', 'post type general name' ),
		'singular_name'      => _x( 'Courses', 'post type singular name' ),
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
		'rewrite'            => array( 'slug' => 'courses' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'has_archive' 		 => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'categories', 'custom-fields' )
	);

	register_post_type( 'course', $args );

	$labels = array(
		'name'               => _x( 'Professors', 'post type general name' ),
		'singular_name'      => _x( 'Professors', 'post type singular name' ),
		'menu_name'          => _x( 'Professors', 'admin menu' ),
		'name_admin_bar'     => _x( 'Professors', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'professor' ),
		'add_new_item'       => __( 'Add New Professor' ),
		'new_item'           => __( 'New Professor' ),
		'edit_item'          => __( 'Edit Professor' ),
		'view_item'          => __( 'View Professor' ),
		'all_items'          => __( 'All Professors' ),
		'search_items'       => __( 'Search Professors' ),
		'parent_item_colon'  => __( 'Parent Professor:' ),
		'not_found'          => __( 'No professor found.' ),
		'not_found_in_trash' => __( 'No professor found in Trash.' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'professors' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'has_archive' 		 => true,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'categories', 'custom-fields' )
	);

	register_post_type( 'professor', $args );

    $labels = array(
		'name'              => _x( 'Course Subject', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Subject', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Subject' ),
		'all_items'         => __( 'All Course Subject' ),
		'parent_item'       => __( 'Parent Subject' ),
		'parent_item_colon' => __( 'Parent Subject:' ),
		'edit_item'         => __( 'Edit Subject' ),
		'update_item'       => __( 'Update Subject' ),
		'add_new_item'      => __( 'Add New Subject' ),
		'new_item_name'     => __( 'New Subject Name' ),
		'menu_name'         => __( 'Subject' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_status = array(
		'name'              => _x( 'Course Status', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Status', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Status' ),
		'all_items'         => __( 'All Course Status' ),
		'parent_item'       => __( 'Parent Status' ),
		'parent_item_colon' => __( 'Parent Status:' ),
		'edit_item'         => __( 'Edit Status' ),
		'update_item'       => __( 'Update Status' ),
		'add_new_item'      => __( 'Add New Status' ),
		'new_item_name'     => __( 'New Status Name' ),
		'menu_name'         => __( 'Status' ),
	);

	$args_status = array(
		'hierarchical'      => true,
		'labels'            => $labels_status,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_credit = array(
		'name'              => _x( 'Course Credit', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Credit', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Credit' ),
		'all_items'         => __( 'All Course Credit' ),
		'parent_item'       => __( 'Parent Credit' ),
		'parent_item_colon' => __( 'Parent Credit:' ),
		'edit_item'         => __( 'Edit Credit' ),
		'update_item'       => __( 'Update Credit' ),
		'add_new_item'      => __( 'Add New Credit' ),
		'new_item_name'     => __( 'New Credit Name' ),
		'menu_name'         => __( 'Credit' ),
	);

	$args_credit = array(
		'hierarchical'      => true,
		'labels'            => $labels_credit,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_level = array(
		'name'              => _x( 'Course Level', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Level', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Level' ),
		'all_items'         => __( 'All Course Level' ),
		'parent_item'       => __( 'Parent Level' ),
		'parent_item_colon' => __( 'Parent Level:' ),
		'edit_item'         => __( 'Edit Level' ),
		'update_item'       => __( 'Update Level' ),
		'add_new_item'      => __( 'Add New Level' ),
		'new_item_name'     => __( 'New Level Name' ),
		'menu_name'         => __( 'Level' ),
	);

	$args_level = array(
		'hierarchical'      => true,
		'labels'            => $labels_level,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_engagement = array(
		'name'              => _x( 'Course Engagement', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Engagement', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Engagement' ),
		'all_items'         => __( 'All Course Engagement' ),
		'parent_item'       => __( 'Parent Engagement' ),
		'parent_item_colon' => __( 'Parent Engagement:' ),
		'edit_item'         => __( 'Edit Engagement' ),
		'update_item'       => __( 'Update Engagement' ),
		'add_new_item'      => __( 'Add New Engagement' ),
		'new_item_name'     => __( 'New Engagement Name' ),
		'menu_name'         => __( 'Engagement' ),
	);

	$args_engagement = array(
		'hierarchical'      => true,
		'labels'            => $labels_engagement,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_platform = array(
		'name'              => _x( 'Course Platform', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Platform', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Platform' ),
		'all_items'         => __( 'All Course Platform' ),
		'parent_item'       => __( 'Parent Platform' ),
		'parent_item_colon' => __( 'Parent Platform:' ),
		'edit_item'         => __( 'Edit Platform' ),
		'update_item'       => __( 'Update Platform' ),
		'add_new_item'      => __( 'Add New Platform' ),
		'new_item_name'     => __( 'New Platform Name' ),
		'menu_name'         => __( 'Platform' ),
	);

	$args_platform = array(
		'hierarchical'      => true,
		'labels'            => $labels_platform,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	$labels_featured = array(
		'name'              => _x( 'Course Featured', 'taxonomy general name' ),
		'singular_name'     => _x( 'Course Featured', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Course Featured' ),
		'all_items'         => __( 'All Course Featured' ),
		'parent_item'       => __( 'Parent Featured' ),
		'parent_item_colon' => __( 'Parent Featured:' ),
		'edit_item'         => __( 'Edit Featured' ),
		'update_item'       => __( 'Update Featured' ),
		'add_new_item'      => __( 'Add New Featured' ),
		'new_item_name'     => __( 'New Featured Name' ),
		'menu_name'         => __( 'Featured' ),
	);

	$args_featured = array(
		'hierarchical'      => true,
		'labels'            => $labels_featured,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'category_courses', array( 'course' ), $args );
	register_taxonomy( 'course_status', array( 'course' ), $args_status );
	register_taxonomy( 'course_credit', array( 'course' ), $args_credit );
	register_taxonomy( 'course_level', array( 'course' ), $args_level );
	register_taxonomy( 'course_engagement', array( 'course' ), $args_engagement );
	register_taxonomy( 'course_platform', array( 'course' ), $args_platform );
	register_taxonomy( 'course_featured', array( 'course' ), $args_featured );

}