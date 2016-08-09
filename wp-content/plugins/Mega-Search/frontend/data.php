<?php
	global $wpdb;
	
	$autocomplete_source=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source');
	
	
	$data='<script>var teams,teams_'.$rand_id.'="";var statistics_data_'.$rand_id.'="";';
	
	if($autocomplete_source=='serach_statistics')
	{
		$table_name = $wpdb->prefix . "pw_livesearch_statistics";
		$data.='statistics_data = {';
		
		$allposts = $wpdb->get_results( "SELECT * FROM $table_name ") ;
		foreach ($allposts as $singlepost) { 
				 $data.="'" .$singlepost->keyword. "':'".$singlepost->keyword."',";
		}
		
		$data.='}';
		
	}else if($autocomplete_source=='post_title'){
		$autocomplete_source_post_type=get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'autocomplete_source_post_type');
		
		$autocomplete_i=0;
		foreach($autocomplete_source_post_type as $post_type){
				
			
			$args=array(
				'post_type'=>$post_type,
				'posts_per_page'=>-1
			);
			$autocomplete_query=new WP_Query($args);
			if($autocomplete_query->have_posts()):
				$data.=" var ".$post_type." = [";
				while($autocomplete_query->have_posts()): $autocomplete_query->the_post();
					$data.="'".get_the_title()."',";
				endwhile;
				wp_reset_query();
					
				$data.="];
			 var ".$post_type." = $.map(".$post_type.", function (team) { return { value: team, data: { category: '".$post_type."' }}; });
			";
				if($autocomplete_i==0)
					$data.='teams_'.$rand_id.' = '.$post_type.';';
				if($autocomplete_i>0)
					$data.='teams_'.$rand_id.' = teams_'.$rand_id.'.concat('.$post_type.');';	
					
				$autocomplete_i++;
			
			endif;
			
			
		}
		
	}
	
	$data.='

		/*jslint  browser: true, white: true, plusplus: true */
		/*global $, countries */
		
		jQuery(function($) {

			"use strict";';
		if($autocomplete_source=='serach_statistics')	
		{
			$data.='
				var statistics_data_Array = $.map(statistics_data_'.$rand_id.', function (value, key) { return { value: value, data: key }; });
		
				// Initialize ajax autocomplete:
				$("#autocomplete-ajax_'.$rand_id.'").autocomplete({
					// serviceUrl: "/autosuggest/service/url",
					lookup: statistics_data_Array,
					lookupFilter: function(suggestion, originalQuery, queryLowerCase) {

						var re = new RegExp("\\b" + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), "gi");
						return re.test(suggestion.value);
					},
					onSelect: function(suggestion) {
						$("#selction-ajax_'.$rand_id.'").html("You selected: " + suggestion.value + ", " + suggestion.data);
					},
					onHint: function (hint) {
						$("#autocomplete-ajax-x_'.$rand_id.'").val(hint);
					},
					onInvalidateSelection: function() {
						$("#selction-ajax_'.$rand_id.'").html("You selected: none");
					}
				});
			';	
		}else if($autocomplete_source=='post_title'){
			$data.='	
			// Initialize autocomplete with local lookup:
				$("#autocomplete_'.$rand_id.'").devbridgeAutocomplete({
					lookup: teams_'.$rand_id.',
					minChars: 1,
					onSelect: function (suggestion) {
						$("#selction-ajax_'.$rand_id.'").html("You selected: " + suggestion.value + ", " + suggestion.data.category);
					},
					showNoSuggestionNotice: true,
					noSuggestionNotice: "Sorry, no matching results",
					groupBy: "category"
				});';
		}

		$data.='
		});
	';
	
	$data.='</script>';
	
	return $data;
?>