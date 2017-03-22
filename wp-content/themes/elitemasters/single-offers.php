<?php
	get_header();
    the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());
$gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$position = $gt3_theme_pagebuilder['page_settings']['team']['position'];
$offer_btn = $gt3_theme_pagebuilder['page_settings']['offers']['offers_btn'];
$offer_url = (isset($gt3_theme_pagebuilder['page_settings']['offers']['offers_link']) ? $gt3_theme_pagebuilder['page_settings']['offers']['offers_link'] : "");

$offer_target = $gt3_theme_pagebuilder['page_settings']['offers']['offers_target'];

if (strlen($gt3_theme_featured_image)) {
	$featured_image = '<div class="col-sm-6 single_team_thumb"><img src="' . $gt3_theme_featured_image . '" alt="" /></div><div class="col-sm-6">';
} else {
	$featured_image = '<div class="col-sm-12">';
}

?> 
	<div class="container">
    	<div class="row single_offer">
                <?php echo $featured_image ?>                
                <!-- col-sm-6(12) -->
				<h5><?php echo get_the_title(); ?></h5>
                <div class="offer_price color"><?php echo $position ?></div>
                <div class="listing_meta">
                	<span><i class="fa fa-calendar"></i><?php echo get_the_time("M d, Y"); ?></span>
                    <?php
                    if (isset($gt3_theme_pagebuilder['page_settings']['icons']) ? $socicons = $gt3_theme_pagebuilder['page_settings']['icons'] : $socicons = false);
                    if (is_array($socicons)) {
                        foreach ($socicons as $key => $value) {
                            ?>
                            <div class="offer_descr"><i class="<?php echo esc_attr($value['data-icon-code']); ?>"></i><?php echo $value['name'] ?></div>
                        <?php
                        }
                    }
                    ?>
                </div>
                <article class="contentarea">
					<?php
                    the_content(esc_html__('Read more!', 'elitemasters'));
                    wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'elitemasters') . ': ', 'after' => '</div>'));
                    ?>
                </article>
                <?php if (strlen($offer_url) > 0 && !$offer_btn == '') { ?>
                    <a href="<?php echo esc_url($offer_url); ?>" class="shortcode_button btn_normal left_icon btn_type1" target="<?php echo esc_attr($offer_target); ?>"><?php echo $offer_btn; ?></a>
                <?php } ?>
            </div><!-- //col-sm-6(12) -->            
        </div>

        <?php if (gt3_get_theme_option("related_offers") == "on") { ?>
            <div class="row mb74 mt_30">
                <div class="col-sm-12 module_offers items4">
                    <h4><?php echo esc_html__('Related Offers', 'elitemasters'); ?></h4>
                    <div class="product_offers_wrapper clearfix">
                        <?php
                        $gt3_wp_query = new WP_Query();
                        $args = array(
                            'post_type' => 'offers',
                            'posts_per_page' => 4,
                            'orderby' => 'rand',
                            'ignore_sticky_posts' => 1
                        );
                        $gt3_wp_query->query($args);
                        while ($gt3_wp_query->have_posts()) : $gt3_wp_query->the_post();

                            $gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());
                            $position = $gt3_theme_pagebuilder['page_settings']['team']['position'];

                            $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                            if (strlen($wp_get_attachment_url)) {
                                $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "270", "220", true, true, true);
                                $featured_image = '<div class="offer_img"><a href="' . get_permalink(get_the_ID()) . '"><img  src="' . $gt3_featured_image_url . '" alt="' . get_the_title() . '" /></a></div>';
                            } else {
                                $featured_image = '';
                            }
                            ?>
                            <div class="offer_item">
                                <div class="offer_wrap">
                                    <?php echo $featured_image; ?>
                                    <h6><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a></h6>
                                    <?php
                                    if (isset($gt3_theme_pagebuilder['page_settings']['icons']) ? $socicons = $gt3_theme_pagebuilder['page_settings']['icons'] : $socicons = false);
                                    if (is_array($socicons)) {
                                        foreach ($socicons as $key => $value) {
                                            ?>
                                            <div class="offer_descr"><i class="<?php echo esc_attr($value['data-icon-code']); ?>"></i><?php echo $value['name'] ?></div>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <?php if (!$position == '') { ?>
                                        <div class="offer_price color"><?php echo $position; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

<?php get_footer(); ?>
