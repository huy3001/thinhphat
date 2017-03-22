<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
);

wp_enqueue_script('gt3_slick_js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_testimonial">
    	<div class="module_content testimonials_list items<?php echo $posts_per_line; ?>">
            <ul>
				<?php
                list($query_args, $build_query) = vc_build_loop_query($build_query);

                $gt3_posts = new WP_Query($query_args);

                if ($gt3_posts->have_posts()) {
                    while ($gt3_posts->have_posts()) {
                        $gt3_posts->the_post();
						
						$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
						
						$testimonials_author = $gt3_theme_pagebuilder['page_settings']['testimonials']['testimonials_author'];
						$testimonials_company = $gt3_theme_pagebuilder['page_settings']['testimonials']['company'];
						$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
						
						$compile .= '
						<li>
							<div class="item with_icon">
								<div class="testimonial_item_wrapper ' . (strlen($featured_image[0]) > 0 ? "" : "no_photo_thumb") . '">
									' . (strlen($featured_image[0]) > 0 ? "<div class=\"testimonials_photo\"><img src='" . aq_resize($featured_image[0], "100", "100", true, true, true) . "' alt='' /></div>" : "") . '
									<div class="testimonials_content">
										<p><i class="fa fa-quote-left"></i>&nbsp;&nbsp;' . get_the_content() . '</p>
										<h5 class="testimonials_title">- ' . $testimonials_author . ', <span>' . $testimonials_company . '</span></h5>
									</div>
								</div>
							</div>
						</li>';
                	}
					wp_reset_postdata();
                }
                echo $compile;
                ?>        
            </ul>
        </div>
    </div>
</div>