;
(function ($) {
    "use strict";

    // Subscribe Shortcode
    function gt3_subscribe_block() {
        jQuery('.shortcode_subscribe form').css({'padding-right': jQuery('.shortcode_subscribe .subscribe_btn').width() + 20 + 'px'});
    }

    // Fullwidth Block
    function gt3_fw_block() {
        var tag_div = jQuery('div');
        if (tag_div.hasClass('right-sidebar') || tag_div.hasClass('left-sidebar')) {
        } else {
            var fw_block = jQuery('.fw_block');
            var fw_block_parent = fw_block.parent().width();
            var fw_site_width = fw_block.parents('.wrapper').width();
            var fw_contentarea_site_width_diff = fw_site_width - fw_block_parent;
            fw_block.css('margin-left', '-' + fw_contentarea_site_width_diff / 2 + 'px').css('width', fw_site_width + 'px').children('.fw_wrapinner').css('padding-left', fw_contentarea_site_width_diff / 2 + 'px').css('padding-right', fw_contentarea_site_width_diff / 2 + 'px');
            jQuery('.wall_wrap .fw_wrapinner').css('padding-left', '0px').css('padding-right', '0px');
        }
    }

    // Colored Info List
    function gt3_colored_section() {
        var maxHeight = 0;
        var colored_section = jQuery(".colored_section");
        colored_section.css({'height': 'auto'});
        colored_section.each(function () {
            if (jQuery(this).height() > maxHeight) {
                maxHeight = jQuery(this).height();
            }
        });
        colored_section.height(maxHeight);
    }

    //	Video iframe height
    function gt3_video_size() {
        var loaded_video_size = setTimeout(function () {
            jQuery('.blog_post_video, .video_module, .format-video').each(function () {
                jQuery(this).find('iframe').css({'height': jQuery(this).width() * 9 / 16 + 'px'});
            });
            clearTimeout(loaded_video_size);
        }, 3000);
    }

    //	Slick Carousel Arrows
    function gt3_slickSliderAr() {
        var windowW = jQuery(window).width();
        var containerW = jQuery(".ult-carousel-wrapper").width();
        var leftPart = (windowW - containerW) / 2 - 50;
        jQuery(".slick-prev").css("left", -leftPart);
        jQuery(".slick-next").css("right", -leftPart);
    }

    //	Min height blog post content
    function gt3_minheight_blogpost() {
        jQuery('.blog_post_preview.no-post-thumbnail').each(function () {
            var listingmetaH = jQuery(this).find(".listing_meta").height() + 60;
            jQuery(this).find(".blog_content").css("min-height", listingmetaH + "px");
        });

        jQuery('.single_post .blog_post_preview').each(function () {
            var listingmetaH = jQuery(this).find(".listing_meta").height() + 10;
            jQuery(this).find(".blog_content").css("min-height", listingmetaH + "px");
        });

        jQuery('.single_post .blog_post_preview.no-post-thumbnail').each(function () {
            var listingmetaH = jQuery(this).find(".listing_meta").height() + 60;
            jQuery(this).find(".blog_content").css("min-height", listingmetaH + "px");
        });
    }

    //	Boxed container
    function gt3_boxed_container() {
        if (jQuery('.gt3_boxed').size() > 0 && jQuery(window).width() > 850) {
            var wrap_cont = jQuery('.wrapper .container');
            jQuery('.gt3_boxed #page_container, .gt3_boxed .fixed-menu').width(wrap_cont.width() + 60 + 'px');
            if (jQuery('.page_with_abs_header').size() > 0) {
                jQuery('.gt3_boxed #main_header').width(wrap_cont.width() + 60 + 'px');
            }
        } else {
            jQuery('.gt3_boxed #page_container, .gt3_boxed .fixed-menu').width(100 + '%');
            if (jQuery('.page_with_abs_header').size() > 0) {
                jQuery('.gt3_boxed #main_header').width(100 + '%');
            }
        }
        var page_container = jQuery('#page_container');
        if (page_container.size() > 0) {
            page_container.css({'min-height': jQuery(window).height() + 'px'});
        }
    }

    jQuery(document).ready(function () {
        // Content FadeIn
        var bodytimer = setTimeout(function () {
            jQuery('body').animate({'opacity': '1'}, 800);
            clearTimeout(bodytimer);
        }, 1000);

        // Custom Bg
        if (jQuery('.img_bg').size() > 0 || jQuery('.pattern_bg').size() > 0) {
            jQuery('body').addClass('gt3_boxed');
        }
        if (jQuery('.clean_bg').size() > 0) {
            jQuery('body').addClass('gt3_clean');
        }

        // Fixed Menu
        var fixed_menu_class = jQuery('.fixed-menu');
        var header_wrap_class = jQuery('.header_parent_wrap');
        if (jQuery('.true_fixed_menu').size() > 0) {
            fixed_menu_class.append(header_wrap_class.html());
            fixed_menu_class.css({'top': -fixed_menu_class.height() * 2 + 'px'});

            fixed_menu_class.addClass(jQuery('#main_header').attr('class'));
            jQuery(window).on('scroll', function () {
                var header_offset = '';
                if (jQuery('.fullscreenbanner').size() > 0 || jQuery('.fullwidthbanner-container').size() > 0) {
                    header_offset = jQuery(window).height() - (jQuery('.logo_sect img').height() + 72);
                }
                else {
                    header_offset = header_wrap_class.offset().top + header_wrap_class.height() * 2;
                }
                if (jQuery(window).scrollTop() > header_offset) {
                    fixed_menu_class.addClass('fixed_show');
                } else {
                    fixed_menu_class.removeClass('fixed_show');
                }
            });
        }

        // SubMenu
        jQuery("nav .menu > li").hoverIntent({
            sensitivity: 1, // number = sensitivity threshold (must be 1 or higher)
            interval: 400,  // number = milliseconds for onMouseOver polling interval
            timeout: 500,   // number = milliseconds delay before onMouseOut
            over: function () {
                jQuery(this).removeClass("hoverOut").toggleClass("hoverIn");
            },
            out: function () {
                jQuery(this).removeClass("hoverIn").toggleClass("hoverOut");
            }
        });

        // Mobile Menu
        var main_header = jQuery('#main_header header');
        main_header.append('<a href="javascript:void(0)" class="menu_toggler"></a><div class="mobile_menu_wrapper"><ul class="mobile_menu container"/></div>');
        jQuery('.mobile_menu').html(main_header.find('.menu').html());
        jQuery('.mobile_menu_wrapper').hide();
        jQuery('.menu_toggler').on("click", function () {
            jQuery('.mobile_menu_wrapper').slideToggle(300);
            jQuery(this).toggleClass("close_toggler");
        });
        jQuery('.mobile_menu a').each(function () {
            jQuery(this).addClass("mob_link");
        });
        jQuery('.mobile_menu li').find('a').on("click", function () {
            jQuery(this).parent().toggleClass("showsub");
        });

        // Top Search
        if (jQuery('.top_search').size() > 0) {
            jQuery('.search_btn').on("click", function () {
                jQuery('.top_search').toggleClass("active");
            });
            jQuery("html, body").on('click', function (e) {
                if (!jQuery(e.target).hasClass("not_click")) {
                    jQuery('.top_search').removeClass("active");
                }
            });
        }

        // Search Submit
        if (jQuery('.search_form').size() > 0 && jQuery('.woocommerce-product-search').size() > 0) {
            jQuery('.search_form, .woocommerce-product-search').each(function () {
                var $this = jQuery(this);
                $this.find('input[type="submit"]').mouseenter(function () {
                    $this.addClass('active_submit');
                }).mouseleave(function () {
                        $this.removeClass('active_submit');
                    }
                );
            });
        }

        // Header Types
        var cart_in_header = jQuery('.cart_in_header');
        var cart_button = jQuery('.cart_btn');
        if (cart_in_header.size() > 0 && cart_button.size() > 0) {
            cart_in_header.append('<div class="cart_btn">' + cart_button.html() + '</div>');
        }

        var socials_in_header = jQuery('.socials_in_header');
        var social_icons = jQuery('.social_icons');
        if (socials_in_header.size() > 0 && social_icons.size() > 0) {
            socials_in_header.append('<div class="social_icons">' + social_icons.html() + '</div>');
        }

        if (jQuery('.fullscreenbanner').size() > 0 || jQuery('.fullwidthabanner').size() > 0) {
            jQuery('#main_header').addClass('mb0');
        }

        var fullscreen_slider = jQuery('.fullscreen_slider');
        if (fullscreen_slider.size() > 0) {
            fullscreen_slider.parent().append('<div class="mouse_icon" />');
        }

        //	Submit Button wrap
        var form_submit = jQuery('p.form-submit');
        if (form_submit.size() > 0) {
            form_submit.each(function () {
                jQuery(this).addClass('comment_submit_wrap');
                jQuery(this).append('<i class="fa fa-hand-o-right"></i>');
            });
        }

        // Form Allowed Tags
        var form_tags = jQuery('.form-allowed-tags');
        if (form_tags.size() > 0) {
            form_tags.width(jQuery('#commentform').width() - jQuery('.comment_submit_wrap').width() - 20);
            jQuery('.comment-reply-link').on("click", function () {
                form_tags.width(jQuery('#commentform').width() - jQuery('.comment_submit_wrap').width() - 20);
            });
        }

        // Subscribe Shortcode
        var shortcode_subscribe = jQuery('.shortcode_subscribe');
        if (shortcode_subscribe.size() > 0) {
            shortcode_subscribe.find('#submit').wrap('<div class="subscribe_btn" />');
            gt3_subscribe_block();
        }

        var fw_block = jQuery('.fw_block');
        if (fw_block.size() > 0) {
            fw_block.not(".wall_wrap").wrapInner('<div class="fw_wrapinner"></div>');
            gt3_fw_block();
        }

        // Ultimate Button
        var ubtn = jQuery('.ubtn');
        if (ubtn.size() > 0) {
            ubtn.each(function () {
                var $this = jQuery(this);
                $this.find(".ubtn-hover").hide();
                $this.mouseenter(function () {
                    $this.find(".ubtn-data.ubtn-icon i").removeAttr('style').css("color", $this.data('hover'));
                    $this.css({'background': $this.data('hover-bg')});
                }).mouseleave(function () {
                        var $this = jQuery(this);
                        $this.find(".ubtn-data.ubtn-icon i").removeAttr('style');
                        $this.css({'background': $this.data('bg')});
                    }
                );
            });
        }

        // Progress Bar
        if (jQuery('.vc_progress_bar').size() > 0) {
            jQuery('.vc_single_bar').each(function () {
                jQuery(this).find('.vc_bar').wrap('<div class="skill_wrap" />');
            });
        }

        // Colored Info List
        if (jQuery('.colored_sections').size() > 0) {
            gt3_colored_section();
        }

        // Video iframe height
        gt3_video_size();

        gt3_minheight_blogpost();

        // Responsive Changes
        var pricing_table = jQuery('.ult_pricing_table');
        if (pricing_table.size() > 0) {
            pricing_table.parents('.vc_row').addClass('col_50');
        }
        var stats_block = jQuery('.stats-block');
        if (stats_block.size() > 0) {
            stats_block.parents('.vc_row').addClass('col_50');
        }
        var aio_icon = jQuery('.custom_ipad .aio-icon-component');
        if (aio_icon.size() > 0) {
            aio_icon.parents('.vc_row').addClass('col_50');
        }
        var flipbox_wrap = jQuery('.flip-box-wrap ');
        if (flipbox_wrap.size() > 0) {
            flipbox_wrap.parents('.vc_row').addClass('col_50');
        }

        gt3_boxed_container();

    });

    jQuery(window).resize(function () {
        // Form Allowed Tags
        var form_tags = jQuery('.form-allowed-tags');
        if (form_tags.size() > 0) {
            form_tags.width(jQuery('#commentform').width() - jQuery('.comment_submit_wrap').width() - 20);
        }
        if (jQuery('.shortcode_subscribe').size() > 0) {
            gt3_subscribe_block();
        }
        if (jQuery('.fw_block').size() > 0) {
            gt3_fw_block();
        }
        // Colored Info List
        if (jQuery('.colored_sections').size() > 0) {
            gt3_colored_section();
        }
        //	Video iframe height
        gt3_video_size();

        gt3_slickSliderAr();

        gt3_minheight_blogpost();

        gt3_boxed_container();

        // Fixed Menu
        var fixed_menu_class = jQuery('.fixed-menu');
        var header_wrap_class = jQuery('.header_parent_wrap');
        if (jQuery('.true_fixed_menu').size() > 0) {
            fixed_menu_class.css({'top': -fixed_menu_class.height() * 2 + 'px'});

            fixed_menu_class.addClass(jQuery('#main_header').attr('class'));
            jQuery(window).on('scroll', function () {
                var header_offset = '';
                if (jQuery('.fullscreenbanner').size() > 0 || jQuery('.fullwidthbanner-container').size() > 0) {
                    header_offset = jQuery(window).height() - (jQuery('.logo_sect img').height() + 72);
                }
                else {
                    header_offset = header_wrap_class.offset().top + header_wrap_class.height() * 2;
                }
                if (jQuery(window).scrollTop() > header_offset) {
                    fixed_menu_class.addClass('fixed_show');
                } else {
                    fixed_menu_class.removeClass('fixed_show');
                }
            });
        }
    });

    jQuery(window).load(function () {
        if (jQuery('.fullscreenbanner').size() > 0) {
            var loadedtimer = setTimeout(function () {
                jQuery('.fullscreenbanner').parent().addClass('loaded');
                clearTimeout(loadedtimer);
            }, 3000);
        }

        gt3_slickSliderAr();
    });

})(jQuery);