<?php
	if ( ! function_exists( 'pw_livesearch_register_custom_post' ) ) 
	{
		add_action('init', 'pw_livesearch_register_custom_post');
		function pw_livesearch_register_custom_post() {
			$args = array(
				'description' => __('Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
				'show_ui' => true,
				//'menu_position' => 25,
				'exclude_from_search' => true,
				'menu_icon' => 'dashicons-search',
				'labels' => array(
					'name'=> __('Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'singular_name' => __('Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'add_new' => __('Add Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'add_new_item' => __('Add Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'edit' => __('Edit Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'edit_item' => __('Edit Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'new-item' => 'New Mega Search',
					'view' => __('View Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'view_item' => __('View Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'search_items' => __('Search Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__),
					'not_found' => __('No Mega Search Found',__PW_LIVESEARCH_TEXTDOMAIN__),
					'not_found_in_trash' => __('No Mega Search Found in Trash',__PW_LIVESEARCH_TEXTDOMAIN__),
					'parent' => __('Parent Mega Search',__PW_LIVESEARCH_TEXTDOMAIN__)
				),
				'public' => true,
				//'taxonomies' => array('propertytype'),
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => true,
				'supports' => array('title'),
				'has_archive' => true,
				
			);
		
			register_post_type( 'pw_livesearch' , $args );
			
			
		}
		
		//ADD CUSTOM COLUMN SHORTOCODE
		if ( ! function_exists( 'custom_add_property_columns_live_search' ) ) 
		{
			add_filter('manage_pw_livesearch_posts_columns', 'custom_add_property_columns_live_search');
			function custom_add_property_columns_live_search($columns) {
				//unset($columns['title']);	
				unset($columns['date']);	
				//$columns['custom_tracking_no']= 'Tracking Number' ;
				$columns['pw_livesearch_shortcode_result']= __('Shortcode',__PW_LIVESEARCH_TEXTDOMAIN__);
				return $columns;
			}
		}
		
	
		if ( ! function_exists( 'custom_render_post_columns_live_search' ) ) 
		{
			add_action('manage_posts_custom_column', 'live_search', 10, 2);
			function live_search($column_name, $id) {
		
				switch ($column_name) {
					
					case 'pw_livesearch_shortcode_result':
						echo '[pw-ajax-live-search id="'.$id.'"]';
					break;	
			
				}
			}
		}
		
		
		//REMOVE PUBLISH METABOX
		function remove_publish_box()
		{
			remove_meta_box( 'submitdiv', 'pw_livesearch', 'side' );
		}
		//add_action( 'admin_menu', 'remove_publish_box' );
				
	}
?>