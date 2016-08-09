<?php
	//FETCH TAXONOMY IN BUILD QUERY IN ADMIN LIST
	add_action('wp_ajax_pw_livesearch_taxonomy_fetch', 'pw_livesearch_taxonomy_fetch');
	add_action('wp_ajax_nopriv_pw_livesearch_taxonomy_fetch', 'pw_livesearch_taxonomy_fetch');
	function pw_livesearch_taxonomy_fetch() {
		global $wpdb,$post;
		
		$param_line ='';
		$option_data='';
		$post_name=$_POST['post_selected'];
		$field_id=$_POST['field_id'];
				
		$option_data='';
		$param_line='';
		$in_option_data=$ex_option_data='';
		
		$all_tax=get_object_taxonomies( $post_name );
		//$all_tax = array_diff($all_tax,array('post_tag'));
		$original_query = $post;
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
						<input type="checkbox" data-input="post_type" value="'.$tax.'" id="pw_checkbox_'.$tax.'" name="'.$field_id.'[taxonomy_checkbox][]" class="pw_taxomomy_checkbox" '.$checked.'> 
						'.$label.'
					</label>';
					
	
					$param_line_exclude =$param_line_include = '<select name="'.$field_id.'[in_'.$tax.'][]" class="chosen-select-build" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Inclulde ',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
					$param_line_exclude = '<select name="'.$field_id.'[ex_'.$tax.'][]" class="chosen-select-build" multiple="multiple" style="width: 531px;" data-placeholder="'.__('Choose Exclude',__PW_LIVESEARCH_TEXTDOMAIN__).' '.$label.' ..." id="pw_'.$tax.'">';
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
				<select name="'.$field_id.'[in_ids][]" style="width: 531px;" class="chosen-select-build" multiple="multiple" data-placeholder="'.__('Choose Include Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
					$param_line.= $in_option_data.'
				</select>
						  ';	
			
			$param_line .='
				<select name="'.$field_id.'[ex_ids][]" style="width: 531px;" class="chosen-select-build" multiple="multiple" data-placeholder="'.__('Choose Exclude Product(s) ...',__PW_LIVESEARCH_TEXTDOMAIN__).' ..." id="pw_post_id">';
					$param_line.= $ex_option_data.'
				</select>
			</div>';	
		}
		$param_line.='
			<script type="text/javascript"> 
				jQuery(document).ready(function(){
					if(jQuery(".chosen-select-build").is(":visible")) {
						setTimeout(function(){
							if(jQuery(".chosen-select-build").is(":visible")) {
								jQuery(".chosen-select-build").chosen();
							}	
						},100);	
					}
				});
			</script>
		';
		
		
		echo $param_line;
		wp_die();
	}
	
	//FETCH TAXONOMY IN BUILD QUERY IN ADMIN LIST
	add_action('wp_ajax_pw_livesearch_set_default', 'pw_livesearch_set_default');
	add_action('wp_ajax_nopriv_pw_livesearch_set_default', 'pw_livesearch_set_default');
	function pw_livesearch_set_default() {
		global $default_search_id;
		$default_search_id=$_POST['id'];
		$rand_id=$_POST['rand_id'];
		require __PW_LIVESEARCH_ROOT_DIR__."/frontend/frontend.php";
		exit(0);
	}
	
	
	//FETCH TAXONOMY IN BUILD QUERY IN ADMIN LIST
	add_action('wp_ajax_pw_livesearch_search_statistics', 'pw_livesearch_search_statistics');
	add_action('wp_ajax_nopriv_pw_livesearch_search_statistics', 'pw_livesearch_search_statistics');
	function pw_livesearch_search_statistics() {
		parse_str($_POST['postdata'], $my_array_of_vars);
		$keyword=esc_html(trim($my_array_of_vars['pw_livesearch_q']));
		
		global $wpdb;
		$table_name = $wpdb->prefix . "pw_livesearch_statistics";
		$charset_collate = $wpdb->get_charset_collate();
        $query = "
			CREATE TABLE IF NOT EXISTS `$table_name` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`search_id` int(11) NOT NULL,
				`keyword` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
				`num` int(11) NOT NULL,
				`last_date` datetime NOT NULL,
				PRIMARY KEY (`id`)
			) $charset_collate AUTO_INCREMENT=1 ;
		";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $query );
		
		/*if($wpdb->update($table_name,array('num'=>,'last_date'),array( 'keyword' => $my_array_of_vars['pw_livesearch_q'] ),))*/
	
		 $postids = $wpdb->get_col("SELECT id FROM $table_name WHERE keyword = '".trim($keyword)."' "); 
		 
		if ( $postids && trim($keyword)!='') 
		{ 
		
			$update_query="
			UPDATE $table_name SET num = num + 1,last_date=".current_time( 'timestamp', 0 )."
			WHERE keyword = '".trim($my_array_of_vars['pw_livesearch_q'])."'";
			dbDelta( $update_query );
			
		}else if($keyword!='')
		{
			$wpdb->insert( 
				$table_name, 
				array( 
					'id' => '', 
					'search_id' => $my_array_of_vars['pw_livesearch_search_id'], 
					'keyword' => $keyword, 
					'num' => '1', 
					'last_date' => current_time( 'timestamp', 0 ), 
				) 
			);
		}
				
		exit(0);
	}
	
	
	//FRONT END AJAX
	add_action('wp_ajax_pw_livesearch_search', 'pw_livesearch_search');
	add_action('wp_ajax_nopriv_pw_livesearch_search', 'pw_livesearch_search');
	function pw_livesearch_search() {
		
		global $wpdb,$pw_livesearch_class;
		
		$nonce = $_POST['nonce'];
		
		if(!wp_verify_nonce( $nonce, 'pw_livesearch_nonce' ) )
		{
			$arr = array(
			  'success'=>'no-nonce',
			  'products' => array()
			);
			print_r($arr);
			die();
		}
		
		$html='';
		
		//Convert String of post date to separate index 
		parse_str($_POST['postdata'], $my_array_of_vars);
		
		////////////FETCH SEARCH FIELDS////////////////////
		$pw_livesearch_search_id=(isset($my_array_of_vars['pw_livesearch_search_id']) ? $my_array_of_vars['pw_livesearch_search_id']:"");
		$q=(isset($my_array_of_vars['pw_livesearch_q']) ? esc_html($my_array_of_vars['pw_livesearch_q']):"");
		
		
		if($q!='')
		{
			
			///////////////////////////////////
			//APPLY SEARCH QUERY TEXT ON SECTIONS
			///////////////////////////////////
			$search_id=$pw_livesearch_search_id;
			$pw_livesearch_class->fetch_custom_fields($search_id);
			
			$section_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number','custom_field','4');
			for($i=1;$i<=$section_number;$i++){
				$section_fetch_content='';
				$section_fetch_content=require __PW_LIVESEARCH_ROOT_DIR__."/frontend/fetch_section_value.php";
				
				$html.=$section_fetch_content.'@!';
			}
			
			
		}else
		{
			///////////////////////////////////
			//AFTER DELETE SEARCH TEXT, SECTION VALUE RETURN TO DEFAULT VALUE
			///////////////////////////////////
			
			$search_id=$pw_livesearch_search_id;
			$pw_livesearch_class->fetch_custom_fields($search_id);
			
			$default_value=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'default_value','custom_field','');
			
			$section_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'section_number','custom_field','4');
			for($i=1;$i<=$section_number;$i++){
				
				
				
				$section_fetch_content='';
				/*if($default_value!=''){
					$section_fetch_content=require __PW_LIVESEARCH_ROOT_DIR__."/frontend/fetch_section_value.php";
					//$section_fetch_content.='#!';
				}else
				{
					$section_fetch_content=__("No Content Default!",__PW_LIVESEARCH_TEXTDOMAIN__);
				}*/
				$section_fetch_content=require __PW_LIVESEARCH_ROOT_DIR__."/frontend/fetch_section_value.php";
				
				
				$html.=$section_fetch_content.'@!';
			}
		}
		
		//header('Content-type: application/json');
		$response = array('html'=>$html);
		echo json_encode($response, JSON_PRETTY_PRINT);
		
		//echo $html;
		
		die();
	}
	
?>