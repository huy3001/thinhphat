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
        },

        menuFixed: function() {
            var menu = $('.header-nav'),
                header = $('header.headerclass'),
                menuOffset = menu.offset().top;
            if(menu.length) {
                $(window).on('scroll', function() {
                    if($(window).scrollTop() > menuOffset) {
                        header.addClass('fixed');
                    }
                    else {
                        header.removeClass('fixed');
                    }
                });
            }
        }
    };

    // Window load function //
    $(window).load(function() {
        // Portfolio height
        customJS.portfolioHeight();

        // Menu fixed
        customJS.menuFixed();
    });
})(jQuery);