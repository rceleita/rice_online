jQuery(function(jQuery) {
	
	//UPLOAD SINGLE IMAGE
	
	if ( ! jQuery('.custom_upload_image').val() )
	{
		jQuery('.custom_upload_image').parent().find('.pw_livesearch_remove_image_button').hide();
	}

	// Uploading files
	var file_frame;
	

	jQuery('.pw_livesearch_upload_image_button').click(function( event ){

		event.preventDefault();
		
		elm=jQuery(this);
		data_id=elm.attr('data-id');
		//confirm(elm.parent().find('.pw_livesearch_remove_image_button').html());
		
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.downloadable_file = wp.media({
			title: 'Choose image',
			button: {
				text: 'Use image',
			},
			multiple: false
		});

		file_frame.on('open', function() {
			
			var selection = file_frame_gallery.state().get('selection');
			
			
			ids = formfield.val().split(',');
				ids.forEach(function(id) {
					attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add( attachment ? [ attachment ] : [] );
				});
			//}
			
		});
		
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			formfield.val( attachment.id );
			preview.attr('src', attachment.url );

			//jQuery('.pw_livesearch_remove_image_button_'+data_id).show();
			elm.parent().find('.pw_livesearch_remove_image_button').show();

		});

		// Finally, open the modal.
		file_frame.open();
	});

	jQuery(document).on( 'click', '.pw_livesearch_remove_image_button', function( event ){
		
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
	
		formfield.val('');
		preview.attr('src', '' );
		jQuery(this).hide();
		return false;
	});
	
	
	
	///IMAGE GALLERY
	if ( ! jQuery('.custom_upload_imagegallery').val() )
	{
		jQuery('.pw_livesearch_remove_imagegallery_button').hide();
	}

	// Uploading files
	var file_frame_gallery;

	jQuery(document).on( 'click', '.pw_livesearch_upload_imagegallery_button', function( event ){

		event.preventDefault();
		
		formfield = jQuery(this).siblings('.custom_upload_imagegallery');
		preview = jQuery(this).siblings('.custom_preview_imagegallery');
		
		// If the media frame already exists, reopen it.
		if ( file_frame_gallery ) {
			file_frame_gallery.open();
			return;
		}

		// Create the media frame.
		file_frame_gallery = wp.media.frames.downloadable_file = wp.media({
			title: 'Add Image to Gallery',
			button: {
				text: 'Insert to Gallery',
			},
			multiple : true,
		});
		
		file_frame_gallery.on('open', function() {
			
			var selection = file_frame_gallery.state().get('selection');
			ids = formfield.val().split(',');
			ids.forEach(function(id) {
				attachment = wp.media.attachment(id);
				attachment.fetch();
				selection.add( attachment ? [ attachment ] : [] );
			});
		});
		

		// When an image is selected, run a callback.
		file_frame_gallery.on( 'select', function() {

			var selection_image=Array();
			var selection_items_dom='';
			var i=0;
			var selection = file_frame_gallery.state().get('selection');
			selection.map( function( attachment ) {	
		 		if(attachment.id!='' && attachment.id!=null && attachment.url!='' && attachment.url!=null )
				{
					attachment = attachment.toJSON();
					//selection_image[i++]=attachment.id+"@"+attachment.url;
					selection_image[i++]=attachment.id;
					
					selection_items_dom+="<div style='float:left'><div class='del_imagegallery'>X</div><img src='"+attachment.url+"' class='custom_preview_imagegallery' width='100' height='100' data-id='"+attachment.id+"'/></div>";
					
				}
			});
			
			formfield.val( selection_image.join(",") );
			jQuery("#pw_livesearch_upload_imagegallery_items").html(selection_items_dom);
			
			jQuery('.pw_livesearch_remove_imagegallery_button').show();
		});

		// Finally, open the modal.
		file_frame_gallery.open();
	});
	
	jQuery(document).on( 'click',".del_imagegallery",function(){
		
		var val=jQuery(".custom_upload_imagegallery").val();
		val=val.replace(jQuery(this).siblings("img").attr("data-id")+",", "");
		val=val.replace(jQuery(this).siblings("img").attr("data-id"), "");
		jQuery(".custom_upload_imagegallery").val(val);
		jQuery(this).parent().remove();
		
		if(val=='')
		{
			jQuery('.pw_livesearch_remove_imagegallery_button').hide();
		}
		
	});
	
	jQuery(document).on( 'click', '.pw_livesearch_remove_imagegallery_button', function( event ){
		
		formfield = jQuery(this).siblings('.custom_upload_imagegallery');
		preview = jQuery(this).siblings('.custom_preview_imagegallery');
	
		formfield.val('');
		preview.attr('src', '' );
		jQuery(this).siblings('.pw_livesearch_remove_imagegallery_button').hide();
		jQuery("#pw_livesearch_upload_imagegallery_items").html('');
		return false;
	});
	
	////////////////////////////
	// SECTIIONS IN ADMIN FORM
	///////////////////////////
	
	
	
	
	
	jQuery('body').on('click','#la_ds_tab_button', function() {
		
		var tab_to_active = '#' + jQuery(this).attr('data-tab_to_active');

		jQuery('.la_ds_tab_button1').removeClass('active');
		jQuery('.la_ds_tab_button2').removeClass('active');
		jQuery('.la_ds_tab_button3').removeClass('active');
		jQuery('.la_ds_tab_button4').removeClass('active');
		jQuery(this).addClass('active');		
		
		
		jQuery(".accordion").each(function(index, element) {
            jQuery(this).hide();
        });
		jQuery(tab_to_active).show();
		
		
		//jQuery('.la_ds_tab_content').hide();
		
		//jQuery('.la_ds_tab_content').removeClass('active');
		jQuery(tab_to_active).addClass('active');		
	});
	
	jQuery('body').on('click','.layouts_thumbnail_main', function() {
		jQuery("#"+param.variable_perfix+"section_type").val(jQuery(this).attr('id'));
		set_main_layout_box(jQuery(this).attr('data-section'),jQuery(this).attr('id'));	
	});
		
	//ACCORDION
	 function close_accordion_section() {
        jQuery('.accordion .accordion-section-title').removeClass('active');
        jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
    }
 
    jQuery('.accordion-section-title').click(function(e) {
        // Grab current anchor value
        var currentAttrValue = jQuery(this).attr('href');
 
        if(jQuery(e.target).is('.active')) {
            close_accordion_section();
        }else {
            close_accordion_section();
 
            // Add active class to section title
            jQuery(this).addClass('active');
            // Open up the hidden content panel
            jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open'); 
        }
 
        e.preventDefault();
    });
	
	jQuery(".pw_section_image").click(function(){
		
		var type = jQuery(this).attr('data-section');
		set_thumbnails_box(type,1,1);
		
		jQuery(this).siblings(".layouts_thumbnail").removeClass("selected");
		jQuery(this).addClass("selected");
		
		jQuery('#pw_section_image_val').val(type);
	});
	
});

	var count_set=0;
	function set_thumbnails_box(type,s1,s2){
		count_set++;
		var places_count = 1;
		var s_count = 1;
		switch(type){
			case '1':
				places_count = 1;
				s_count = 1;
			break;
			case '2':
				places_count = 2;	
				s_count = 2;
			break;
			case '3':
				places_count = 8;
				s_count = 3;
			break;					
			case '4':
				places_count = 7;
				s_count = 4;
			break;	
			case '5':
				places_count = 1;	
				s_count = 2;
			break;
			case '6':
				places_count = 1;
				s_count = 3;
			break;					
			case '7':
				places_count = 1;
				s_count = 4;
			break;
						
		}
		var html = '';
		for (i = 1; i <= places_count; i++){
			if(type==4 && i==5)
				continue;
			var selected = '';
			if(i == s1) selected = 'selected';
			html += "<div class='layouts_thumbnail layouts_thumbnail_main t" + type + i +" " + selected + "' id='t"+ type + i +"' data-section='"+s_count+"'></div>";
		}	
		html += "<div class='clear_both'></div>";
		jQuery("#layouts_box_thumbnail").html(html);	
		set_main_layout_box(s_count,"t" + type + "1");
		
		var section_type=jQuery("#"+param.variable_perfix+"section_type").val();
		//confirm("umad"+section_type.substr(section_type.length-1,1));
		if(jQuery("#"+param.variable_perfix+"section_type").val()=='' || count_set>1)
			jQuery("#"+param.variable_perfix+"section_type").val("t" + type + "1");
	}
	
	
	function set_main_layout_box(s_count,id){

		jQuery(".layouts_thumbnail_main").removeClass("selected");
		jQuery('#'+id).addClass("selected");
		var html = '';
		for (i = 1; i <= s_count; i++) {
			html += "<div class='"+id+i+" la_ds_tab_button"+i+"' id='la_ds_tab_button' data-tab_to_active='la_ds_tab_content_"+i+"'></div>";
		}
		
		jQuery(".layout_main_box").html(html);
		jQuery("#la_ds_tab_button").trigger("click");
		//jQuery("#type_of_box_arrange").val(id.substring(2, 3));		
	}