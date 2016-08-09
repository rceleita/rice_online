/*jslint  browser: true, white: true, plusplus: true */
/*global $, countries */

jQuery(function($) {

    'use strict';
	if(params.autocomplete_source=='serach_statistics'){
		var statistics_data_Array = $.map(statistics_data, function (value, key) { return { value: value, data: key }; });

		// Initialize ajax autocomplete:
		$('.autocomplete-ajax-main').autocomplete({
			// serviceUrl: '/autosuggest/service/url',
			lookup: statistics_data_Array,
			lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
				var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
				return re.test(suggestion.value);
			},
			onSelect: function(suggestion) {
				$('.selction-ajax-main').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
			},
			onHint: function (hint) {
				//$('.autocomplete-ajax-x').val(hint);
			},
			onInvalidateSelection: function() {
				//$('.selction-ajax-main').html('You selected: none');
			}
		});
	}else if(params.autocomplete_source='post_title'){
		// Initialize autocomplete with local lookup:
		$('#autocomplete').devbridgeAutocomplete({
			lookup: teams,
			minChars: 1,
			onSelect: function (suggestion) {
				$('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data.category);
			},
			showNoSuggestionNotice: true,
			noSuggestionNotice: 'Sorry, no matching results',
			groupBy: 'category'
		});
	}

});