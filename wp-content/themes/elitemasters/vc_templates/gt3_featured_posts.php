<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_feature_posts">
        <div class="items<?php echo $posts_per_line; ?> featured_posts clearfix">
            <?php
            list($query_args, $build_query) = vc_build_loop_query($build_query);

            $gt3_posts = new WP_Query($query_args);

            if ($gt3_posts->have_posts()) {
                while ($gt3_posts->have_posts()) {
                    $gt3_posts->the_post();

                    $post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 120));
                    $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                    if (strlen($wp_get_attachment_url)) {
                        if ($posts_per_line == "4") {
                            $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "270", "200", true, true, true);
                        }
                        if ($posts_per_line == "3") {
                            $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "370", "275", true, true, true);
                        }
                        if ($posts_per_line == "2") {
                            $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "570", "420", true, true, true);
                        }
                        if ($posts_per_line == "1") {
                            $gt3_featured_image_url = $wp_get_attachment_url;
                        }
                        $featured_image = '<div class="featured_img"><a href="' . get_permalink(get_the_ID()) . '"><img alt="" src="' . $gt3_featured_image_url . '"></a></div>';
                    } else {
                        $featured_image = '';
                    }
                    $compile .= '
                    <div class="featured_item">
                        ' . $featured_image . '
                        <div class="featured_item_descr">
                            <h6><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h6>
                            <div class="featured_item_content">
                                ' . $post_excerpt . '
                            </div>
                            <div class="featured_meta">' . get_the_time("M") . ' ' . get_the_time("d") . ', ' . get_the_time("Y") . '&nbsp;&nbsp;/&nbsp;&nbsp;<a href="' . get_permalink(get_the_ID()) . '">' . get_comments_number(get_the_ID()) . ' ' . esc_html__('comments', 'elitemasters') . '</a></div>
                        </div>
                    </div>
                    ';
                }
                wp_reset_postdata();
            }

            echo $compile;
            ?>
        </div>
    </div>
</div>