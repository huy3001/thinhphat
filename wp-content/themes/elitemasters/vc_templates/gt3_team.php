<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

?>

<div class="vc_row">
    <div class="vc_col-sm-12 module_team">
    	<div class="shortcode_team">
            <div class="items<?php echo $posts_per_line; ?>">
                <ul class="item_list">
                	<?php
                    list($query_args, $build_query) = vc_build_loop_query($build_query);

                    $gt3_posts = new WP_Query($query_args);

                    if ($gt3_posts->have_posts()) {
                        while ($gt3_posts->have_posts()) {
                            $gt3_posts->the_post();
							
							$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);	
                            $post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 80));
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
								$featured_image = '<img  src="' . $gt3_featured_image_url . '" alt="' . get_the_title() . '" />';
                            } else {
                                $featured_image = '';
                            }
							$position = $gt3_theme_pagebuilder['page_settings']['team']['position'];
                            $compile .= '
							<li>
								<div class="item_wrapper">
									<div class="item">
										<div class="team_img featured_img">
											<a href="' . get_permalink(get_the_ID()) . '">' . $featured_image . '</a>
										</div>
										<div class="team_title">
											<h6><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h6>
											<p>' . $position . '</p>
										</div>
										<div class="team_desc">' . $post_excerpt . '</div>
										<div class="team_icons_wrapper">';
											if (isset($gt3_theme_pagebuilder['page_settings']['icons']) ? $socicons = $gt3_theme_pagebuilder['page_settings']['icons'] : $socicons = false) ;
											if (is_array($socicons)) {
												foreach ($socicons as $key => $value) {
													if ($value['link'] == '') $value['link'] = '#';
													$compile .= '<a href="' . $value['link'] . '" class="teamlink" title="' . $value['name'] . '" style="color:' . $value['fcolor'] . '"><i class="' . $value['data-icon-code'] . '"></i></a>';
												}
											}
										$compile .= '
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