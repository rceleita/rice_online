(function() {
	var val;
	tinymce.PluginManager.add('als_shortcodes', function( editor, url ) {
		editor.addButton( 'als_shortcodes', {
			title: 'Mega Search Shortcodes',
			icon: 'icon als-shortcodes-icon',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Choose ALS Shortcode',
					body: [
					{
						type: 'listbox', 
						name: 'level', 
						label: 'Shortcodes ', 
					    values: mce_options.pages,
						onselect: function(e) {
							val = this.value();
						}
					}],
					onsubmit: function( e ) {
						editor.insertContent(val);
					}
				}); 
					
			}
      });
   });
})();
	
/*(function($) {
    tinymce.PluginManager.add('als_shortcodes', function( editor, url ) {
        editor.addButton( 'als_shortcodes', {
            title: 'ALS Shortcodes',
            type: 'listbox',
			fixedWidth: true,
            icon: 'icon als-shortcodes-icon',
            values: mce_options.categories,
			onselect: function() {
				//insert key
				editor.insertContent(this.value());
				
				//reset selected value
				this.value(null);
			},
        });
    });
})();*/