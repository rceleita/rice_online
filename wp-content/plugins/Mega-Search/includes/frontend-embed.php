<?php
	//CSS
	
	//////////////////Scroll Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'fontawesome-css', __PW_LIVESEARCH_CSS_URL__.'/font-awesome.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'fontawesome-css');
	
	//////////////////Scroll Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll-css', __PW_LIVESEARCH_CSS_URL__.'front-end/new-scroll/prettify.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll-css');
	
	//////////////////Autocomplete Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete-css', __PW_LIVESEARCH_CSS_URL__.'front-end/autocomplete/styles.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete-css');
	
	//////////////////Search Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'main-css', __PW_LIVESEARCH_CSS_URL__.'front-end/style.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'main-css');
	
	//////////////////OWL Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'owl-carousel', __PW_LIVESEARCH_CSS_URL__.'front-end/owl/owl-style.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'owl-carousel');
	
	//////////////////GRID Style//////////////////////////
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'grid-system', __PW_LIVESEARCH_CSS_URL__.'front-end/grid/style.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'grid-system');
	
	//JS
	
	/////JS ENQUEUE////////////
	wp_enqueue_script('jquery');


	/*wp_enqueue_script('add-to-cart-variation_ajax', __PW_LIVESEARCH_JS_URL__.'front-end/add-to-cart-variation.js', array('jquery'), false, true);
	wp_localize_script('add-to-cart-variation_ajax', 'AddToCartAjax', array('ajaxurl' => admin_url('admin-ajax.php')));*/
	

	//////////////////SCROLL JS//////////////////////////
	wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll_js', __PW_LIVESEARCH_JS_URL__.'front-end/new-scroll/prettify.js' , false, '1.0.0' );
	wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll_js' );
	
	wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll_js1', __PW_LIVESEARCH_JS_URL__.'front-end/new-scroll/jquery.slimscroll.js' , false, '1.0.0' );
	wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'new-scroll_js1' );
	
	
	
	$autocomplete_source=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source');
	$autocomplete_on=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on');
	if($autocomplete_on)
	{
		//////////////////AUTOCOMPLETE JS//////////////////////////
		wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_js1', __PW_LIVESEARCH_JS_URL__.'front-end/autocomplete/jquery.autocomplete.js' , false, '1.0.0' );
		wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_js1' );
	
		/*wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_js3', __PW_LIVESEARCH_JS_URL__.'front-end/autocomplete/demo.js' , false, '1.0.0' );
		wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_js3' );
		wp_localize_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_js3','params',
			array(
				'autocomplete_source' =>$autocomplete_source
			)
		);*/
	}
	
	
	//////////////////OWL JS//////////////////////////
	wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'owl-js', __PW_LIVESEARCH_JS_URL__.'front-end/owl/owl.jquery.js' , false, '1.0.0' );
	wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'owl-js' );
	
	
	//////////////////CUSTOM JS//////////////////////////
	wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'custom-js', __PW_LIVESEARCH_JS_URL__.'front-end/custom-search-js.js' , false, '1.0.0' );
	wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'custom-js' );
	
	/*wp_localize_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'custom-js','params',
		array(
			'url' =>__PW_LIVESEARCH_URL__
		)
	);*/
	
	
?>	