<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
    'featured_image_type' => 'square'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>
<div class="vc_row">
    <div class="vc_col-sm-12 feature_portfolio">
        <div class="featured_items <?php echo esc_attr($featured_image_type); ?>">
            <div class="items<?php echo $posts_per_line; ?>">
                <ul class="item_list">
                    <?php
                    list($query_args, $build_query) = vc_build_loop_query($build_query);
					
					$gt3_posts = new WP_Query($query_args);

                    if ($gt3_posts->have_posts()) {
                        while ($gt3_posts->have_posts()) {
                            $gt3_posts->the_post();
                            $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
							if (strlen($wp_get_attachment_url)) {								
								if ($featured_image_type == "circle") {
									if ($posts_per_line == "4") {
										$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "270", "270", true, true, true);
									}
									if ($posts_per_line == "3") {
										$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "370", "370", true, true, true);
									}								
									if ($posts_per_line == "2" || $posts_per_line == "1") {
										$gt3_featured_image_url = aq_resize($wp_get_attachment_url, "470", "470", true, true, true);
									} 
								} else {
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
								}
                                $featured_image = '<img alt="" src="' . $gt3_featured_image_url . '" />';
                            } else {
                                $featured_image = '';
                            }
							// Categories
							$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
							if ( $terms && ! is_wp_error( $terms ) ) {
								$draught_links = array();
								foreach ( $terms as $term ) {
									$draught_links[] = '<a href="'.get_term_link($term->slug, "portfolio_category").'">'.$term->name.'</a>';
								}
								$on_draught = join( ", ", $draught_links );
							}
							else {
								$on_draught = 'Uncategorized';
							}
							
                            $compile .= '
                            <li>
                                <div class="portfolio_item">
									<div class="portf_img">
										<a href="' . get_permalink(get_the_ID()) . '">
											' . $featured_image . '
										</a>
									</div>
									<div class="portf_descr">
										<h6 class="portf_title"><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h6>
										<div class="listing_meta">
											<span><i class="fa fa-bookmark-o"></i>' . $on_draught . '</span>
										</div>
									</div>
                                </div>
                            </li>
                            ';
                        }
                        wp_reset_postdata();

                    }

                    echo $compile;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>