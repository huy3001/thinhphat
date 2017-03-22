<?php
	get_header();
    the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());
$gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$position = $gt3_theme_pagebuilder['page_settings']['team']['position'];

if (strlen($gt3_theme_featured_image)) {
	$featured_image = '<div class="col-sm-6 single_team_thumb"><img src="' . $gt3_theme_featured_image . '" alt="" /></div><div class="col-sm-6">';
} else {
	$featured_image = '<div class="col-sm-12">';
}

?> 
	<div class="container single_team">
    	<div class="row">
                <?php echo $featured_image ?>                
                <!-- col-sm-6(12) -->
				<h5><?php echo get_the_title(); ?></h5>
                <div class="listing_meta">
                	<span><i class="fa fa-calendar"></i><?php echo get_the_time("M d, Y"); ?></span>
                    <span><i class="fa fa-user"></i><?php echo $position ?></span>
                </div>
                <article class="contentarea">
					<?php
                    the_content(esc_html__('Read more!', 'elitemasters'));
                    wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'elitemasters') . ': ', 'after' => '</div>'));
                    ?>
                </article>
                <div class="team_socials">
					<?php
                        if (isset($gt3_theme_pagebuilder['page_settings']['icons']) ? $socicons = $gt3_theme_pagebuilder['page_settings']['icons'] : $socicons = false);
                        if (is_array($socicons)) {
                            foreach ($socicons as $key => $value) {
                                if ($value['link'] == '') $value['link'] = '#';
                    ?>
                    <a href="<?php echo esc_url($value['link']); ?>" class="teamlink" title="<?php echo $value['name'] ?>" style="color:<?php echo $value['fcolor'] ?>"><span><i class="<?php echo $value['data-icon-code'] ?>"></i></span></a>
                    <?php
                            }
                        }		
                    ?>
                </div>
            </div><!-- //col-sm-6(12) -->            
        </div>
    </div>

<?php get_footer(); ?>
