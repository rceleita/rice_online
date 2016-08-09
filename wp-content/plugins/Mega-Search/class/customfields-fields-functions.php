<?php
	
	function pw_livesearch_get_google_fonts($selected=''){
		require __PW_LIVESEARCH_ROOT_DIR__.'/includes/google-fonts.php';
		$font_options='';
		foreach($fonts_array as $key=>$value){
			$font_options.='<option '.selected($selected,$key,0).' value="'.$key.'">'.$value.'</option>';
		}
		return $font_options;
	}
	
	function pw_livesearch_metaboxname() {
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
		$pw_livesearch_metaboxname_fields_resultbox,
		
		$post;

		

		// Use nonce for verification  
		$html= '<input type="hidden" name="show_custom_meta_box_livesearch_grid_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
			  
			
			// Begin the field table and loop  
			$html.='<div class="tabs tabsA tabs-style-topline"> 
					<nav>
						<ul>
							<li><a href="#section-bar-1" class=""><i class="fa fa-cogs"></i> <span>'.__('Search Type Settings',__PW_LIVESEARCH_TEXTDOMAIN__).'</span></a></li>
							<li><a href="#section-bar-1" class=""><i class="fa fa-text-width"></i> <span>'.__('Search Box Settings',__PW_LIVESEARCH_TEXTDOMAIN__).'</span></a></li>
							<li><a href="#section-bar-2" class=""><i class="fa fa-list-alt"></i> <span>'.__('Result Box Settings',__PW_LIVESEARCH_TEXTDOMAIN__).'</span></a></li>
							<li><a href="#section-bar-1" class=""><i class="fa fa-columns"></i> <span>'.__('Result Box Sections Settings',__PW_LIVESEARCH_TEXTDOMAIN__).'</span></a></li>
						</ul>
					</nav><div class="content-wrap">';
		$i=1;
		foreach($pw_livesearch_fields_variable as $var){
			if($var!='pw_livesearch_metaboxname_fields_section_variable')
				$html.= '<section id="section-bar-'.$i++.'"><table class="form-table form-my-table">';  	
			if($var=='pw_livesearch_metaboxname_fields_section_variable')
			{
				$html.= '
				<table class="form-table" border="1">
					<tr>
						<td width="20%" style="vertical-align: top;"><div class="layout_main_box"></div></td>
						<td style="vertical-align: top;">
							
				';  
				
				for($k=1;$k<5;$k++)
				{
					
					$html.='<div class="accordion" id="la_ds_tab_content_'.$k.'">';
				
				$j=1;
				foreach($pw_livesearch_metaboxname_fields_section_variable as $section_var){
			
					$html.= '
					
					<div class="accordion-section-'.$k.'-'.$j.'_field">
			        <a class="accordion-section-title" href="#accordion-'.$j.'-'.$k.'">'.$section_var_title[$section_var].'</a>
         
			        <div id="accordion-'.$j.'-'.$k.'" class="accordion-section-content">
					
					<table class="form-table">';
					$j++;
					foreach($$section_var as $field){
						
						$field['id']=$field['id'].'-'.$k;
						
						if(isset($field['dependency']))  
						{
							$html.=pw_livesearch_dependency($field['id'],$field['dependency'],$k);	
						}
						
						// get value of this field if it exists for this post  
						$meta = get_post_meta($post->ID, $field['id'], true);  
		
						// begin a table row with 
						if($field['type']=='hidden')
						{
							$html.= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="product" />';
							continue;
						}
						
						// begin a table row with  
						$style='';
						
						if($field['type']=='notype')
							$style='style="border-bottom:solid 1px #ccc"';
						
						
							
						$html.= '<tr class="'.$field['id'].'_field" '.$style.'>  
		
								<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
								<td>';
								switch($field['type']) {  
		
									
									
									case 'text':  
			
										$html.= '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
										<br /><span class="description">'.$field['desc'].'</span>	';  
									break; 
									
									case 'textarea':  
										$html.= '<textarea name="'.$field['id'].'" id="'.$field['id'].'">'.$meta.'</textarea>
										<br /><span class="description">'.$field['desc'].'</span>	';  
									break; 
									
									case 'hidden':  
			
										$html.= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />';  
									break; 
									
									case 'radio':  
										foreach ( $field['options'] as $option ) {
											$html.= '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
													<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
										}  
									break;
									
									case 'select':  
										$html.= '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
										foreach ($field['options'] as $option) {  
											$html.= '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
										}  
										$html.= '</select><br /><span class="description">'.$field['desc'].'</span>';
										
									break;
									
									case 'numeric':  
										$default_value=(isset($field['value'])? $field['value']:"");
										$html.= '
										<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.($meta=='' ? $default_value:$meta).'" size="30" class="width_170" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" />
			';
										$html.= '
											<br /><span class="description">'.$field['desc'].'</span>';  
									break;
									
									case 'checkbox':  
										$html.= '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( $meta, "on" ,0).'"/> 
											<br /><span class="description">'.$field['desc'].'</span>';  
									break;
									
									case 'radio':  
										foreach ( $field['options'] as $option ) {
											$html.= '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
													<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
										}  
									break;
									
									case 'html_editor':
									{
										ob_start();

											$html.= '
											<p><span class="description">'.$field['desc'].'</span></p>
											<p class="form-field product_field_type" >';
											$editor_id =$field['id'];
											 wp_editor( $meta, $editor_id );
											$html.= ob_get_clean();
											$html.='</p>';
									}
									break; 
									
									case 'multi_select': 
									{ 
										
										$html.= '<select name="'.$field['id'].'[]" id="'.$field['id'].'" style="width: 170px;" class="chosen-select-public" multiple="multiple">';  
										foreach ($field['options'] as $option) {  
											$selected='';
											if(is_array($meta) && in_array($option['value'],$meta))
												$selected='SELECTED';
											$html.= '<option '. $selected.' value="'.$option['value'].'">'.$option['label'].'</option>';  
										}  
										$html.= '</select><br /><span class="description">'.$field['desc'].'</span>';  
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function(jQuery){
												//jQuery(".chosen-select-build").chosen();
											});
										</script>';
									}
									break;
									
									case 'icon_type':  
									{
										$html.= '<input type="hidden" id="'.$field['id'].'_font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
										$html.= '<div class="'.$field['id'].' pw_iconpicker_grid" id="benefit_image_icon">';
										$html.= include(__PW_LIVESEARCH_ROOT_DIR__ .'/includes/font-awesome.php');
										$html.= '</div>';
										$html.= '<span class="description">'.$field['desc'].'</span><br /><br />'; 
										$output = '
										<script type="text/javascript"> 
											jQuery(document).ready(function(jQuery){';
												if ($meta == '') $meta ="fa-none";
												$output .= 'jQuery( ".'.$field['id'].' .'.$meta.'" ).siblings( ".active" ).removeClass( "active" );
												jQuery( ".'.$field['id'].' .'.$meta.'" ).addClass("active");';
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
									}
									break; 
									
									case 'color_picker':
									{	
										$default_value=(isset($field['value']) ? $field['value']:"#fc5b5b");
									
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'-color" class="full-label">'.$field['label'].'</label><input name="'.$field['id'].'" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="'.($meta!=''?$meta:$default_value).'" data-default-color="'.$default_value.'">
											 </div>';
											 
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 	 
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												
											});
										</script>
										';
									}
									break;
									
									case "pw_custom_margin_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';	
										
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;
									
									case "pw_custom_general_font_set":
									{
										if(!isset($meta['color']))
										{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#333333" data-default-color="#333333">
												  </div>';
										}
										else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												</div>';	
										}
										
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Size',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
												<input type="number" name="'.$field['id'].'[size]" id="'.$field['id'].'" value="'.($meta=='' ? "13":$meta['size']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
											  </div>
											  <div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Font Family',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>								
												<select name="'.$field['id'].'[font-family]" id="'.$field['id'].'-family"><option value="inherit">Inherit</option>'.pw_livesearch_get_google_fonts((isset($meta['font-family'])?$meta['font-family']:'')).'</select>
												
												
												<script type="text/javascript">
													function pw_search_isNumber(n) {
														return !isNaN(parseFloat(n)) && isFinite(n);
													}
													jQuery(document).ready(function(){
														
													
														if(jQuery("#'.$field['id'].'-family").val()!="inherit")
														{
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery("#'.$field['id'].'-family").val()+"\" />");	
															var $font_family=jQuery("#'.$field['id'].'-family").val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
															}
															
															jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
														}
														
														jQuery("#'.$field['id'].'-family").change(function(){
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery(this).val()+"\" />");	
															
															var $font_family=jQuery(this).val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery(this).find(":selected").text());
															}
														});
														
													});
												
												</script>
												<p class="pw-check-font-'.$field['id'].'-family">Grumpy wizards make toxic brew for the evil Queen and Jack.</p>
											  </div>';
										
									}
									break;
									
									case "pw_custom_general_font_set_2":
									{
										
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Size',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
												<input type="number" name="'.$field['id'].'[size]" id="'.$field['id'].'" value="'.($meta=='' ? "13":$meta['size']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
											  </div>
											  <div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Font Family',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>								
												<select name="'.$field['id'].'[font-family]" id="'.$field['id'].'-family"><option value="inherit">Inherit</option>'.pw_livesearch_get_google_fonts((isset($meta['font-family'])?$meta['font-family']:'')).'</select>
												
												
												<script type="text/javascript">
													function pw_search_isNumber(n) {
														return !isNaN(parseFloat(n)) && isFinite(n);
													}
													jQuery(document).ready(function(){
														
													
														if(jQuery("#'.$field['id'].'-family").val()!="inherit")
														{
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery("#'.$field['id'].'-family").val()+"\" />");	
															var $font_family=jQuery("#'.$field['id'].'-family").val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
															}
															
															jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
														}
														
														jQuery("#'.$field['id'].'-family").change(function(){
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery(this).val()+"\" />");	
															
															var $font_family=jQuery(this).val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery(this).find(":selected").text());
															}
														});
														
													});
												
												</script>
												<p class="pw-check-font-'.$field['id'].'-family">Grumpy wizards make toxic brew for the evil Queen and Jack.</p>
											  </div>';
										
									}
									break;
									
									case "upload":
									{
										$btn_rand=rand(0,1000);
										$image='';
										$image = __PW_LIVESEARCH_URL__.'/assets/images/pw-transparent.gif'; 
										
										if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }
										$html.= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.(isset($meta) ? $meta:'').'" data-id="'.$btn_rand.'"/> 
												<img src="'.$image.'" class="custom_preview_image" alt="" />
												<input name="btn_'.$field['id'].'" class="pw_livesearch_upload_image_button button" type="button" value="'.__('Choose Image',__PW_LIVESEARCH_TEXTDOMAIN__).'" data-id="'.$btn_rand.'"/>
												<button type="button" class="pw_livesearch_remove_image_button_'.$btn_rand.' pw_livesearch_remove_image_button button">'.__('Remove image',__PW_LIVESEARCH_TEXTDOMAIN__).'</button>';  
										
									}
									break;
									
									case "gallery":
									{
										$image='';
										$image = __PW_LIVESEARCH_URL__.'/assets/images/pw-transparent.gif'; 
										
										if ($meta) { 
											$image_gallery=explode(",",$meta);
											$images='';
											foreach($image_gallery as $ima){
												$image = wp_get_attachment_image_src($ima, 'medium'); 
												$image = $image[0]; 
												$images.='
												<div style="float:left">
													<div class="del_imagegallery">X</div>
													<img src="'.$image.'" class="custom_preview_imagegallery" width="100" height="100" data-id="'.$ima.'"/>
												</div>
												';
											}
											$image=$images;
										
										}else
										{
											$image='';
											
										}
										$html.= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="hidden" class="custom_upload_imagegallery" value="'.(isset($meta) ? $meta:'').'" /> 
										<input name="btn_'.$field['id'].'" class="pw_livesearch_upload_imagegallery_button button" type="button" value="'.__('Choose Images',__PW_LIVESEARCH_TEXTDOMAIN__).'" />
										<button type="button" class="pw_livesearch_remove_imagegallery_button button">'.__('Remove image',__PW_LIVESEARCH_TEXTDOMAIN__).'</button>
										<div id="pw_livesearch_upload_imagegallery_items">'.$image.'</div>';  
									}
									break;
									
									case "pw_custom_4_color":
									{
										if(!is_array($meta))
										{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												</div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Background Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-hcolor]" id="'.$field['id'].'-hover" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												  </div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Text Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#ffffff" data-default-color="#ffffff">
												  </div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Text Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-hcolor]" id="'.$field['id'].'-hover" type="text" class="wp_ad_picker_color" value="#ffffff" data-default-color="#ffffff">
												 </div>
												';
										}
										else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['bg-color'].'" data-default-color="#'.$meta['bg-color'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Background Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-hcolor]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['bg-hcolor'].'" data-default-color="#'.$meta['bg-hcolor'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Text Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['text-color'].'" data-default-color="#'.$meta['text-color'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Text Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-hcolor]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['text-hcolor'].'" data-default-color="#'.$meta['text-hcolor'].'">
												 </div>
											';	
											
										}
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												//jQuery(".wp_ad_picker_color").wpColorPicker();
											});
										</script>
		
										';
									}
									break;
									
									case 'posttype_seletc':  
									{
										$output = 'objects';
										$args = array(
											'public' => true
										);
										$post_types = get_post_types( $args , $output);
																		
										$html.='<select name="'.$field['id'].'" id="'.$field['id'].'">';
										$html.='<option value="" >'.__('Choose Post Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</option>';
										foreach ( $post_types  as $post_type ) {
											if ( $post_type->name != 'attachment' ) {
												$post_value=$post_type->name;
												$post_lbl=$post_type->labels->name;
												$html.='<option value="'.$post_value.'" '.selected($meta,$post_value,0).'>'.$post_lbl.' ('.$post_value.')</option>';
											}
										}
										$html.='</select>';
									}
									break; 
									
									case 'pw_custom_taxonomy':
									{
										$post_name='post';	
										if($meta!='')
											$post_name = get_post_meta($post->ID, __PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type-'.$k, true);
										
										
										$html.='
										<div id="pw_general_taxonomy_buildquery_result-'.$k.'">';
										$original_query = $post;
			
										$option_data='';
										$param_line='';
										$in_option_data ='';
										$ex_option_data ='';
										
										$rand_id=rand(0,9999);
										
										$all_tax=get_object_taxonomies( $post_name );
										//$all_tax = array_diff($all_tax,array('post_tag'));
										
										$current_value=array();
										if(is_array($all_tax) && count($all_tax)>0){
											$post_type_label=get_post_type_object( $post_name );
											$label=$post_type_label->label ; 
											$param_line .='<div class="header-lbl" style="display: block !important">'.$label.' '.__('Taxonomies ',__PW_LIVESEARCH_TEXTDOMAIN__).'</div>';
											
											//FETCH TAXONOMY
											foreach ( $all_tax as $tax ) {
												
												//if ('post_tag' === $taxonomy) continue;
												
												$taxonomy=get_taxonomy($tax);	
												$values=$tax;
												$label=$taxonomy->label;
									
												$checked='';
												if (isset($meta['taxonomy_checkbox']) &&  in_array($tax, $meta['taxonomy_checkbox']) ) $checked = ' checked="checked"';
												
												$param_line .=' 
												<div class="full-lbl-cnt more-padding" style="display: block;">
													<label class="full-label" >
														<input type="checkbox" data-input="post_type" value="'.$tax.'" id="pw_checkbox_'.$tax.'" name="'.$field['id'].'[taxonomy_checkbox][]" class="pw_taxomomy_checkbox" '.$checked.'> 
														'.$label.'
													</label>';
													
													
									
													$param_line_exclude =$param_line_include = '<select name="'.$field['id'].'[in_'.$tax.'][]" class="chosen-select-build-'.$rand_id.'" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Inclulde ',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
													$param_line_exclude = '<select name="'.$field['id'].'[ex_'.$tax.'][]" class="chosen-select-build-'.$rand_id.'" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Exclude',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
													$args = array(
														'orderby'                  => 'name',
														'order'                    => 'ASC',
														'hide_empty'               => 1,
														'hierarchical'             => 1,
														'exclude'                  => '',
														'include'                  => '',
														'child_of'          	   => 0,
														'number'                   => '',
														'pad_counts'               => false 
													
													); 
									
													//$categories = get_categories($args); 
													$categories = get_terms($tax,$args);
													foreach ($categories as $category) {
														$selected='';
														if(isset($meta['in_'.$tax]) && is_array($meta['in_'.$tax]))
														{
															$selected=(in_array($category->term_id,$meta['in_'.$tax]) ? "SELECTED":"");
														}
														
														$option = '<option value="'.$category->term_id.'" '.$selected.'>';
														$option .= $category->name;
														$option .= ' ('.$category->count.')';
														$option .= '</option>';
														$param_line_include .= $option;
								
													}
													$param_line_include .='</select>';
													
													//$categories = get_categories($args); 
													$categories = get_terms($tax,$args);
													
													foreach ($categories as $category) {
														$selected='';
														if(isset($meta['ex_'.$tax]) && is_array($meta['ex_'.$tax]))
														{
															$selected=(in_array($category->term_id,$meta['ex_'.$tax]) ? "SELECTED":"");
														}
														
														$option = '<option value="'.$category->term_id.'" '.$selected.'>';
														$option .= $category->name;
														$option .= ' ('.$category->count.')';
														$option .= '</option>';
														$param_line_exclude .= $option;
													}
													$param_line_exclude .='</select>';
													$param_line .= $param_line_include.$param_line_exclude.'
												</div>';	
											}
								
										
										
											//CREATE INDIVIDUAL SELECT BOX
											$pw_post_id='';
											$args_post = array('post_type' => $post_name,'posts_per_page'=>-1);
											$loop_post = new WP_Query( $args_post );
											$in_option_data ='<optgroup label="'.$post_name.'">';
											$ex_option_data ='<optgroup label="'.$post_name.'">';
											while ( $loop_post->have_posts() ) : $loop_post->the_post();
												$selected='';
												if(isset($meta['in_ids']))
												{
													$selected=(in_array(get_the_ID(),$meta['in_ids']) ? "SELECTED":"");
												}
												$in_option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
												
												$selected='';
												if(isset($meta['ex_ids']))
												{
													$selected=(in_array(get_the_ID(),$meta['ex_ids']) ? "SELECTED":"");
												}
												$ex_option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
											endwhile;
											
											$post = $original_query;
											wp_reset_postdata();
											
											$in_option_data.='</optgroup>';
											$ex_option_data.='</optgroup>';
										}else{
											$param_line=__('There is no Taxonomy/Category for this (Custom) post!',__PW_LIVESEARCH_TEXTDOMAIN__);
										}
										
										if($ex_option_data!='' || $in_option_data!=''){
											$param_line .='<div class="header-lbl" style="display: block !important;">'.__('Individual Product(s)',__PW_LIVESEARCH_TEXTDOMAIN__).'</div>';
											$param_line .='<div class="full-lbl-cnt more-padding" style="display: block;">
												<select name="'.$field['id'].'[in_ids][]" style="width: 531px;" class="chosen-select-build-'.$rand_id.'" multiple="multiple" data-placeholder="'.__('Choose Include Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
													$param_line.= $in_option_data.'
												</select>
														  ';	
											
											$param_line .='
												<select name="'.$field['id'].'[ex_ids][]" style="width: 531px;" class="chosen-select-build-'.$rand_id.'" multiple="multiple" data-placeholder="'.__('Choose Exclude Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
													$param_line.= $ex_option_data.'
												</select>
											</div>';	
										}
										$param_line.='
											<script type="text/javascript"> 
												jQuery(document).ready(function(){
													var visible = true;
													setInterval(
														function()
														{
															if(visible)
																if(jQuery(".chosen-select-build-'.$rand_id.'").is(":visible"))
																{
																	visible = false;
																	jQuery(".chosen-select-build-'.$rand_id.'").chosen();
																}
													}, 100);
													
												});
											</script>';
										$html.= $param_line;
										$html.='
										</div>';
										
										$html.='
										<script type="text/javascript">
											jQuery(document).ready(function(){
												
												jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type-'.$k.'").change(function(){
													var $post_type=jQuery(this).val();
		
													jQuery.ajax ({
														type: "POST",
														url: ajaxurl,
														data:   "field_id='.$field['id'].'&post_selected="+$post_type+"&action=pw_livesearch_taxonomy_fetch",
														success: function(data) {
															jQuery("#pw_general_taxonomy_buildquery_result-'.$k.'").html(data);
														}
													});
												});
											});
										</script>';
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
										$page=wp_dropdown_pages($args);
										$html.=$page;
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;
									
									case "pw_custom_padding_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt"> 
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
			';
									}
									break;
									
									case "pw_custom_margin_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';	
									}
									break;
									
									case "pw_custom_box_shadow_set":
									{
										
										if(is_array($meta))
										{
											$html.= '
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Horizontal Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[hor-len]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['hor-len']).'" size="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span>
												</div>	
												<div class="medium-lbl-cnt"> 
													<label for="'.$field['id'].'" class="full-label">'.__('Vertical Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[ver-len]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['ver-len']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span> 
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Blur Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[blur-radius]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['blur-radius']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'  </span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Spread Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[spread-radius]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['spread-radius']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Shadow Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Opacity',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[opacity]" id="'.$field['id'].'">
														<option value="0.1" '.selected($meta['opacity'],'0.1',0).'>0.1</option>
														<option value="0.2" '.selected($meta['opacity'],'0.2',0).'>0.2</option>
														<option value="0.3" '.selected($meta['opacity'],'0.3',0).'>0.3</option>
														<option value="0.4" '.selected($meta['opacity'],'0.4',0).'>0.4</option>
														<option value="0.5" '.selected($meta['opacity'],'0.5',0).'>0.5</option>
														<option value="0.6" '.selected($meta['opacity'],'0.6',0).'>0.6</option>
														<option value="0.7" '.selected($meta['opacity'],'0.7',0).'>0.7</option>
														<option value="0.8" '.selected($meta['opacity'],'0.8',0).'>0.8</option>
														<option value="0.9" '.selected($meta['opacity'],'0.9',0).'>0.9</option>
														<option value="1" '.selected($meta['opacity'],'1',0).'>1</option>
													</select>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[type]" id="'.$field['id'].'">
														<option value="outline" '.selected($meta['type'],'outline',0).'>Outline</option>
														<option value="inset" '.selected($meta['type'],'inset',0).'>Inset</option>
													</select>
												</div>
											<span class="description">'.$field['desc'].'</span>
											';
										}else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Horizontal Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[hor-len]" id="'.$field['id'].'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Vertical Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[ver-len]" id="'.$field['id'].'"  size="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>  
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Blur Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[blur-radius]" id="'.$field['id'].'"  size="1"  pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">  
													<label for="'.$field['id'].'" class="full-label">'.__('Spread Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[spread-radius]" id="'.$field['id'].'"  size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Shadow Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Opacity',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[opacity]" id="'.$field['id'].'">
														<option value="0.1">0.1</option>
														<option value="0.2">0.2</option>
														<option value="0.3">0.3</option>
														<option value="0.4">0.4</option>
														<option value="0.5">0.5</option>
														<option value="0.6">0.6</option>
														<option value="0.7">0.7</option>
														<option value="0.8">0.8</option>
														<option value="0.9">0.9</option>
														<option value="1">1</option>
													</select>
											
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[type]" id="'.$field['id'].'">
														<option value="outline" >Outline</option>
														<option value="inset" >Inset</option>
													</select>
												</div>
											<span class="description">'.$field['desc'].'</span>
											';
										}
										
										
									}
									break;
									
									case 'pw_custom_border_set':
									{
										if(!isset($meta['color']))
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
													<input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="#dddddd" data-default-color="#dddddd">
												  </div>';
										else
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
													<input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												  </div>';	
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												//jQuery(".wp_ad_picker_color").wpColorPicker();
											});
										</script>';
										
										$border_type=array('solid','dotted','dashed','none','hidden','double','groove','ridge','inset','outset','initial','inherit');
										$html.= '
										<div class="medium-lbl-cnt">
											<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
											<select name="'.$field['id'].'[type]" id="'.$field['id'].'">';
											foreach($border_type as $b_type){
												if(is_array($meta))
													$html.= '<option value="'.$b_type.'" '.selected($b_type,$meta['type'],0).'>'.$b_type.'</option>';
												else
													$html.= '<option value="'.$b_type.'" >'.$b_type.'</option>';	
													
											}
											$html.= '</select>
										</div>';
										
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1"  min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'  </span>
										</div>	
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span> 
										</div>
										<div class="small-lbl-cnt">								
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
										
									}
									break;
									
									case "pw_custom_border_radius_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span> 
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';
										
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;
				
								} //end switch  
						$html.= '</td></tr>';  
						
					}
					$html.= '
					</table>
					</div><!--end .accordion-section-content-->
				    </div><!--end .accordion-section-->';
				}
					$html.='</div><!--end .accordion-->';
					
				}
				$html.= '
							
						</td>
					</tr>
				</table>';
			}
			else
			{
				foreach($$var as $field){
					if(isset($field['dependency']))  
						{
							$html.=pw_livesearch_dependency($field['id'],$field['dependency']);	
						}
						
						// get value of this field if it exists for this post  
						$meta = get_post_meta($post->ID, $field['id'], true);  
						// begin a table row with 
						if($field['type']=='hidden')
						{
							$html.= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />';
							continue;
						}
						
						// begin a table row with  
						$style='';
						
						if($field['type']=='notype')
							$style='style="border-bottom:solid 1px #ccc"';
							
						$html.= '<tr class="'.$field['id'].'_field" '.$style.'>  
		
								<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
								<td>';  
								switch($field['type']) {  
								
									case 'image_select':  
										
										if($meta=='')
											$meta=1;
			
										$html.= '
										<input type="hidden" name="'.$field['id'].'" id="pw_section_image_val" value="'.($meta!='' ? $meta:1).'" />
										<div class="pw_section_image_main layouts_box_thumbnail">
											<div class="layouts_thumbnail pw_section_image" data-section="1"></div>
											<div class="layouts_thumbnail t21 pw_section_image" data-section="2"></div>
											<div class="layouts_thumbnail t37 pw_section_image" data-section="3"></div>
											<div class="layouts_thumbnail t46 pw_section_image" data-section="4" ></div>
										</div>
										
										<script type="text/javascript">
											jQuery(document).ready(function(){
											
												setTimeout(function(){
													jQuery(".pw_section_image_main").find(".pw_section_image").each(function(){
														var div_val=jQuery(this).attr("data-section");
														if(div_val=="'.$meta.'")
														{
															jQuery(this).addClass("selected").removeClass("unselected");
															set_thumbnails_box(div_val,1,1);
															var div_two_val=jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__.'section_type").val();
															if(div_two_val=="")
																div_two_val="t11";
															set_main_layout_box(div_val,div_two_val);
														}
													});		
													
												},1000);	
											});
										</script>
											
										<br /><span class="description">'.$field['desc'].'</span>
										<p style="clear:both;margin-bottom: 20px;"></p>	';  
									break;
		
									case 'text':  
			
										$html.= '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
										';  
									break; 
									
									case 'textarea':  
										$html.= '<textarea name="'.$field['id'].'" id="'.$field['id'].'">'.$meta.'</textarea>
										<br /><span class="description">'.$field['desc'].'</span>	';  
									break; 
									
									case 'hidden':  
			
										$html.= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />';  
									break; 
									
									case 'radio':  
										foreach ( $field['options'] as $option ) {
											$html.= '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
													<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
										}  
									break;
									
									case 'select':  
										$html.= '<select name="'.$field['id'].'" id="'.$field['id'].'" style="width: 170px;">';  
										foreach ($field['options'] as $option) {  
											$html.= '<option '. selected( $meta , $option['value'],0 ).' value="'.$option['value'].'">'.$option['label'].'</option>';  
										}  
										$html.= '</select><br /><span class="description">'.$field['desc'].'</span>';  
									break;
									
									case 'numeric':  
										$default_value=(isset($field['value'])? $field['value']:"");
										$html.= '
										<input type="number" name="'.$field['id'].'" id="'.$field['id'].'" value="'.($meta=='' ? $default_value:$meta).'" size="30" class="width_170" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" />
			';
										$html.= '
											<br /><span class="description">'.$field['desc'].'</span>';  
									break;
									
									case 'checkbox':  
										$html.= '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" '.checked( $meta, "on" ,0).'"/> 
											<br /><span class="description">'.$field['desc'].'</span>';  
									break;
									
									case 'radio':  
										foreach ( $field['options'] as $option ) {
											$html.= '<input type="radio" name="'.$field['id'].'" value="'.$option['value'].'" '.checked( $meta, $option['value'] ,0).' '.$option['checked'].' /> 
													<label for="'.$option['value'].'">'.$option['label'].'</label><br><br>';  
										}  
									break;
									
									case 'multi_select': 
									{ 
										
										$html.= '<select name="'.$field['id'].'[]" id="'.$field['id'].'" style="width: 170px;" class="chosen-select-public" multiple="multiple">';  
										foreach ($field['options'] as $option) {  
											$selected='';
											if(is_array($meta) && in_array($option['value'],$meta))
												$selected='SELECTED';
											$html.= '<option '. $selected.' value="'.$option['value'].'">'.$option['label'].'</option>';  
										}  
										$html.= '</select><br /><span class="description">'.$field['desc'].'</span>';  
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function(jQuery){
												//jQuery(".chosen-select-build").chosen();
											});
										</script>';
									}
									break;
									
									case 'icon_type':  
									{
										$html.= '<input type="hidden" id="'.$field['id'].'_font_icon" name="'.$field['id'].'" value="'.$meta.'"/>';
										$html.= '<div class="'.$field['id'].' pw_iconpicker_grid" id="benefit_image_icon">';
										$html.= include(__PW_LIVESEARCH_ROOT_DIR__ .'/includes/font-awesome.php');
										$html.= '</div>';
										$html.= '<span class="description">'.$field['desc'].'</span><br /><br />'; 
										$output = '
										<script type="text/javascript"> 
											jQuery(document).ready(function(jQuery){';
												if ($meta == '') $meta ="fa-none";
												$output .= 'jQuery( ".'.$field['id'].' .'.$meta.'" ).siblings( ".active" ).removeClass( "active" );
												jQuery( ".'.$field['id'].' .'.$meta.'" ).addClass("active");';
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
									}
									break; 
									
									case 'color_picker':
									{	
										$default_value=(isset($field['value']) ? $field['value']:"#fc5b5b");
									
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'-color" class="full-label">'.$field['label'].'</label><input name="'.$field['id'].'" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="'.($meta!=''?$meta:$default_value).'" data-default-color="'.$default_value.'">
											 </div>';
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												//jQuery(".wp_ad_picker_color").wpColorPicker();
											});
										</script>
										';
									}
									break;
									
									case "pw_custom_box_shadow_set":
									{
										
										if(is_array($meta))
										{
											$html.= '
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Horizontal Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[hor-len]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['hor-len']).'" size="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span>
												</div>	
												<div class="medium-lbl-cnt"> 
													<label for="'.$field['id'].'" class="full-label">'.__('Vertical Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[ver-len]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['ver-len']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span> 
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Blur Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[blur-radius]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['blur-radius']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'  </span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Spread Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[spread-radius]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['spread-radius']).'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Shadow Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Opacity',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[opacity]" id="'.$field['id'].'">
														<option value="0.1" '.selected($meta['opacity'],'0.1',0).'>0.1</option>
														<option value="0.2" '.selected($meta['opacity'],'0.2',0).'>0.2</option>
														<option value="0.3" '.selected($meta['opacity'],'0.3',0).'>0.3</option>
														<option value="0.4" '.selected($meta['opacity'],'0.4',0).'>0.4</option>
														<option value="0.5" '.selected($meta['opacity'],'0.5',0).'>0.5</option>
														<option value="0.6" '.selected($meta['opacity'],'0.6',0).'>0.6</option>
														<option value="0.7" '.selected($meta['opacity'],'0.7',0).'>0.7</option>
														<option value="0.8" '.selected($meta['opacity'],'0.8',0).'>0.8</option>
														<option value="0.9" '.selected($meta['opacity'],'0.9',0).'>0.9</option>
														<option value="1" '.selected($meta['opacity'],'1',0).'>1</option>
													</select>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[type]" id="'.$field['id'].'">
														<option value="outline" '.selected($meta['type'],'outline',0).'>Outline</option>
														<option value="inset" '.selected($meta['type'],'inset',0).'>Inset</option>
													</select>
												</div>
											<span class="description">'.$field['desc'].'</span>
											';
										}else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Horizontal Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[hor-len]" id="'.$field['id'].'" size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Vertical Length',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[ver-len]" id="'.$field['id'].'"  size="1" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>  
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Blur Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[blur-radius]" id="'.$field['id'].'"  size="1"  pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">  
													<label for="'.$field['id'].'" class="full-label">'.__('Spread Radius',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<input type="number" name="'.$field['id'].'[spread-radius]" id="'.$field['id'].'"  size="1" style="width:50px" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="Only Digits!" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Shadow Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Opacity',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[opacity]" id="'.$field['id'].'">
														<option value="0.1">0.1</option>
														<option value="0.2">0.2</option>
														<option value="0.3">0.3</option>
														<option value="0.4">0.4</option>
														<option value="0.5">0.5</option>
														<option value="0.6">0.6</option>
														<option value="0.7">0.7</option>
														<option value="0.8">0.8</option>
														<option value="0.9">0.9</option>
														<option value="1">1</option>
													</select>
											
												</div>
												<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
													<select name="'.$field['id'].'[type]" id="'.$field['id'].'">
														<option value="outline" >Outline</option>
														<option value="inset" >Inset</option>
													</select>
												</div>
											<span class="description">'.$field['desc'].'</span>
											';
										}
										
										
									}
									break;
									
									case "pw_custom_margin_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';	
									}
									break;
									
									case "pw_custom_general_font_set":
									{
										if(!isset($meta['color']))
										{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#333333" data-default-color="#333333">
												  </div>';
										}
										else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												</div>';	
										}
										
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Size',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
												<input type="number" name="'.$field['id'].'[size]" id="'.$field['id'].'" value="'.($meta=='' ? "13":$meta['size']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
											  </div>
											  <div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Font Family',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>								
												<select name="'.$field['id'].'[font-family]" id="'.$field['id'].'-family"><option value="inherit">Inherit</option>'.pw_livesearch_get_google_fonts((isset($meta['font-family'])?$meta['font-family']:'')).'</select>
												
												
												<script type="text/javascript">
													function pw_search_isNumber(n) {
														return !isNaN(parseFloat(n)) && isFinite(n);
													}
													jQuery(document).ready(function(){
														
													
														if(jQuery("#'.$field['id'].'-family").val()!="inherit")
														{
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery("#'.$field['id'].'-family").val()+"\" />");	
															var $font_family=jQuery("#'.$field['id'].'-family").val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
															}
															
															jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
														}
														
														jQuery("#'.$field['id'].'-family").change(function(){
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery(this).val()+"\" />");	
															
															var $font_family=jQuery(this).val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery(this).find(":selected").text());
															}
														});
														
													});
												
												</script>
												<p class="pw-check-font-'.$field['id'].'-family">Grumpy wizards make toxic brew for the evil Queen and Jack.</p>
											  </div>';
										
									}
									break;
									
									case "pw_custom_general_font_set_2":
									{
										
										$html.= '<div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Size',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
												<input type="number" name="'.$field['id'].'[size]" id="'.$field['id'].'" value="'.($meta=='' ? "13":$meta['size']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
											  </div>
											  <div class="medium-lbl-cnt">
												<label for="'.$field['id'].'" class="full-label">'.__('Font Family',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>								
												<select name="'.$field['id'].'[font-family]" id="'.$field['id'].'-family"><option value="inherit">Inherit</option>'.pw_livesearch_get_google_fonts((isset($meta['font-family'])?$meta['font-family']:'')).'</select>
												
												
												<script type="text/javascript">
													function pw_search_isNumber(n) {
														return !isNaN(parseFloat(n)) && isFinite(n);
													}
													jQuery(document).ready(function(){
														
													
														if(jQuery("#'.$field['id'].'-family").val()!="inherit")
														{
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery("#'.$field['id'].'-family").val()+"\" />");	
															var $font_family=jQuery("#'.$field['id'].'-family").val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
															}
															
															jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery("#'.$field['id'].'-family").find(":selected").text());
														}
														
														jQuery("#'.$field['id'].'-family").change(function(){
															jQuery("head").append("<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family="+jQuery(this).val()+"\" />");	
															
															var $font_family=jQuery(this).val();
															var $font_arr=$font_family.split(":");
															if($font_arr.length>0 && pw_search_isNumber($font_arr[1]))
															{
																$font_weight=$font_arr[1];
																$font_name=$font_arr[0].replace("+"," ");
																jQuery(".pw-check-font-'.$field['id'].'-family").css({"font-family":$font_name,"font-weight":$font_weight});
															}else
															{
																jQuery(".pw-check-font-'.$field['id'].'-family").css("font-family",jQuery(this).find(":selected").text());
															}
														});
														
													});
												
												</script>
												<p class="pw-check-font-'.$field['id'].'-family">Grumpy wizards make toxic brew for the evil Queen and Jack.</p>
											  </div>';
										
									}
									break;
									
									case "upload":
									{
										$btn_rand=rand(0,1000);
										$image='';
										$image = __PW_LIVESEARCH_URL__.'/assets/images/pw-transparent.gif'; 
										
										if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium'); $image = $image[0]; }
										$html.= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.(isset($meta) ? $meta:'').'" data-id="'.$btn_rand.'"/> 
												<img src="'.$image.'" class="custom_preview_image" alt="" />
												<input name="btn_'.$field['id'].'" class="pw_livesearch_upload_image_button button" type="button" value="'.__('Choose Image',__PW_LIVESEARCH_TEXTDOMAIN__).'" data-id="'.$btn_rand.'"/>
												<button type="button" class="pw_livesearch_remove_image_button_'.$btn_rand.' pw_livesearch_remove_image_button button">'.__('Remove image',__PW_LIVESEARCH_TEXTDOMAIN__).'</button>';  
									}
									break;
									
									case "gallery":
									{
										$image='';
										$image = __PW_LIVESEARCH_URL__.'/assets/images/pw-transparent.gif'; 
										
										if ($meta) { 
											$image_gallery=explode(",",$meta);
											$images='';
											foreach($image_gallery as $ima){
												$image = wp_get_attachment_image_src($ima, 'medium'); 
												$image = $image[0]; 
												$images.='
												<div style="float:left">
													<div class="del_imagegallery">X</div>
													<img src="'.$image.'" class="custom_preview_imagegallery" width="100" height="100" data-id="'.$ima.'"/>
												</div>
												';
											}
											$image=$images;
										
										}else
										{
											$image='';
											
										}
										$html.= '<input name="'.$field['id'].'" id="'.$field['id'].'" type="hidden" class="custom_upload_imagegallery" value="'.(isset($meta) ? $meta:'').'" /> 
										<input name="btn_'.$field['id'].'" class="pw_livesearch_upload_imagegallery_button button" type="button" value="'.__('Choose Images',__PW_LIVESEARCH_TEXTDOMAIN__).'" />
										<button type="button" class="pw_livesearch_remove_imagegallery_button button">'.__('Remove image',__PW_LIVESEARCH_TEXTDOMAIN__).'</button>
										<div id="pw_livesearch_upload_imagegallery_items">'.$image.'</div>';  
									}
									break;
									
									case "pw_custom_4_color":
									{
										if(!is_array($meta))
										{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												</div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Background Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-hcolor]" id="'.$field['id'].'-hover" type="text" class="wp_ad_picker_color" value="#fc5b5b" data-default-color="#fc5b5b">
												  </div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Text Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-color]" id="'.$field['id'].'-color" type="text" class="wp_ad_picker_color" value="#ffffff" data-default-color="#ffffff">
												  </div>';
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Text Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-hcolor]" id="'.$field['id'].'-hover" type="text" class="wp_ad_picker_color" value="#ffffff" data-default-color="#ffffff">
												 </div>
												';
										}
										else{
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Background Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['bg-color'].'" data-default-color="#'.$meta['bg-color'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Background Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[bg-hcolor]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['bg-hcolor'].'" data-default-color="#'.$meta['bg-hcolor'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-color" class="full-label">'.__('Text Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['text-color'].'" data-default-color="#'.$meta['text-color'].'">
												 </div>';	
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'-hover" class="full-label">'.__('Text Hover Color',__PW_LIVESEARCH_TEXTDOMAIN__).'</label><input name="'.$field['id'].'[text-hcolor]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['text-hcolor'].'" data-default-color="#'.$meta['text-hcolor'].'">
												 </div>
											';	
											
										}
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												//jQuery(".wp_ad_picker_color").wpColorPicker();
											});
										</script>
		
										';
									}
									break;
									
									case 'posttype_seletc':  
									{
										$output = 'objects';
										$args = array(
											'public' => true
										);
										$post_types = get_post_types( $args , $output);
																		
										$html.='<select name="'.$field['id'].'" id="'.$field['id'].'">';
										$html.='<option value="" >'.__('Choose Post Type',__PW_LIVESEARCH_TEXTDOMAIN__).'</option>';
										foreach ( $post_types  as $post_type ) {
											if ( $post_type->name != 'attachment' ) {
												$post_value=$post_type->name;
												$post_lbl=$post_type->labels->name;
												$html.='<option value="'.$post_value.'" '.selected($meta,$post_value,0).'>'.$post_lbl.' ('.$post_value.')</option>';
											}
										}
										$html.='</select>';
									}
									break; 
									
									case 'pw_custom_taxonomy':
									{
										$post_name='post';	
										if($meta!='')
											$post_name = get_post_meta($post->ID, __PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type', true);
										
										
										$html.='
										<div id="pw_general_taxonomy_buildquery_result">';
										$original_query = $post;
			
										$option_data='';
										$param_line='';
										$in_option_data ='';
										$ex_option_data ='';
										
										$all_tax=get_object_taxonomies( $post_name );
										//$all_tax = array_diff($all_tax,array('post_tag'));
										
										$current_value=array();
										if(is_array($all_tax) && count($all_tax)>0){
											$post_type_label=get_post_type_object( $post_name );
											$label=$post_type_label->label ; 
											$param_line .='<div class="header-lbl" style="display: block !important">'.$label.' '.__('Taxonomies ',__PW_LIVESEARCH_TEXTDOMAIN__).'</div>';
											
											//FETCH TAXONOMY
											foreach ( $all_tax as $tax ) {
												
												//if ('post_tag' === $taxonomy) continue;
												
												$taxonomy=get_taxonomy($tax);	
												$values=$tax;
												$label=$taxonomy->label;
									
												$checked='';
												if (isset($meta['taxonomy_checkbox']) &&  in_array($tax, $meta['taxonomy_checkbox']) ) $checked = ' checked="checked"';
												
												$param_line .=' 
												<div class="full-lbl-cnt more-padding" style="display: block;">
													<label class="full-label" >
														<input type="checkbox" data-input="post_type" value="'.$tax.'" id="pw_checkbox_'.$tax.'" name="'.$field['id'].'[taxonomy_checkbox][]" class="pw_taxomomy_checkbox" '.$checked.'> 
														'.$label.'
													</label>';
													
													$rand_id=rand(0,9999);
									
													$param_line_exclude =$param_line_include = '<select name="'.$field['id'].'[in_'.$tax.'][]" class="chosen-select-build-'.$rand_id.'" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Inclulde ',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
													$param_line_exclude = '<select name="'.$field['id'].'[ex_'.$tax.'][]" class="chosen-select-build-'.$rand_id.'" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Exclude',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
													$args = array(
														'orderby'                  => 'name',
														'order'                    => 'ASC',
														'hide_empty'               => 1,
														'hierarchical'             => 1,
														'exclude'                  => '',
														'include'                  => '',
														'child_of'          	   => 0,
														'number'                   => '',
														'pad_counts'               => false 
													
													); 
									
													//$categories = get_categories($args); 
													$categories = get_terms($tax,$args);
													foreach ($categories as $category) {
														$selected='';
														if(isset($meta['in_'.$tax]) && is_array($meta['in_'.$tax]))
														{
															$selected=(in_array($category->term_id,$meta['in_'.$tax]) ? "SELECTED":"");
														}
														
														$option = '<option value="'.$category->term_id.'" '.$selected.'>';
														$option .= $category->name;
														$option .= ' ('.$category->count.')';
														$option .= '</option>';
														$param_line_include .= $option;
								
													}
													$param_line_include .='</select>';
													
													//$categories = get_categories($args); 
													$categories = get_terms($tax,$args);
													
													foreach ($categories as $category) {
														$selected='';
														if(isset($meta['ex_'.$tax]) && is_array($meta['ex_'.$tax]))
														{
															$selected=(in_array($category->term_id,$meta['ex_'.$tax]) ? "SELECTED":"");
														}
														
														$option = '<option value="'.$category->term_id.'" '.$selected.'>';
														$option .= $category->name;
														$option .= ' ('.$category->count.')';
														$option .= '</option>';
														$param_line_exclude .= $option;
													}
													$param_line_exclude .='</select>';
													$param_line .= $param_line_include.$param_line_exclude.'
												</div>';	
											}
								
										
										
											//CREATE INDIVIDUAL SELECT BOX
											$pw_post_id='';
											$args_post = array('post_type' => $post_name,'posts_per_page'=>-1);
											$loop_post = new WP_Query( $args_post );
											$in_option_data ='<optgroup label="'.$post_name.'">';
											$ex_option_data ='<optgroup label="'.$post_name.'">';
											while ( $loop_post->have_posts() ) : $loop_post->the_post();
												$selected='';
												if(isset($meta['in_ids']))
												{
													$selected=(in_array(get_the_ID(),$meta['in_ids']) ? "SELECTED":"");
												}
												$in_option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
												
												$selected='';
												if(isset($meta['ex_ids']))
												{
													$selected=(in_array(get_the_ID(),$meta['ex_ids']) ? "SELECTED":"");
												}
												$ex_option_data.='<option '.$selected.' value="'.get_the_ID().'">'.get_the_title().'</option>';
											endwhile;
											
											$post = $original_query;
											wp_reset_postdata();
											
											$in_option_data.='</optgroup>';
											$ex_option_data.='</optgroup>';
										}else{
											$param_line=__('There is no Taxonomy/Category for this (Custom) post!',__PW_LIVESEARCH_TEXTDOMAIN__);
										}
										
										if($ex_option_data!='' || $in_option_data!=''){
											$param_line .='<div class="header-lbl" style="display: block !important;">'.__('Individual Product(s)',__PW_LIVESEARCH_TEXTDOMAIN__).'</div>';
											$param_line .='<div class="full-lbl-cnt more-padding" style="display: block;">
												<select name="'.$field['id'].'[in_ids][]" style="width: 531px;" class="chosen-select-build-'.$rand_id.'" multiple="multiple" data-placeholder="'.__('Choose Include Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
													$param_line.= $in_option_data.'
												</select>
														  ';	
											
											$param_line .='
												<select name="'.$field['id'].'[ex_ids][]" style="width: 531px;" class="chosen-select-build-'.$rand_id.'" multiple="multiple" data-placeholder="'.__('Choose Exclude Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
													$param_line.= $ex_option_data.'
												</select>
											</div>';	
										}
										$param_line.='
											<script type="text/javascript"> 
												jQuery(document).ready(function(){
													jQuery(".chosen-select-build-'.$rand_id.'").chosen();
													/*jQuery.when( jQuery(".chosen-select").chosen() ).done(function( x ) {
														jQuery(".chosen-container").each(function(){
															//jQuery(this).css({"width": "500px"});
														});
													});*/
													
												});
											</script>
										';
										$html.= $param_line;
										$html.='
										</div>';
										
										$html.='
										<script type="text/javascript">
											jQuery(document).ready(function(){
												
												jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'post_type'.'").change(function(){
													var $post_type=jQuery(this).val();
		
													jQuery.ajax ({
														type: "POST",
														url: ajaxurl,
														data:   "field_id='.$field['id'].'&post_selected="+$post_type+"&action=pw_livesearch_taxonomy_fetch",
														success: function(data) {
															jQuery("#pw_general_taxonomy_buildquery_result").html(data);
														}
													});
												});
											});
										</script>';
									}
									break;
									
									case "pw_pages":
									{
										$args = array(
											'depth'                 => 0,
											'child_of'              => 0,
											'selected'              => $meta,
											'echo'                  => 1,
											'name'                  => $field['id'],
											'id'                    => null, // string
											'show_option_none'      => __('Choose a Page',__PW_LIVESEARCH_TEXTDOMAIN__), // string
											'show_option_no_change' => null, // string
											'option_none_value'     => null, // string
										);
										$page=wp_dropdown_pages($args);
										$html.=$page;
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;

									
									case "pw_custom_padding_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt"> 
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
			';
									}
									break;
									
									case "pw_custom_margin_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';	
									}
									break;
									
									case 'pw_custom_border_set':
									{
										if(!isset($meta['color']))
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
													<input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="#dddddd" data-default-color="#dddddd">
												  </div>';
										else
											$html.= '<div class="medium-lbl-cnt">
													<label for="'.$field['id'].'" class="full-label">'.__('Color',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
													<input name="'.$field['id'].'[color]" id="'.$field['id'].'" type="text" class="wp_ad_picker_color" value="'.$meta['color'].'" data-default-color="#'.$meta['color'].'">
												  </div>';	
										
										$html.= '
										<script type="text/javascript">
											jQuery(document).ready(function($) {   
												//jQuery(".wp_ad_picker_color").wpColorPicker();
											});
										</script>';
										
										$border_type=array('solid','dotted','dashed','none','hidden','double','groove','ridge','inset','outset','initial','inherit');
										$html.= '
										<div class="medium-lbl-cnt">
											<label for="'.$field['id'].'" class="full-label">'.__('Type',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
											<select name="'.$field['id'].'[type]" id="'.$field['id'].'">';
											foreach($border_type as $b_type){
												if(is_array($meta))
													$html.= '<option value="'.$b_type.'" '.selected($b_type,$meta['type'],0).'>'.$b_type.'</option>';
												else
													$html.= '<option value="'.$b_type.'" >'.$b_type.'</option>';	
													
											}
											$html.= '</select>
										</div>';
										
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).' </label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1"  min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).' </span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'  </span>
										</div>	
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span> 
										</div>
										<div class="small-lbl-cnt">								
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';
										
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;
									
									case "pw_custom_border_radius_set":
									{
										$html.= '
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Top',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[top]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['top']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span> 
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Right',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[right]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['right']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Bottom',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[bottom]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['bottom']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>  
										</div>
										<div class="small-lbl-cnt">
											<label for="'.$field['id'].'" class="small-label">'.__('Left',__PW_LIVESEARCH_TEXTDOMAIN__).'</label>
											<input type="number" name="'.$field['id'].'[left]" id="'.$field['id'].'" value="'.($meta=='' ? "0":$meta['left']).'" size="1" style="width:50px" min="0" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="'.__('Only Digits!',__PW_LIVESEARCH_TEXTDOMAIN__).'" class="input-text qty text" /><span class="input-unit">'.__('px',__PW_LIVESEARCH_TEXTDOMAIN__).'</span>
										</div>';
										
										$html.= '<br /><span class="description">'.$field['desc'].'</span>'; 
									}
									break;
				
								} //end switch  
						$html.= '</td></tr>';  
						
						if($field['id']==__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number'){
							$html.='<tr><th><label for="">'.__('Choose Layout',__PW_LIVESEARCH_TEXTDOMAIN__).'</label></th><td><div id="layouts_box_thumbnail"></div></td><td>';
						}
				} // end foreach  
			}
			
			if($var!='pw_livesearch_metaboxname_fields_section_variable' && $var!='pw_livesearch_metaboxname_fields_section')
				$html.='</table></section>';
			
			if($var=='pw_livesearch_metaboxname_fields_section')
				$html.='</table>';
			
			if($var=='pw_livesearch_metaboxname_fields_section_variable')
				$html.='</table></section>';
				
		}

		$html.='</div><!-- /content -->
				</div><!-- /tabs -->';
				
		
				
		$html.='
		<script type="text/javascript">
			jQuery(document).ready(function(){
				[].slice.call( document.querySelectorAll( ".tabsA" ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});
			});	
		</script>';
		echo $html;
	}
	
	function pw_livesearch_metaboxname_export(){
		global $pw_livesearch_fields_variable_export,$post;
		
		// Use nonce for verification  
		$html= '<input type="hidden" name="show_custom_meta_box_livesearch_grid_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
		
		foreach($pw_livesearch_fields_variable_export as $field){
			$html.= '
				<table class="form-table">';
			
			if(isset($field['dependency']))  
				{
					$html.=pw_livesearch_dependency($field['id'],$field['dependency']);	
				}
				
				// get value of this field if it exists for this post  
				$meta = get_post_meta($post->ID, $field['id'], true);  
				// begin a table row with 
				if($field['type']=='hidden')
				{
					$html.= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />';
					continue;
				}
				
				// begin a table row with  
				$style='';
				
				if($field['type']=='notype')
					$style='style="border-bottom:solid 1px #ccc"';
					
				$html.= '<tr class="'.$field['id'].'_field" '.$style.'>  
	
						<th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
						<td>';  
						switch($field['type']) {  
						
							case 'text':  
	
								$html.= '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" />
								';  
							break; 
							
							case 'disable_text':  
								
								global $post;
								$shortcode='[pw-ajax-live-search id="'.$post->ID.'"]';

	
								$html.= "<input disabled type='text' name='$field[id]' id='$field[id]' value='$shortcode' />";
							
							break; 
							
							case 'textarea':  
								$html.= '<textarea style="  height: 200px;width: 100%;" name="'.$field['id'].'" id="'.$field['id'].'">'.$meta.'</textarea>
								<br /><span class="description">'.$field['desc'].'</span>	';  
							break; 
						}
				$html.='</td>
					</tr>
				';		
		}
		$html.='</table>';
		echo $html;
	}
	
	
	function pw_livesearch_save_custom_meta ($post_id) { 
		
		global $pw_livesearch_fields_variable,
		
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
		$pw_livesearch_metaboxname_fields_resultbox,
		
		//Export
		$pw_livesearch_fields_variable_export
		;
		
		// verify nonce
		if(isset($_POST) && !empty($_POST)){
			
			//die(print_r($_POST));
			
			if (isset($_POST['show_custom_meta_box_livesearch_grid_nonce']) && !wp_verify_nonce($_POST['show_custom_meta_box_livesearch_grid_nonce'], basename(__FILE__)))
				return $post_id;
		
		// check autosave  
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)  
				return $post_id;  
			// check permissions  
			if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {  
				if (!current_user_can('edit_page', $post_id))  
					return $post_id;  
				} elseif (!current_user_can('edit_post', $post_id)) {  
					return $post_id;  
			}  
			
			foreach($pw_livesearch_fields_variable as $var){
				if($var=='pw_livesearch_metaboxname_fields_section_variable')
				{
					for($k=1;$k<5;$k++)
					{
						$j=1;
						foreach($pw_livesearch_metaboxname_fields_section_variable as $section_var){
							$j++;
							foreach($$section_var as $field){
								
								$field['id']=$field['id'].'-'.$k;
								
								if(!isset($_POST[$field['id']])){
									delete_post_meta($post_id, $field['id']);  
									continue;
								}
				
								$post = get_post($post_id);
								$category = $_POST[$field['id']];  
								wp_set_post_terms( $post_id, $category, $field['id'],false );
				
								$old = get_post_meta($post_id, $field['id'], true);  
								$new = $_POST[$field['id']];  
								if ('' == $new && ($old||$old==0)) {  
									delete_post_meta($post_id, $field['id'], $old);  
								}elseif (($new ||$new==0) && $new != $old) {  
									update_post_meta($post_id, $field['id'], $new);  
								} 
							}
						}
					}
				}else
				{
					foreach($$var as $field){
						if(!isset($_POST[$field['id']])){
							delete_post_meta($post_id, $field['id']);  
							continue;
						}
		
						$post = get_post($post_id);
						$category = $_POST[$field['id']];  
						wp_set_post_terms( $post_id, $category, $field['id'],false );
		
						$old = get_post_meta($post_id, $field['id'], true);  
						$new = $_POST[$field['id']];  
						if ('' == $new && ($old||$old==0)) {  
							delete_post_meta($post_id, $field['id'], $old);  
						}elseif (($new ||$new==0) && $new != $old) {  
							update_post_meta($post_id, $field['id'], $new);  
						} 
					}
				}
			}
			
			
			
			//EXPORT METABOX
			foreach($pw_livesearch_fields_variable_export as $field){
				if(!isset($_POST[$field['id']])){
					delete_post_meta($post_id, $field['id']);  
					continue;
				}
	
				$post = get_post($post_id);
				$category = $_POST[$field['id']];  
				wp_set_post_terms( $post_id, $category, $field['id'],false );
	
				$old = get_post_meta($post_id, $field['id'], true);  
				$new = $_POST[$field['id']];  
				if ('' == $new && ($old||$old==0)) {  
					delete_post_meta($post_id, $field['id'], $old);  
				}elseif (($new ||$new==0) && $new != $old) {  
					update_post_meta($post_id, $field['id'], $new);  
				} 
			}
				

		}		
	
		
	} 
	 
	add_action('save_post', 'pw_livesearch_save_custom_meta');  
?>