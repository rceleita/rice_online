<?php

	function livesearch_custom_css($rand_id=''){
		
		global $pw_livesearch_class;
		
		wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'custom-css', __PW_LIVESEARCH_CSS_URL__ . '/front-end/custom-css.css', array() , null);
		$style='';
		
		$imported_font = array('inherit'); 
		$search_btn_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_font','custom_field','inherit');
		if ($search_btn_font['font-family']!='inherit') {
			$imported_font[] = $search_btn_font['font-family']; 
		} 
		//textbox font family
		$text_box_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_font','custom_field','inherit');
		if ($text_box_font['font-family']!='inherit') {
			$imported_font[] = $text_box_font['font-family']; 
		} 
		
		//Section Font Family
		$section_number=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number'];
		$section_type=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'section_type'];
		
		$section_num=substr($section_type,1,1);
		$section_type=substr($section_type,2,1);
		
		for($i=1;$i<=$section_number;$i++){		
			//ITEM FONT FAMILY	
			$section_item_title_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_text-'.$i,'custom_field','inherit');
			if ($section_item_title_font['font-family']!='inherit') {
				$imported_font[] = $section_item_title_font['font-family']; 
			}
			$section_item_meta_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_meta-'.$i,'custom_field','inherit');
			if ($section_item_meta_font['font-family']!='inherit') {
				$imported_font[] = $section_item_meta_font['font-family']; 
			}
			$section_item_excerpt_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_excerpt-'.$i,'custom_field','inherit');
			if ($section_item_excerpt_font['font-family']!='inherit') {
				$imported_font[] = $section_item_excerpt_font['font-family']; 
			}
			
			//SECTION TITLE
			$section_title_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_font-'.$i,'custom_field','inherit');
			if (isset($section_title_font['font-family']) && $section_title_font['font-family']!='inherit') {
				$imported_font[] = $section_title_font['font-family']; 
			}
			 
		}//end foreach
		$imported_font= array_filter(array_unique($imported_font));
		$sep='|';$font_family='';
		foreach ( $imported_font as $font ){
			if ($font_family==''){$sep='';}
			if ($font!='inherit')
				$font_family .= $sep . $font;
			$sep='|';
		}

		if (($font_family!='inherit') && ($font_family!='')){
			$style .= '
					@import url(http://fonts.googleapis.com/css?family='. $font_family.');';
		}
			
		////////////////Display CSS - TAB 1//////////////////
		$search_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_box_type','custom_field','general-type');
		
		
		
		///////////////Public Setting/////////////////
		$icon_color_setting=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_icon_color','custom_field','');
		
		if(isset($icon_color_setting["bg-color"]))
			$style.='
			.ls-popbtn-'.$rand_id.' , 
			.ls-fullbtn-'.$rand_id.' , 
			.ls-sticky-'.$rand_id.' .ls-sticky-btn ,
			.ls-sticky-'.$rand_id.' .ls-sticky-search-cnt,
			.ls-top-sticky-'.$rand_id.' .ls-top-sticky-btn,
			.ls-top-sticky .ls-top-sticky-close-'.$rand_id.' 

					{background-color: '.$icon_color_setting["bg-color"].'}
					';
		if(isset($icon_color_setting["bg-hcolor"]))
			$style.='.ls-popbtn-'.$rand_id.':hover , 
			.ls-fullbtn-'.$rand_id.':hover ,  
			.ls-sticky-'.$rand_id.' .ls-sticky-btn:hover,
			.ls-top-sticky-'.$rand_id.' .ls-top-sticky-btn:hover
					 {background-color: '.$icon_color_setting["bg-hcolor"].'}
					 ';
		if(isset($icon_color_setting["text-color"]))
			$style.='.ls-popbtn-'.$rand_id.' , .ls-popbtn-'.$rand_id.' i ,
			.ls-fullbtn-'.$rand_id.' , .ls-fullbtn-'.$rand_id.' i ,
			.ls-sticky-'.$rand_id.' .ls-sticky-btn, 
			.ls-sticky-'.$rand_id.'  .ls-sticky-btn i ,
			.ls-top-sticky-'.$rand_id.' .ls-top-sticky-btn
			
					{color: '.$icon_color_setting["text-color"].'}
					';
		if(isset($icon_color_setting["text-hcolor"]))
			$style.='.ls-popbtn-'.$rand_id.':hover , .ls-popbtn-'.$rand_id.':hover i ,
			.ls-fullbtn-'.$rand_id.':hover , .ls-fullbtn-'.$rand_id.':hover i ,
			.ls-sticky-'.$rand_id.'  .ls-sticky-btn:hover, 
			.ls-sticky-'.$rand_id.'  .ls-sticky-btn:hover i ,
			.ls-top-sticky-'.$rand_id.' .ls-top-sticky-btn:hover
					 {color: '.$icon_color_setting["text-hcolor"].'}
					 ';		
		
		
		//BTN FONT STYLE
		$search_btn_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_font','custom_field','');
		$search_btn_font_family=explode(':',str_replace('+',' ',$search_btn_font["font-family"]));
		
		$style.='
			.ls-popbtn-'.$rand_id.' , 
			.ls-fullbtn-'.$rand_id.' {
				font-size:'.($search_btn_font['size']!=''?$search_btn_font['size'].'px':'13px').';
				font-family:'.$search_btn_font_family[0].';
				
			}
		';
		
		//BTN BORDER STYLE
		$search_btn_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_border_set','custom_field','');
			$style.='
			.ls-popbtn-'.$rand_id.' , 
			.ls-fullbtn-'.$rand_id.' {
				border-color:'.($search_btn_border['color']!=''?$search_btn_border['color']:'inherit').';
				border-style:'.($search_btn_border['type']!=''?$search_btn_border['type']:'inherit').';
				
				border-top-width:'.($search_btn_border['top']!=''?$search_btn_border['top'].'px':'inherit').';
				border-right-width:'.($search_btn_border['right']!=''?$search_btn_border['right'].'px':'inherit').';
				border-bottom-width:'.($search_btn_border['bottom']!=''?$search_btn_border['bottom'].'px':'inherit').';
				border-left-width:'.($search_btn_border['left']!=''?$search_btn_border['left'].'px':'inherit').';
			}
			';
		//BTN HEIGHT & RADIUS
		$search_bth_height=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_btn_height','custom_field','40');
		$search_btn_radius=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'btn_border_radius_set','custom_field','0');
		$style.='
			.ls-popbtn-'.$rand_id.' , 
			.ls-fullbtn-'.$rand_id.' {
				height:'.$search_bth_height.'px;
				line-height:'.$search_bth_height.'px;				
				-webkit-border-radius:'.$search_btn_radius.'px;
				-moz-border-radius:'.$search_btn_radius.'px;
				border-radius:'.$search_btn_radius.'px;
			}';
		
		
		switch($search_type){
			case "general-type":
			{
				
			}
			break;
			
			case "popup-type":
			{
				if(isset($icon_color_setting["bg-color"]))
					$style.='.ls-popbtn {background-color: '.$icon_color_setting["bg-color"].'}';
					$overlay_back=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_overlay_color','custom_field','#000000');
					list($r, $g, $b) = sscanf($overlay_back, "#%02x%02x%02x"); 
					$overlay_back ='rgba('.$r.','.$g.','.$b.', 0.8);';
					$style.='.ls-popup-overlay-'.$rand_id.'{ 
					 	background:'.$overlay_back.';
					 }';
					 
					 $popup_back = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_bg_color','custom_field','#ffffff');
					 $popup_radius=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'popup_border_radius_set','custom_field','0');
					 $style.='.ls-popup-overlay-'.$rand_id.' .ls-popup-cnt{ 
					 	background:'.$popup_back.';
						-moz-border-radius:'.$popup_radius.'px;
						-webkit-border-radius:'.$popup_radius.'px;
						border-radius:'.$popup_radius.'px;
					 }';
			}
			break;
			
			case "sticky-type":
			{
				$sticky_back = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_bg_color','custom_field','#ffffff');
				
				$sticky_margin_top=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_margin_top','custom_field','100');
				
				$sticky_padding=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'sticky_top_padding','custom_field','');
				$sticky_padding_top=($sticky_padding['top']!='')?$sticky_padding['top']:'0';
				$sticky_padding_right=($sticky_padding['right']!='')?$sticky_padding['right']:'0';
				$sticky_padding_bottom=($sticky_padding['bottom']!='')?$sticky_padding['bottom']:'0';
				$sticky_padding_left=($sticky_padding['left']!='')?$sticky_padding['left']:'0';
				
				$text_height = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_height','custom_field','40');
				$sticky_top_val = $text_height + $sticky_padding_top + $sticky_padding_bottom+5;
				$style.='.ls-sticky-'.$rand_id.'{ top:'.$sticky_margin_top.'px; }';
				//top sticky
				$style.='
				.ls-top-sticky-'.$rand_id.'{
					background:'.$sticky_back.';
					
					padding-top:'.$sticky_padding_top.'px;
					padding-right:'.$sticky_padding_right.'px;
					padding-bottom:'.$sticky_padding_bottom.'px;
					padding-left:'.$sticky_padding_left.'px;
					
					top:-'.$sticky_top_val.'px;
				}
				.ls-top-sticky .ls-top-sticky-btn-'.$rand_id.' 
				 {
					height:'.$search_bth_height.'px;
					width:'.$search_bth_height.'px;
					bottom:-'.$search_bth_height.'px;
					line-height:'.$search_bth_height.'px;	
				}
				.ls-top-sticky .ls-top-sticky-close-'.$rand_id.' 
				 {
					height:'.$search_bth_height.'px;
					width:'.$search_bth_height.'px;
					line-height:'.$search_bth_height.'px;	
					margin-bottom:-'.($search_bth_height/2).'px;
				}';
				$style.='
				.ls-top-sticky .ls-top-sticky-btn-'.$rand_id.' i,.ls-top-sticky .ls-top-sticky-close-'.$rand_id.' i 
				{
					line-height:'.$search_bth_height.'px;
				}';
				//LEFT/RIGHT STICKY
				$style.='
				.ls-sticky-cnt .ls-sticky-btn-'.$rand_id.' 
				 {
					height:'.$search_bth_height.'px;
					width:'.$search_bth_height.'px;
					line-height:'.$search_bth_height.'px;	
				}
				.ls-sticky-cnt .ls-sticky-btn-'.$rand_id.' i 
				 {
					line-height:'.$search_bth_height.'px;	
				}
				
				.ls-sticky-cnt-'.$rand_id.' .ls-sticky-search-cnt{
					height:'.$search_bth_height.'px;
				}
				.ls-sticky-cnt-'.$rand_id.'.ls-left-sticky .ls-sticky-search-cnt{
					left:'.$search_bth_height.'px;
					right:auto;
				}
				.ls-sticky-cnt-'.$rand_id.'.ls-right-sticky .ls-sticky-search-cnt{
					right:'.$search_bth_height.'px;
					left:auto;
				}
				';
				
			}
			break;
			
			case "fullscreen-type":
			{
				 $popup_back = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'search_bg_color','custom_field','#ffffff');
				 $style.='.ls-fullscreen-'.$rand_id.'{ 
					background:'.$popup_back.';
				 }';
			}
			break;
		}
		
		
		
		////////////////Search Box CSS - TAB 2///////////////
		
		$search_box_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_font','custom_field','13');
		$search_box_font_family=explode(':',str_replace('+',' ',$search_box_font["font-family"]));
		//TEXT BOX FONT SIZE & FAMILY
		if(isset($search_box_font["size"]))
			$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input ,  .autocomplete-suggestion , .autocomplete-group {
				font-size:'.$search_box_font["size"].'px;
				font-family:'.$search_box_font_family[0].';
				 }
			';
		//TEXT BOX COLOR	
		if(isset($search_box_font["color"]))
			$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input {color:'.$search_box_font["color"].'; }
			';
		//TEXT BOX BACKGROUND	
		$search_box_back_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_background_color','custom_field','transparent');
		if($search_box_back_color!='')
			$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input,#pw_main_search_main_result_'.$rand_id.' .ls-search-input:focus {background-color:'.$search_box_back_color.'!important; }
			';
		//TEXT BOX WIDTH
		$search_box_width=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_width','custom_field','300');
		$search_box_height=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_height','custom_field','34');
		$main_result_height = $search_box_height + 5;
		
		$style.='#pw_main_search_main_result_'.$rand_id.' {width:'.$search_box_width.'px;height:'.$main_result_height.'px; }
			';
		//TEXT BOX HEIGHT
		$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input {height:'.$search_box_height.'px; line-height:'.$search_box_height.'px; }
			';
		//BORDER STYLE
		$search_box_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_border_set','custom_field','');
		if(isset($search_box_font["size"])){
			$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input, #pw_main_search_main_result_'.$rand_id.' .ls-search-input:focus {
				border-color:'.($search_box_border['color']!=''?$search_box_border['color']:'inherit').'!important;
				border-style:'.($search_box_border['type']!=''?$search_box_border['type']:'inherit').';
				
				border-top-width:'.($search_box_border['top']!=''?$search_box_border['top'].'px':'inherit').';
				border-right-width:'.($search_box_border['right']!=''?$search_box_border['right'].'px':'inherit').';
				border-bottom-width:'.($search_box_border['bottom']!=''?$search_box_border['bottom'].'px':'inherit').';
				border-left-width:'.($search_box_border['left']!=''?$search_box_border['left'].'px':'inherit').';
			}
			';
		}
		else {
			$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input, #pw_main_search_main_result_'.$rand_id.' .ls-search-input:focus {
				border:none!important;
			}
			';
		}
		
		$border_height = ($search_box_border['top']!=''?$search_box_border['top']:0);
		$border_height += ($search_box_border['bottom']!=''?$search_box_border['bottom']:0);	
		$icon_height = $search_box_height-$border_height;
		$style.='
		#pw_main_search_main_result_'.$rand_id.' .ls-search-btn i{
			height:'.$icon_height.'px; 
			line-height:'.$icon_height.'px;
			
		}
		#pw_main_search_main_result_'.$rand_id.'.ls-ltr .ls-search-btn {
			top:'.$search_box_border['top'].'px;
			right:'.$search_box_border['right'].'px;
		}
		#pw_main_search_main_result_'.$rand_id.'.ls-rtl .ls-search-btn {
			top:'.$search_box_border['top'].'px;
			left:'.$search_box_border['left'].'px;
		}';
		
		
		$text_box_radius=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_border_radius','custom_field','0');	
		$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-input {
			-moz-border-radius:'.$text_box_radius.'px;
			-webkit-border-radius:'.$text_box_radius.'px;
			border-radius:'.$text_box_radius.'px;
		}';
		$icon_radius = ($text_box_radius>0?$text_box_radius-1:0);
		$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-btn i {
			-moz-border-radius:0 '.$icon_radius.'px '.$icon_radius.'px 0 ;
			-webkit-border-radius:0 '.$icon_radius.'px '.$icon_radius.'px 0 ;
			border-radius:0 '.$icon_radius.'px '.$icon_radius.'px 0 ;
		}';
		//TEXT BOX ICON
		$text_box_show_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_show_icon','custom_field','');
		if ($text_box_show_icon=='on'){
			//ICON TEXT COLOR
			$search_box_icon_text_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon_color','custom_field','');
			if($search_box_icon_text_color!='')
				$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-btn i {color:'.$search_box_icon_text_color.'; }';
			//ICON BACK COLOR
			$search_box_icon_back_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'text_box_icon_background_color','custom_field','');
			if($search_box_icon_back_color!='')
				$style.='#pw_main_search_main_result_'.$rand_id.' .ls-search-btn i {background-color:'.$search_box_icon_back_color.'; }	';
		}//if $text_box_show_icon==on
		
		////////////////Result Box CSS - TAB 3///////////////
		//WIDHT-HEIGHT
		$result_width=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_width','custom_field','400');
		$result_height=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_height','custom_field','400');	
		
		//PADDING 
		$result_padding=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'padding_set','custom_field','');
		$result_padding_top=($result_padding['top']!='')?$result_padding['top'].'px':'0px';
		$result_padding_right=($result_padding['right']!='')?$result_padding['right'].'px':'0px';
		$result_padding_bottom=($result_padding['bottom']!='')?$result_padding['bottom'].'px':'0px';
		$result_padding_left=($result_padding['left']!='')?$result_padding['left'].'px':'0px';
		
		//BORDER STYLE 
		$result_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'border_set','custom_field','');
		$result_border_color=($result_border['color']!='')?$result_border['color']:'#dddddd';
		$result_border_style=($result_border['type']!='')?$result_border['type']:'solid';
		$result_border_top=($result_border['top']!='')?$result_border['top'].'px':'1px';
		$result_border_right=($result_border['right']!='')?$result_border['right'].'px':'1px';
		$result_border_bottom=($result_border['bottom']!='')?$result_border['bottom'].'px':'1px';
		$result_border_left=($result_border['left']!='')?$result_border['left'].'px':'1px';
		
		//RADIUS 
		$result_radius_tl = $result_radius_tr = $result_radius_br = $result_radius_bl ='0px';
		$result_active_radius = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'active_border_radius','custom_field','');
		if ($result_active_radius){
			$result_radius=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'border_radius_set','custom_field','');
			$result_radius_tl=($result_radius['top']!='')?$result_radius['top'].'px':'0px';
			$result_radius_tr=($result_radius['right']!='')?$result_radius['right'].'px':'0px';
			$result_radius_br=($result_radius['bottom']!='')?$result_radius['bottom'].'px':'0px';
			$result_radius_bl=($result_radius['left']!='')?$result_radius['left'].'px':'0px';
		}
		
		//SHADOW 
		$result_shadow_hor = $result_shadow_ver = $result_shadow_blur = $result_shadow_sp ='0px';
		$result_shadow_color='#333';
		$result_shadow_opacity='1';
		$result_shadow_type='outline';
		$result_active_shadow = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'box_enable_shadow','custom_field','');
		if ($result_active_shadow){
			$result_shadow=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'box_shadow_set','custom_field','');
			$result_shadow_hor=($result_shadow['hor-len']!='')?$result_shadow['hor-len'].'px':'0px';
			$result_shadow_ver=($result_shadow['ver-len']!='')?$result_shadow['ver-len'].'px':'0px';
			$result_shadow_blur=($result_shadow['blur-radius']!='')?$result_shadow['blur-radius'].'px':'0px';
			$result_shadow_sp=($result_shadow['spread-radius']!='')?$result_shadow['spread-radius'].'px':'0px';
			
			$result_shadow_opacity=($result_shadow['opacity']!='')?$result_shadow['opacity']:'1';
			list($r, $g, $b) = sscanf($result_shadow['color'], "#%02x%02x%02x"); 
			$result_shadow_color ='rgba('.$r.','.$g.','.$b.','.$result_shadow_opacity.');';
		
			$result_shadow_type=($result_shadow['type']!='')?$result_shadow['type']:'outline';
		}
		
		
		//BACKGROUND
		$result_back_color = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_color','custom_field','transparent');
		$result_back_img_id= $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_image','custom_field','');
		$result_back_img  = array('');
		$result_back_size = 'inherit';
		$result_back_pos  = 'inherit';
		$result_back_rep  = 'no-repeat';
		if ( $result_back_img_id ){
			$result_back_img = wp_get_attachment_image_src( $result_back_img_id,'full' );
			$result_back_size = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_size','custom_field','inherit');
			$result_back_pos = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_position','custom_field','top left');
			$result_back_rep = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'result_box_background_repeat','custom_field','no-repeat');
		}
		
		$style.='#pw_main_search_result_'.$rand_id.' {
				width: '.$result_width.'px;
				height:'.$result_height.'px;
				max-height:'.$result_height.'px;
				padding-top:'.$result_padding_top.';
				padding-right:'.$result_padding_right.';
				padding-bottom:'.$result_padding_bottom.';
				padding-left:'.$result_padding_left.';
				
				border-top-width:'.$result_border_top.';
				border-right-width:'.$result_border_right.';
				border-bottom-width:'.$result_border_bottom.';
				border-left-width:'.$result_border_left.';
				border-style:'.$result_border_style.';
				border-color:'.$result_border_color.';
				
				-webkit-border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';
				-moz-border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';
				border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';
				
				box-shadow:  '.$result_shadow_hor.' '.$result_shadow_ver.' '.$result_shadow_blur.' '.$result_shadow_sp.' '.$result_shadow_color.' '.$result_shadow_type.';
				
				
				background-color:'.$result_back_color.';
				background-image: url('.$result_back_img[0].');
				background-repeat : '.$result_back_rep.';
				background-position:'.$result_back_pos.';
				background-size:'.$result_back_size.';
				}';	
			
		$style.='#pw_main_search_result_'.$rand_id.' .pw_ls_loading {
			-webkit-border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';
			-moz-border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';
			border-radius: '.$result_radius_tl.' '.$result_radius_tr.' '.$result_radius_br.' '.$result_radius_bl.';	
		}
		';
		
		////////////////Sections CSS - TAB 4/////////////////
		$section_number=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number'];
		$section_type=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'section_type'];
		
		$section_num=substr($section_type,1,1);
		$section_type=substr($section_type,2,1);
		
		for($i=1;$i<=$section_number;$i++){		
			//SECTION BACKGROUND		
			$section_bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_color-'.$i,'custom_field','transparent');
			$section_bg_img_id= $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_image-'.$i,'custom_field','');
			$section_bg_img  = array('');
			$section_bg_size = 'inherit';
			$section_bg_pos  = 'inherit';
			$section_bg_rep  = 'no-repeat';
			if ( $section_bg_img_id ){
				$section_bg_img = wp_get_attachment_image_src( $section_bg_img_id,'full' );
				$section_bg_size = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_size-'.$i,'custom_field','inherit');
				$section_bg_pos = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_position-'.$i,'custom_field','top left');
				$section_bg_rep = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_background_repeat-'.$i,'custom_field','no-repeat');
			}
			
			//SECTION PADDING 
			$section_padding=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_padding_set-'.$i,'custom_field','');
			$section_padding_top=($section_padding['top']!='')?$section_padding['top'].'px':'0px';
			$section_padding_right=($section_padding['right']!='')?$section_padding['right'].'px':'0px';
			$section_padding_bottom=($section_padding['bottom']!='')?$section_padding['bottom'].'px':'0px';
			$section_padding_left=($section_padding['left']!='')?$section_padding['left'].'px':'0px';
			
			//SECTION BORDER STYLE 
			$section_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_border_set-'.$i,'custom_field','');
			$section_border_color=($section_border['color']!='')?$section_border['color']:'#dddddd';
			$section_border_style=($section_border['type']!='')?$section_border['type']:'solid';
			$section_border_top=($section_border['top']!='')?$section_border['top'].'px':'1px';
			$section_border_right=($section_border['right']!='')?$section_border['right'].'px':'1px';
			$section_border_bottom=($section_border['bottom']!='')?$section_border['bottom'].'px':'1px';
			$section_border_left=($section_border['left']!='')?$section_border['left'].'px':'1px';
			
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' {
					background-color: '.$section_bg_color.';	
					background-image: url('.$section_bg_img[0].');
					background-repeat : '.$section_bg_rep.';
					background-position:'.$section_bg_pos.';
					background-size:'.$section_bg_size.';
				
					padding:'.$section_padding_top.' '.$section_padding_right.' '.$section_padding_bottom.' '.$section_padding_left.';	
					
					border-top-width:'.$section_border_top.';
					border-right-width:'.$section_border_right.';
					border-bottom-width:'.$section_border_bottom.';
					border-left-width:'.$section_border_left.';
					border-style:'.$section_border_style.';
					border-color:'.$section_border_color.';	
				}
				#ls-result-sec-'.$rand_id.'-'.$i.' .read-more a{
					bottom:'.$section_padding_bottom.';
				}';
			
			//ITEM SETTING
			
			//item border style
			$item_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_border_set-'.$i,'custom_field','');
			$item_border_color=($item_border['color']!='')?$item_border['color']:'#dddddd';
			$item_border_style=($item_border['type']!='')?$item_border['type']:'solid';
			$item_border_top=($item_border['top']!='')?$item_border['top'].'px':'0px';
			$item_border_right=($item_border['right']!='')?$item_border['right'].'px':'0px';
			$item_border_bottom=($item_border['bottom']!='')?$item_border['bottom'].'px':'0px';
			$item_border_left=($item_border['left']!='')?$item_border['left'].'px':'0px';
			
			//item Hover border style
			$item_hborder=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_border_hover_set-'.$i,'custom_field','');
			$item_hborder_color=($item_hborder['color']!='')?$item_hborder['color']:'#dddddd';
			$item_hborder_style=($item_hborder['type']!='')?$item_hborder['type']:'solid';
			$item_hborder_top=($item_hborder['top']!='')?$item_hborder['top'].'px':'0px';
			$item_hborder_right=($item_hborder['right']!='')?$item_hborder['right'].'px':'0px';
			$item_hborder_bottom=($item_hborder['bottom']!='')?$item_hborder['bottom'].'px':'0px';
			$item_hborder_left=($item_hborder['left']!='')?$item_hborder['left'].'px':'0px';
			
			//item border radius 
			$item_radius_tl = $item_radius_tr = $item_radius_br = $item_radius_bl ='0px';
			$item_radius=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_border_radius_set-'.$i,'custom_field','');
			$item_radius_tl=($item_radius['top']!='')?$item_radius['top'].'px':'0px';
			$item_radius_tr=($item_radius['right']!='')?$item_radius['right'].'px':'0px';
			$item_radius_br=($item_radius['bottom']!='')?$item_radius['bottom'].'px':'0px';
			$item_radius_bl=($item_radius['left']!='')?$item_radius['left'].'px':'0px';
			
			$style.='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item{
				border-top-width:'.$item_border_top.';
				border-right-width:'.$item_border_right.';
				border-bottom-width:'.$item_border_bottom.';
				border-left-width:'.$item_border_left.';
				border-style:'.$item_border_style.';
				border-color:'.$item_border_color.';
				
				-webkit-border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';
				-moz-border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';
				border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';	
			}
			';
			$style.='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item:hover{
				border-top-width:'.$item_hborder_top.';
				border-right-width:'.$item_hborder_right.';
				border-bottom-width:'.$item_hborder_bottom.';
				border-left-width:'.$item_hborder_left.';
				border-style:'.$item_hborder_style.';
				border-color:'.$item_hborder_color.';
			}';
			//thumb radius
			$thumb_shap = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_shape-'.$i,'custom_field','');
			if ($thumb_shap=='inherit_radius'){
				$style .='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item img.inherit_radius-shap{
							-webkit-border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';
							-moz-border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';
							border-radius: '.$item_radius_tl.' '.$item_radius_tr.' '.$item_radius_br.' '.$item_radius_bl.';		
						}
						';
			}
			
			$item_show_thumb=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_thumbnail-'.$i,'custom_field','off');
			if ($item_show_thumb=='off'){
				$style.='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-content{
						margin-left:0px;
				}';
			}
			
			$item_title_font_family_font = $item_meta_font_family_font =$item_excerpt_font_family_font = array('inherit');
			//title font
			$item_title_font_style=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_text-'.$i,'custom_field','');
			$item_title_font_color=($item_title_font_style['color']!='')?$item_title_font_style['color']:'#333333';
			$item_title_font_size=($item_title_font_style['size']!='')?$item_title_font_style['size'].'px':'13px';
			$item_title_font_family=($item_title_font_style['font-family']!='')?$item_title_font_style['font-family']:'inherit';
			$item_title_font_family_font=explode(':',str_replace('+',' ',$item_title_font_family));
			
			$item_txt_hcolor=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_text_color-'.$i,'custom_field','#333333');
			
			//meta font
			$item_meta_font_style=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_meta-'.$i,'custom_field','');
			$item_meta_font_color=($item_meta_font_style['color']!='')?$item_meta_font_style['color']:'#333333';
			$item_meta_font_size=($item_meta_font_style['size']!='')?$item_meta_font_style['size'].'px':'13px';
			$item_meta_font_family=($item_meta_font_style['font-family']!='')?$item_meta_font_style['font-family']:'inherit';
			$item_meta_font_family_font=explode(':',str_replace('+',' ',$item_meta_font_family));
			$item_meta_font_hcolor=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_meta_color-'.$i,'custom_field','#333333');
			
			//excerpt font
			$item_excerpt_font_style=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_excerpt-'.$i,'custom_field','');
			$item_excerpt_font_color=($item_excerpt_font_style['color']!='')?$item_excerpt_font_style['color']:'#333333';
			$item_excerpt_font_size=($item_excerpt_font_style['size']!='')?$item_excerpt_font_style['size'].'px':'13px';
			$item_excerpt_font_family=($item_excerpt_font_style['font-family']!='')?$item_excerpt_font_style['font-family']:'inherit';
			$item_excerpt_font_family_font=explode(':',str_replace('+',' ',$item_excerpt_font_family));
			
			//item background
			$item_bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_background_color-'.$i,'custom_field','transparent');
			$item_bg_hcolor=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_hover_background_color-'.$i,'custom_field','transparent');
			
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item{
				background:'.$item_bg_color.';
			}';
						
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item:hover{
				background:'.$item_bg_hcolor.';
			}';
			
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-title a  ,#ls-result-sec-'.$rand_id.'-'.$i.'  .ls-message-cnt span  {
				color:'.$item_title_font_color.';
				font-size:'.$item_title_font_size.';
				font-family:'.$item_title_font_family_font[0].';
			}';
		
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-title a:hover   {
				color:'.$item_txt_hcolor.';
			}';
			
			$style.='
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-meta{
					line-height:'.$item_meta_font_size.';
				}';
			$style.='
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-meta a,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-meta span,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-price,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-addtocart a
				
				{
					color:'.$item_meta_font_color.';
					font-size:'.$item_meta_font_size.';
					font-family:'.$item_meta_font_family_font[0].';
				}
				';
			$style.='
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-meta a:hover,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.button.add_to_cart_button:hover,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.added_to_cart.wc-forward:hover,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.product_type_variable:hover
				{
					color:'.$item_meta_font_hcolor.';
				}
				';
			$style.='
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.button.add_to_cart_button,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.added_to_cart.wc-forward,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.product_type_variable{
					border-color:'.$item_meta_font_color.';
				}';
			$style.='
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.button.add_to_cart_button:hover,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.added_to_cart.wc-forward:hover,
				#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.product_type_variable:hover{
					border-color:'.$item_meta_font_hcolor.';
				}';
				
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item .ls-result-excerpt{
				color:'.$item_excerpt_font_color.';
				font-size:'.$item_excerpt_font_size.';
				font-family:'.$item_excerpt_font_family_font[0].';	
			}
			';
			
			//skin 2 overlay background
			list($r, $g, $b) = sscanf($item_bg_color, "#%02x%02x%02x"); 
			$grid_overlay_back ='rgba('.$r.','.$g.','.$b.', 0.7);';
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item.ls-grided-style2 .ls-result-content, #ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item.ls-grided-style2 a.ls-result-icon{
				background-color:'.$grid_overlay_back.';
			}
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item.ls-grided-style2 a.ls-result-icon i
			{
				color:'.$item_title_font_color.';
			}';
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-result-item a.ls-result-icon{
				color:'.$item_title_font_color.';
			}';
			
			//ITEM TITLE STYLE
			$title_bg_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_background_text_color-'.$i,'custom_field','transparent');
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-sect-title , #ls-result-sec-'.$rand_id.'-'.$i.' .ls-sect-title span   {
				background-color:'.$title_bg_color.';
			}';
			
			$title_font_family_font= array('inherit');
			$title_font=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_font-'.$i,'custom_field','');
			$title_font_color = (isset($title_font['color']) && $title_font['color']!='')?$title_font['color']:'#333333';
			$title_font_size  = (isset($title_font['size']) && $title_font['size']!='')?$title_font['size']:'13px';
			$title_font_family= (isset($title_font['font-family']) && $title_font['font-family']!='')?$title_font['font-family']:'inherit';
			$title_font_family_font=explode(':',str_replace('+',' ',$title_font_family));
			
			$style.='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-sect-title span   {
				color:'.$title_font_color.';
				font-size:'.$title_font_size.'px;
				font-family:'.$title_font_family_font[0].';
			}';
			$style.='#ls-result-sec-'.$rand_id.'-'.$i.' .ls-sect-title:before   {
				background-color:'.$title_font_color.';
			}';
			$title_icon_color=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'title_icon_color-'.$i,'custom_field','#333333');
			$style.='
			#ls-result-sec-'.$rand_id.'-'.$i.' .ls-sect-title span i  {
				color:'.$title_icon_color.';
			}';
			
			//OTHER SETTING
			$show_more_setting=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_color-'.$i,'custom_field','');
			$show_more_back = (isset($show_more_setting['bg-color']) && $show_more_setting['bg-color']!='')?$show_more_setting['bg-color']:'transparent';
			$show_more_hback = (isset($show_more_setting['bg-hcolor']) && $show_more_setting['bg-hcolor']!='')?$show_more_setting['bg-hcolor']:'transparent';
			$show_more_text = (isset($show_more_setting['text-color']) && $show_more_setting['text-color']!='')?$show_more_setting['text-color']:'#333333';
			$show_more_htext = (isset($show_more_setting['text-hcolor']) && $show_more_setting['text-hcolor']!='')?$show_more_setting['text-hcolor']:'#333333';
			$style .='
				.ls-sect-readmore_'.$rand_id.'_'.$i.' a{
					background-color:'.$show_more_back.';
					color:'.$show_more_text.'!important;
				}
				.ls-sect-readmore_'.$rand_id.'_'.$i.' a:hover{
					background-color:'.$show_more_hback.';
					color:'.$show_more_htext.';
				}
			';
			//SHOWMORE BORDER STYLE 
			$showmore_border=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_border_set-'.$i,'custom_field','');
			$showmore_border_color=($showmore_border['color']!='')?$showmore_border['color']:'#dddddd';
			$showmore_border_style=($showmore_border['type']!='')?$showmore_border['type']:'solid';
			$showmore_border_top=($showmore_border['top']!='')?$showmore_border['top'].'px':'0px';
			$showmore_border_right=($showmore_border['right']!='')?$showmore_border['right'].'px':'0px';
			$showmore_border_bottom=($showmore_border['bottom']!='')?$showmore_border['bottom'].'px':'0px';
			$showmore_border_left=($showmore_border['left']!='')?$showmore_border['left'].'px':'0px';
			
			//SHOWMORE RADIUS 
			
			$showmore_radius = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_border_radius_set-'.$i,'custom_field','0');
			
			$style .='
				.ls-sect-readmore_'.$rand_id.'_'.$i.' a{
					border-top-width:'.$showmore_border_top.';
					border-right-width:'.$showmore_border_right.';
					border-bottom-width:'.$showmore_border_bottom.';
					border-left-width:'.$showmore_border_left.';
					border-style:'.$showmore_border_style.';
					border-color:'.$showmore_border_color.';
					
					-webkit-border-radius: '.$showmore_radius.'px;
					-moz-border-radius: '.$showmore_radius.'px;
					border-radius: '.$showmore_radius.'px;
				}
				';
		}//end for section
		
		
	
	//CUSTOM CSS
	$custom_css = 	$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_css','custom_field','0');
	$style.= $custom_css;
	wp_add_inline_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'custom-css', $style );
}
	
	//add_action('wp_head','livesearch_custom_css');
	
	
?>