<?php
	
	$final_html='';

	$final_html.='<script>
		var first_popup_height="";
    	jQuery( document ).ready(function($) {
			
			$(document).keyup(function(e){
				if(e.keyCode==27)
				{
					if($("#pw_main_search_result_'.$rand_id.'").css("display")=="block")
					{
						$("#pw_main_search_result_'.$rand_id.'").css("display","none");
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
						
					}else if($( ".ls-popup-cnt-'.$rand_id.'" ).css("display")=="block"){
						$(".ls-popup-overlay-'.$rand_id.'").css("opacity","0");
						$(".ls-popup-overlay-'.$rand_id.'").css("display","none");
						$(".ls-popup-cnt-'.$rand_id.'").css("display","none");
						$(".ls-popup-cnt-'.$rand_id.'").removeClass("showSweetAlert").addClass("hideSweetAlert");
						//console.log("FP:"+e.keyCode);
					}else{
						$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
					}
				}
				
			});
			
			/*Increase height and display result box after search*/
		
			
		
			//Show POPUP form
			$(".ls-popbtn-'.$rand_id.'").click(function(){
				$(".ls-popup-overlay-'.$rand_id.'").css("opacity","1");
				$(".ls-popup-overlay-'.$rand_id.'").css("display","block");
				
				$(".ls-popup-cnt-'.$rand_id.'").css("display","block");
				$(".ls-popup-cnt-'.$rand_id.'").removeClass("hideSweetAlert").addClass("showSweetAlert");
				
				if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && first_popup_height=="")
				{
					first_popup_height=$( ".ls-popup-cnt-'.$rand_id.'" ).innerHeight();
				}
				if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && !$( ".ls-result" ).is(":visible"))
				{
					$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
				}
				$("#pw_livesearch_form_'.$rand_id.' input").focus();
				
			});
			//Close POPUO form
			$(".ls-popup-close-'.$rand_id.'").click(function(){
				$(".ls-popup-overlay-'.$rand_id.'").css("opacity","0");
				$(".ls-popup-overlay-'.$rand_id.'").css("display","none");
				$(".ls-popup-cnt-'.$rand_id.'").css("display","none");
				$(".ls-popup-cnt-'.$rand_id.'").removeClass("showSweetAlert").addClass("hideSweetAlert");
				
				$("#pw_main_search_result_'.$rand_id.'").css("display","none");
				$( ".ls-popup-cnt-'.$rand_id.'" ).css("height",first_popup_height+"px");
				
				$("#pw_livesearch_form_'.$rand_id.' input[name=\'pw_livesearch_q\']").val("");
				var pdata = {
					action: "pw_livesearch_search",
					postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
					nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
				}
				$("#pw_loading_'.$rand_id.'").show();
				ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
				
			});
		
			$(window).resize(function(){
				if($( ".ls-popup-cnt-'.$rand_id.'" ).is(":visible") && $( ".ls-result" ).is(":visible"))
				{
					popup_responsive_height("'.$rand_id.'");
				}
			});
			';
			if($default_search_id=='')
			{
				$final_html.='$("body").append($(".ls-popup-overlay-'.$rand_id.'"));';
			}
			$final_html.='
		});
		
    </script>
	
	<div class="ls-button ls-popbtn-'.$rand_id.'" >'.($search_text!=''?'<span>'.$search_text.'</span>':'').'<i class="fa '.$search_icon.'"></i></div>
	<div class="'.$custom_class.' ls-popup-overlay ls-popup-overlay-'.$rand_id.'">								
	<div class="ls-popup-cnt hideSweetAlert ls-popup-cnt-'.$rand_id.'" data-animation="'.$popup_animation.'">
    	<div class="ls-popup-close ls-popup-close-'.$rand_id.'">
        	<i class="fa fa-times"></i>
        </div>';
	$final_html.= $search_html;
	$final_html.=' </div><!-- -->
</div><!--ls-popup-overlay -->';

?>