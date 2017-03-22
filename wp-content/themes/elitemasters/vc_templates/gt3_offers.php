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
    <div class="vc_col-sm-12 module_offers items<?php echo $posts_per_line; ?>">
    	<div class="product_offers_wrapper clearfix">
			<?php
			list($query_args, $build_query) = vc_build_loop_query($build_query);

			$gt3_posts = new WP_Query($query_args);

			if ($gt3_posts->have_posts()) {
				while ($gt3_posts->have_posts()) {
					$gt3_posts->the_post();

					$gt3_theme_pagebuilder = get_post_meta(get_the_ID(), "pagebuilder", true);
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
						$featured_image = '<div class="offer_img"><a href="' . get_permalink(get_the_ID()) . '"><img  src="' . $gt3_featured_image_url . '" alt="' . get_the_title() . '" /></a></div>';
					} else {
						$featured_image = '';
					}
					$position = $gt3_theme_pagebuilder['page_settings']['team']['position'];
					$compile .= '
					<div class="offer_item">
						<div class="offer_wrap">
							' . $featured_image . '
							<div class="offer_body">
								<h6><a href="' . get_permalink(get_the_ID()) . '">' . get_the_title() . '</a></h6>';
								if (isset($gt3_theme_pagebuilder['page_settings']['icons']) ? $socicons = $gt3_theme_pagebuilder['page_settings']['icons'] : $socicons = false) ;
								if (is_array($socicons)) {
									foreach ($socicons as $key => $value) {
										$compile .= '<div class="offer_descr"><i class="' . $value['data-icon-code'] . '"></i>' . $value['name'] . '</div>';
									}
								}
								if (!$position == '') {
									$compile .= '<div class="offer_price color">' . $position . '</div>';
								}
							$compile .= '
							</div>
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