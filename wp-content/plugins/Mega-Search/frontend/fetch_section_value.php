<?php

	$section_source_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'source_type-'.$i,'custom_field','manual_data');
	
	switch($section_source_type){
		case "manual_data":
		{
			$section_fetch_content=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'manual_data-'.$i,'custom_field','');
			ob_start();
				echo  do_shortcode($section_fetch_content);
				$section_fetch_content= ob_get_contents();
			ob_get_clean();
		}
		break;
		
		case "fix_structur":
		{
			
		}
		break;
		
		case "stored_data":
		{
			//$section_fetch_content.=(isset($q)?$q:"NO Q");
			
			$post_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'post_number-'.$i,'custom_field','-1');
			
			$post_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'post_type-'.$i,'custom_field','post');

			//Fetch all | Build Query
			$fetch_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'fetch_type-'.$i,'custom_field','all');
				
			$id=$search_id;	
			$fetch_section_value_args=require __PW_LIVESEARCH_ROOT_DIR__.'/includes/pw_build_query.php';

			$fetch_section_value_query = new WPSE_OR_Query( $fetch_section_value_args );
			//if($post_type=='product')
				//echo $fetch_section_value_query->request;
			
			$display_layout=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type-'.$i,'custom_field','list');
			
			$grid_skin=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin-'.$i,'custom_field','ls-grided-item ls-grided-style1');
			$grid_skin=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin-'.$i];
			
			$grid_desktop_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_desktop_col-'.$i];
			
			$grid_tablet_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_tablet_col-'.$i];
			
			$grid_mobile_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_mobile_col-'.$i];
			
			
			
			$enable_carousel=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'enable_carousel-'.$i,'custom_field','no');
						
			$show_title=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_title-'.$i,'custom_field','on');
			
			$show_thumbnail=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_thumbnail-'.$i,'custom_field','');
			
			$show_categories=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_categories-'.$i,'custom_field','');
			
			$categories_count=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'categories_count-'.$i,'custom_field','1');
			
			$show_author=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_author-'.$i,'custom_field','');
			
			$show_comment_no=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_comment_no-'.$i,'custom_field','');
			
			$show_date=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_date-'.$i,'custom_field','');
		
			$show_excerpt=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_excerpt-'.$i,'custom_field','');
		
			$excerpt_source_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'desc_type-'.$i,'custom_field','excerpt');
			
			$excerpt_len=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'excerpt_len-'.$i,'custom_field','10');
			
			$show_addtocart=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_addtocart-'.$i,'custom_field','');
			
			$show_price=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_price-'.$i,'custom_field','');
			
			$show_sale_banner=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_sale_banner-'.$i,'custom_field','');
			
			$show_featured_banner=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_featured_banner-'.$i,'custom_field','');
			
			if($post_type=='product')
			{
				include("addtocart_func.php");
			}
			
			
			if ( $fetch_section_value_query->have_posts() ) {
				
				$display_items_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_item_number-'.$i,'custom_field',$post_number);
				$display_items_number=($display_items_number=="-1" || $display_items_number=='' ? "all":$display_items_number);
				
				if($enable_carousel=='on')
				{
					
					$display_carousel_desktop_items=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_desktop_items-'.$i,'custom_field','3');
					$display_carousel_tablet_items=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_tablet_items-'.$i,'custom_field','2');
					$display_carousel_mobile_items=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_mobile_items-'.$i,'custom_field','1');
					$display_carousel_item_margin=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_item_margin-'.$i,'custom_field','10');
					$display_carousel_slide_speed=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_slide_speed-'.$i,'custom_field','300');
					$display_carousel_auto_play=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_auto_play-'.$i,'custom_field','');
					$display_carousel_slider_loop=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_slider_loop-'.$i,'custom_field','');
					$display_carousel_pause_on_mouse_hover=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_pause_on_mouse_hover-'.$i,'custom_field','');
					$display_carousel_show_control=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_show_control-'.$i,'custom_field','');
					$display_carousel_show_pagination=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_carousel_show_pagination-'.$i,'custom_field','');
					

					$display_carousel_auto_play=(($display_carousel_auto_play) ? "true":"false");
					$display_carousel_slider_loop=(($display_carousel_slider_loop) ? "true":"false");
					$display_carousel_pause_on_mouse_hover=(($display_carousel_pause_on_mouse_hover) ? "true":"false");
					$display_carousel_show_control=(($display_carousel_show_control) ? "true":"false");
					$display_carousel_show_pagination=(($display_carousel_show_pagination) ? "true":"false");
					
					$carousel_settings="speed=$display_carousel_slide_speed-margin=$display_carousel_item_margin-autoplay=$display_carousel_auto_play-loop=$display_carousel_slider_loop-pause=$display_carousel_pause_on_mouse_hover-desktop_item=$display_carousel_desktop_items-tablet_item=$display_carousel_tablet_items-mobile_item=$display_carousel_mobile_items-controls=$display_carousel_show_control-pagination=$display_carousel_show_pagination";
					
					$section_fetch_content.='<div class="pw_ls_loading pw_ls_loading_car" ><span class="ls-loading-img"></span></div><div class="ls-pl-bxslider pl-car-car pl-carousel-layout" data-owl-settting="'.$carousel_settings.'" >';
				}
				$counter=0;
				$query_number=$fetch_section_value_query->found_posts;
				
				while ( $fetch_section_value_query->have_posts() && (($display_items_number=='all') || $counter<$display_items_number)) {
					$counter++;	
					$fetch_section_value_query->the_post();
					//$section_fetch_content.=$fetch_section_value_query->post->ID;
					
					$title='';
					$addtocart='';
					$excerpt='';
					$section_image='';
					$price='';
					
					//////////////////////////////////////////////////////////
					//IF POST TYPE IS PRODUCT
					//////////////////////////////////////////////////////////

					if($post_type=='product' &&  class_exists( 'WooCommerce' )){
						
						$pid=$fetch_section_value_query->post->ID;
						$product = get_product($pid);
						
						
						//////////////TITLE/////////////////////
						$title='';
						if($show_title)
						{
							//$title = '<h3 class="ls-result-title"><a href="'.$product->get_permalink().'">'.$product->get_title().'</a></h3>';
							$variation_label='';
							if(get_post_type($pid)=='product_variation'){
								$all_meta = get_post_meta( $pid );
								foreach ( $all_meta as $name => $value ) {
									if ( ! strstr( $name, 'attribute_' ) ) {
					                     continue;
									}
									if($value[0]!='')
										$variation_label.=' - '.str_replace(array("pa_","attribute_"),"",$name).' : '.$value[0];
								}
							}
							
							 
							$title = '<h3 class="ls-result-title"><a href="'.$product->get_permalink().'">'.$product->get_title().$variation_label .' </a></h3>';
						}
						
						//////////////CATEGORY-TAXONOMY/////////////////////
						$cat_tax='';
						if($show_categories)
						{
							
							$cat= $pw_livesearch_class->get_category_tag( $pid , 'product_cat', '', '<span class="meta-del">/</span>', '', $categories_count);
			
							$tag = $pw_livesearch_class->get_category_tag( $pid , 'product_tag', '', '<span class="meta-del">/</span>', '', $categories_count);
							
							$cat_tax=$cat.'<span class="meta-del">/</span>'.$tag.'<span class="meta-del">/</span>';
						}
						
						//////////////SALE BANNER/////////////////////
						$sale_banner='';
						if($show_sale_banner)
						{
							$sale_price = get_post_meta( $pid, '_sale_price',true);
							if($sale_price!='')
								$sale_banner='<span class="banner-meta">'.__('Sale!',__PW_LIVESEARCH_TEXTDOMAIN__).'</span><span class="meta-del">/</span>';
						}
						
						//////////////FEATURED BANNER/////////////////////
						$featured_banner='';
						if($show_featured_banner)
						{
							$featured = get_post_meta( $pid, '_featured',true);
							if($featured=='yes')
								$featured_banner='<span class="banner-meta">'.__('Featured',__PW_LIVESEARCH_TEXTDOMAIN__).'</span><span class="meta-del">/</span>';
						}
						
						
						/////////////////META TAGS//////////////
						$meta='';
						if($cat_tax!='' || $sale_banner!='' || $featured_banner!='')
						{
							$meta='<div class="ls-result-meta">'.$cat_tax.$sale_banner.$featured_banner.'</div>';
						}
						
						/////////////SHOW THUMBNAIL/////
						$section_image='';
						if($show_thumbnail)
						{
							$thumbnail_id = $product->get_image_id();
							$img_url_thumb = wp_get_attachment_image_src( $thumbnail_id, 'wp_small' );
							$img_url_thumb=$img_url_thumb[0];
							$thumb_shap = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_shape-'.$i,'custom_field','');
							$section_image=($img_url_thumb!='' ? '<img src="'.$img_url_thumb.'" class="'.$thumb_shap.'-shap" />':'');
						}
						
						///////////SHOW EXCERPT//////////
						$excerpt='';
						if($show_excerpt)
						{
							$content_exp=$pw_livesearch_class->excerpt($product->post->post_excerpt,$excerpt_len,'excerpt');
							if($excerpt_source_type=='full_text')
							{
								$content_exp=$pw_livesearch_class->excerpt($product->post->post_content,$excerpt_len,'full_text');
							}
							$excerpt='<div class="ls-result-excerpt">'.$content_exp.'</div>';
						}
						
						///////////SHOW PRICE///////////
						$price='';
						if($show_price)
						{
							$price='<div class="ls-result-price">'.$product->get_price_html().'</div>';
						}
						
						///////////SHOW ADD To CART///////////
						$addtocart='';
						if($show_addtocart)
						{
							$pid=$fetch_section_value_query->post->ID;
							$product_bottun_icon_link=livesearch_add_to_cart_grid('btn_icon_type',$pid);
							$product_bottun_text_link=livesearch_add_to_cart_grid('btn_text_type',$pid);
							
							$addtocart='<div class="ls-result-addtocart">'.$product_bottun_text_link.'</div>';
						}
						
						$section_fetch_content.=
							($enable_carousel=='on' ? "<div class='item'>":"").
							($display_layout=='grid' && $enable_carousel!='on' ? "<div class='$grid_mobile_col $grid_tablet_col $grid_desktop_col'>
		<div class='ls-result-item $grid_skin'>":($display_layout=='grid' && $enable_carousel=='on' ? "<div class='ls-result-item $grid_skin'>":'<div class="ls-result-item">')).
							
								'<a href="'.get_permalink().'">'.$section_image.'</a>'.
								($display_layout=='grid' && $grid_skin=='ls-grided-item ls-grided-style2' ? '<a href="'.get_permalink().'" class="ls-result-icon"><i class="fa fa-link"></i></a>':"").
								'<div class="ls-result-content">'
									.$title
									.$meta
									.($display_layout=='list' || $grid_skin=='ls-grided-item ls-grided-style1' ? $excerpt.$price.$addtocart:"")
								.'</div>'.		
							($display_layout=='grid' && $enable_carousel!='on' ? "</div></div>":($display_layout=='grid' && $enable_carousel=='on' ? "</div>":'</div>')).
							($enable_carousel=='on' ? "</div>":"");
						
						
					}
					else{
						$pid=$fetch_section_value_query->post->ID;
						//////////////////////////////////////////////////////////
						//IF POST IS NOT PRODUCT
						//////////////////////////////////////////////////////////
						
						
						//////////////TITLE/////////////////////
						$title='';
						if($show_title)
						{
							$title = '<h3 class="ls-result-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
						}
						
						//////////////AUTHOR/////////////////////
						$author='';
						if($show_author)
						{
							$author = get_the_author();
							$author_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
							$author = '<a href="'.$author_link.'">'.$author.'</a><span class="meta-del">/</span>';
						}
						
						//////////////COMMENT NO./////////////////////
						$comment_no='';
						if($show_comment_no)
						{
							$comment_number=get_comments_number();
							$comment_link = get_comments_link();
							
							if ( comments_open() ) {
								if ( $comment_number == 0 ) {
									$comment = __('No Comments',__PW_LIVESEARCH_FIELDS_PERFIX__);
								} elseif ( $comment_number > 1 ) {
									$comment = $comment_number .' '. __('Comments',__PW_LIVESEARCH_FIELDS_PERFIX__);
								} else {
									$comment = __('1 Comment',__PW_LIVESEARCH_FIELDS_PERFIX__);
								}
							}
							
							$comment_no = '<a href="'.$comment_link.'">'.$comment.'</a>';
						}
						
						//////////////DATE/////////////////////
						$date='';
						if($show_date)
						{
							$date = get_the_date();
							$date = '<span>'.$date.'</span><span class="meta-del">/</span>';
						}
						
						//////////////CATEGORY-TAXONOMY/////////////////////
						$cat_tax='';
						if($show_categories)
						{
							
							$all_tax=get_object_taxonomies( $post_type );
							$current_value=array();
							if(is_array($all_tax) && count($all_tax)>0){
								foreach ( $all_tax as $tax ) {
									if($tax=="post_tag")
										continue;
									$cat= $pw_livesearch_class->get_category_tag( $pid , $tax, '', '<span class="meta-del">/</span>', '', $categories_count);					
									if($cat!='')
										$cat_tax[]=$cat;
								}
							}
							$cat_tax=implode(' <span class="meta-del">/</span> ',$cat_tax).'<span class="meta-del">/</span>';
						}
						
						/////////////////META TAGS//////////////
						$meta='';
						if($cat_tax!='' || $author!='' || $date!='' || $comment_no!='')
						{
							$meta='<div class="ls-result-meta">'.$author.$cat_tax.$date.$comment_no.'</div>';
						}
						
						//////////SHOW THUMBNAIL///////////
						$section_image='';
						if($show_thumbnail)
						{
							$thumbnail_id = get_post_meta( $fetch_section_value_query->post->ID, '_thumbnail_id',true);
							$src_featured = wp_get_attachment_image_src( $thumbnail_id, 'wp_small' ,0);	
							$thumb_shap = $pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'item_shape-'.$i,'custom_field','');
							$section_image=($src_featured[0]!='' ? '<img src="'.$src_featured[0].'" class="'.$thumb_shap.'-shap" />':'');
						}
						
						////////////SHOW EXCERPT///////////
						$excerpt='';
						if($show_excerpt)
						{
							$content_exp=$pw_livesearch_class->excerpt(get_the_excerpt(),$excerpt_len,'excerpt');
							if($excerpt_source_type=='full_text')
							{
								$content_exp=$pw_livesearch_class->excerpt(get_the_content(),$excerpt_len,'full_text');
							}
							$excerpt='<div class="ls-result-excerpt">'.$content_exp.'</div>';
						}
						
						$section_fetch_content.=
							($enable_carousel=='on' ? "<div class='item'>":"").
							($display_layout=='grid' && $enable_carousel!='on' ? "<div class='$grid_mobile_col $grid_tablet_col $grid_desktop_col'>
		<div class='ls-result-item $grid_skin'>":($display_layout=='grid' && $enable_carousel=='on' ? "<div class='ls-result-item $grid_skin'>":'<div class="ls-result-item">')).
							
								'<a href="'.get_permalink().'">'.$section_image.'</a>'.
								($display_layout=='grid' && $grid_skin=='ls-grided-item ls-grided-style2' ? '<a href="'.get_permalink().'" class="ls-result-icon"><i class="fa fa-link"></i></a>':"").
								'<div class="ls-result-content">'
									.$title
									.$meta
									.($display_layout=='list' || $grid_skin=='ls-grided-item ls-grided-style1' ? $excerpt:"")
								.'</div>'.
							($display_layout=='grid' && $enable_carousel!='on' ? "</div></div>":($display_layout=='grid' && $enable_carousel=='on' ? "</div>":'</div>')).
							($enable_carousel=='on' ? "</div>":"");
						
					}
					
					
				}
				wp_reset_query();
				
				if($enable_carousel=='on')
				{
					$section_fetch_content.='</div>';
				}
				
				
				if($query_number>$display_items_number && isset($_POST['nonce']))
				{
					//////////////////////////////////////////
					$show_more_button=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_button-'.$i,'custom_field','');
					
					$g_show_more_trasnlate=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__."general_show_more_title",__('Show More',__PW_LIVESEARCH_TEXTDOMAIN__));
					
					$show_more_trasnlate=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'show_more_trasnlate-'.$i,'custom_field',$g_show_more_trasnlate);
					
					$showmore_icon=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_icon-'.$i,'custom_field','');
					$showmoreicon='';
					if($showmore_icon)
					{
						$showmoreicon='<i class="fa '.$showmore_icon.'"></i>';
					}
					
					
					$main_showmore_page_id=get_option('my_plugin_page_id');
					$main_showmore_page=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page',$main_showmore_page_id);
					$section_showmore_page=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_page-'.$i,'custom_field',$main_showmore_page);
					
					
					if($section_showmore_page)
						$section_showmore_page=get_permalink( $section_showmore_page );
					
					$showmore_link='';
					if($show_more_button)
					{
						$showmore_link='<a href="'.$section_showmore_page.'" data-section-id="'.$i.'" class="pw_ls_showmore_link'.$i.'">'.$showmoreicon.'<span>'.$show_more_trasnlate.'</span></a>';
					}
					///////////////////////////////////////////
					
					$section_fetch_content.='#@'.$showmore_link;
				}
				
			}else
			{
				$no_result_manual=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'noresult_search');
				if($no_result_manual=='')
					$no_result_manual=$pw_livesearch_class->alert('error',__('Not Found!',__PW_LIVESEARCH_TEXTDOMAIN__));
				else
					$no_result_manual=stripslashes(do_shortcode($no_result_manual));
					
				$section_fetch_content.=$no_result_manual;
			}
		}
		break;
	}

	
	return $section_fetch_content;
?>