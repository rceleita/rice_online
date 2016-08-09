<?php
	
	if(!isset($paged))
		$paged=1;
	
	if($fetch_type=='build_query')
	{
		$query_by_id_in='';
		$query_by_id_not_in='';
		$query_tax_with_query='';
		
		$pw_query=$pw_livesearch_class->check_isset(__PW_LIVESEARCH_FIELDS_PERFIX__.'build_query_taxonomy-'.$i,'custom_field','');
		
		if(isset($pw_query['taxonomy_checkbox'])){				
	
			$taxonomies=$pw_query['taxonomy_checkbox'];
			foreach($taxonomies as $taxonomy){
				if(isset($pw_query['in_'.$taxonomy]))
				{
					$taxonomy_value=$pw_query['in_'.$taxonomy];
					$include_tax_build_query[$taxonomy]=$taxonomy_value;
				}
				
				if(isset($pw_query['ex_'.$taxonomy]))
				{
					$taxonomy_value=$pw_query['ex_'.$taxonomy];
					$exclude_tax_build_query[$taxonomy]=$taxonomy_value;
				}
			}
		}
		
		
		if(isset($pw_query['in_ids'])){
			$query_by_id_in=$pw_query['in_ids'];
		}
		
		if(isset($pw_query['ex_ids'])){
			$query_by_id_not_in=$pw_query['ex_ids'];
		}
		
		$all_tax=get_object_taxonomies($post_type);

		if(is_array($all_tax) && count($all_tax)>0){
			
			//FETCH TAXONOMY
			foreach ( $all_tax as $tax ) {
				$taxonomy=get_taxonomy($tax);	
				$values=$tax;
				$label=$taxonomy->label;
				
				if(isset($include_tax_build_query[$tax])){
					//$property_type=array_merge($_FIELDS[$tax],$include_tax_build_query[$tax]);
					//$property_type=array_unique($property_type);
					
					$query_tax_with_query[]=array(
						'taxonomy' => $tax,
						'field'    => 'id',
						'terms'    => $include_tax_build_query[$tax],
						'operator' => 'IN',
						//'include_children' => false
					);
					
				}
				
				if(isset($exclude_tax_build_query[$tax]))
				{
					$query_tax_with_query[]=array(
						'taxonomy' => $tax,
						'field'    => 'id',
						'terms'    => $exclude_tax_build_query[$tax],
						'operator' => 'Not IN',
					);
				}
			}
		}
		
		if($query_tax_with_query!='')
		{
			$query_tax_with_query['relation']='AND';
		}

		
		
		$args = array(
			'post_type'  =>  ($post_type=='product' ? array($post_type,'product_variation') : $post_type),
			'posts_per_page'=>$post_number,
			'paged'=>$paged,
			'tax_query'=>$query_tax_with_query,
			'post__in'=>$query_by_id_in,
			'post__not_in'=>$query_by_id_not_in,
			'meta_or_tax'=>true
		);
		// The Query		
	}else if($fetch_type=='all'){
		
		$args = array(
			'post_type'  => ($post_type=='product' ? array($post_type,'product_variation') : $post_type),
			'posts_per_page'=>$post_number,
			'meta_or_tax'=>true,
			'paged'=>$paged
		);
		// The Query
	}
	
	////////////TARGET FIELD SEARCH////////////
	$target_field=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'target_field',array('title'));
	
	foreach($target_field as $t_field)
	{
		switch($t_field){
			case $t_field=="title" || $t_field=="excerpt" || $t_field=="content":
			{
				//$args['search_title']=(isset($q)?$q:"");
				$args=array_merge($args,array('search_title_content_excerpt'=>(isset($q)?$q:"")));
			}
			break;
			
			case "custom_field":
			{
				$custom_fields=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'custom_fields','');
				$meta_query='';
				if($custom_fields!='')
				{
					foreach($custom_fields as $c_field)
					{
						if(isset($q) && $q!='')
						{
							$meta_query[]=array(
								'key'     => $c_field,
								'value'   => array((isset($q)?$q:"")),
								'compare' => 'IN',
							);
						}
					}
				}
				
				if($meta_query!='')
				{
					$meta_query['relation']='OR';
				}

				$args=array_merge($args,array('meta_query'=>$meta_query));
				//$args['meta_or_tax']=TRUE;
			}
			break;
		}
	}
	
	//print_r($args);
	
	return $args;
?>