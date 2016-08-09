<?php
/**
 TinyMCE own buttons
*/

	add_action('admin_head', 'gavickpro_add_my_tc_button');
	add_action('admin_enqueue_scripts', 'gavickpro_tc_css');
	
	add_action( 'admin_enqueue_scripts', 'mce_admin_scripts' );
	function mce_admin_scripts( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			add_action( "admin_head-$hook", 'mce_admin_head' );
		}
	}
	function mce_admin_head() {
		global $wpdb,$post;
		
		$original_query = $post;
		$args=array(
			'post_type'=>'pw_livesearch',
			'posts_per_page'=>-1,
			'order'=>'data',
			'orderby'=>'DESC',
			
		);
		$loops = new WP_Query( $args );		
		$output='';
		
		while ( $loops->have_posts() ) : 
			$loops->the_post();
			$output[]=array( 'text' => get_the_title(), 'value' => '[pw-ajax-live-search id="'.get_the_ID().'"]' );
		endwhile;	
		$post = $original_query;
        wp_reset_postdata();
		
		echo '<script type="text/javascript">var mce_options=' . json_encode( array( 'pages' => $output ) ) . '; </script>';
	}
	

	function gavickpro_add_my_tc_button() {
		global $typenow;
		// sprawdzamy czy user ma uprawnienia do edycji postów/podstron
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
		return;
		}
		// weryfikujemy typ wpisu
		if( ! in_array( $typenow, array( 'post', 'page' ) ) )
			return;
		// sprawdzamy czy user ma włączony edytor WYSIWYG
		if ( get_user_option('rich_editing') == 'true') {
			add_filter("mce_external_plugins", "gavickpro_add_tinymce_plugin");
			add_filter('mce_buttons', 'gavickpro_register_my_tc_button');
		}
	}
	
	function gavickpro_add_tinymce_plugin($plugin_array) {
		$plugin_array['als_shortcodes'] = plugins_url( '/submenu-button.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
		
		$plugin_array['als_showmore'] = plugins_url( '/custom-icon-button.js', __FILE__ ); // CHANGE THE BUTTON SCRIPT HERE
		
		return $plugin_array;
	}
	
	function gavickpro_register_my_tc_button($buttons) {
	   array_push($buttons, "als_shortcodes");
	   array_push($buttons, "als_showmore");
	   return $buttons;
	}
	
	function gavickpro_tc_css() {
		wp_enqueue_style('gavickpro-tc', plugins_url('/style.css', __FILE__));
		
	}
?>