<?php
if (!function_exists('livesearch_add_to_cart_grid')){
	function livesearch_add_to_cart_grid($type='',$id='') {
	global $product;
	
	$read_more_title=(get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'read_more_title')=='' ? __('Read More',__PW_LIVESEARCH_TEXTDOMAIN__) : get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'read_more_title'));
	
	$add_to_cart_title=(get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'add_to_cart_title')=='' ? __('Add To Cart',__PW_LIVESEARCH_TEXTDOMAIN__) : get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'add_to_cart_title'));
	
	$select_options_title=(get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'select_options_title')=='' ? __('Select options',__PW_LIVESEARCH_TEXTDOMAIN__) : get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'select_options_title'));
	
	$view_options_title=(get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'view_options_title')=='' ? __('View options',__PW_LIVESEARCH_TEXTDOMAIN__) : get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'view_options_title'));
	
	
	
	if($id!='')
		$product = get_product($id);
	
	if (!$product->is_in_stock()) :
		
		if($type=='link') :
			return apply_filters('out_of_stock_add_to_cart_url', get_permalink($product->id));
		elseif($type=='label')	:
			return apply_filters('not_purchasable_text', $read_more_title);
		endif;
		
	else :
		$link = array(
			'url' => '',
			'label' => '',
			'class' => '',
		);

		$handler = apply_filters('woocommerce_add_to_cart_handler', $product->product_type, $product);

		switch ($handler) {
			case "variable" :
				$link['url'] = apply_filters('variable_add_to_cart_url', get_permalink($product->id));
				$link['label'] = apply_filters('variable_add_to_cart_text wt-addtocart', $select_options_title);
				$link['class'] = apply_filters('add_to_cart_class', 'button  product_type_variable');
				break;
			case "grouped" :
				$link['url'] = apply_filters('grouped_add_to_cart_url', get_permalink($product->id));
				$link['label'] = apply_filters('grouped_add_to_cart_text', $view_options_title);
				$link['class'] = apply_filters('add_to_cart_class', 'button  product_type_simple');
				break;
			case "external" :
				$link['url'] = apply_filters('external_add_to_cart_url', get_permalink($product->id));
				$link['label'] = $product->get_button_text();
				$link['class'] = apply_filters('add_to_cart_class', 'button  product_type_simple');
				break;
				
			/*case "variation" :
				$link['url'] = apply_filters('add_to_cart_url', esc_url($product->add_to_cart_url()));
				$link['label'] = apply_filters('add_to_cart_text', $add_to_cart_title);
				$link['class'] = apply_filters('add_to_cart_class', 'button add_to_cart_button product_type_simple');
			break;*/
				
			default :
				if ($product->is_purchasable()) {
					$link['url'] = apply_filters('add_to_cart_url', esc_url($product->add_to_cart_url()));
					$link['label'] = apply_filters('add_to_cart_text', $add_to_cart_title);
					$link['class'] = apply_filters('add_to_cart_class', 'button add_to_cart_button product_type_simple');
				} else {
					$link['url'] = apply_filters('not_purchasable_url', get_permalink($product->id));
					$link['label'] = apply_filters('not_purchasable_text', $read_more_title);
					$link['class'] = apply_filters('add_to_cart_class', 'button  product_type_simple');
				}
				break;
		}
		
		if($type=='link')
			return apply_filters('woocommerce_loop_add_to_cart_link', esc_url($link['url']));
		else if($type=='label')	
			return $link['label'];

		if(strpos($link['url'], 'href='))
		{
			$add_to_cart_has_tag_a=true;
			return apply_filters('woocommerce_loop_add_to_cart_link', esc_url($link['url']));
		}
		else if($type=='btn_icon_type'){
		
			return apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<div class="woo-addcart" title="%s"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s  product_type_%s" title="%s"></a></div>', esc_html($link['label']),esc_url($link['url']), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr($link['class']), esc_attr($product->product_type), esc_html($link['label'])), $product, $link);
		
		}else if($type=='btn_text_type'){
			
			return apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s  product_type_%s">%s</a>', esc_url($link['url']), esc_attr($product->id), esc_attr($product->get_sku()), esc_attr($link['class']), esc_attr($product->product_type), esc_html($link['label'])), $product, $link);
			
		}
		

	endif;
	}
}
?>