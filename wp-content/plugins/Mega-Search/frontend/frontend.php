<?php

	global $wpdb,$pw_livesearch_class;
	global $default_search_id;
	if($default_search_id!='')
	{
		$id=$default_search_id;
		//$rand_id =$default_search_id.'_'.rand(0,1000);
	}
	
	//$target_field=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'target_field',array('title'));
	
	
	
	////////////FETCH SEARCH FIELDS////////////////////
	$args = array(
		'post_type'  => 'pw_livesearch',
		'post__in'=>array($id)
	);

	$final_query = new WP_Query( $args );

	//die($final_query->request);
	
	while ( $final_query->have_posts() ) {	
	
		$final_query->the_post();
		$search_id=$final_query->post->ID;
		
		
		$pw_livesearch_class->fetch_custom_fields($search_id);
		$section_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number','custom_field','1');
		$section_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_type','custom_field','t11');
		$search_html='';
		
		
		//////////////////////////////////////
		//SEARCH BOX FORM
		/////////////////////////////////////
		
		///AUTOCOMPLETE OPTIONS//
		$autocomplete_source=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source');
		$autocomplete_enable=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_on');
		
		if($autocomplete_enable)
			$search_html.=include("data.php");

        $place_holder=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_placeholder','custom_field',__('Type Some Word...',__PW_LIVESEARCH_TEXTDOMAIN__));

        $text_box_show_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon','custom_field','');

        $text_box_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon','custom_field','');
		
		$search_box_layout=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_layout','custom_field','');
		
		$search_box_dir=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box__direction','custom_field','ltr');
		
		$custom_class=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_class','custom_field','');
		///AUTOCOMPLETE OPTIONS//
		
		$search_html.='
		<div class="ls-search-box ls-'.$search_box_layout.' ls-'.$search_box_dir.' '.$custom_class.'" id="pw_main_search_main_result_'.$rand_id.'" >
		
		<form id="pw_livesearch_form_'.$rand_id.'" method="post">';
		
		if($autocomplete_enable && $autocomplete_source=='serach_statistics'){
			$search_html.='
			
				<input type="text" name="pw_livesearch_q" id="autocomplete-ajax" class="autocomplete-ajax autocomplete-ajax-main ls-search-input" placeholder="'.$place_holder.'" />';
				if($text_box_show_icon && $text_box_icon!='')
				{
					$search_html.='
					<div class="ls-search-btn">
						<i class="fa '.$text_box_icon.'"></i>
					</div><!--ls-search-btn -->
					';
				}
				
			$search_html.='';
		}elseif($autocomplete_enable && $autocomplete_source=='post_title'){
			$search_html.='
				<input type="text" name="pw_livesearch_q" class="ls-search-input" id="autocomplete_'.$rand_id.'" placeholder="'.$place_holder.'" />
			';
			if($text_box_show_icon && $text_box_icon!='')
            {
                $search_html.='
                <div class="ls-search-btn">
                    <i class="fa '.$text_box_icon.'"></i>
                </div><!--ls-search-btn -->
                ';
            }
		}else{
			$search_html.='
			<input type="text" name="pw_livesearch_q" class="ls-search-input" placeholder="'.$place_holder.'" />';
            if($text_box_show_icon && $text_box_icon!='')
            {
                $search_html.='
                <div class="ls-search-btn">
                    <i class="fa '.$text_box_icon.'"></i>
                </div><!--ls-search-btn -->
                ';
            }

		}
			
		///////////////////////////////////	
		$search_html.='
			<input type="hidden" name="pw_livesearch_search_id" value="'.$search_id.'"/>
			<input type="hidden" name="pw_livesearch_search_section" value="" id="pw_livesearch_search_section_'.$rand_id.'"/>
		</form>';
		
		

		//////////////////////////////////////
		//SEARCH RESULT BOX SECTIONS
		/////////////////////////////////////
		$result_box_width=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_width','custom_field','700');
		
		$result_box_height=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_height','custom_field','500');
		
		$result_box_bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_color','custom_field','#ffffff');
		
		
		$default_value=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'default_value','custom_field','');
		
		
		/*$search_html.='<div style="width:'.$result_box_width.'px;height:'.$result_box_height.'px;background-color:'.$result_box_bg_color.';display:none" id="pw_main_search_result_'.$rand_id.'">';
		for($i=1;$i<=$section_number;$i++){
			
			
			
			$section_fetch_content='';
			if($default_value!=''){
				$section_fetch_content=include("fetch_section_value.php");
			}else
			{
				$section_fetch_content=__("No Content Default!",__PW_LIVESEARCH_TEXTDOMAIN__);
			}
			
			$bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_color-'.$i,'custom_field','#cccccc');
			$search_html.='<div id="pw_livesearch_result_'.$rand_id.'_'.$i.'" style="background-color:'.$bg_color.';border:1px solid #ccc">'.$section_fetch_content.'</div>';
		}
		$search_html.='</div>';*/
		
		$custom_css='';
		
		
		$search_html.='
		<div class="ls-result" style="display:none" id="pw_main_search_result_'.$rand_id.'">
			<div class="pw_ls_loading" id="pw_loading_'.$rand_id.'"><span class="ls-loading-img"></span></div>
            <div class="full-content">';
			$section_num=substr($section_type,1,1);
			$section_type=substr($section_type,2,1);
			
			for($i=1;$i<=$section_number;$i++){		
				$section_fetch_content='';
				if($default_value!=''){
					//$section_fetch_content=include("fetch_section_value.php");
				}else
				{
					//$section_fetch_content=__("No Content Default!",__PW_LIVESEARCH_TEXTDOMAIN__);
				}
				
				$bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_color-'.$i,'custom_field','#cccccc');
				
				$section_title_show=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_show-'.$i,'custom_field','');
				$section_title=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_text-'.$i,'custom_field','');
				
				$section_title_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_icon-'.$i,'custom_field','');
				
				
				
				$search_html.='
				<div class="ls-result-sec ls-sec'.$section_num.'-t'.$section_type.'-c'.$i.'" id="ls-result-sec-'.$rand_id.'-'.$i.'">';
					if($section_title_show)
					{	
					$search_html.='
					<div class="ls-sect-title">
						<span><i class="fa '.$section_title_icon.'"></i>'.$section_title.'</span>
					</div>';
					}
					$search_html.='
					<div class="ls-content-s" id="pw_livesearch_result_'.$rand_id.'_'.$i.'">
					'.$section_fetch_content.'
					</div><!--overview -->
					<div class="ls-sect-readmore_'.$rand_id.'_'.$i.' read-more" data-rand-id="'.$rand_id.'" >
					</div>
                </div>';
			}
			
        $search_html.='
		 </div>
            
        </div><!--ls-result -->
		';        
		
		//////////////CUSTOM CSS//////////////     
		/*if(!function_exists('livesearch_custom_css'))
			require_once('custom_css.php');  */  
       // livesearch_custom_css($rand_id);
		
		////////////////CUSTOM JS/////////////////
		include("frontend_custom_search_js.php");
		//////////////////////////////////
		
		$search_html.='</div><!--END MAIN SEARCH DIV-->';
		
		//////////////////////////////////////
		//SEARCH TYPE FRONT-END : GENERAL- POPUP - STICKY - FULLSCREEN
		/////////////////////////////////////
		$search_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type','custom_field','general-type');
		$search_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon','custom_field','');
		$search_text=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_title','custom_field','');
		$popup_animation=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'popup_animation','custom_field','pop');
		
		///SEARCH BOX  SETTING
		$sticky_position=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_position','custom_field','');
		$sticky_top_btn_position=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_top_align','custom_field','center');
		
		
//$search_type='general-type';
		switch($search_type){
			case "general-type":
			{
				include("templates/general_search.php");
				return $final_html;
			}
			break;
			
			case "popup-type":
			{
				include("templates/popup_search.php");
				return $final_html;
			}
			break;
			
			case "sticky-type":
			{
				include("templates/sticky_search.php");
				return $final_html;
			}
			break;
			
			case "fullscreen-type":
			{
				include("templates/fullscreen_search.php");
				return $final_html;
			}
			break;
		}
		
	}
	wp_reset_query();
	////////////FETCH SEARCH FIELDS////////////////////
	
	
?>