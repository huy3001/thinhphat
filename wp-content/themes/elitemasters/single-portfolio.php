<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$gt3_theme_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));

if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar" || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar") {
	$posts_per_line = '3';
} else {
	$posts_per_line = '4';
}

// Categories
$echoallterm = '';
$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
if ( $terms && ! is_wp_error( $terms ) ) {
	$draught_links = array();
	foreach ( $terms as $term ) {
		$draught_links[] = '<a href="'.get_term_link($term->slug, "portfolio_category").'">'.$term->name.'</a>';
		$tempname = strtr($term->name, array(
			" " => "-",
			"'" => "-",
		));
		$echoallterm .= strtolower($tempname) . " ";
		$echoterm = $term->name;
	}
	$on_draught = join( ", ", $draught_links );
}
else {
	$on_draught = 'Uncategorized';
}

$post_class = '';
	if (empty($gt3_theme_featured_image)) $post_class = 'no-post-thumbnail';
?>
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> single_post <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") ? "fullwidth_post" : ""); ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea">
                        	<div class="blog_post_preview <?php echo $post_class ?>">
                            	<?php
								if (!isset($gt3_theme_pagebuilder['settings']['show_title_area']) || ($gt3_theme_pagebuilder['settings']['show_title_area'] !== "no" && gt3_get_theme_option("show_title_area") !== "no")) {
									echo '<h2 class="blogpost_title">'. get_the_title().'</h2>';
								}
								?>
								<div class="blog_post_image">
                                    <?php echo get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder)); ?>
                                </div>
                                <div class="blog_content">                                                                                                                            
                                    <div class="listing_meta">
										<span><i class="fa fa-calendar"></i><?php echo get_the_time("M d, Y"); ?></span>
										<span><i class="fa fa-bookmark-o"></i><?php echo strtolower($on_draught); ?></span>
										<?php
										if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
											foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
												echo '
													<span>
														' . ((isset($skillvalue['value']) && strlen($skillvalue['value']) > 0) && (isset($skillvalue['icon']) && strlen($skillvalue['icon']) > 0) ? "<i class='" . esc_attr($skillvalue['icon']) . "'></i>" : "") . esc_attr($skillvalue['value']) . '
													</span>
												';
											}
										}
										?>
										<div class="share_block">
											<a class="soc_fb" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"><i class="fa fa-facebook-square"></i></a>
											<a class="soc_tweet" target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"><i class="fa fa-twitter"></i></a>
											<a class="soc_google" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
											<a class="soc_pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($gt3_theme_featured_image[0]) > 0) ? $gt3_theme_featured_image[0] : gt3_get_theme_option("logo"); ?>"><i class="fa fa-pinterest"></i></a>
										</div>
									</div>
									<?php
										the_content(esc_html__('Read more!', 'elitemasters'));
										wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'elitemasters') . ': ', 'after' => '</div>'));
									?>                                    
                                </div>
                                <div class="dn"><?php posts_nav_link(); ?></div>
                                <div class="clea_r"></div>
                            </div>                             
                        	
							<div class="prev_next_links clearfix">
								<?php
									$prev_post = get_adjacent_post(false, '', true);
									$next_post = get_adjacent_post(false, '', false);

									if($prev_post){
										$post_url = get_permalink($prev_post->ID);            
										echo '<div class="pull-left"><a href="' . $post_url . '" title="' . $prev_post->post_title . '"><p>' . esc_html__('Previous Post', 'elitemasters') . '</p><b>' . $prev_post->post_title . '</b></a></div>';
									}

									if($next_post) {
										$post_url = get_permalink($next_post->ID);            
										echo '<div class="pull-right"><a href="' . $post_url . '" title="' . $next_post->post_title . '"><p>' . esc_html__('Next Post', 'elitemasters') . '</p><b>' . $next_post->post_title . '</b></a></div>';
									} 
								?>
                            </div>
							
                            <?php if (gt3_get_theme_option("related_portfolio_posts") == "on") { ?>
							<div class="row">
                                <div class="col-sm-12 feature_portfolio">
                                	<h4><?php echo esc_html__('Related Projects', 'elitemasters'); ?></h4>
                                    <div class="featured_items square">
                                        <div class="items<?php echo esc_attr($posts_per_line); ?>">
                                            <ul class="item_list">
                                                <?php
                                                    $gt3_wp_query = new WP_Query();

                                                    if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar" || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar") {
                                                        $args = array(
															'post_type' => 'portfolio',
                                                            'posts_per_page' => 3,
                                                            'orderby' => 'rand',
                                                            'ignore_sticky_posts' => 1
														);
													} else {
                                                        $args = array(
															'post_type' => 'portfolio',
                                                            'posts_per_page' => 4,
                                                            'orderby' => 'rand',
                                                            'ignore_sticky_posts' => 1
														);
													}
                                                    $gt3_wp_query->query($args);
                                                    while ($gt3_wp_query->have_posts()) : $gt3_wp_query->the_post();
                                                        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                                                        if (strlen($wp_get_attachment_url)) {
                                                            $gt3_featured_image_url = aq_resize($wp_get_attachment_url, "270", "220", true, true, true);
                                                            $featured_image = '<img alt="" src="' . $gt3_featured_image_url . '" />';
                                                        } else {
                                                            $featured_image = '';
                                                        }
														// Categories
														$echoallterm = '';
														$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
														if ( $terms && ! is_wp_error( $terms ) ) {
															$draught_links = array();
															foreach ( $terms as $term ) {
																$draught_links[] = '<a href="'.get_term_link($term->slug, "portfolio_category").'">'.$term->name.'</a>';
																$tempname = strtr($term->name, array(
																	" " => "-",
																	"'" => "-",
																));
																$echoallterm .= strtolower($tempname) . " ";
																$echoterm = $term->name;
															}
															$on_draught = join( ", ", $draught_links );
														}
														else {
															$on_draught = 'Uncategorized';
														}
                                                ?>                                                            
                                                <li>
													<div class="item">
														<div class="portfolio_item">
															<div class="portf_img">
																<a href="<?php echo get_permalink(get_the_ID()); ?>">
																	<?php echo $featured_image; ?>
																</a>
															</div>
															<div class="portf_descr">
																<h6 class="portf_title"><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo  get_the_title(); ?></a></h6>
																<div class="listing_meta">
																	<span><i class="fa fa-bookmark-o"></i><?php echo $on_draught ?></span>
																</div>
															</div>
														</div>
													</div>
                                                </li>
                                                <?php     
                                                    endwhile;
                                                    wp_reset_postdata();
                                                ?>                             
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (gt3_get_theme_option("portfolio_comments") == "enabled") { ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php comments_template(); ?>
                                </div>
                            </div> 
                            <?php } else { ?>
								<div class="<?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "no-sidebar") ? "pb45" : "pb25"); ?>"></div>
							 <?php } ?>
							<div class="clear"></div>                             
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