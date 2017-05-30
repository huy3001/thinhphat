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

        portfolioSlider: function() {
            var slider = $('.new-portfolio .portfolio-grid-list');
            if(slider.length) {
                slider.slick({
                    autoplay: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
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

        // Portfolio slider
        customJS.portfolioSlider();

        // Menu fixed
        customJS.menuFixed();
    });
})(jQuery);