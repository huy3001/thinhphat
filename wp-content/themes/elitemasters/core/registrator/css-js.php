<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style("gt3_custom", $wp_upload_dir['baseurl'] . "/" . "custom.css");

        #JS
		wp_enqueue_script('gt3_hoverintent_js', get_template_directory_uri() . '/js/hoverintent.js', array(), false, true);
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    if (!function_exists('woo_files')) {
        function woo_files()
        {
			$wp_upload_dir = wp_upload_dir();
			
            wp_enqueue_style('css_woo', get_template_directory_uri() . '/css/woo.css');
            wp_enqueue_script('js_woo', get_template_directory_uri() . '/js/woo.js', array('jquery'), false, true);
        }
    }
    add_action('wp_print_styles', 'woo_files');
}

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    $protocol = is_ssl() ? 'https' : 'http';

    #CSS (MAIN)
    wp_enqueue_style('font_awesome', get_template_directory_uri() . '/core/admin/css/font-awesome.min.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style("admin_font", "$protocol://fonts.googleapis.com/css?family=Roboto:400,700,300");
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'));
    wp_enqueue_media();
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
}

$header_bg = gt3_get_theme_option("header_bg_color");
$header_bg_rgba = gt3_HexToRGB($header_bg);
$header_bg_opacity = gt3_get_theme_option("sticky_menu_opacity")/100;

#Data for creating static css/js files.
$gt3_custom_css = new cssJsGenerator(
    $filename = "custom.css",
    $filetype = "css",
    $output = '
		/* Custom CSS */
		h1, h1 span, h1 a {
			font-size:' . gt3_get_theme_option("h1_font_size") . ';
			line-height:' . gt3_get_theme_option("h1_line_height") . ';
		}		
		h2, h2 span, h2 a {
			font-size:' . gt3_get_theme_option("h2_font_size") . ';
			line-height:' . gt3_get_theme_option("h2_line_height") . ';
		}		
		h3, h3 span, h3 a {
			font-size:' . gt3_get_theme_option("h3_font_size") . ';
			line-height:' . gt3_get_theme_option("h3_line_height") . ';
		}		
		h4, h4 span, h4 a {
			font-size:' . gt3_get_theme_option("h4_font_size") . ';
			line-height:' . gt3_get_theme_option("h4_line_height") . ';
		}
		h5, h5 span, h5 a,
		#respond h3.comment-reply-title,
		#respond h3.comment-reply-title a {
			font-size:' . gt3_get_theme_option("h5_font_size") . ';
			line-height:' . gt3_get_theme_option("h5_line_height") . ';
		}
		h6, h6 span, h6 a {
			font-size:' . gt3_get_theme_option("h6_font_size") . ';
			line-height:' . gt3_get_theme_option("h6_line_height") . ';
		}
		body,
		input[type="text"],
		input[type="email"],
		input[type="search"],
		input[type="password"],
		input[type="submit"],
		textarea,
		.comment-form p.form-allowed-tags code {
			font-family: "' . gt3_get_theme_option("main_font") . '";
		}
		body {
			color:' . gt3_get_theme_option("main_text_color") . ';
			line-height:' . gt3_get_theme_option("content_line_height") . ';
			font-size:' . gt3_get_theme_option("content_font_size") . ';
			font-weight:' . gt3_get_theme_option("content_font_weight") . ';
		}
		#page_container {
			background:' . gt3_get_theme_option("default_bg_color") . ';
		}
		blockquote {
			line-height:' . gt3_get_theme_option("content_line_height") . ';
			font-size:' . gt3_get_theme_option("content_font_size") . ';
		}
		input[type="text"],
		input[type="email"],
		input[type="search"],
		input[type="password"],
		textarea {
			color: ' . gt3_get_theme_option("main_text_color") . ';
		}
		a {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		a:hover,
		a:focus {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		::selection {
			background:' . gt3_get_theme_option("color_theme") . ';
			color:#ffffff;
		}
		::-moz-selection {
			background:' . gt3_get_theme_option("color_theme") . ';
			color:#ffffff;
		}
		.color {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}		
		.colored_bg {
			background-color:' . gt3_get_theme_option("color_theme") . ';
		}
		.tagline,
		.tagline a,
		.social_icons a {
			color:' . gt3_get_theme_option("tagline_text_color") . ';
		}
		.tagline a:hover {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		.breadcrumbs a,
		.breadcrumbs span,
		.breadcrumbs a:after {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.breadcrumbs a:hover {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		h1, h1 span, h1 a,
		h2, h2 span, h2 a,
		h3, h3 span, h3 a,
		h4,
		h5, h5 span, h5 a,
		h6, h6 span, h6 a,
		.featured_items_title h5,
		.featured_items_title h5 a,
		.summary .amount,
		.shop_cart thead th {
			color:' . gt3_get_theme_option("headings_color") . ';
		}
		.highlighted_colored {
			background:' . gt3_get_theme_option("color_theme") . ';
		}
		#main_header,
		#main_header header {
			background:' . gt3_get_theme_option("header_bg_color") . ';
		}
		.fixed-menu header {
			background:rgba(' . $header_bg_rgba . ', ' . $header_bg_opacity . ');
		}
		.contact_text .section_title,
		.pre_footer .contact_text div.section.section_info p:first-child {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.pre_footer .contact_text div.section p:first-child a:hover {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		.footer {
			background: ' . gt3_get_theme_option("footer_bg_color") . ';
		}
		.pre_footer {
			background-color:' . gt3_get_theme_option("prefooter_bg_color") . ';
		}
		.prefooter_bgimg {
			background-image: url('.gt3_get_theme_option('bg_img_pre_footer').');
		}
		.cart_submenu,
		.cart_submenu .product_posts li a.title {
			color:' . gt3_get_theme_option("main_text_color") . ';
			font-size:' . gt3_get_theme_option("content_font_size") . ';
		}
		.tagline {
			background:' . gt3_get_theme_option("tagline_bg_color") . ';
		}
		.tagline:before {
			background: ' . gt3_get_theme_option("tagline_bg_color") . ';
		}
		header nav ul.menu > li > a,
		header nav ul.sub-menu li a {
			color: ' . gt3_get_theme_option("main_menu_text_color") . ';
		}
		header nav ul.menu > li:hover > a,
		header nav ul.menu > li.current-menu-ancestor > a,
		header nav ul.menu > li.current-menu-item > a,
		header nav ul.menu > li.current-menu-parent > a {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		header nav ul.sub-menu > li:hover > a,
		header nav ul.sub-menu > li.current-menu-item > a,
		header nav ul.sub-menu > li.current-menu-parent > a {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		header nav ul.menu .sub-nav:after {
			background: ' . gt3_get_theme_option("color_theme") . ';
		}
		.mobile_menu_wrapper,
		.mobile_menu_wrapper:before {
			background: ' . gt3_get_theme_option("color_theme") . ';
		}
		.top_search a:hover,
		.page_with_abs_header .view_cart_btn:hover {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		.foot_menu li a:hover,
		.foot_menu li.current-menu-parent a,
		.foot_menu li.current-menu-item a {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		.copyright,
		.foot_info_block,
		.footer_bottom .social_icons a,
		.footer_bottom .social_icons span {
			color: ' . gt3_get_theme_option("footer_text_color") . ';
		}
		.wpcf7-validation-errors,
		div.wpcf7-response-output {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}

		.widget_text a {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}		
		.widget_text a:hover,
		.sidepanel a:hover,
		.recent_posts li a.title:hover,
		.sidepanel li.current-menu-item a,
		.featured_items_title h5 a:hover,
		.featured_meta a:hover,
		.featured_items_body a:hover,
		.module_team h6 a:hover,
		.listing_meta a:hover,
		.blogpost_title a:hover,
		.pagerblock li a.current,
		.pagerblock li a.current:hover,
		.comment-reply-link a:hover,
		.comment_author_name a:hover,
		#respond h3.comment-reply-title a,
		.sidepanel li.current-cat a,
		h2.portf_title a:hover {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		.widget_pages ul li.current_page_item > a {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		.tagcloud a:hover {
			background:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ';
		}
		.testimonials_list li .item .testimonials_photo i,
		#comments .badge {
			background-color:' . gt3_get_theme_option("color_theme") . ';
		}

		.filter_navigation ul li ul li.selected a,
		.filter_navigation ul li ul li a:hover {
			background: ' . gt3_get_theme_option("color_theme") . ';
			border-color: ' . gt3_get_theme_option("color_theme") . ';
		}

		.pagerblock li a:hover {
			background-color: ' . gt3_get_theme_option("color_theme") . ';
			border-color: ' . gt3_get_theme_option("color_theme") . ';
		}

		blockquote:before {
			background: ' . gt3_get_theme_option("color_theme") . ';
		}
		.module_content ul li:before,
		.wpb_text_column ul li:before {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.colored_icon .ubtn-icon i {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}

		.shortcode_button.btn_type3,
		.shortcode_button.btn_type6:hover,
		.shortcode_button.btn_type6:focus {
			background: ' . gt3_get_theme_option("color_theme") . ';
			border-color: ' . gt3_get_theme_option("color_theme") . ';
		}
		
		.dark_parent .shortcode_button.btn_type6:hover,
		.dark_bg .shortcode_button.btn_type6:hover,
		.dark_parent .shortcode_button.btn_type6:focus,
		.dark_bg .shortcode_button.btn_type6:focus {
			background: ' . gt3_get_theme_option("color_theme") . ' !important;
			border-color: ' . gt3_get_theme_option("color_theme") . ' !important;
		}

		.post_format_quote_title {
			border-left:4px solid ' . gt3_get_theme_option("color_theme") . ';
		}
		
		.blog_post_readmore {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		
		.blog_post_readmore:hover {
			color: ' . gt3_get_theme_option("main_text_color") . ';
		}
		
		.post_format_link_href:hover,
		.post_format_link_href.color:hover {
			color: ' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		
		.pagerblock li a:hover {
			background-color: ' . gt3_get_theme_option("color_theme") . ';
			border-color: ' . gt3_get_theme_option("color_theme") . ';
		}

		.pagerblock li a:focus {
			color: ' . gt3_get_theme_option("main_text_color") . ';
		}

		.pagerblock li a.current,
		.pagerblock li a.current:hover {
			color: ' . gt3_get_theme_option("color_theme") . ';
		}
		
		.search_form.active_submit:before,
		.widget_product_search form.woocommerce-product-search.active_submit:before {
			color:' . gt3_get_theme_option("headings_color") . ';
		}
		
		.prev_next_links .pull-left a:hover:before,
		.prev_next_links .pull-left a:hover:after,
		.prev_next_links .pull-right a:hover:before,
		.prev_next_links .pull-right a:hover:after {
			background-color: ' . gt3_get_theme_option("color_theme") . ';
		}
		
		.comment-reply-link:hover {
			border-color: ' . gt3_get_theme_option("color_theme") . ';
			background-color: ' . gt3_get_theme_option("color_theme") . ';
		}
		.www_form input[type="text"]:focus,
		 .www_form input[type="email"]:focus {
			border-color: ' . gt3_get_theme_option("color_theme") . ';
		}
		.remove_products:hover:before,
		.remove_products:hover:after{
			background-color:' . gt3_get_theme_option("headings_color") . ' !important;
		}
		.content_block .ult_price_body .ult_price .ult_price_term {
			font-size:' . gt3_get_theme_option("content_font_size") . ';
		}
		.logged-in-as,
		.comment-notes,
		.form-allowed-tags {
			color: ' . gt3_get_theme_option("main_text_color") . ';
			font-size:' . gt3_get_theme_option("content_font_size") . ';
		}
		
		/* VC_ELEMENTS */
		.uvc-sub-heading {
			font-weight:' . gt3_get_theme_option("content_font_weight") . ' !important;
			line-height:' . gt3_get_theme_option("content_line_height") . ' !important;
		}
		.content_block .vc_toggle_default .vc_toggle_title:hover,
		.content_block .vc_toggle_default.vc_toggle_active .vc_toggle_title,
		.content_block .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
		.content_block .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:hover,
		.content_block .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading:focus,
		.content_block .wpb_tabs .wpb_tabs_nav li a:hover,
		.content_block .wpb_tabs .wpb_tabs_nav li.ui-tabs-active a,
		.content_block .wpb_tour .wpb_tabs_nav a:hover,
		.content_block .wpb_tour .wpb_tabs_nav li.ui-tabs-active a {
		   background:' . gt3_get_theme_option("color_theme") . ';
		   border-color:' . gt3_get_theme_option("color_theme") . ';
		}		
		.content_block .vc_button-2-wrapper a.vc_btn_vista_blue,
		.content_block .vc_gitem_row .vc_gitem-col a.vc_btn {
			background:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ';
		}
		.content_block .vc_btn-vista_blue.vc_btn_outlined,
		.content_block a.vc_btn-vista_blue.vc_btn_outlined,
		.content_block button.vc_btn-vista_blue.vc_btn_outlined,
		.content_block .vc_btn-vista_blue.vc_btn_square_outlined,
		.content_block a.vc_btn-vista_blue.vc_btn_square_outlined,
		.content_block button.vc_btn-vista_blue.vc_btn_square_outlined {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}		
		.content_block .vc_button-2-wrapper a.vc_btn_white:hover,
		.content_block .vc_button-2-wrapper a.vc_btn_chino:hover,
		.content_block .vc_button-2-wrapper a.vc_btn_black:hover,
		.content_block .vc_button-2-wrapper a.vc_btn_grey:hover,
		.content_block .vc_btn-vista_blue.vc_btn_outlined:hover,
		.content_block a.vc_btn-vista_blue.vc_btn_outlined:hover,
		.content_block button.vc_btn-vista_blue.vc_btn_outlined:hover,
		.content_block .vc_btn-vista_blue.vc_btn_square_outlined:hover,
		.content_block a.vc_btn-vista_blue.vc_btn_square_outlined:hover,
		.content_block button.vc_btn-vista_blue.vc_btn_square_outlined:hover {
			background: ' . gt3_get_theme_option("color_theme") . ' !important;
			border-color: ' . gt3_get_theme_option("color_theme") . ' !important;
			color: #fff !important;
		}
		.content_block .dark_bg .vc_call_to_action.vc_cta_outlined h2,
		.content_block .dark_bg .vc_call_to_action.vc_cta_outlined h4 {
			color:' . gt3_get_theme_option("headings_color") . ';
		}		
		.content_block .dark_bg .vc_call_to_action.vc_cta_outlined p {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		/* ULTIMATE ADDONS */
		.content_block .aio-icon-box-link:hover .aio-icon-title {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}		
		.content_block .counter_suffix,
		.content_block .counter_prefix {
			color:' . gt3_get_theme_option("headings_color") . ' !important;
		}		
		.custom_tab .ult_tabcontent ul li:before {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		.content_block .vc_tta.vc_general .vc_tta-tab > a:hover,
		.content_block .vc_tta.vc_general .vc_tta-tab > a:focus,
		.content_block .vc_tta.vc_general .vc_tta-tab.vc_active > a {
			background-color:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ' !important;
		}

		.content_block .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		
		/* Woocommerce CSS */
		nav.woocommerce-pagination ul.page-numbers li a,
		nav.woocommerce-pagination ul.page-numbers li span {
			color:' . gt3_get_theme_option("headings_color") . ';
		}
		nav.woocommerce-pagination ul.page-numbers li a:hover {
			background:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ';
		}
		nav.woocommerce-pagination ul.page-numbers li span.current {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}
		.woocommerce select,
		.woocommerce-product-search input.search-field {
			font-family: "' . gt3_get_theme_option("main_font") . '";
			font-weight:' . gt3_get_theme_option("content_font_weight") . ';
		}		
		.woocommerce_container ul.products li.product h3,
		.woocommerce ul.products li.product h3 {
			color:' . gt3_get_theme_option("headings_color") . ';
		}		
		.woocommerce_container ul.products li.product h3:hover,
		.woocommerce ul.products li.product h3:hover {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}
		.woocommerce .woocommerce_container ul.products li.product .product_meta .posted_in a:hover,
		.woocommerce .woocommerce_container .upsells.products ul li.product .product_meta .posted_in a:hover,
		.woocommerce ul.products li.product .product_meta .posted_in a:hover,
		.woocommerce .upsells.products ul li.product .product_meta .posted_in a:hover,
		.woocommerce_container ul.products li.product a.button:hover,
		.woocommerce ul.products li.product a.button:hover {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}
		.widget_product_tag_cloud a {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		.widget_product_tag_cloud a:hover {
			background-color:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ';
		}
		.woo_wrap ul.cart_list li a:hover, .woo_wrap ul.product_list_widget li a:hover,
		.woocommerce ul.product_list_widget li a:hover {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}	
		.widget_product_categories a:hover,
		.widget_product_categories li.current-cat a,
		.widget_login .pagenav a:hover,
		.woocommerce-page .widget_nav_menu ul li a:hover,
		.widget_layered_nav li:hover, .widget_layered_nav li.chosen,
		.widget_layered_nav li:hover a, .widget_layered_nav li.chosen a,
		.woocommerce .widget_layered_nav ul li.chosen a,
		.woocommerce-page .widget_layered_nav ul li.chosen a {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}			
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #respond input#submit,
		.woocommerce #content input.button,
		.woocommerce a.edit,
		.woocommerce #commentform #submit,
		.woocommerce-page input.button,
		.woocommerce .wrapper input[type="reset"],
		.woocommerce .wrapper input[type="submit"] {
			font-family: "' . gt3_get_theme_option("main_font") . '";
		}
		.woocommerce #commentform #submit,
		.woocommerce #respond input#submit,
		.woocommerce form.login input.button,
		.woocommerce form.lost_reset_password input.button,
		.return-to-shop a.button,
		#payment input.button,
		.woocommerce p input.button,
		.woocommerce p button.button,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #content input.button,
		.woocommerce a.edit,
		.woocommerce-page input.button,
		.woocommerce .wrapper input[type="reset"],
		.woocommerce .wrapper input[type="submit"],
		.woocommerce .checkout_coupon p input.button,
		.woocommerce .checkout_coupon p button.button,
		.woocommerce .woocommerce-shipping-calculator p button.button,
		.widget_price_filter .price_slider_amount .button:hover	{
			background:' . gt3_get_theme_option("color_theme") . ' !important;
			border-color:' . gt3_get_theme_option("color_theme") . ' !important;
		}
		.woocommerce #commentform #submit:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce form.login input.button:hover,
		.woocommerce form.lost_reset_password input.button:hover,
		.return-to-shop a.button:hover,
		#payment input.button:hover,
		.woocommerce p input.button:hover,
		.woocommerce p button.button:hover,
		.woocommerce a.button:hover,
		.woocommerce button.button:hover,
		.woocommerce input.button:hover,
		.woocommerce #content input.button:hover,
		.woocommerce a.edit:hover,
		.woocommerce-page input.button:hover,
		.woocommerce .wrapper input[type="reset"]:hover,
		.woocommerce .wrapper input[type="submit"]:hover,
		.woocommerce .checkout_coupon p input.button:hover,
		.woocommerce .checkout_coupon p button.button:hover,
		.woocommerce .woocommerce-shipping-calculator p button.button:hover {
			color:' . gt3_get_theme_option("main_text_color") . ' !important; 
		}			
		.woo_wrap .price_label {color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.widget_price_filter .ui-slider .ui-slider-range {
			background:' . gt3_get_theme_option("color_theme") . ' !important;
		}		
		.woocommerce-review-link:hover {color:' . gt3_get_theme_option("color_theme") . ';
		}
		.summary del,
		.summary del .amount,
		.woocommerce .summary .price span.from {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}		
		div.product .summary .amount,
		div.product .summary ins,
		div.product .summary ins .amount,
		.summary p.price {
			color:' . gt3_get_theme_option("headings_color") . ';	
		}	
		.summary .product_meta span a:hover {color:' . gt3_get_theme_option("color_theme") . ' !important;
		}
		.woocommerce_container ul.products li.product a.add_to_cart_button.loading,
		.woocommerce ul.products li.product a.add_to_cart_button.loading,
		.product_posts a:hover {
			color:' . gt3_get_theme_option("color_theme") . ' !important;
		}		
		.woocommerce div.product .woocommerce-tabs .panel,
		.woocommerce #content div.product .woocommerce-tabs .panel,
		.woocommerce div.product .woocommerce-tabs .panel p,
		.woocommerce #content div.product .woocommerce-tabs .panel p,
		.woocommerce .chosen-container .chosen-drop {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.woocommerce div.product .woocommerce-tabs .panel a:hover,
		.woocommerce #content div.product .woocommerce-tabs .panel a:hover {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		.woocommerce div.product .woocommerce-tabs .panel h2,
		.woocommerce #content div.product .woocommerce-tabs .panel h2,
		.woocommerce .woocommerce-tabs #reviews #reply-title,
		.woocommerce .chosen-container-single .chosen-search input[type="text"] {
			color:' . gt3_get_theme_option("headings_color") . ' !important;
		}
		.woocommerce-page .widget_shopping_cart .empty {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}	
		.woocommerce #payment div.payment_box,
		.woocommerce .chzn-container-single .chzn-single,
		.woocommerce .chosen-container-single .chosen-single {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;			
		}
		.shop_table .product-name,
		.shop_table .product-name a,
		.shop_table .product-price .amount,
		.woocommerce-review-link {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}		
		.shop_table .product-name a:hover {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		mark {background:' . gt3_get_theme_option("color_theme") . ';
		}
		.woo_wrap ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
		.main_container ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
		.woocommerce ul.product_list_widget li a,
		.woocommerce-page .widget_shopping_cart .empty,
		.woo_wrap .widget_shopping_cart .total
		.main_container .widget_shopping_cart .total,
		.woocommerce ul.cart_list li dl dt,
		.woocommerce ul.product_list_widget li dl dt,
		.woocommerce ul.cart_list li dl dd,
		.woocommerce ul.product_list_widget li dl dd,
		.widget_product_categories a,
		.widget_login .pagenav a,
		.widget_product_categories a,
		.widget_login .pagenav a,
		.widget_price_filter .ui-slider .ui-slider-handle:before,
		.woocommerce .woocommerce_message, .woocommerce .woocommerce_error, .woocommerce .woocommerce_info,
		.woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info,
		.summary .product_meta span a,
		.woocommerce table.shop_attributes th,
		.woocommerce table.shop_attributes td,
		.woocommerce form .form-row input.input-text,
		.woocommerce form .form-row textarea,
		.woocommerce #coupon_code,
		.woocommerce strong span.amount,
		.woocommerce table.shop_table th,
		.woocommerce table.shop_table td,
		.order_table_item strong,
		.woocommerce .order_details li strong,
		.woocommerce-page .order_details li strong,
		.woocommerce .cart_totals th,
		.woocommerce .cart_totals th strong,
		.woocommerce select,
		.woo_wrap .quantity,
		.woo_wrap .quantity .amount,
		.main_container .quantity,
		.main_container .quantity .amount,
		.woo_wrap .widget_shopping_cart .total strong,
		.main_container .widget_shopping_cart .total strong,
		.widget_layered_nav li,
		.widget_layered_nav li a,
		.woocommerce .woocommerce_message a,
		.woocommerce .woocommerce_error a,
		.woocommerce .woocommerce_info a,
		.woocommerce .woocommerce-message a,
		.woocommerce .woocommerce-error a,
		.woocommerce .woocommerce-info a,
		.woocommerce-review-link,
		.woocommerce .lost_password,
		.woocommerce .cart_totals tr th, .woocommerce .cart_totals tr td,
		.woocommerce-checkout #payment .payment_method_paypal .about_paypal,
		.woocommerce-checkout #payment ul.payment_methods li {
			font-weight:' . gt3_get_theme_option("content_font_weight") . ';
		}
		.woocommerce_container ul.products li.product a.button,
		.woocommerce ul.products li.product a.button,
		.variations td label,
		.woocommerce label.checkbox,
		.calculated_shipping .order-total th,
		.calculated_shipping .order-total td .amount,
		.shop_table .product-name,
		.shop_table .product-name a,
		.shop_table .product-subtotal .amount,
		.shop_table .product-price .amount,
		.shop_table .product-name dl.variation dt,
		.shop_table .product-name dl.variation dd,
		.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta time,
		.woocommerce table.shop_table tfoot td,
		.woocommerce table.shop_table th,
		.product-name strong {
			font-weight:' . gt3_get_theme_option("content_font_weight") . ' !important;
		}
		.woocommerce .order_details li strong,
		.woocommerce-page .order_details li strong,
		.woocommerce table.shop_table thead th,
		.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta strong {
			color:' . gt3_get_theme_option("headings_color") . ' !important;
		}		
		#ship-to-different-address {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.select2-container .select2-choice,
		.select2-container .select2-choice:hover,
		.select2-container .select2-choice span,
		.select2-container .select2-choice:hover span {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
			font-weight:' . gt3_get_theme_option("content_font_weight") . ' !important;
		}
		.header_cart_content a:hover,
		.shipping-calculator-button:hover,
		.shipping-calculator-button:after {
			color:' . gt3_get_theme_option("color_theme") . ';
		}
		.widget_product_categories a,
		.widget_login .pagenav a,
		.widget_layered_nav li,
		.widget_layered_nav li a,
		.widget_layered_nav li small.count,
		.woo_wrap ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
		.main_container ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
		.woocommerce ul.product_list_widget li a,
		.woocommerce .quantity input.qty,
		.woocommerce #content .quantity input.qty {
			color:' . gt3_get_theme_option("main_text_color") . ';
		}
		.woocommerce div.product .woocommerce-tabs ul.tabs li a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li a {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover a, 
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active:hover a,
		.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:hover a,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a {
			background:' . gt3_get_theme_option("color_theme") . ';
			border-color:' . gt3_get_theme_option("color_theme") . ';
		}	
		.woocommerce .woocommerce_message,
		.woocommerce .woocommerce-message,
		.woocommerce .woocommerce_message a,
		.woocommerce .woocommerce-message a {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		.woocommerce .woocommerce_message:before,
		.woocommerce .woocommerce-message:before {
			color:' . gt3_get_theme_option("main_text_color") . ' !important;
		}
		
	'
);

?>