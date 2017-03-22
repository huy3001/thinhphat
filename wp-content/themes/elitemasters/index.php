<?php
get_header();
#Emulate default settings for page without personal ID
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea"> 
                            <?php
								echo '<div class="row"><div class="col-sm-12 module_blog">';
								while (have_posts()) : the_post();
									get_template_part("bloglisting");
								endwhile;
								echo gt3_get_theme_pagination();
								echo '</div><div class="clear"></div></div>';
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
    
<?php get_footer(); ?>