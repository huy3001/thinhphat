;
(function ($) {
    "use strict";
    // Price Filter
    if (jQuery('.price_slider_wrapper').size() > 0) {
        setInterval(function woopricefilter() {
            var price_amount = jQuery('.price_slider_amount');
            var price_slider = jQuery('.price_slider');
            var price_from = price_amount.find('span.from').text();
            var price_to = price_amount.find('span.to').text();

            price_slider.find('.ui-slider-handle').first().attr('data-width', price_from);
            price_slider.find('.ui-slider-handle').last().attr('data-width-r', price_to);
        }, 100);
    }

    jQuery(document).ready(function () {
        // Shop Title
        var woo_container = jQuery('.woocommerce_container');
        var page_title = jQuery('.page_title');
        var page_descr = jQuery('.page-description');

        if (woo_container.size() > 0 && page_title.size() > 0) {
            var p_title = woo_container.find('h1.page-title').html();
            jQuery('.page_title h1').append(p_title);
            if (woo_container.size() > 0 && page_descr.size() > 0) {
               page_title.append('<div class="icon_divider"></div>' + page_descr.html());
            }
        }

        // Cart Collaterals
        var cart_collaterals = jQuery('.cart-collaterals');
        if (cart_collaterals.size() > 0) {
            var cart_calc = cart_collaterals.find('.woocommerce-shipping-calculator').parent().html();
            if (typeof cart_calc !== 'undefined') {
                jQuery('.cart-collaterals .order-total').before('<tr><td class="fake_calc" colspan="2">' + cart_calc + '<div class="clea_r"></div></td></div>');
            }
        }

        // Add to cart button (add icon)
        var list_details_btn = jQuery('.woocommerce ul.products li.product .shop_list_details a.button');
        if (list_details_btn.size() > 0) {
            list_details_btn.append('<i class="fa fa-shopping-cart"></i>');
        }

        // Sale label
        var onsale = jQuery('.single-product .product span.onsale');
        if (onsale.size() > 0) {
            jQuery('.single-product .images .woocommerce-main-image').append(onsale.detach());
        }

        // Wrap shop ordering
        if (jQuery('.woocommerce-result-count').size() > 0) {
            jQuery('p.woocommerce-result-count, form.woocommerce-ordering').wrapAll('<div class="shop_ordering clearfix" />');
        }

        //	Product Comment Form
        if (jQuery('#commentform').size() > 0) {
            jQuery('.comment-form-author #author').attr('placeholder', jQuery('.comment-form-author label').text());
            jQuery('.comment-form-email #email').attr('placeholder', jQuery('.comment-form-email label').text());
            jQuery('.comment-form-comment #comment').attr('placeholder', jQuery('.comment-form-comment label').text());
        }

        // Shop Table Wrap
        var shop_table = jQuery('.shop_table');
        if (shop_table.size() > 0) {
            shop_table.each(function () {
                jQuery(this).wrap('<div class="shop_table_wrap" />');
            });
        }

    });

    jQuery(window).load(function () {
        // Woocommerce
        jQuery(".woocommerce-page .widget_price_filter .price_slider").wrap("<div class='price_filter_wrap'></div>");
        jQuery(".shop_table.cart").wrap("<div class='woo_shop_cart'></div>");
    });
})(jQuery);
