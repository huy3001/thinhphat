<?php
	get_header();
	the_post();
	$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
?>		
    <div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title_area']) || ($gt3_theme_pagebuilder['settings']['show_title_area'] !== "no" && gt3_get_theme_option("show_title_area") !== "no")) { ?>
                <div class="page_title">
                    <h1><?php the_title(); ?></h1>
                    <?php if (isset($gt3_theme_pagebuilder['page_settings']['subtitle']) && $gt3_theme_pagebuilder['page_settings']['subtitle'] !== '') { ?>
                        <?php
                            echo '<div class="icon_divider"></div><p>';
                            echo $gt3_theme_pagebuilder['page_settings']['subtitle'];
                            echo '</p>';
                        ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea"> 
                            <?php
                            the_content(esc_html__('Read more!', 'elitemasters'));
                            wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'elitemasters') . ': ', 'after' => '</div>'));
                
                            if (gt3_get_theme_option("page_comments") == "enabled") { ?>
                                <div class="clea_r"></div>
                                <div class="row">
                                    <div class="col-sm-12 pt35">
                                        <?php comments_template(); ?>
                                    </div>
                                </div>                
                            <?php } ?>
                            <div class="clea_r"></div>
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