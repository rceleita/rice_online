(function() {
    tinymce.PluginManager.add('als_showmore', function( editor, url ) {
        editor.addButton( 'als_showmore', {
            title: 'Mega Search ShowMore Page',
            icon: 'icon als-showmore-icon',
            onclick: function() {
                editor.insertContent('[pw-ajax-live-search-page]');
            }
        });
    });
	
})();