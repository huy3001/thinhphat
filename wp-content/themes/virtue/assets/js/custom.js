/* Virtue theme custom js */

(function($) {
    var customJS = {
        portfolioHeight: function() {
            var portfolioItem = $('.kad_portfolio_item');
            if(portfolioItem.length) {
                portfolioItem.each(function() {
                    $(this).height($(this).width());
                    var portfolioImage = $(this).find('.imghoverclass img');
                    portfolioImage.imgCentering({
                        'forceSmart': true
                    });
                });
            }
        }
    };

    // Window load function //
    $(window).load(function() {
        // Portfolio height
        customJS.portfolioHeight();
    });
})(jQuery);