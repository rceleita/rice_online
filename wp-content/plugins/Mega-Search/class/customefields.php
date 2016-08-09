<?php

	///////////////////METABOXES//////////////////////////////////
		
	if(!function_exists('pw_livesearch_add_metabox')){
		function pw_livesearch_add_metabox() {
			add_meta_box(  
				'pw_livesearch_metaboxname', // $id  
				__('Mega Search Custom Fields',__PW_LIVESEARCH_TEXTDOMAIN__), // $title   
				'pw_livesearch_metaboxname', // $callback  
				'pw_livesearch', // $page  
				'normal', // $context  
				'high');
				
				add_meta_box(  
				'pw_livesearch_metaboxname_export', // $id  
				__('Mega Search Extra Options',__PW_LIVESEARCH_TEXTDOMAIN__), // $title   
				'pw_livesearch_metaboxname_export', // $callback  
				'pw_livesearch', // $page  
				'normal', // $context  
				'high');	
				
		}  
		add_action('add_meta_boxes', 'pw_livesearch_add_metabox'); 
	}
	///////////////////END METABOXES//////////////////////////////////
	
	
	///////////////////LIST OF FILDS VARIABLES//////////////////////////////////
		
	include  'customfields-fields-variables.php';
	
	///////////////////END LIST OF FIELDS VARIABLES/////////////////////////////

	
	/////////////////SHOW CUSTOM FIELD////////////////////////
	
	include  'customfields-fields-functions.php';	
	
	/////////////////END SHOW CUSTOM FIELD////////////////////
	
	
?>