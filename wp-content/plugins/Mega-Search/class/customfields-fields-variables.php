<?php
	
	global
		$pw_livesearch_fields_variable,
	
		//secion 
		$pw_livesearch_metaboxname_fields_section_variable,
		$section_var_title,
		$pw_livesearch_metaboxname_fields_section,
		$pw_livesearch_metaboxname_fields_section_data_source,
		$pw_livesearch_metaboxname_fields_section_data_bg_setting,
		$pw_livesearch_metaboxname_fields_section_data_item_setting,
		$pw_livesearch_metaboxname_fields_section_data_title_setting,
		$pw_livesearch_metaboxname_fields_section_data_display_setting,
		$pw_livesearch_metaboxname_fields_section_data_other_setting,
		
		//display
		$pw_livesearch_metaboxname_fields_display,
		
		//search box
		$pw_livesearch_metaboxname_fields_searchbox,
		
		//result box
		$pw_livesearch_metaboxname_fields_resultbox;
		
	global 
		$pw_livesearch_fields_variable_export;
	
	$pw_livesearch_fields_variable=array("pw_livesearch_metaboxname_fields_display","pw_livesearch_metaboxname_fields_searchbox","pw_livesearch_metaboxname_fields_resultbox","pw_livesearch_metaboxname_fields_section","pw_livesearch_metaboxname_fields_section_variable");

	//SECTION TAB
	$pw_livesearch_metaboxname_fields_section_variable=array("pw_livesearch_metaboxname_fields_section_data_source","pw_livesearch_metaboxname_fields_section_data_title_setting","pw_livesearch_metaboxname_fields_section_data_bg_setting","pw_livesearch_metaboxname_fields_section_data_display_setting","pw_livesearch_metaboxname_fields_section_data_item_setting","pw_livesearch_metaboxname_fields_section_data_other_setting");
	
	$section_var_title=array(
	"pw_livesearch_metaboxname_fields_section_data_source"=>__("Data Source",__PW_LIVESEARCH_TEXTDOMAIN__),
	"pw_livesearch_metaboxname_fields_section_data_title_setting"=>__("Title Settings",__PW_LIVESEARCH_TEXTDOMAIN__),
	"pw_livesearch_metaboxname_fields_section_data_bg_setting"=>__("Background Settings",__PW_LIVESEARCH_TEXTDOMAIN__),
	"pw_livesearch_metaboxname_fields_section_data_display_setting"=>__("Display Settings",__PW_LIVESEARCH_TEXTDOMAIN__),
	"pw_livesearch_metaboxname_fields_section_data_item_setting"=>__("Item Settings",__PW_LIVESEARCH_TEXTDOMAIN__),
	"pw_livesearch_metaboxname_fields_section_data_other_setting"=>__("Other Settings",__PW_LIVESEARCH_TEXTDOMAIN__));
	
	$pw_livesearch_metaboxname_fields_section = array(
		
		array(  
			'label'	=> __("Number of Section(s)",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> __("Choose your Section",__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_number',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_number',
			'type'	=> 'image_select'
		),
		array(  
			'label'	=> __("Number of Section(s)",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> __("Choose your Section",__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_type',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_type',
			'type'	=> 'hidden'
		),
		array(  
			'label' => '<strong>'.__('Use as Default Value',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('yes,Please. This value will be displayed when search box focused. Otherwise the result will be displayed after enter minimum character',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'default_value',
			'type'  => 'checkbox'
		)						
	);
	
	$pw_livesearch_metaboxname_fields_section_data_source = array(
			
		array(  
			'label' => '<strong>'.__('Data Source Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Data Source Type',__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'  => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',
			'type'  => 'select',
			'options' => array (  
				
				'one' => array (
					'label' => __('Manual Data',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'manual_data'  
				),
				/*'two' => array (
					'label' => __('Fix Structure',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'fix_structur'  
				),*/
				'three' => array (
					'label' => __('Stored Data',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'stored_data'  
				)
			)
		),
		//MANUAL DATA
		array(  
			'label' => '<strong>'.__('Manual Data',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set Your Content',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'manual_data',
			'type'  => 'html_editor',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','manual_data') 	
			),
		),
		
		//FIX STRUCTURE
		array(  
			'label' => '<strong>'.__('Based on',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Data Source Based on',__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'  => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'fix_structure_basedon',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'fix_structure_basedon',
			'type'  => 'select',
			'options' => array (  
				
				'one' => array (
					'label' => __('Tag',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'based_tag'  
				),
				'two' => array (
					'label' => __('Taxonomy/Category',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'based_tax_cat'   
				),
				'three' => array (
					'label' => __('Individual Id(s)',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'based_individual'  
				)
			),
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','fix_structur') 	
			),
		),
		
		
		//STORAGE DATA
		array(  
			'label' => '<strong>'.__('Count of Post(s)',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set Count of Post(s) that you want fetched',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_number',
			'type'  => 'text',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data') 	
			),
		),
		array(  
			'label' => '<strong>'.__('Post Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Custom Post Type',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_name',
			'type'  => 'hidden',
		),
		array(  
			'label' => '<strong>'.__('Custom Post Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Custom Post Type',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type',
			'type'  => 'posttype_seletc',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data') 	
			),
		),
		array(  
			'label' => '<strong>'.__('Build Query Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Build Query Type',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'fetch_type',
			'type'  => 'select',  
			'options' => array (  
				
				'one' => array (
	
					'label' => __('Fetch All Data',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'all'  
				),
				'two' => array (
	
					'label' => __('Custom Query',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'build_query'  
				)
			),
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data') 	
			),
		),  
		array(  
			'label' => '<strong>'.__('Build Query',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Select/Unselect Taxonomy, Category or other tag for build Query',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'build_query_taxonomy',
			'type'  => 'pw_custom_taxonomy',  
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'fetch_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'fetch_type'	  => array('select','build_query') 	
			),
		),
	);
	
	$pw_livesearch_metaboxname_fields_section_data_title_setting = array(
			
		array(  
			'label' => __("Show Title",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_show',			
			'type'  => 'checkbox'
		),
		array(
			'label'	=>__('Section Title',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_text',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_text',
			'type'	=>'text',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'	  => array('checkbox','true')	
			), 

		),
		
		array(  
			'label' => __('Title Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_background_text_color', 
			'type'  => 'color_picker' ,
			'value' => '',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'	  => array('checkbox','true')	
			), 
		),
		array(  
			'label' =>__("Title Font",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_font',
			'type'  => 'pw_custom_general_font_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'	  => array('checkbox','true')	
			), 
		),
		
		array(  
			'label' => __('Title Icon',__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_icon',
			'type'  => 'icon_type',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'	  => array('checkbox','true')	
			), 
		),
		array(  
			'label' => __('Title Icon Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'title_icon_color', 
			'type'  => 'color_picker' ,
			'value' => '',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'title_show'	  => array('checkbox','true')	
			), 
		)		
	);
	
	$pw_livesearch_metaboxname_fields_section_data_bg_setting = array(
		array(  
			'label' => __('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_color', 
			'type'  => 'color_picker' ,
			'value'  => ''
		),
		array(  
			'label' => '<strong>'.__("Padding",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Padding",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'section_padding_set',
			'type'  => 'pw_custom_padding_set'
		),
		
		array(  
			'label' => '<strong>'.__("Border",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Border",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'section_border_set',
			'type'  => 'pw_custom_border_set'
		),
		
		array(  
			'label' => __('Background Image',__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_image',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_image',
			'type'  => 'upload'
		),
		array(
			'label'	=>__('Background Size',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_size',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_size',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Inherit',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'inherit'  
					),
					'two'	=> array (
						'label'	=> __('Contain',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'contain'  
					),
					'three'	=> array (
						'label'	=> __('Cover',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'cover'  
					),
				),	
		),
		
		array(  
			'label'	=> __("Background Position",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_position',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_position',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Left top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left top'  
					),
					'two'	=> array (
						'label'	=> __('left center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left center'  
					),
					'three'	=> array (
						'label'	=> __('Left Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left bottom'  
					),
					'four'	=> array (
						'label'	=> __('Right Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right top'  
					),
					'five'	=> array (
						'label'	=> __('Right Center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right center'  
					),
					'sex'	=> array (
						'label'	=> __('Right Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right bottom'  
					),
					'seven'	=> array (
						'label'	=> __('Center Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center top'  
					),
					'eight'	=> array (
						'label'	=> __('Center Center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center center'  
					),
					'nine'	=> array (
						'label'	=> __('Center Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center bottom'  
					)							
			)		
		),
		array(  
			'label'	=> __("Background Repeat",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_repeat',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_repeat',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> 'No Repeat',  
						'value'	=> 'no-repeat'  
					),
					'two'	=> array (
						'label'	=> 'Repeat',  
						'value'	=> 'repeat'  
					)			
			)		
		)				
	);
	
	$pw_livesearch_metaboxname_fields_section_data_display_setting = array(
		array(  
			'label'	=> __("Display Type",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> '',
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_type',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_type',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('List',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'list'  
					),
					'two'	=> array (
						'label'	=> __('Grid',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'grid'  
						
					)	
			)				
		),
		
		array(  
			'label'	=> __("Grid Skin",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> '',
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Skin One (Outer Description)',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grided-item ls-grided-style1'  
					),
					'two'	=> array (
						'label'	=> __('Skin Two (Boxed Layout)',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grided-item ls-grided-style2'  
						
					)	
			),
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','grid'),
			), 					
		),
		
		array(  
			'label' => __("Show in Carousel ?",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Yes, Please display items as carousel mode",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel',			
			'type'  => 'checkbox',
		),
		
		array(
			'label'	=>__('Item Number',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>__('Number of item(s) for display. Leave blank to use from post number',__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_item_number',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_item_number',
			'type'	=>'numeric',
		),
		//GRID VIEW
		array(
			'label'	=>__('Desktop Column(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_desktop_col',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_desktop_col',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('1 Column',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-d-12'  
					),
					'two'	=> array (
						'label'	=> __('2 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-d-6'  
						
					),
					'three'	=> array (
						'label'	=> __('3 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-d-4'  
						
					),
					'four'	=> array (
						'label'	=> __('4 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-d-3'  
						
					)	
			),	
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','grid'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','false'),
			), 	
		),
		array(
			'label'	=>__('Tablet Column(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_tablet_col',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_tablet_col',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('1 Column',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-t-12'  
					),
					'two'	=> array (
						'label'	=> __('2 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-t-6'  
						
					),
					'three'	=> array (
						'label'	=> __('3 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-t-4'  
						
					),
					'four'	=> array (
						'label'	=> __('4 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-t-3'  
						
					)	
			),	
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','grid'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','false'),
			),
		),
		array(
			'label'	=>__('Mobile Column(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_mobile_col',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_mobile_col',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('1 Column',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-m-12'  
					),
					'two'	=> array (
						'label'	=> __('2 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-m-6'  
						
					),
					'three'	=> array (
						'label'	=> __('3 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-m-4'  
						
					),
					'four'	=> array (
						'label'	=> __('4 Columns',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ls-grid-m-3'  
						
					)	
			),	
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','grid'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','false'),
			),
		),
		
		//LIST VIEW
		/*array(  
			'label' => __("Show Scroll",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_list_show_scroll',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','list')	
			), 	
		),
		*/
		//CAROUSEL	
		array(
			'label'	=>__('Desktop Item(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_desktop_items',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_desktop_items',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
		array(
			'label'	=>__('Tablet Items(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_tablet_items',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_tablet_items',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
		array(
			'label'	=>__('Mobile Items(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_mobile_items',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_mobile_items',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
		array(
			'label'	=>__('Item Margin',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_item_margin',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_item_margin',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
		array(  
			'label'	=> __("Slide Speed",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __("Set Time as Milliseconds, Example 3000=3 seconds",__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_slide_speed',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_slide_speed',
			'type'	=> 'numeric',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 		
		),
		array(  
			'label' => __("Auto play",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_auto_play',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 
		),
		array(  
			'label' => __("Slider Loop",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_slider_loop',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			),  	
		),
		array(  
			'label' => __("Pause on mouse hover",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_pause_on_mouse_hover',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
		
		array(  
			'label' => __("Show Controls",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_show_control',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 
		),
		array(  
			'label' => __("Show Pagination",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_show_pagination',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel' => array('checkbox','true'),	
			), 	
		),
	);
	
	$pw_livesearch_metaboxname_fields_section_data_item_setting = array(
		
		//SHOW/HIDE ITEM FIELDS
		array(  
			'label' => __('Items Fields Option',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_fields_option', 
			'type'  => 'notype' ,
		),
		array(  
			'label' => __("Show Title",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_title',			
			'type'  => 'checkbox',
		),
		array(  
			'label' => __("Show Thumbnail",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_thumbnail',			
			'type'  => 'checkbox',
		),
		array(  
			'label' => __("Show Meta Tags",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Show Category/Taxonomy/Tag for items",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_categories',			
			'type'  => 'checkbox',
		),
		array(  
			'label' => __("Count of Tags",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Count of each Category/Taxonomy/Tag for items",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'categories_count',			
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_categories'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_categories'	  => array('checkbox','true') 	
			),
		),
		array(  
			'label' => __("Show Author",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_author',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','post') 	
			),
		),
		array(  
			'label' => __("Show Comment No.",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_comment_no',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','post') 	
			),
		),
		array(  
			'label' => __("Show Date",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_date',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','post') 	
			),
		),
		array(  
			'label' => __("Show Sale Banner",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_sale_banner',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','product') 	
			),
		),
		array(  
			'label' => __("Show Featured Banner",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_featured_banner',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','product') 	
			),
		),
		array(  
			'label' => __("Show Excerpt/Content",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_excerpt',			
			'type'  => 'checkbox',
		),
		array(  
			'label' => '<strong>'.__('Description Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Choose Description Type',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'desc_type',
			'type'  => 'select',  
			'options' => array (  
				
				'one' => array (
	
					'label' => __('Full Text',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'full_text'  
				),
				'two' => array (
	
					'label' => __('Excerpt',__PW_LIVESEARCH_TEXTDOMAIN__),  
					'value' => 'excerpt'  
				)
			),
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'	  => array('checkbox','true') 	
			),
		),  
		array(  
			'label' => __("Description Length",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'excerpt_len',			
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'	  => array('checkbox','true') 	
			),
		),
		array(  
			'label' => __("Show 'Add to cart' Button",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_addtocart',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','product') 	
			),
		),
		array(
			'label' => __("Show Price",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_price',			
			'type'  => 'checkbox',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type',__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type'	  => array('select','stored_data'), 
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'	  => array('select','product') 	
			),
		),
		
		//COLOR / FONT
		array(  
			'label' => __('Item Layout',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_fields_typography', 
			'type'  => 'notype' ,
		),
		array(  
			'label' => __("Item Border",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Item Border. <strong>Note : </strong>This feature will be apply on List and Grid (Skin two - Outer Description).",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'item_border_set',
			'type'  => 'pw_custom_border_set',
			/*'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','list')	
			),*/
		),
		
		array(  
			'label' => __("Item Border on Hover",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Item Border on Hover. <strong>Note : </strong>This feature will be apply on List and Grid (Skin two - Outer Description).",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'item_border_hover_set',
			'type'  => 'pw_custom_border_set',
			/*'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','list')	
			),*/
		),

		array(  
			'label' => __("Item Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Border Radius. <strong>Note : </strong>This feature will be apply on List and Grid (Skin two - Outer Description).",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'item_border_radius_set',
			'type'  => 'pw_custom_border_radius_set',
			/*'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type'	=> array('select','list')	
			), */
		),
		array(  
			'label' =>__("Item Thumbnail Shape",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Choose thumbnail shape. <strong>Note : </strong>This feature will be apply on List and Grid (Skin two - Outer Description).",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_shape',
			'type'  => 'select',
			'options' =>array(
				'one'=>array(
					'label' => __('Square',__PW_LIVESEARCH_TEXTDOMAIN__),
					'value' => 'square'
				),
				'two'=>array(
					'label' => __('Circle',__PW_LIVESEARCH_TEXTDOMAIN__),
					'value' => 'circle'
				),
				'three'=>array(
					'label' => __('Inherit Border Radius',__PW_LIVESEARCH_TEXTDOMAIN__),
					'value' => 'inherit_radius'
				),
			),
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_thumbnail'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'show_thumbnail'	=> array('checkbox','true')	
			),
		),
		array(  
			'label' =>__("Title Typography",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_text',
			'type'  => 'pw_custom_general_font_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_title'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_title'	  => array('checkbox','true') 	
			),
		),
		array(  
			'label' =>__("Item Hover Color",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_text_color',
			'type'  => 'color_picker',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_title'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_title'	  => array('checkbox','true') 	
			),
		),
		
		array(  
			'label' =>__("Meta Typography",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_meta',
			'type'  => 'pw_custom_general_font_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_meta'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_meta'	  => array('checkbox','true') 	
			),
		),
		array(  
			'label' =>__("Meta Hover Color",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_meta_color',
			'type'  => 'color_picker',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_meta'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_meta'	  => array('checkbox','true') 	
			),
		),
		
		array(  
			'label' =>__("Excerpt Typography",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_excerpt',
			'type'  => 'pw_custom_general_font_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'	  => array('checkbox','true') 	
			),
		),
		array(  
			'label' =>__("Excerpt Hover Color",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_excerpt_color',
			'type'  => 'color_picker',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'show_excerpt'	  => array('checkbox','true') 	
			),
		),
	
		array(  
			'label' => __('Item Background/Overlay Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('<strong>Note :</strong> Overlay Color will be used in grid',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_background_color', 
			'type'  => 'color_picker' ,
			'value' => ''
		),
		array(  
			'label' => __('Item Hover Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_background_color', 
			'type'  => 'color_picker' ,
			'value' => ''
		),
		
	);
	
	$pw_livesearch_metaboxname_fields_section_data_other_setting = array(
		array(
			'label' => __('Show "Show More" Button',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button',
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button',
			'type'=>'checkbox'
		),	
		array(
			'label' => __('"Show More" Translate',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_trasnlate',
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_trasnlate',
			'type'=>'text',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'	=> array('checkbox','true')	
			), 
		),	
		array(
			'label' => __('Color setting',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_color',
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_color',
			'type'=>'pw_custom_4_color',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'	=> array('checkbox','true')	
			), 
		),	
		array(  
			'label' => __('Icon',__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_icon',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'	=> array('checkbox','true')	
			), 	
			'type'  => 'icon_type'
		),
		
		array(  
			'label' => __("Border",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Item Border",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'showmore_border_set',
			'type'  => 'pw_custom_border_set'
		),

		array(  
			'label' => __("Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'showmore_border_radius_set',
			'type'  => 'numeric', 
		),
		
		array(  
			'label'	=> __("Show More Page",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __("Choose Showmore Page, You can choose default Showmore page (Mega Search Show More Page) or add a new page and insert [pw-ajax-live-search-page] to content. <br /><strong>Note :</strong>Leave blank if you want to use from general setting",__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page',
			'type'	=> 'pw_pages',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button'	=> array('checkbox','true')	
			),		
		),
		array(  
			'label' => __("Post Per Page",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Post Per Page in Show More Page",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'showmore_post_per_page',
			'type'  => 'numeric', 
		),
	);
	
	//DISPLAY SETTING TAB
	$pw_livesearch_metaboxname_fields_display = array(
		array(  
			'label'	=> __("Display Mode",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('General Mode',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'general-type'  
					),
					'two'	=> array (
						'label'	=> __('Full screen',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'fullscreen-type'  
					),
					'three'	=> array (
						'label'	=> __('Popup',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'popup-type'  
					),
					'four'	=> array (
						'label'	=> __('Sticky',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'sticky-type'  
					)					
			),
		),
		array(  
			'label'	=> __("Position",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position',
			'type'	=> 'select',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','sticky-type') 	
			),		
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Left',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left'  
					),
					'two'	=> array (
						'label'	=> __('Right',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right'  
					),
					'three'	=> array (
						'label'	=> __('Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'top'  
					)			
			)		
		),
		
		array(
			'label'	=>__('Margin Top',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_margin_top',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_margin_top',
			'type'	=>'numeric',
			'value' => '100',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','sticky-type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'	=> array('select','left','right'), 	
			),	
		),
		array(  
			'label' => '<strong>'.__("Padding",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Padding",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'sticky_top_padding',
			'type'  => 'pw_custom_padding_set',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','sticky-type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'	=> array('select','top'), 	
			),	
		),
		array(
			'label' => __('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_bg_color',
			'desc'  => __('Set Background Color for fullscreen/Popup',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_bg_color',
			'type'=>'color_picker',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','sticky-type','fullscreen-type') 	
			)
		),	
		array(
			'label' => __('Overlay Color',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_overlay_color',
			'desc'  => __('Set Overlay Color for popup',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_overlay_color',
			'type'=>'color_picker',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type') 	
			)
		),	
		array(  
			'label' => __("Popup Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Border Radius for Popup",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'popup_border_radius_set',
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type') 	
			)
		),
		array(  
			'label'	=> __("Popup Animation",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'popup_animation',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'popup_animation',
			'type'	=> 'select',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type') 	
			),		
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('None',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'none'  
					),
					'two'	=> array (
						'label'	=> __('Pop',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'pop'  
					),
					'three'	=> array (
						'label'	=> __('Slide From Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'slide-from-top'  
					),
					'four'	=> array (
						'label'	=> __('Slide From Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'slide-from-bottom'  
					),			
			)		
		),
		array(
			'label'	=>__('Button Settings',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'button_setting',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'button_setting',
			'type'	=>'notype',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','fullscreen-type') 	
			)
		),
		/*array(  
			'label'	=> __("Button Style",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_button_style',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_button_style',
			'type'	=> 'select',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','fullscreen-type') 	
			),	
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Style 1',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style1'  
					),
					'two'	=> array (
						'label'	=> __('Style 2',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style2'  
					),
					'three'	=> array (
						'label'	=> __('Style 3',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style3'  
					)			
			)		
		),*/
		array(
			'label'	=>__('Button/Tooltip title',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_title',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_title',
			'type'	=>'text',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','sticky-type','fullscreen-type') 		
			)
		),
		array(
			'label' => __('Button Color setting',__PW_LIVESEARCH_TEXTDOMAIN__), 
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon_color',
			'desc'  => '',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon_color',
			'type'=>'pw_custom_4_color',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','sticky-type','fullscreen-type') 	
			)
		),	
		array(
			'label'	=> __('Icon ',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __("Set Icon for Search Button",__PW_LIVESEARCH_TEXTDOMAIN__),	
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon',
			'type'	=>'icon_type',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','sticky-type','fullscreen-type') 	
			)
		),
		array(  
			'label' =>__("Font Options",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Font for Search Button",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_font',
			'type'  => 'pw_custom_general_font_set_2',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','fullscreen-type') 	
			)
		),
		array(  
			'label' => __("Border",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Border for Search Button",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'search_btn_border_set',
			'type'  => 'pw_custom_border_set',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','fullscreen-type') 	
			)
		),
		array(  
			'label' => __("Button Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => __("Set Border Radius for Button",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'btn_border_radius_set',
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','popup-type','fullscreen-type') 	
			)
		),
		array(  
			'label'	=> __("Button Alignment",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_top_align',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_top_align',
			'type'	=> 'select',  
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','sticky-type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'	=> array('select','top'), 	
			),		
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Left',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left'  
					),
					'two'	=> array (
						'label'	=> __('Right',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right'  
					)		
			)		
		),
		array(  
			'label' => __('Height',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Set Height for Search Button',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_height', 
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','sticky-type','popup-type','fullscreen-type') 	
			)
		),
		
	);
	
	//SEARCH TEXT BOX TAB
	$pw_livesearch_metaboxname_fields_searchbox = array(
		
		/*array(  
			'label'	=> __("Search Box Layout",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_layout',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_layout',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Style 1',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style1'  
					),
					'two'	=> array (
						'label'	=> __('style 2',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style2'  
					),
					'three'	=> array (
						'label'	=> __('style 3',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style3'  
					),
					'four'	=> array (
						'label'	=> __('style 4',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style4'  
					)						
			),
		),*/
		array(  
			'label'	=> __("Direction",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box__direction',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box__direction',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Left To Right',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'ltr'  
					),
					'two'	=> array (
						'label'	=> __('Right To Left',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'rtl'  
					)			
			)		
		),
		array(  
			'label' =>__("Font Options",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_font',
			'type'  => 'pw_custom_general_font_set'
		),
		array(  
			'label' => __('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_background_color', 
			'type'  => 'color_picker' ,
			'value' => '',
		),
		array(  
			'label' => __('Placeholder',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_placeholder', 
			'type'  => 'text',
		),
		array(  
			'label' => __('Width',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_width', 
			'type'  => 'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','general-type','sticky-type'),
			),
		),
		array(  
			'label' => __('Height',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_height', 
			'type'  => 'numeric',
		),
		array(  
			'label' => '<strong>'.__("Border",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Border",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'text_box_border_set',
			'type'  => 'pw_custom_border_set'
		),
		array(  
			'label' => __('Border Radius',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_border_radius', 
			'type'  => 'numeric',
		),
		array(
			'label'=>__('Show Icon',__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon',
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon',
			'type'=>'checkbox',
		),	
		array(  
			'label' => __('Icon',__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon',
			'type'  => 'icon_type',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'	=> array('checkbox','true')	
			), 	
		),
		array(  
			'label' => __('Icon Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon_color', 
			'type'  => 'color_picker' , 	
			'value' => '#333333',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'	=> array('checkbox','true')	
			), 
		),
		array(  
			'label' => __('Icon Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon_background_color', 
			'type'  => 'color_picker' ,		
			'value' => '#ffffff',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon'	=> array('checkbox','true')	
			), 	
		)
	);
	
	//SEARCH RESULT BOX TAB
	$pw_livesearch_metaboxname_fields_resultbox = array(
		
		/*array(  
			'label'	=> __("Search Result Layout",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_result_layout',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'search_result_layout',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Style 1',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style1'  
					),
					'two'	=> array (
						'label'	=> __('style 2',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style2'  
					),
					'three'	=> array (
						'label'	=> __('style 3',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'style3'  
					),
					'four'	=> array (
						'label'	=> __('Custom Layout',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'custom-layout'  
					)						
			),
		),*/
		array(
			'label'	=>__('Width',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>__('Leave Blank to use default value',__PW_LIVESEARCH_TEXTDOMAIN__),		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_width',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_width',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','general-type','sticky-type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'	=> array('select','left','right'),	
			),
		),
		array(
			'label'	=>__('Height',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>__('Leave Blank to use default value',__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_height',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_height',
			'type'	=>'numeric',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type',__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type'	=> array('select','general-type','sticky-type'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position'	=> array('select','left','right'),	
			),
		),
		array(  
			'label' => '<strong>'.__("Padding",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Padding",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'padding_set',
			'type'  => 'pw_custom_padding_set'
		),
		
		array(  
			'label' => '<strong>'.__("Border",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Border",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'border_set',
			'type'  => 'pw_custom_border_set'
		),
		
		array(  
			'label' => '<strong>'.__("Active Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Yes, Please",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'active_border_radius',
			'type'  => 'checkbox'
		),
		
		array(  
			'label' => '<strong>'.__("Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Set Border Radius",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'border_radius_set',
			'type'  => 'pw_custom_border_radius_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'active_border_radius'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'active_border_radius'	  => array('checkbox','true')	
			), 
		),
		array(  
			'label' => '<strong>'.__("Enable Box Shadow",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Yes, Please",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'box_enable_shadow',
			'type'  => 'checkbox',
		),
		array(  
			'label' => '<strong>'.__("Box Shadow",__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __("Box Shadow type",__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'box_shadow_set',
			'type'  => 'pw_custom_box_shadow_set',
			'dependency' => array(
				'parent_id' => array(__PW_LIVESEARCH_FIELDS_PERFIX__ . 'box_enable_shadow'),
				__PW_LIVESEARCH_FIELDS_PERFIX__ . 'box_enable_shadow'	  => array('checkbox','true'),	
			), 
		),
		
		array(  
			'label' => __('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_color', 
			'type'  => 'color_picker' ,
			'value'  => '',
			
		),
		array(  
			'label' => __('Background Image',__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'  => '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_image',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_image',
			'type'  => 'upload',
			
		),
		array(
			'label'	=>__('Background Size',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_size',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_size',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Inherit',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'inherit'  
					),
					'two'	=> array (
						'label'	=> __('Contain',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'contain'  
					),
					'three'	=> array (
						'label'	=> __('Cover',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'cover'  
					),
				),	
			
		),
		
		array(  
			'label'	=> __("Background Position",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_position',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_position',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> __('Left top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left top'  
					),
					'two'	=> array (
						'label'	=> __('left center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left center'  
					),
					'three'	=> array (
						'label'	=> __('Left Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'left bottom'  
					),
					'four'	=> array (
						'label'	=> __('Right Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right top'  
					),
					'five'	=> array (
						'label'	=> __('Right Center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right center'  
					),
					'sex'	=> array (
						'label'	=> __('Right Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'right bottom'  
					),
					'seven'	=> array (
						'label'	=> __('Center Top',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center top'  
					),
					'eight'	=> array (
						'label'	=> __('Center Center',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center center'  
					),
					'nine'	=> array (
						'label'	=> __('Center Bottom',__PW_LIVESEARCH_TEXTDOMAIN__),  
						'value'	=> 'center bottom'  
					)				
			)		,
			
		),
		array(  
			'label'	=> __("Background Repeat",__PW_LIVESEARCH_TEXTDOMAIN__),  
			'desc'	=> '',
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_repeat',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_repeat',
			'type'	=> 'select',  
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> 'No Repeat',  
						'value'	=> 'no-repeat'  
					),
					'two'	=> array (
						'label'	=> 'Repeat',  
						'value'	=> 'repeat'  
					)			
			)	,
			
		)
	);
	
	//LIVESEARCH EXPORT METABOX
	$pw_livesearch_fields_variable_export=array(
		
		array(
			'label'	=>__('Custom Class',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'custom_class',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'custom_class',
			'type'	=>'text',
		),
		array(
			'label'	=>__('Custom Css',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'custom_css',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'custom_css',
			'type'	=>'textarea',
		),
		array(
			'label'	=>__('LiveSearch Export',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'export_setting',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'export_setting',
			'type'	=>'notype',
		),
		array(
			'label'	=>__('Shortcode',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=>'',		
			'name'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'shortcode',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'shortcode',
			'type'	=>'disable_text',
		),
	);
	
?>