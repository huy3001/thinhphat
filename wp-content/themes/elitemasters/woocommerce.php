<?php
get_header();
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$gt3_theme_pagebuilder['settings']['selected-sidebar-name'] = "WooCommerce";
?>		
    <div class="container">
        <div class="content_block woo_wrap row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <?php
				if (!isset($gt3_theme_pagebuilder['settings']['show_title_area']) || ($gt3_theme_pagebuilder['settings']['show_title_area'] !== "no" && gt3_get_theme_option("show_title_area") !== "no")) {				
					if (!is_product()) {
						echo '<div class="page_title"><h1></h1></div>';
					}                                    
				}
				if (!isset($gt3_theme_pagebuilder['settings']['show_breadcrumb_area']) || ($gt3_theme_pagebuilder['settings']['show_breadcrumb_area'] !== "no" && gt3_get_theme_option("show_breadcrumb_area") !== "no")) {
					if (!is_product()) {
						echo '<span class="shop_breadcrumb">'. esc_html__('Shop', 'elitemasters') .'</span>';
					}
				}
			?>   
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea woocommerce_container"> 
                            <?php
								woocommerce_content();
								wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'elitemasters') . ': ', 'after' => '</div>'));
                            ?>                         
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "</div>" : ""); ?>        
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>    	    
    </div>
    
    <?php
		$GLOBALS['showOnlyOneTimeJS']['woo_breadcrumb'] = '
		<script>
			jQuery(document).ready(function () {
				"use strict";
				var shop_breadcrumb = jQuery(".shop_breadcrumb");
				if (jQuery(".breadcrumbs").size() > 0 && shop_breadcrumb.size() > 0) {
					jQuery(".breadcrumbs .container span").hide();
					jQuery(".breadcrumbs .container").append("<span>"+shop_breadcrumb.text()+"</span>");
				}
			});			
		</script>
		';                
	?> 

<?php get_footer(); ?>