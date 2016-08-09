<?php
	
	function horizontal_pagination($pages = '', $paged=1,$range = 4,$class='ls-page',$url)
	{  
		
		$showitems = ($range * 2)+1;  
		$output='';
		if(empty($paged)) $paged = 1;
		
		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}   
		
		if(1 != $pages)
		{
		
			$output.='';
			
			if (1 != $paged &&( $showitems < $paged+$range))
			{
				$output.='<div class="ls-page"><a  href="'.$url.'&page_no=1">1</a></div><div class="ls-page"><a href="#">...</a></div>';
			}	
			
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					$output.= ($paged == $i)? '<div class="ls-page ls-active-page"><a href="'.$url.'&page_no='.$i.'">'.$i.'</a></div>':'<div class="ls-page"><a href="'.$url.'&page_no='.$i.'">'.$i.'</a></div>';
				}
			}
			
			if (1 != $pages  && $showitems<$pages && $paged!=$pages &&( $pages > $paged+$range+1))
			{
				$output.='<div class="ls-page"><a href="#">...</a></div><div class="ls-page"><a href="'.$url.'&page_no='.$i.'">'.$i.'</a></div>';
			}
			
			$output.= "";
		}
		$paged=1;
		return $output;
	}
	
	//print_r($_GET);
	
	$q=esc_html($_GET['pw_livesearch_q']);
	$search_id=esc_html($_GET['pw_livesearch_search_id']);
	$i=esc_html($_GET['pw_livesearch_search_section']);
	$paged=(isset($_GET['page_no'])?esc_html($_GET['page_no']):1);
	$paged_class="pw_p$paged";
	$section_fetch_content='';
	
	global $pw_livesearch_class;
	$pw_livesearch_class->fetch_custom_fields($search_id);
	
	
	$rand_id=$search_id.'_'.rand(0,1000);
	livesearch_custom_css($rand_id);
	//////////GET PAGE NUMBERS////////////
	
	$post_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'post_number-'.$i,'custom_field','-1');
	
	$post_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'showmore_post_per_page-'.$i,'custom_field',$post_number);
	
	$post_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'post_type-'.$i,'custom_field','post');
	
	//Fetch all | Build Query
	$fetch_type=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'fetch_type-'.$i,'custom_field','all');
	
	$id=$search_id;	
	$fetch_section_value_args=require __PW_LIVESEARCH_ROOT_DIR__.'/includes/pw_build_query.php';

	$fetch_section_value_query = new WPSE_OR_Query( $fetch_section_value_args );
	$page_numbers=$fetch_section_value_query->max_num_pages;
	//if($post_type=='product')
		//echo $fetch_section_value_query->request;
	
	$display_layout=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_type-'.$i,'custom_field','list');
	
	$grid_skin=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin-'.$i,'custom_field','ls-grided-item ls-grided-style1');
	$grid_skin=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'grid_skin-'.$i];
	
	$grid_desktop_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_desktop_col-'.$i];
	
	$grid_tablet_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_tablet_col-'.$i];
	
	$grid_mobile_col=$pw_livesearch_class->custom_field[__PW_LIVESEARCH_FIELDS_PERFIX__.'display_grid_mobile_col-'.$i];
	
				
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
		$pagination='';
		$display_items_number=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'display_item_number-'.$i,'custom_field',$post_number);
		$display_items_number=($display_items_number=="-1" || $display_items_number=='' ? "all":$display_items_number);
		
		$query_number=$fetch_section_value_query->found_posts;
		while ( $fetch_section_value_query->have_posts()) {
			$fetch_section_value_query->the_post();
			//$section_fetch_content.=$fetch_section_showmore_query->post->ID;
			
			$title='';
			$addtocart='';
			$excerpt='';
			$section_image='';
			$price='';
			
			//////////////////////////////////////////////////////////
			//IF POST TYPE IS PRODUCT
			//////////////////////////////////////////////////////////
			if($post_type=='product' && class_exists( 'WooCommerce' )){
				
				$pid=$fetch_section_value_query->post->ID;
				$product = get_product($pid);
				
				
				//////////////TITLE/////////////////////
				$title='';
				if($show_title)
				{
					$title = '<h3 class="ls-result-title"><a href="'.$product->get_permalink().'">'.$product->get_title().'</a></h3>';
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
					$img_url_thumb = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );
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
					
					($display_layout=='grid'? "<div class='$grid_mobile_col $grid_tablet_col $grid_desktop_col'>
<div class='ls-result-item $paged_class $grid_skin'>":($display_layout=='grid'  ? "<div class='ls-result-item  $paged_class $grid_skin'>":"<div class='ls-result-item $paged_class'>")).
					
						'<a href="'.get_permalink().'">'.$section_image.'</a>'.
						($display_layout=='grid' && $grid_skin=='ls-grided-item ls-grided-style2' ? '<a href="'.get_permalink().'" class="ls-result-icon"><i class="fa fa-link"></i></a>':"").
						'<div class="ls-result-content">'
							.$title
							.$meta
							.($display_layout=='list' || $grid_skin=='ls-grided-item ls-grided-style1' ? $excerpt.$price.$addtocart:"")
						.'</div>'.		
					($display_layout=='grid'  ? "</div></div>":($display_layout=='grid' ? "</div>":'</div>'));
				
				
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
					$src_featured = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' ,0);	
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
					
					($display_layout=='grid'  ? "<div class='$grid_mobile_col $grid_tablet_col $grid_desktop_col'>
<div class='ls-result-item $paged_class $grid_skin'>":($display_layout=='grid' ? "<div class='ls-result-item $paged_class $grid_skin'>":"<div class='ls-result-item $paged_class'>")).
					
						'<a href="'.get_permalink().'">'.$section_image.'</a>'.
						($display_layout=='grid' && $grid_skin=='ls-grided-item ls-grided-style2' ? '<a href="'.get_permalink().'" class="ls-result-icon"><i class="fa fa-link"></i></a>':"").
						'<div class="ls-result-content">'
							.$title
							.$meta
							.($display_layout=='list' || $grid_skin=='ls-grided-item ls-grided-style1' ? $excerpt:"")
						.'</div>'.
					($display_layout=='grid' ? "</div></div>":($display_layout=='grid'  ? "</div>":'</div>'));
				
			}
		}
		wp_reset_query();
	}
	
	global $wp;
	$current_url = add_query_arg( '', '', home_url( $wp->request ) );
	$current_url =$current_url."/?pw_livesearch_q=$q&pw_livesearch_search_id=$search_id&pw_livesearch_search_section=$i";
	
	echo '<div id="ls-result-sec-'.$rand_id.'-'.$i.'">'.$section_fetch_content.'</div>';
	
	echo '<div class="ls-pagination-cnt">'.horizontal_pagination($page_numbers, $paged, $post_number,'ls-page',$current_url).'</div>';
	
?>