/* Virtue theme custom js */

(function($) {
    var customJS = {
        portfolioHeight: function() {
            var carouselItem = $('.kad_portfolio_item');
            if(carouselItem.length) {
                carouselItem.each(function() {
                    $(this).height($(this).innerWidth());
                    var carouselImage = $(this).find('.imghoverclass img');
                    carouselImage.imgCentering({
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