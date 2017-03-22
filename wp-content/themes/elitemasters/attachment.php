<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$attachment_image_src = wp_get_attachment_url(get_the_ID(), "full");
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <?php if (gt3_get_theme_option("show_title_area") !== "no") { ?>
                <div class="page_title"><h1><?php echo esc_html__('Welcome to Blog', 'elitemasters'); ?></h1></div>
            <?php } ?>
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea"> 
                            <?php if (isset($attachment_image_src[1]) && $attachment_image_src[1] > 0) { ?>
                                <img src="<?php echo $attachment_image_src[0]; ?>" class="rounded_block" alt=""/>
                            <?php } ?>                          
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "</div>" : ""); ?>        
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>    	    
    </div>

<?php get_footer(); ?>