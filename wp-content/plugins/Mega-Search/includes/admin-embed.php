<?php
	
	//include('../includes/actions.php');
	
	//CSS
	
	//FONTAWESOME STYLE //font-awesome-css
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'font-awesome-ccc', __PW_LIVESEARCH_CSS_URL__.'font-awesome.css',true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'font-awesome-ccc');
	
	/////////ADMIN STYLE/////////////////
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'admin-style',__PW_LIVESEARCH_CSS_URL__.'back-end/admin-style.css',true);

	
	/////////////////////////CSS CHOSEN///////////////////////
	wp_register_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'chosen_css_1', __PW_LIVESEARCH_CSS_URL__.'back-end/chosen/chosen.css', false, '1.0.0' );
	wp_enqueue_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'chosen_css_1' );
	
	
	/////////////////////////Two Side Multi Select///////////////////////
	wp_enqueue_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'two-side-multi-select', __PW_LIVESEARCH_CSS_URL__.'back-end/two-side-multiselect/jquerysctipttop.css');
	wp_enqueue_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'two-side-multi-select-style', __PW_LIVESEARCH_CSS_URL__.'back-end/two-side-multiselect/style.css');
	wp_enqueue_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'two-side-multi-select-bootstrap', __PW_LIVESEARCH_CSS_URL__.'back-end/two-side-multiselect/bootstrap.min.css');
	
	
	
	
	
	
	
	// JQPLOT 
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-jqplot', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jquery.jqplot.min.css', true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-jqplot');	
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jquery.jqplot.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot1', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.canvasTextRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot1');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot2', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.canvasAxisLabelRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot2');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot3', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.pieRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot3');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot4', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.donutRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot4');	
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot5', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.dateAxisRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot5');		
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot6', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.canvasAxisTickRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot6');		
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot7', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.categoryAxisRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot7');		
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot8', __PW_LIVESEARCH_URL__.'/plugins/jqplot/jqplot.barRenderer.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-jqplot8');	
	
	// DATATABLES
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-datatables', __PW_LIVESEARCH_URL__.'/plugins/datatables/css/jquery.dataTables.min.css', true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-datatables');	
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-moments', __PW_LIVESEARCH_URL__.'/plugins/moments/moment.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-moments');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-datatables', __PW_LIVESEARCH_URL__.'/plugins/datatables/js/jquery.dataTables.min.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-datatables');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-datatables-tabletools', __PW_LIVESEARCH_URL__.'/plugins/datatables/js/dataTables.tableTools.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-datatables-tabletools');
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-moments-datatable', __PW_LIVESEARCH_URL__.'/plugins/moments/datetime-moment.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-moments-datatable');	
	
	// TABLETOOLS
	wp_register_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-datatables-tabletools', __PW_LIVESEARCH_URL__.'/plugins/datatables/css/dataTables.tableTools.css', true);
	wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'css-datatables-tabletools');		

	
	//custom-js statistics
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-statistics', __PW_LIVESEARCH_JS_URL__.'back-end/statistics-js.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-statistics');	
	
	
	
		
	//JS
	/////COLOR PICKKER//////
	wp_enqueue_style( 'wp-color-picker' );
	
	/////JS ENQUEUE////////////
	wp_enqueue_script('jquery');
	wp_enqueue_script('wp-color-picker');
	
	//FOR UPLOAD FILE IN TAXONOMY
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	
	
	//////////////////CHOSEN//////////////////////////
	wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'chosen_js1', __PW_LIVESEARCH_JS_URL__.'back-end/chosen/chosen.jquery.min.js' , false, '1.0.0' );
	wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'chosen_js1' );
	
	//////////////////MULTISELECT MULTI SIDE//////////////////////////
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'two-side-multi-select-bootstrap-js',__PW_LIVESEARCH_JS_URL__.'back-end/two-side-multiselect/bootstrap.min.js',array( 'jquery' ));
	
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'two-side-multi-select-js',__PW_LIVESEARCH_JS_URL__.'back-end/two-side-multiselect/multiselect.js',array( 'jquery' ));
	
	//////////////////DEPENDENCY//////////////////////////
	global $post_type;
	if( 'pw_livesearch' == $post_type || (isset($_GET['post_type']) && 'pw_livesearch' == $_GET['post_type']) )
	{
		
		////Tab IN ADMIN FORM CSS
		wp_register_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab1-css', __PW_LIVESEARCH_CSS_URL__.'/back-end/Tab/tabs.css' , false, '1.0.0' );
		wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab1-css');	
		
		wp_register_style( __PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab2-css', __PW_LIVESEARCH_CSS_URL__.'/back-end/Tab/tabstyles.css' , false, '1.0.0' );
		wp_enqueue_style(__PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab2-css');	
		
		
		
		///DEPENDENCY
		wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'dependency', __PW_LIVESEARCH_JS_URL__.'back-end/dependency/dependsOn-1.0.1.min.js' , false, '1.0.0' );
		wp_enqueue_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'dependency' );
		
		
		/////Tab IN ADMIN FORM JS
		wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab1-js', __PW_LIVESEARCH_JS_URL__.'/back-end/Tab/modernizr.custom.js' , false, '1.0.0' );
		wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab1-js');
		wp_register_script( __PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab2-js', __PW_LIVESEARCH_JS_URL__.'/back-end/Tab/cbpFWTabs.js' , false, '1.0.0' );
		wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'adminform-tab2-js');
		
		
	}
	
	//////////////////CUSTOM JS//////////////////////////
	wp_register_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-custom', __PW_LIVESEARCH_JS_URL__. 'back-end/custom-js.js', true);
	wp_enqueue_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-custom');
	wp_localize_script(__PW_LIVESEARCH_FIELDS_PERFIX__.'js-custom','param',
		array(
			'variable_perfix' =>__PW_LIVESEARCH_FIELDS_PERFIX__
		)
	);


	$output='
			<script type="text/javascript">
				jQuery(document).ready(function(jQuery){
					
					/////////////////////////////////////////////////////////
					////////SET ONE COLUMN FOR LIVESEARCH ADMIN FORM/////////
					jQuery(".metabox-holder").removeClass("columns-2").addClass("columns-1");
					jQuery("input[name=screen_columns][value=1]").prop("checked", true);
					
					
					/////////////////////////////////////////////////////////
					//////////////////COLOR PICKER///////////////////
					jQuery(".wp_ad_picker_color").wpColorPicker();
					
					/////////////////////////////////////////////////////////
					//////////////////ACCORDION DEPENDENCY///////////////////
					
					
					if(jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-1").val()=="manual_data")
					{
						jQuery(".accordion-section-1-4_field").hide();
						jQuery(".accordion-section-1-5_field").hide();
					}else
					{
						jQuery(".accordion-section-1-4_field").show();
						jQuery(".accordion-section-1-5_field").show();
					}
					
					jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-1").change(function(){
						if(jQuery(this).val()=="manual_data")
						{
							jQuery(".accordion-section-1-4_field").hide();
							jQuery(".accordion-section-1-5_field").hide();
						}else
						{
							jQuery(".accordion-section-1-4_field").show();
							jQuery(".accordion-section-1-5_field").show();
						}
					});
					
					
					if(jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-2").val()=="manual_data")
					{
						jQuery(".accordion-section-2-4_field").hide();
						jQuery(".accordion-section-2-5_field").hide();
					}else
					{
						jQuery(".accordion-section-2-4_field").show();
						jQuery(".accordion-section-2-5_field").show();
					}
					jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-2").change(function(){
						if(jQuery(this).val()=="manual_data")
						{
							jQuery(".accordion-section-2-4_field").hide();
							jQuery(".accordion-section-2-5_field").hide();
						}else
						{
							jQuery(".accordion-section-2-4_field").show();
							jQuery(".accordion-section-2-5_field").show();
						}
					});
					
					if(jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-3").val()=="manual_data")
					{
						jQuery(".accordion-section-3-4_field").hide();
						jQuery(".accordion-section-3-5_field").hide();
					}else
					{
						jQuery(".accordion-section-3-4_field").show();
						jQuery(".accordion-section-3-5_field").show();
					}
					jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-3").change(function(){
						if(jQuery(this).val()=="manual_data")
						{
							jQuery(".accordion-section-3-4_field").hide();
							jQuery(".accordion-section-3-5_field").hide();
						}else
						{
							jQuery(".accordion-section-3-4_field").show();
							jQuery(".accordion-section-3-5_field").show();
						}
					});
					
					if(jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-4").val()=="manual_data")
					{
						jQuery(".accordion-section-4-4_field").hide();
						jQuery(".accordion-section-4-5_field").hide();
					}else
					{
						jQuery(".accordion-section-4-4_field").show();
						jQuery(".accordion-section-4-5_field").show();
					}
					jQuery("#'.__PW_LIVESEARCH_FIELDS_PERFIX__ . 'source_type-4").change(function(){
						if(jQuery(this).val()=="manual_data")
						{
							jQuery(".accordion-section-4-4_field").hide();
							jQuery(".accordion-section-4-5_field").hide();
						}else
						{
							jQuery(".accordion-section-4-4_field").show();
							jQuery(".accordion-section-4-5_field").show();
						}
					});
					
					//////////////////ACCORDION DEPENDENCY///////////////////
					/////////////////////////////////////////////////////////
					
				});
			</script>	
	';
	echo $output;

	if(!function_exists('pw_livesearch_dependency'))
	{
		function pw_livesearch_dependency($element_id,$args,$index='')
		{
			$output='';
			
			
			$output.='
			<script type="text/javascript">
				jQuery(document).ready(function(jQuery){
					jQuery("."+"'.$element_id.'_field").dependsOn({';		
					foreach($args['parent_id'] as $parent)
					{
						
						
						
						$element_type=$args[$parent][0];
						unset($args[$parent][0]);
						
						$elem_parent=$parent;
						if($index!='')
							$elem_parent=$elem_parent.'-'.$index;
						
						switch($element_type)
						{
							
							case "select":
							{
								$output.= '
								"#'.$elem_parent.'": {
										values: [\''.(is_array($args[$parent]) ? implode("','", $args[$parent]) : $args[$parent]).'\']
								},';
							}
							break;
							
							case "checkbox":
							{
								if($args[$parent])
									$output.= '
									"#'.$elem_parent.'": {
										checked: '.implode("','", $args[$parent]).'
									},';
								else
									$output.= '
									"#'.$elem_parent.'": {
										checked: '.implode("','", $args[$parent]).'
									},';

							}
							break;
						}
					}
			$output.='
					});
				});
			 </script>';
			 return $output;
		}
	}
?>