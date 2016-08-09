<?php
	$min_character= get_option(__PW_LIVESEARCH_FIELDS_PERFIX__.'min_character',3);

	$search_html.='<script>
		
		jQuery(function($) {
			
				
			//GET CURRENT DOCUMENT WIDTH
			var main_width=($(document).width());

			$(window).resize(function(){
				//set_resultbox_left("'.$rand_id.'");
				/*//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
				var main_width=($(document).width());
				var curent_width=$("#pw_main_search_result_'.$rand_id.'").outerWidth();
				var cl=$("#pw_livesearch_form_'.$rand_id.' input").offset().left;
				cwidth=$("#pw_livesearch_form_'.$rand_id.' input").outerWidth();
				
				var final_left=(main_width-(curent_width+cl));
				//console.log("M:"+main_width+" C:"+curent_width+" L:"+cl+" R:"+final_left);
				
				
				if ($(window).outerWidth()<=768){
					$("#pw_main_search_result_'.$rand_id.'").css("left","0px");
					//console.log($(window).innerWidth()+"<768");
				}else if(cwidth>=curent_width){
					$("#pw_main_search_result_'.$rand_id.'").css("left","0px");
					//console.log("tW>rW "+final_left);
				}else if(final_left!=0 && final_left<cl){
					$("#pw_main_search_result_'.$rand_id.'").css("left",final_left+"px");
					//console.log("!=0 "+final_left);
				}else if(final_left>cl){
					$("#pw_main_search_result_'.$rand_id.'").css("left",0+"px");
					//console.log("New "+final_left);
				}
				else{
					$("#pw_main_search_result_'.$rand_id.'").css("left",(cwidth-curent_width)+"px");
					//console.log("==0 "+final_left);
				}*/
				
				set_resultbox_left("'.$rand_id.'");
				
			});
			
			';
			
			
			///////////////////////////////////
			// DISPLAY DEFAULT RESULT AFTER CLICK ON SEARCH BOX
			///////////////////////////////////
			if($default_value=='on')	
			{
				$search_html.='
				var curent_val="";
				var set_focus="";
				
				//SAVE SEARCH TEXT IN STATISTICS + SHOW DEFAULT PANEL
				$("#pw_livesearch_form_'.$rand_id.' input").focus(function(){
					
					var input_box_value=$("#pw_livesearch_form_'.$rand_id.' input").val();
					
					if(input_box_value.length<'.$min_character.' && set_focus=="")
					{
						curent_val=input_box_value;
						//console.log("Cur Val : " + curent_val);
						//console.log("it works" + new Date());
						var pdata = {
							action: "pw_livesearch_search",
							postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
							nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
						}
						
						//$("#pw_main_search_result_'.$rand_id.'").html("Loading ...");
						$("#pw_loading_'.$rand_id.'").show();
		
						ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");

					}
					set_focus=1;
					
					$("#pw_main_search_result_'.$rand_id.'").show();
					
					//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
					set_resultbox_left("'.$rand_id.'");
					
					/*var curent_width=$("#pw_main_search_result_'.$rand_id.'").outerWidth();
					var cl=$("#pw_livesearch_form_'.$rand_id.' input").offset().left;
					
					var final_left=(main_width-(curent_width+cl));
					//console.log("M:"+main_width+" C:"+curent_width+" L:"+cl+" R:"+final_left);
					
					if(final_left<0)
						$("#pw_main_search_result_'.$rand_id.'").css("left",final_left+"px");*/
								
					//FOR STICKY/FULLSCREEN/POPUP
					$("#pw_main_search_result_'.$rand_id.'").css("display","block");
					
					//JUST POPUP
					popup_responsive_height("'.$rand_id.'");
					
					//JUST STICKY TOP
					sticky_top_responsive_height("'.$rand_id.'");
					
					//JUST FULLSCREEN
					fullscreen_responsive_height("'.$rand_id.'");
					
					
				});';
				
			}else{
				$search_html.='
					var curent_val="";
					var set_focus="";
					//SAVE SEARCH TEXT IN STATISTICS + SHOW DEFAULT PANEL
					$("#pw_livesearch_form_'.$rand_id.' input").focus(function(){
		
						var input_box_value=$("#pw_livesearch_form_'.$rand_id.' input").val();
						
						if(input_box_value.length>='.$min_character.')
						{
						
							//FOR STICKY/FULLSCREEN/POPUP
							$("#pw_main_search_result_'.$rand_id.'").css("display","block");
							//console.log("1"+new Date());
							
							//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
							set_resultbox_left("'.$rand_id.'");
								
							//JUST STICKY TOP
							sticky_top_responsive_height("'.$rand_id.'");	
								
							//JUST POPUP
							popup_responsive_height("'.$rand_id.'");
							
							//JUST FULLSCREEN
							fullscreen_responsive_height("'.$rand_id.'");
												
							curent_val=input_box_value;
							//console.log("Cur Val : " + curent_val);
							//console.log("it works" + new Date());
							var pdata = {
								action: "pw_livesearch_search",
								postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
								nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
							}
							
							$("#pw_loading_'.$rand_id.'").show();
			
							ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
						}
						
					});
				';
				
			}
		
		
			$search_html.='	
			
			/*$("#pw_main_search_main_result_'.$rand_id.'").focusout(function () {
				$("#pw_main_search_result_'.$rand_id.'").hide();
				if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
				{
					$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
				}
			});*/
			
			/*$("#pw_main_search_main_result_'.$rand_id.'").focusout(function () {
			   if ($(this).has(document.activeElement).length == 0) {
				   // remove div
				   confirm("remo");
			   }
			});*/
		
			var resultsSelected = false;
			$("#pw_main_search_main_result_'.$rand_id.'").hover(
				function () { resultsSelected = true; },
				function () { resultsSelected = false; }
			);
			
			
			
			$("#pw_livesearch_form_'.$rand_id.' input").blur(function () {
				
				var sug=false;
				$(".autocomplete-suggestions, .autocomplete-suggestions *").click(function(e) {
					sug=true;
					$("#pw_livesearch_form_'.$rand_id.' input").trigger("change");
				});

				if (!resultsSelected && !sug) {  //if you click on anything other than the results
					$("#pw_main_search_result_'.$rand_id.'").hide();  //hide the results
				
					if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
					{
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
					}
					sug=false;
				}
			});
			
			/*$("#pw_main_search_main_result_'.$rand_id.'").focusout(function(){
				$("#pw_main_search_result_'.$rand_id.'").hide();
				if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
				{
					$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
				}
			});*/
			
			$("#pw_livesearch_form_'.$rand_id.'").submit(function(e){
				e.preventDefault();
			});
	
			
			
			$("#pw_livesearch_form_'.$rand_id.' input").keyup(function(e){
				
				var input_box_value=$("#pw_livesearch_form_'.$rand_id.' input").val();
				//console.log("Val: "+input_box_value+" keyUp"+ new Date());
				if(e.keyCode==27 && input_box_value==""){
					$("#pw_main_search_result_'.$rand_id.'").hide();
					if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
					{
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
					}
					$(this).blur();
					//console.log("FIRST");
					return false;
				}else if(e.keyCode==27 && input_box_value!=""){
					$(this).val("");
					var pdata = {
						action: "pw_livesearch_search",
						postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
						nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
					}
					$("#pw_loading_'.$rand_id.'").show();
					ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
					return false;
				}
				
				//console.log("CV: "+curent_val);
				/*if(curent_val==input_box_value)
				{
					return false;
				}*/
				
				search_q=$("#pw_livesearch_form_'.$rand_id.' input").val();
				
				if((e.keyCode!=27) && (search_q.length>='.$min_character.' || (e.keyCode==8 && search_q.length>=0)))
				{';
					
					if($default_value!='on')	
					{
						$search_html.='
						if(search_q.length<'.$min_character.')
						{
							$("#pw_main_search_result_'.$rand_id.'").hide();
						
							if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
							{
								$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
							}
							
							return false;
						}';
					}
				$search_html.='	
					curent_val=input_box_value;
					
					//FOR STICKY/FULLSCREEN/POPUP
					$("#pw_main_search_result_'.$rand_id.'").css("display","block");
					
					//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
					set_resultbox_left("'.$rand_id.'");
						
					//JUST POPUP
					popup_responsive_height("'.$rand_id.'");
					
					//JUST FULLSCREEN
					fullscreen_responsive_height("'.$rand_id.'");
					
					//JUST STICKY TOP
					sticky_top_responsive_height("'.$rand_id.'");
					
					
					var pdata = {
						action: "pw_livesearch_search",
						postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
						nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
					}
					
					//$("#pw_main_search_result_'.$rand_id.'").html("Loading ...");
					$("#pw_loading_'.$rand_id.'").show();
	
					ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
					
				}
				
				';
				if($default_value!='on')	
				{
					$search_html.='
					if(search_q.length<'.$min_character.'){
						$("#pw_main_search_result_'.$rand_id.'").hide();
						
						if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
						{
							$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
						}
						
					}';
				}
				
				$search_html.='

				if(e.keyCode==27){
					//$("#pw_livesearch_form_'.$rand_id.' input").val("");
					$("#pw_main_search_result_'.$rand_id.'").hide();
					if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
					{
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
					}
					return false;
				}
				
			});
		
			$("#pw_livesearch_form_'.$rand_id.' input").change(function(e){
				
				//console.log($("#pw_livesearch_form_'.$rand_id.'").serialize());
				
				var input_box_value=$("#pw_livesearch_form_'.$rand_id.' input").val();
				
				if(curent_val==input_box_value)
				{
					return false;
				}
				
				search_q=$("#pw_livesearch_form_'.$rand_id.' input").val();
				
				if((e.keyCode!=27) && (search_q.length>='.$min_character.' || (e.keyCode==8 && search_q.length>=0)))
				{';
					
					if($default_value!='on')	
					{
						$search_html.='
						if(search_q.length<'.$min_character.')
						{
							$("#pw_main_search_result_'.$rand_id.'").hide();
						
							if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
							{
								$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
							}
							
							return false;
						}';
					}
				$search_html.='	
					curent_val=input_box_value;
					
					//FOR STICKY/FULLSCREEN/POPUP
					$("#pw_main_search_result_'.$rand_id.'").css("display","block");
					
					//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
					set_resultbox_left("'.$rand_id.'");
						
					//JUST POPUP
					popup_responsive_height("'.$rand_id.'");
					
					//JUST FULLSCREEN
					fullscreen_responsive_height("'.$rand_id.'");
					
					//JUST STICKY TOP
					sticky_top_responsive_height("'.$rand_id.'");
					
					
					var pdata = {
						action: "pw_livesearch_search",
						postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
						nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
					}
					
					//$("#pw_main_search_result_'.$rand_id.'").html("Loading ...");
					$("#pw_loading_'.$rand_id.'").show();
	
					ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
				}
				
				';
				if($default_value!='on')	
				{
					$search_html.='
					if(search_q.length<'.$min_character.'){
						$("#pw_main_search_result_'.$rand_id.'").hide();
						
						if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
						{
							$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
						}
						
					}';
				}
				
				$search_html.='
				
				if(e.keyCode==27){
					//$("#pw_livesearch_form_'.$rand_id.' input").val("");
					$("#pw_main_search_result_'.$rand_id.'").hide();
					if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
					{
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
					}
					return false;
				}
				
			});
		});</script>';
?>