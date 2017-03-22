<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>

	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> single_post <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") ? "fullwidth_post" : ""); ?>">
            <?php if (gt3_get_theme_option("show_title_area") !== "no" && has_excerpt()) { ?>
                <div class="page_title"><h1><?php echo get_the_excerpt(); ?></h1></div>
            <?php } ?>

            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea">
                        	<?php
								$post = get_post();
								$attachment_size = array(1170, 800);
								$next_attachment_url = wp_get_attachment_url();

								$attachment_ids = get_posts(array(
									'post_parent' => $post->post_parent,
									'fields' => 'ids',
									'numberposts' => -1,
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order' => 'ASC',
									'orderby' => 'menu_order ID'
								));

								if (count($attachment_ids) > 1) {
									foreach ($attachment_ids as $attachment_id) {
										if ($attachment_id == $post->ID) {
											$next_id = current($attachment_ids);
											break;
										}
									}

									if ($next_id) {
										$next_attachment_url = get_attachment_link($next_id);
									} else {
										$next_attachment_url = get_attachment_link(array_shift($attachment_ids));
									}
								}
							?>
                        	<div class="blog_post_preview">
                            	<div class="listing_meta">
                                	<?php
										$published_text = '<span class="attachment-meta">' . esc_html__('Published on', 'elitemasters') . '<time class="entry-date" datetime="%1$s">%2$s</time>' . esc_html__('in', 'elitemasters') . '<a href="%3$s" rel="gallery">%5$s</a></span>';
										$post_title = get_the_title($post->post_parent);
										if (empty($post_title) || 0 == $post->post_parent) {
											$published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%1$s">%2$s</time></span>';
										}

										printf($published_text,
											esc_attr(get_the_date('c')),
											esc_html(get_the_date()),
											esc_url(get_permalink($post->post_parent)),
											esc_attr(strip_tags($post_title)),
											$post_title
										);

										$metadata = wp_get_attachment_metadata();
										printf('<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
											esc_url(wp_get_attachment_url()),
											esc_html__('Link to full-size image', 'elitemasters'),
											esc_html__('Full resolution', 'elitemasters'),
											$metadata['width'],
											$metadata['height']
										);

										edit_post_link(esc_html__('Edit', 'elitemasters'), '<span class="edit-link">', '</span>');
									?>
                                </div>
                                <div class="blog_post_image">
                                    <div class="pf_output_container">
                                    	<?php
											printf('%1$s',
												wp_get_attachment_image($post->ID, $attachment_size)
											);
										?>
                                    </div>
                                </div>
                                <?php if (!empty($post->post_content)) { ?>
                                    <div class="blog_content">
                                        <?php the_content(); ?>
                                        <?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'elitemasters'), 'after' => '</div>')); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="prev_next_links">
                            	<div class="fleft">
                                	<a class="shortcode_button btn_small btn_type5 share_btn" href="<?php echo esc_js("javascript:history.back()");?>"><i class="fa fa-mail-reply"></i><?php echo esc_html__('Back', 'elitemasters'); ?></a>
                                </div>
                                <div class="clear"></div>
                            </div>
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