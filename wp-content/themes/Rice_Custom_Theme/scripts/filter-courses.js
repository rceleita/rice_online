(function($) {
    'use strict';

    var $taxonomyNav = $('nav.taxonomy-nav');
    var $taxonomyDropdown = $('select.taxonomy-dropdown');
    // var $numResultsNav = $('nav.num-results-nav');
    // var num = $numResultsNav.find('a.active').data('num');
    var num = -1;
    var $grid = $('.course-holder');

    var getLoadingHTML = function() {
        return $('<div></div>', {
            'class': 'loading',
            'html': '<i class="fa fa-spinner fa-spin"> </i><p>Loading...</p>'
        });
    };

    var getData = function(terms, num, postType) {
        var data = {
            action: 'filter_taxonomy',
            elr_nonce: elr_vars.elr_nonce,
            elr_current_term: elr_vars.elr_current_term,
            type: 'post',
            taxonomy: terms,
            num: num,
            post_type: postType
        };

        var fetchPosts = $.ajax({
            type: 'POST',
            url: elr_vars.elr_ajax_url,
            data: data
        });

        fetchPosts.fail(function(jqXHR, textStatus) {
            console.log('Request failed: ' + textStatus);
        });

        fetchPosts.done(function(response) {
            updateGrid(response);
        });

    };

    var updateGrid = function(data) {
        $grid.html(data);
    };

    var initButtons = function(terms) {
        var $taxonomyButtons = $taxonomyNav.find('a');

        $.each(terms, function(currentTax, currentTerm) {
            $taxonomyButtons.each(function() {
                var $that = $(this);
                var $ul = $that.closest('ul');
                // var href = $that.attr('href');
                var tax = $ul.data('tax');
                var term = $that.data('term');

                if (tax === currentTax && term === currentTerm) {
                    $ul.find('a').removeClass('active');
                    $that.addClass('active');
                }
            });
        });
    };

    var getNewHash = function(terms) {
        var newHash = '';

        $.each(terms, function(k, v) {
            var key = k.replace('_', '-');
            var hashKey = key + ":" + v;

            if (newHash === '') {
                return newHash += '' + hashKey;
            } else {
                return newHash += '&' + hashKey;
            }
        });

        return newHash;
    };

    var parseHash = function() {
        var hash = window.location.hash.replace('#', '');
        var terms = {'type': elr_vars.elr_current_type};

        if (hash) {
            var newHash = hash.split('&');

            $.each(newHash, function(k, v) {
                var newValue = v.split(':');
                var tax = newValue[0].replace('-', '_');
                var term = newValue[1];

                if (term !== 'all') {
                    terms[tax] = term;
                }
            });
        }

        return terms;
    };

    var updateTerms = function(tax, term, terms) {
        if (term !== 'all') {
            terms[tax] = term;
        } else if (term === 'all' && elr_vars.elr_current_term) {
            delete terms[tax];
            terms[elr_vars.elr_current_tax] = elr_vars.elr_current_term;
        } else {
            delete terms[tax];
        }

        return terms;
    };

    if ($taxonomyNav.length) {
        var postType = $grid.data('post-type');
        var hash = window.location.hash;
        var terms = parseHash();
        var posts = null;

        initButtons(terms);

        if (hash) {
            $grid.html(getLoadingHTML());
            getData(terms, num, postType);
        }
    }

    $taxonomyNav.on('click', 'a', function(e) {
        e.preventDefault();
        var $that = $(this);
        var $ul = $that.closest('ul');
        var tax = $ul.data('tax');
        var term = $that.data('term');

        posts = null;
        terms = updateTerms(tax, term, terms);

        $ul.find('a').removeClass('active');
        $that.addClass('active');

        window.location.hash = getNewHash(terms);

        $grid.html(getLoadingHTML());
        getData(terms, num, postType);
    });

    $taxonomyDropdown.on('change', function() {
        var $that = $(this);
        var tax = $that.data('tax');
        var term = $that.val();

        // console.log(tax + ': ' + term);

        posts = null;
        terms = updateTerms(tax, term, terms);

        window.location.hash = getNewHash(terms);

        $grid.html(getLoadingHTML());
        getData(terms, num, postType);
    });

})(jQuery);