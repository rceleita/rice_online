<?php
	
	$pw_livesearch_options_part=array(
		array(
			'id' => 'pw_livesearch_metaboxname_fields_options_general_setting',
			'title' => __('General Settings',__PW_LIVESEARCH_TEXTDOMAIN__),
			'icon' => '<i class="fa fa-clipboard"></i>',
			'variable' => 'pw_livesearch_metaboxname_fields_options_general_setting'
		),
		array(
			'id' => 'pw_livesearch_metaboxname_fields_options_search_options',
			'title' => __('Search Optipons',__PW_LIVESEARCH_TEXTDOMAIN__),
			'icon' => '<i class="fa fa-clipboard"></i>',
			'variable' => 'pw_livesearch_metaboxname_fields_options_search_options'
		),
		array(
			'id' => 'pw_livesearch_metaboxname_fields_options_localization',
			'title' => __('Localization',__PW_LIVESEARCH_TEXTDOMAIN__),
			'icon' => '<i class="fa fa-clipboard"></i>',
			'variable' => 'pw_livesearch_metaboxname_fields_options_localization'
		),
	);
	
	
	//GENERAL SETTING
	$pw_livesearch_metaboxname_fields_options_general_setting = array(
		array(  
			'label'	=> __("Default Search",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __("If you want to replace 'Mega Search' with your theme default search, Please contact us to integrate it with your theme. <a target='_blank' href='http://support.proword.net/'> Leave a Custom Work Ticket</a>",__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'set_default_search',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'set_default_search',
			'type'	=> 'notype',		
		),
		array(  
			'label'	=> __("Show More Page",__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __("Choose Showmore Page, You can choose default Showmore page (Mega Search Show More Page) or add a new page and insert [pw-ajax-live-search-page] to content.",__PW_LIVESEARCH_TEXTDOMAIN__),
			'name'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page',
			'id'	=> __PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page',
			'type'	=> 'pw_pages',		
		)
	);
	
	//SEARCH OPTION
	$pw_livesearch_metaboxname_fields_options_search_options= array(
		array(
			'label'	=> __('Minimum Character',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'	=> __('Set Minimum Character To Start Search (min=3)',__PW_LIVESEARCH_TEXTDOMAIN__),		
			'name'  => __PW_LIVESEARCH_FIELDS_PERFIX__.'min_character',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'min_character',
			'type'	=>'numeric',
		),
		array(  
			'label' => __('Search Target Field',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Choose Search Target Field',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'target_field', 
			'name'  => __PW_LIVESEARCH_FIELDS_PERFIX__.'target_field', 
			'type'  => 'multi_select' ,
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> 'Title',  
						'value'	=> 'title'  
					),
					'two'	=> array (
						'label'	=> 'Content',  
						'value'	=> 'content'  
					),
					'three'	=> array (
						'label'	=> 'Excerpt',  
						'value'	=> 'excerpt'  
					),
					'four'	=> array (
						'label'	=> 'Custom Fields',  
						'value'	=> 'custom_field'  
					)					
			)
		),
		array(  
			'label' => __('Custom Fields',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Select your custom fields for serach query',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields', 
			'type'  => 'multi_side',
		),
		array(  
			'label' => __('Manual Result',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Set your manual data. This will be displayed when there is no result for search',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'noresult_search', 
			'type'  => 'html_editor'
		),
		array(  
			'label' => __('Autocomplete Options',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => '',
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_options', 
			'type'  => 'notype'
		),
		array(  
			'label' => __('Enable Autocomplete',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Yes, Please',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on', 
			'type'  => 'checkbox'
		),
		array(  
			'label' => __('Autocomplete Source',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Choose Autocomplete Source',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source', 
			'name'  => __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source', 
			'type'  => 'select' ,
			'options'	=> array (  	
					'one'	=> array (
						'label'	=> 'Search Statistics',  
						'value'	=> 'serach_statistics'  
					),
					'two'	=> array (
						'label'	=> 'Post Title',  
						'value'	=> 'post_title'  
					)/*,
					'three'	=> array (
						'label'	=> 'Post Tag',  
						'value'	=> 'post_tag'  
					),
					'four'	=> array (
						'label'	=> 'Google Keywords',  
						'value'	=> 'google_keywords'  
					)		*/		
			),
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on'	=> array('checkbox',true) 	
			)
		),
		array(  
			'label' => __('Post Type(s)',__PW_LIVESEARCH_TEXTDOMAIN__),
			'desc'  => __('Choose post type(s) for autocomplete based on title',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source_post_type', 
			'type'  => 'posttype_seletc',
			'dependency' => array(
				'parent_id' 	=> array(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on',__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source'),
				__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on'	=> array('checkbox',true) 	,
				__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source' =>array('select','post_title') 	
			)
		),
	);
		
	//LOCALIZAITION
	$pw_livesearch_metaboxname_fields_options_localization= array(
		array(  
			'label' => '<strong>'.__('"Show More" button',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set your translate',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'general_show_more_title',
			'type'  => 'text'  
		),
		
		array(  
			'label' => '<strong>'.__('"Add to cart" Button',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set your translate',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'add_to_cart_title',
			'type'  => 'text'  
		),
		
		array(  
			'label' => '<strong>'.__('"Read More" Button',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set your translate',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'read_more_title',
			'type'  => 'text'  
		),
		
		array(  
			'label' => '<strong>'.__('"Select options" Button',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set your translate',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'select_options_title',
			'type'  => 'text'  
		),
		
		array(  
			'label' => '<strong>'.__('"View options" Button',__PW_LIVESEARCH_TEXTDOMAIN__).'</strong>',  
			'desc'  => __('Set your translate',__PW_LIVESEARCH_TEXTDOMAIN__),
			'id'    => __PW_LIVESEARCH_FIELDS_PERFIX__ . 'view_options_title',
			'type'  => 'text'  
		),
	);
	
	
	
	if (isset($_POST["update_settings"])) {
		// Do the saving
		foreach($pw_livesearch_options_part as $option_part){
			$this_part_variable=$$option_part['variable'];
			foreach ($this_part_variable as $field) { 
				if(!isset($_POST[$field['id']])){
					delete_option($field['id']);  
					continue;
				}
				
	
				$old = get_option($field['id']);  
				$new = $_POST[$field['id']];  
				if ($new && $new != $old) {  
					update_option($field['id'], $new);  
				} elseif ('' == $new && $old) {  
					delete_option($field['id']);  
				}
	
			} // end foreach  
		}
		?>
			<div id="setting-error-settings_updated" class="updated settings-error">
				<p><strong><?php echo __('Settings saved',__PW_LIVESEARCH_TEXTDOMAIN__);?>.</strong></p>
            </div>
		<?php
	}	
	
	$html= '<div class="wrap">
			<h2>'.__('Mega Search Settings',__PW_LIVESEARCH_TEXTDOMAIN__).'</h2>
			<br />
			<form method="POST" action="">
				<input type="hidden" name="update_settings" value="Y" />
				<div class="tabs tabsA tabs-style-topline"> 
					<nav>
						<ul>';
							foreach($pw_livesearch_options_part as $option_part){
								$html.='<li><a href="#'.$option_part['id'].'" class="">'.$option_part['icon'].' <span>'.$option_part['title'].'</span></a></li>';
							}
					$html.='
						</ul>
					</nav>
					<div class="content-wrap">';		
						
	
	foreach($pw_livesearch_options_part as $option_part){
		//TAB TITLE
		
		
		$html.= '<section id="'.$option_part['id'].'">';
			$html.= '<table class="form-table">'; 
			$this_part_variable=$$option_part['variable'];
			foreach ($this_part_variable as $field) {  
				if(isset($field['dependency']))  
				{
					$html.= pw_livesearch_dependency($field['id'],$field['dependency']);	
				}
				// get value of this field if it exists for this post  
				$meta = get_option($field['id']);  
				// begin a table row with  
				$style='';
				if($field['type']=='notype')
					$style='style="border-bottom:solid 1px #ccc"';
				$html.= '<tr class="'.$field['id'].'_field" '.$style.'> 
		
					<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
					<td>';  
					switch($field['type']) {  
		
						case 'notype':
							$html.= '<span class="description">'.$field['desc'].'</span>';
						break;
						
						case 'text':
							$html.= '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" class="'.$field['id'].'" value="'.$meta.'" />
							<br /><span class="description">'.$field['desc'].'</span>	';  
						break; 
						
						case 'radio':  
							foreach ( $field['options'] as $option ) {
								$html.= '<input type="radio" name="'.$field['id'].'" class="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
										<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
							}  
						break;
						
						case 'checkbox':  
								$html.= '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( $meta, "on" ,0).'"/> 
									<br /><span class="description">'.$field['desc'].'</span>';  
							break;
						
						case 'select':  
							$html.= '<select name="'.$field['id'].'" id="'.$field['id'].'" class="'.$field['id'].'" style="width: 170px;">';  
							foreach ($field['options'] as $option) {  
								$html.= '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
							}  
							$html.= '</select><br /><span class="description">'.__($field['desc'],__PW_LIVESEARCH_TEXTDOMAIN__).'</span>';  
						break;
						
						case 'numeric':  
							$html.= '
							<input type="number" name="'.$field['id'].'"  id="'.$field['id'].'" value="'.($meta=='' ? "":$meta).'" size="30" class="width_170 '.$field['id'].'" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" />
		';
							$html.= '
								<br /><span class="description">'.$field['desc'].'</span>';  
						break;
						
						case 'html_editor':
						{
							ob_start();

								$html.= '
								<p><span class="description">'.$field['desc'].'</span></p>
								<p class="form-field product_field_type" >';
								$editor_id =$field['id'];
								 wp_editor(stripslashes($meta), $editor_id );
								$html.= ob_get_clean();
								$html.='</p>';
						}
						break; 
						
						case "pw_pages":
						{
							$args = array(
								'depth'                 => 0,
								'child_of'              => 0,
								'selected'              => $meta,
								'echo'                  => 0,
								'name'                  => $field['id'],
								'id'                    => null, // string
								'show_option_none'      => __('Choose a Page',__PW_LIVESEARCH_TEXTDOMAIN__), // string
								'show_option_no_change' => null, // string
								'option_none_value'     => null, // string
							);
							$html.=wp_dropdown_pages($args);
							$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
						}
						break;
						
						case 'posttype_seletc':  
						{
							$output = 'objects';
							$args = array(
								'public' => true
							);
							$post_types = get_post_types( $args , $output);
															
							$html.='<select name="'.$field['id'].'[]" id="'.$field['id'].'" class="chosen-select-build-posttype" multiple="multiple"> ';
							$html.='<option value="" >'.__('Choose Post Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</option>';
							foreach ( $post_types  as $post_type ) {
								
								if ( $post_type->name != 'attachment' ) {
									$post_value=$post_type->name;
									$post_lbl=$post_type->labels->name;
									
									$selected='';
									if(is_array($meta) && in_array($post_value,$meta))
										$selected='SELECTED';
									
									$html.='<option value="'.$post_value.'" '.$selected.'>'.$post_lbl.' ('.$post_value.')</option>';
								}
							}
							
							$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
							$html.='</select>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									var visible = true;
									setInterval(
									function()
									{
										if(visible)
											if(jQuery(".chosen-select-build-posttype").is(":visible"))
											{
												jQuery(".chosen-select-build-posttype").chosen();
											}
									}, 100);
								});
							</script>';
						}
						break; 
						
						case 'all_search':
						{
							$html.='
							<select name="'.$field['name'].'" >
								<option value="">'.__('Choose Live Search',__PW_LIVESEARCH_TEXTDOMAIN__).'</option>';
								global $pw_woo_ad_main_class,$wpdb;
								
								$args=array('post_type' => 'pw_livesearch',
								'post_status'=>'publish',
								);
								
								$my_query_archive = new WP_Query($args);
								
								if( $my_query_archive->have_posts()):
									while ( $my_query_archive->have_posts() ) : $my_query_archive->the_post(); 	
										$id=get_the_ID();
										$html.= '<option value="'.$id.'" '.selected($id,$meta,0).'>'.get_the_title().'</option>';
									endwhile;
									wp_reset_query();
								endif;	
								$html.='</select>';
								$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
						}
						break;
						
						
						case "colorpicker":
							
							$html.= '<div class="medium-lbl-cnt">
											<label for="'.$field['id'].'" class="full-label">'.$field['label'].'</label>
											<input name="'.$field['id'].'" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta.'" data-default-color="#'.$meta.'">
										  </div>
									';	
							$html.= '
							
							<br />';
							$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
						break;
						
						case 'icon_type':  
							$html.= $meta;
							$html.= '<input type="hidden" id="'.$field['id'].'font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
							$html.= '<div class="'.$field['id'].' pw_iconpicker_grid" id="benefit_image_icon">';
							$html.= include(__PW_LIVESEARCH_ROOT_DIR__ .'/includes/font-awesome.php');
							$html.= '</div>';
							$html.= '<br /><span class="description">'.$field['desc'].'</span><br />'; 
							$output = '
							<script type="text/javascript"> 
								jQuery(document).ready(function(jQuery){';
									if ($meta == '') $meta ="fa-none";
									$output .= 'jQuery( ".'.$field['id'].' .'.$meta.'" ).siblings( ".active" ).removeClass( "active" );
									jQuery( ".'.$field['id'].' .'.$meta.'" ).addClass("active");';
							$output.='
									jQuery(".'.$field['id'].' i").click(function(){
										var val=(jQuery(this).attr("class").split(" ")[0]!="fa-none" ? jQuery(this).attr("class").split(" ")[0]:"");
										jQuery("#'.$field['id'].'font_icon").val(val);
										jQuery(this).siblings( ".active" ).removeClass( "active" );
										jQuery(this).addClass("active");
									});
								});
							</script>';
							$html.= $output;
						break; 	
						
						case 'upload':
							//wp_enqueue_media();
							$image = __PW_LIVESEARCH_ROOT_DIR__.'/assets/images/pw-transparent.gif';
							if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }
						
							$html.= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="hidden" class="custom_upload_image '.$field['id'].'" value="'.(isset($meta) ? $meta:'').'" /> 
							<img src="'.(isset($image) ? $image:'').'" class="custom_preview_image" alt="" />
							<input name="btn" class="pw_woo_search_upload_image_button button" type="button" value="'.__('Choose Image',__PW_LIVESEARCH_TEXTDOMAIN__).'" /> 
							<button type="button" class="pw_woo_ad_search_remove_image_button button">Remove image</button>';  
						break;
						
						case 'loading_type':
							$html.= '<input type="hidden" id="'.$field['id'].'_font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
							$html.= '<div class="'.$field['id'].' pw_iconpicker_grid pw_iconpicker_loading" id="benefit_image_icon">';
							include(__PW_LIVESEARCH_ROOT_DIR__ .'/includes/loading-icon.php');
							$html.= '</div>';
							$output = '
							<script type="text/javascript"> 
								jQuery(document).ready(function(jQuery){';
									if ($meta == '') $meta ="fa-none";
									$output .= 'jQuery( ".'.$meta.'" ).siblings( ".active" ).removeClass( "active" );
									jQuery( ".'.$meta.'" ).addClass("active");';
							$output.='
									jQuery(".'.$field['id'].' i").click(function(){
										var val=(jQuery(this).attr("class").split(" ")[0]!="fa-none" ? jQuery(this).attr("class").split(" ")[0]:"");
										jQuery("#'.$field['id'].'_font_icon").val(val);
										jQuery(this).siblings( ".active" ).removeClass( "active" );
										jQuery(this).addClass("active");
									});
								});
							</script>';
							$html.= $output;
						break;
						
						case "default_archive_grid":
						{
							global $pw_woo_ad_main_class,$wpdb;
			
							$query_meta_query=array('relation' => 'AND');
							$query_meta_query[] = array(
														'key' => __PW_LIVESEARCH_FIELDS_PERFIX__.'shortcode_type',
														'value' => "search_archive_page",
														'compare' => '=',
													);
							
							$args=array('post_type' => 'ad_woo_search_grid',
										'post_status'=>'publish',
										'meta_query' => $query_meta_query,
									 );
							
							$html.= '<select name="'.$field['id'].'" id="'.$field['id'].'" class="'.$field['id'].'" style="width: 170px;">
									<option>'.__('Choose Shorcode',__PW_LIVESEARCH_TEXTDOMAIN__).'</option>';  
							
							$my_query_archive = new WP_Query($args);
							if( $my_query_archive->have_posts()):
								while ( $my_query_archive->have_posts() ) : $my_query_archive->the_post(); 							
									$html.= '<option value="'.get_the_ID().'" '.selected($meta,get_the_ID(),0).'>'.get_the_title().'</option>';
								endwhile;	
							endif;	
							
							$html.= '</select>';
						}
						break;
						
						case "pw_sendto_form_fields":
						{
							$html.= '
							<label class="pw_showhide" for="displayProduct-price"><input name="'.$field['id'].'[name_from]" type="checkbox" '.(is_array($meta) && in_array("name_from",$meta) ? "CHECKED": "").' value="name_from" class="displayProduct-eneble">'.__('Name (From) Field',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
							
							<label class="pw_showhide" for="displayProduct-price"><input name="'.$field['id'].'[name_to]" type="checkbox" '.(is_array($meta) && in_array("name_to",$meta) ? "CHECKED": "").' value="name_to" class="displayProduct-eneble">'.__('Name (To) Field',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>                            
											
							<label class="pw_showhide" for="displayProduct-star"><input name="'.$field['id'].'[email]" type="checkbox" '.(is_array($meta) && in_array("email",$meta) ? "CHECKED": "").' value="email" class="displayProduct-eneble">'.__('Email (To) Field',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>                                    
														
							<label class="pw_showhide" for="displayProduct-metatag"><input name="'.$field['id'].'[description]" type="checkbox" '.(is_array($meta) && in_array("description",$meta) ? "CHECKED": "").' value="description">'.__('Description Field',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
							';
						}
						break;
						
						case 'multi_select': 
						{ 
							
							$html.= '<select name="'.$field['id'].'[]" id="'.$field['id'].'" style="width: 170px;" class="chosen-select-build" multiple="multiple">';  
							foreach ($field['options'] as $option) {  
								$selected='';
								if(is_array($meta) && in_array($option['value'],$meta))
									$selected='SELECTED';
								$html.= '<option '. $selected.' value="'.$option['value'].'">'.$option['label'].'</option>';  
							}  
							$html.= '</select><br /><span class="description">'.$field['desc'].'</span>';  
							
							$html.= '			
							<script type="text/javascript"> 
								jQuery(document).ready(function(){
									var visible = true;
									setInterval(
										function()
										{
											if(visible)
												if(jQuery(".chosen-select-build").is(":visible"))
												{
													visible = false;
													jQuery(".chosen-select-build").chosen();
												}
									}, 100);
									
								});
							</script>
							';
						}
						break;
						
						case 'multi_side':
						{
							global $wpdb;
							$options='';
							$selected_options='';
							
							if(is_array($meta)){
								foreach($meta as $opt){
									$selected_options.= '<option value="'.$opt.'" SELECTED>'.$opt.'</option>';
								}
							}
							
							$types = $wpdb->get_results("SELECT meta_key FROM ".$wpdb->postmeta." GROUP BY meta_key", ARRAY_A);
							if ($types!=null && is_array($types)) {
								foreach($types as $k=>$v) {
//								  if ($this->selected==null || !in_array($v['meta_key'], $this->selected)) {
									$options.= '<option value="'.$v['meta_key'].'">'.$v['meta_key'].'</option>';
	//							  }
								}
							  }
							$html.='
							<div class="row">
								
							</div>
							<div class="col-xs-4">
									<select name="from" id="undo_redo" class="form-control" size="11" multiple="multiple">
										'.$options.'
									</select>
								</div>
								
								<div class="col-xs-2">
									<button type="button" id="undo_redo_undo" class="btn btn-primary btn-block">undo</button>
									<button type="button" id="undo_redo_rightAll" class="btn btn-default btn-block"><i class="fa fa-forward"></i></button>
									<button type="button" id="undo_redo_rightSelected" class="btn btn-default btn-block"><i class="fa fa-chevron-right"></i></button>
									<button type="button" id="undo_redo_leftSelected" class="btn btn-default btn-block"><i class="fa fa-chevron-left"></i></button>
									<button type="button" id="undo_redo_leftAll" class="btn btn-default btn-block"><i class="fa fa-backward"></i></button>
									<button type="button" id="undo_redo_redo" class="btn btn-warning btn-block">redo</button>
								</div>
								
								<div class="col-xs-4">
									<select name="'.$field['id'].'[]"  id="undo_redo_to" class="form-control" size="11" multiple="multiple">'.$selected_options.'</select>
								</div>
							<script type="text/javascript"> 
								jQuery(document).ready(function($) {
									$("#undo_redo").multiselect();
								});	
							</script>	
							';
						}
						break;
						
						
					}
			}
			$html.= '</table>';
		$html.= '</section>';	
	}
	
	$html.= '</nav><!--END TAB-->';
	
	$html.= ' <p>
				<input type="submit" value="Save settings" class="button-primary"/>
			</p>
		</form>
	</div>
	
	<script type="text/javascript">
		function strpos(haystack, needle, offset) {
			var i = (haystack + "").indexOf(needle, (offset || 0));
			return i === -1 ? false : i;
		}
		
		jQuery(document).ready(function(){
			[].slice.call( document.querySelectorAll( ".tabsA" ) ).forEach( function( el ) {
				new CBPFWTabs( el );
			});
			
			////////////SHOW/HIDE CUSTOM FIELD SELECTION/////////////
			
			var val=jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__.'target_field'.'").val();
			if( strpos(val, "custom_field", 0) ){
				jQuery(".'.__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields'.'_field").show();
			}else{
				jQuery(".'.__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields'.'_field").hide();
			}
			
			jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__.'target_field'.'").change(function(){
				var val=jQuery(this).val();
				if( strpos(val, "custom_field", 0) ){
					jQuery(".'.__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields'.'_field").show();
				}else{
					jQuery(".'.__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields'.'_field").hide();
				}
			});
			////////////END SHOW/HIDE CUSTOM FIELD SELECTION/////////////
			
		});	
	</script>
	';
	
	echo $html;
?>