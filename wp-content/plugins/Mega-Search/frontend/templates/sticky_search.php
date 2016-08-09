<?php
	$final_html='';

	if ($sticky_position=='top'){
		$final_html.='
		
		 <script>
			jQuery( document ).ready(function($) {

				$(document).keyup(function(e){		
					if(e.keyCode==27)
					{
						if($("#pw_main_search_result_'.$rand_id.'").css("display")=="block")
						{
							$("#pw_main_search_result_'.$rand_id.'").css("display","none");
						}else if($( ".ls-top-sticky-'.$rand_id.'" ).css("display")=="block"){
							if($(".ls-top-sticky-'.$rand_id.'").hasClass("show-top-sticky"))
							{
								$(".ls-top-sticky-'.$rand_id.'").removeClass("show-top-sticky");
							}
						}
					}
				});
				
				//Show Fullscreen form
				$(".ls-top-sticky-btn-'.$rand_id.' , .ls-top-sticky-close-'.$rand_id.'").click(function(){
					
					if($(".ls-top-sticky-'.$rand_id.'").hasClass("show-top-sticky"))
					{
						$("#pw_livesearch_form_'.$rand_id.' input[name=\'pw_livesearch_q\']").val("");
						$("#pw_main_search_result_'.$rand_id.'").css("display","none");
					}
					
					$(".ls-top-sticky-'.$rand_id.'").toggleClass("show-top-sticky");
					$("#pw_livesearch_form_'.$rand_id.' input").focus();
				});
				
				$(window).resize(function(){
					if($( ".ls-top-sticky-'.$rand_id.'" ).is(":visible") && $( ".ls-result" ).is(":visible"))
					{
						sticky_top_responsive_height("'.$rand_id.'");
					}
				});
				
				';
				if($default_search_id=='')
				{
					$final_html.='$("body").append($(".ls-top-sticky-'.$rand_id.'"));';
				}
				$final_html.='
			});
			
		</script>
		
		<div class="'.$custom_class.'  ls-top-sticky ls-top-sticky-'.$rand_id.'">
			<div class="ls-top-sticky-close ls-top-sticky-close-'.$rand_id.' ls-close-'.$sticky_top_btn_position.'-btn"><i class="fa fa-angle-double-up"></i></div>
			';
			$final_html.= $search_html.
			'<div class="ls-top-sticky-btn ls-top-sticky-btn-'.$rand_id.' ls-'.$sticky_top_btn_position.'-btn" title="'.($search_text!=''?$search_text:'').'"><i class="fa '.$search_icon.'"></i></div>
		</div>
		';
	}
	else {
		$final_html.='
		
		 <script>
			jQuery( document ).ready(function($) {
				
				
				$(document).keyup(function(e){		
					if(e.keyCode==27)
					{
						if($("#pw_main_search_result_'.$rand_id.'").css("display")=="block")
						{
							$("#pw_main_search_result_'.$rand_id.'").css("display","none");
						}else if($( ".ls-sticky-cnt-'.$rand_id.'" ).css("display")=="block"){
							if($(".ls-sticky-cnt-'.$rand_id.'").hasClass("ls-hide-sticky"))
							{
								
							}else
							{
								$(".ls-sticky-cnt-'.$rand_id.'").addClass("ls-hide-sticky");
							}
						}
					}
				});
				
				//Show Fullscreen form
				
				$(".ls-sticky-btn-'.$rand_id.'").click(function(){
					
					if($(".ls-sticky-cnt-'.$rand_id.'").hasClass("ls-hide-sticky"))
					{
						
					}else{
						$("#pw_livesearch_form_'.$rand_id.' input[name=\'pw_livesearch_q\']").val("");
						$("#pw_main_search_result_'.$rand_id.'").css("display","none");
					}
					
					$(".ls-sticky-cnt-'.$rand_id.'").toggleClass("ls-hide-sticky");
					$("#pw_livesearch_form_'.$rand_id.' input").focus();
				});
				
				
				';
				if($default_search_id=='')
				{
					$final_html.='$("body").append($(".ls-sticky-cnt-'.$rand_id.'"));';
				}
				$final_html.='
			});
			
		</script>
		
		<div class="'.$custom_class.'  ls-sticky-cnt  ls-sticky-cnt-'.$rand_id.' ls-'.$sticky_position.'-sticky ls-hide-sticky ls-sticky-'.$rand_id.'">
			<div class="ls-sticky-btn ls-sticky-btn-'.$rand_id.'" title="'.($search_text!=''?$search_text:'').'"><i class="fa  '.$search_icon.'"></i></div>
			<div class="ls-sticky-search-cnt ls-sticky-search-cnt-'.$rand_id.'">
				
			
		';
		$final_html.=$search_html.
			'</div><!--Ls-search-box -->
		</div>';
	}//end else
?>