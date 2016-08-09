	function set_resultbox_left(rand_id){
		var main_width=(jQuery(window).outerWidth());
		var result_width=jQuery("#pw_main_search_result_"+rand_id).outerWidth();
		var form_left=jQuery("#pw_livesearch_form_"+rand_id+" input").offset().left;
		
		var search_pixcel=form_left+result_width;
		//console.log("M:"+main_width+" C:"+result_width+" L:"+form_left+" R:"+search_pixcel);
		if(search_pixcel>main_width && result_width<=main_width)
		{
			var final_left=(main_width-(result_width+form_left));
			
			jQuery("#pw_main_search_result_"+rand_id).css("left",final_left+"px");
		}
		
		if (jQuery(window).outerWidth()<=768){
			jQuery("#pw_main_search_result_"+rand_id).css("left","0px");
		}
	}
	
	function set_resultbox_left_1(rand_id){
		//IF WINDOW RESIZED AFTER RESULT APPEAR, THERFORE RESULT LEFT BE CHANEGD
		var main_width=(jQuery(document).width());
		var curent_width=jQuery("#pw_main_search_result_"+rand_id).outerWidth();
		var cl=jQuery("#pw_livesearch_form_"+rand_id+" input").offset().left;
		cwidth=jQuery("#pw_livesearch_form_"+rand_id+" input").outerWidth();
		
		var final_left=(main_width-(curent_width+cl));
		//console.log("M:"+main_width+" C:"+curent_width+" L:"+cl+" R:"+final_left);
		
		
		if (jQuery(window).outerWidth()<=768){
			jQuery("#pw_main_search_result_"+rand_id).css("left","0px");
			//console.log(jQuery(window).innerWidth()+"<768");
		}else if(cwidth>=curent_width){
			jQuery("#pw_main_search_result_"+rand_id).css("left","0px");
			//console.log("tW>rW "+final_left);
		}else if(final_left!=0 && final_left<cl){
			jQuery("#pw_main_search_result_"+rand_id).css("left",final_left+"px");
			//console.log("!=0 "+final_left);
		}else if(final_left>cl){
			jQuery("#pw_main_search_result_"+rand_id).css("left",0+"px");
			//console.log("New "+final_left);
		}
		else{
			jQuery("#pw_main_search_result_"+rand_id).css("left",(cwidth-curent_width)+"px");
			//console.log("==0 "+final_left);
		}
	}
	
	
	
	
	function simple_scroller(targer_element){
		jQuery(targer_element).slimscroll({
			alwaysVisible: true,
			size: "6px",
			height: "100%"
		});
	}

	function popup_responsive_height(rand_id){
		if(jQuery( ".ls-popup-cnt-"+rand_id ).is(":visible") && jQuery( ".ls-result" ).is(":visible"))
		{
			var win_height=jQuery(window).height();
			var popup_top=jQuery( ".ls-popup-cnt-"+rand_id ).position().top;
			var popup_height=jQuery( ".ls-popup-cnt-"+rand_id ).height();
			
			var popup_pos=popup_top+popup_height;

			var other_height=jQuery( ".ls-popup-cnt-"+rand_id ).find( ".ls-search-box" ).find("form").height()+(jQuery( ".ls-popup-cnt-"+rand_id ).find( ".ls-search-box" ).position().top)*2;
			//console.log("POs: "+popup_pos+" OT:"+other_height);
			
			var added_height=win_height-popup_pos-popup_top;
			
			var final_popup_height=popup_height+added_height;
			jQuery( ".ls-popup-cnt-"+rand_id ).animate({ "height": final_popup_height+"px" },"fast" );
			
			
			var result_height=final_popup_height-other_height;
			jQuery( ".ls-result" ).css("height",result_height+"px" );
			

			//OWL CAROUSEL	
			owl_call();
		}
	}
	
	function sticky_top_responsive_height(rand_id){
		if(jQuery( ".ls-top-sticky-"+rand_id ).is(":visible") && jQuery( ".ls-result" ).is(":visible"))
		{
			var win_height=jQuery(window).height();
			
			var other_height=jQuery( ".ls-top-sticky-"+rand_id ).find( ".ls-search-box" ).find("form").height()+(jQuery( ".ls-top-sticky-"+rand_id ).find( ".ls-search-box" ).position().top)*2;
			//console.log("POs: "+popup_pos+" OT:"+other_height);
	
			var result_height=win_height-other_height;
			jQuery( ".ls-result" ).css("height",result_height+"px" );

			//OWL CAROUSEL	
			owl_call();
		}
	}
	
	function fullscreen_responsive_height(rand_id){
		if(jQuery( ".ls-fullscreen-"+rand_id ).is(":visible") && jQuery( ".ls-result" ).is(":visible"))
		{
			var win_height=jQuery(window).height();
			var popup_top=jQuery( ".ls-fullscreen-"+rand_id ).position().top;
			var popup_height=jQuery( ".ls-fullscreen-"+rand_id ).height();
			var popup_pos=popup_top+popup_height;
			var other_height=jQuery( ".ls-fullscreen-"+rand_id ).find("form").innerHeight()+(jQuery( ".ls-fullscreen-"+rand_id ).find(".ls-search-box").position().top)*2;
			
			//console.log(jQuery( ".ls-search-box" ).find("form").outerHeight());
			
			var added_height=win_height-popup_pos-popup_top;
			
			var final_popup_height=popup_height+added_height;
			jQuery( ".ls-fullscreen-"+rand_id ).animate({ "height": win_height+"px" },"fast" );
			
			
			var result_height=win_height-other_height;
			
			jQuery( ".ls-result" ).css("height",result_height+"px" );

			//OWL CAROUSEL	
			owl_call();
		}
	}
	
	function owl_call(){
		
		//confirm("sp:"+data['speed']+"co:"+data['controls']+"pg:"+data['pagination']+"mar:"+data['margin']+"auto:"+data['autoplay']+"loo:"+data['loop']+"pau:"+data['pause']+"di:"+data['descktop_item']+"ti:"+data['tablet_item']+"mi:"+data['mobile_item']);	
		
		if (jQuery(".ls-pl-bxslider").children().length > 1) {
			
			var owl_data=jQuery(".ls-pl-bxslider").attr('data-owl-settting');
			
			//confirm(owl_data);
			
			var owl_settings=Array();
			owl_settings=owl_data.split('-');
			owl_settings_field=Array();
			data=Array();
			
			jQuery.each(owl_settings, function(index, value) {
				owl_settings_field=value.split('=');
				data[owl_settings_field[0]]=owl_settings_field[1];
			});
			
			//jQuery("<div>sp:"+data['speed']+"co:"+data['controls']+"pg:"+data['pagination']+"mar:"+data['margin']+"auto:"+data['autoplay']+"loo:"+data['loop']+"pau:"+data['pause']+"di:"+data['descktop_item']+"ti:"+data['tablet_item']+"mi:"+data['mobile_item']+"</div>").insertBefore(".ls-pl-bxslider");
			
			/*if(jQuery(".ls-pl-bxslider").hasClass("owl-loaded"))
			{
				jQuery(".ls-pl-bxslider").data('owlCarousel').destroy();
			}*/
			
			jQuery(".pw_ls_loading_car").show();
			jQuery.when(
				jQuery(".ls-pl-bxslider").owlCarousel({
					nav 				: (data['controls']=='true' ? true:false),
					dots				: (data['pagination']=='true' ? true:false),
					margin				: parseInt(data['margin']),
					autoplay			: (data['autoplay']=='true' ? true:false),
					loop				: (data['loop']=='true' ? true:false),
					smartSpeed			: parseInt(data['speed']),
					autoplayHoverPause	: (data['pause']=='true' ? true:false),
					//autoWidth:true,
					responsive:{
						0:{
							items		: parseInt(data['mobile_item'])
						},
						768:{
							items		: parseInt(data['tablet_item'])
						},
						993:{
							items		: parseInt(data['desktop_item'])
						}
					}
				})
			).then(function(){
				jQuery(".pw_ls_loading_car").hide();
				jQuery(".ls-pl-bxslider").show();
			});
		}else
		{
			jQuery(".pw_ls_loading_car").show();
			jQuery.when(
				jQuery(".ls-pl-bxslider").owlCarousel({
					nav : false,
					margin:1,
					items:1,
					animateOut: 'fadeOut'
				 })
			).then(function(){
				jQuery(".pw_ls_loading_car").hide();
				jQuery(".ls-pl-bxslider").show();
			});
		}
	}
	
	function click_a(element,rand_id){
		//$(".pw_ls_showmore_link").click(function(e){
		//e.preventDefault();
		
		var rand_id=element.parent().attr("data-rand-id");
		
		
		var section_id=element.attr("data-section-id");
		var showmore_link=element.attr("href");

		jQuery("#pw_livesearch_search_section_"+rand_id).val(section_id);
		jQuery("#pw_livesearch_form_"+rand_id).attr('action',showmore_link);
		//$("#pw_livesearch_form_"+rand_id).submit();
		window.open(showmore_link+"?"+jQuery("#pw_livesearch_form_"+rand_id).serialize());
		
	//});
	}

	
	var ajaxcache={};
	function ajax_fetch_data(pdata,rand_id,ajaxurl){
		
		cache_id=rand_id+pdata['postdata'];
		
		var abort_id='';

		if ( Object.keys(ajaxcache).length > 0 )
		{
	    	jQuery.each(ajaxcache, function(index, value) {
				//console.log(value);
				if(index!=cache_id)
				{
					ajaxcache[index].abort();
					abort_id=index;
				}else
				{
					ajaxcache[cache_id]=jQuery.ajax ({
						type: "POST",
						url: ajaxurl,
						data:  pdata
					});
					return false;
				}
			});
		}
		
		if (!ajaxcache[cache_id]) {
			ajaxcache[cache_id]=jQuery.ajax ({
				type: "POST",
				url: ajaxurl,
				data:  pdata
			});
		}
		
		ajaxcache[cache_id].success(function(serverResponse){

			/*jQuery.ajax ({
				type: "POST",
				url: ajaxurl,
				data:  pdata,
			success: function(serverResponse) {*/
				
			//SEARCH STATISTICS
			pdata['action']='pw_livesearch_search_statistics';
			jQuery.ajax ({
				type: "POST",
				url: ajaxurl,
				data:  pdata,
				success: function(resps) {return false;}
			});
			
			//console.log(resp);
			var data = JSON.parse(serverResponse);
			var resp=data.html;
			//confirm(data.html);
			jQuery("#pw_loading_"+rand_id).hide();
			var arr_data=resp.split("@!");
			var $count=1;
			
			jQuery(arr_data).each(function(index, element) {
				
				var content=arr_data[index].split("#@");
				
				if(content.length>1)
				{	
					jQuery("#pw_livesearch_result_"+rand_id+"_"+$count).html(content[0]);
					jQuery(".ls-sect-readmore_"+rand_id+"_"+$count).html(content[1]);
					//$(content[1]).insertAfter("#pw_livesearch_result_"+rand_id);
				}
				else{
					jQuery("#pw_livesearch_result_"+rand_id+"_"+$count).html(content[0]);
					//$(".ls-sect-readmore_"+rand_id).find(".read-more").remove();
					jQuery(".ls-sect-readmore_"+rand_id+"_"+$count).html("");
				}
				
				jQuery(".pw_ls_showmore_link"+$count).click(function(e){
					e.preventDefault();
					click_a(jQuery(this),rand_id);
				});
				$count++
			});
			
			setTimeout(function(){
				if (jQuery(window).width()<=768){
					simple_scroller('.full-content');
				}else
				{
					simple_scroller(".ls-content-s");
				}
			},500);
			
			jQuery(".ls-pl-bxslider").hide();
			setTimeout(function(){
				//OWL CAROUSEL
				owl_call();
				
				
				//jQuery.get(params.url+'/../contact-form-7/includes/js/jquery.form.min.js', function(data) { eval(data); });

				//jQuery.get(params.url+'/../contact-form-7/includes/js/scripts.js', function(data) { eval(data); });
				
				
				//jQuery('.wpcf7-form').wpcf7InitForm();
				
				
				
			},100);	
		});
		return true;
	}

jQuery( document ).ready(function() {
	
	//HIDE SUGGECT ON SCROLL
	jQuery(window).scroll(function(){	
		if(jQuery("html").find(".autocomplete-suggestions").length>0)
		{
			jQuery(".autocomplete-suggestions").css("display","none");
		}
	});
	
	jQuery(window).resize(function(){
		
		if (jQuery(window).width()<=768){
			
			setTimeout(function(){
			  	
				//OWL CAROUSEL	
				owl_call()
				
			  	//Simple Scroll
			  	simple_scroller('.full-content');
			}, 100);
			
		}else {
			
			//OWL CAROUSEL	
			owl_call();
			
			//Simple Scroll
			simple_scroller('.ls-content-s');
		}
		
	});
	
});
