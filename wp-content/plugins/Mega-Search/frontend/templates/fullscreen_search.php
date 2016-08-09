<?php
	
	$final_html='';

	$final_html.='
	<script>
    	jQuery( document ).ready(function($) {
			
			$(document).keyup(function(e){
				if(e.keyCode==27)
				{
					if($("#pw_main_search_result_'.$rand_id.'").css("display")=="block")
					{
						$("#pw_main_search_result_'.$rand_id.'").css("display","none");
						//console.log("R:"+e.keyCode);
					}else if($( ".ls-fullscreen-'.$rand_id.'" ).css("display")=="block"){
						$(".ls-fullscreen-'.$rand_id.'").removeClass("showSweetAlert").addClass("hideSweetAlert");
						$( ".ls-fullscreen-'.$rand_id.'" ).css("display","none");
						//console.log("F:"+e.keyCode);
					}
				}
				
			});
			
			/*$(".ls-search-input").keyup(function(){
				$("#pw_main_search_result_'.$rand_id.'").css("display","block");	

			});*/
			
			//Show Fullscreen form
			$(".ls-fullbtn-'.$rand_id.'").click(function(){
				$(".ls-fullscreen-'.$rand_id.'").css("display","block");
				$("#pw_livesearch_form_'.$rand_id.' input").focus();
				$(".ls-fullscreen-'.$rand_id.'").removeClass("hideSweetAlert").addClass("showSweetAlert");
				
				$("body").addClass("ls-ie-show-scroll");
			});
			//Close POPUO form
			$(".ls-fullscreen-close-'.$rand_id.'").click(function(){
				$(".ls-fullscreen-'.$rand_id.'").removeClass("showSweetAlert").addClass("hideSweetAlert");
				$( ".ls-fullscreen-'.$rand_id.'" ).css("display","none");
				
				$("#pw_livesearch_form_'.$rand_id.' input[name=\'pw_livesearch_q\']").val("");
				var pdata = {
					action: "pw_livesearch_search",
					postdata: $("#pw_livesearch_form_'.$rand_id.'").serialize(),
					nonce: "'.wp_create_nonce( 'pw_livesearch_nonce' ).'",
				}
				$("#pw_loading_'.$rand_id.'").show();
				ajax_fetch_data(pdata,"'.$rand_id.'","'.admin_url( 'admin-ajax.php').'");
				
				$("body").removeClass("ls-ie-show-scroll");
			});
			
			
			
			//Scroller Responsive
			$(window).resize(function(){
				if($( ".ls-fullscreen-'.$rand_id.'" ).is(":visible") && $( ".ls-result" ).is(":visible"))
				{
					fullscreen_responsive_height("'.$rand_id.'");
				}
			});
			
			';
			if($default_search_id=='')
			{
				$final_html.='$("body").append($(".ls-fullscreen-'.$rand_id.'"));';
			}
			$final_html.='
			
		});
		
    </script>
	
	<div class="ls-button ls-fullbtn-'.$rand_id.'" >'.($search_text!=''?'<span>'.$search_text.'</span>':'').'<i class="fa '.$search_icon.'"></i></div>
	<div class="'.$custom_class.' ls-fullscreen-'.$rand_id.' ls-fullscreen hideSweetAlert" data-animation="pop">
    	<div class="ls-fullscreen-close ls-fullscreen-close-'.$rand_id.'">
        	<i class="fa fa-times"></i>
        </div>
	';
	$final_html.= $search_html;
	
	$final_html.='
	
    </div>
	
	';
?>