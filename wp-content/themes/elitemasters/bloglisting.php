<?php
	$gt3_theme_featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
	
	if (get_the_tags() !== '') {
		$posttags = get_the_tags();
	}
	if ($posttags) {
		$post_tags = '';
		$post_tags_compile = '<span><i class="fa fa-tag"></i>';
		foreach ($posttags as $tag) {
			$post_tags = $post_tags . '<a href="' . get_term_link($tag) . '">' . $tag->name . '</a>' . ', ';
		}
		$post_tags_compile .= ' ' . trim($post_tags, ', ') . '</span>';
	} else {
		$post_tags_compile = '';
	}
	
	$comments_num = '' . get_comments_number(get_the_ID()) . '';
	
	if ($comments_num == 1) {
		$comments_text = '' . esc_html__('comment', 'elitemasters') . '';
	} else {
		$comments_text = '' . esc_html__('comments', 'elitemasters') . '';
	}
	
	$pf = get_post_format();
	if (empty($pf)) $pf = "standard";
	
	$post_class = '';
	if (empty($gt3_theme_featured_image)) $post_class = 'no-post-thumbnail';
	if ($pf == 'link' && !isset($gt3_theme_pagebuilder['post-formats']['linkurl'])) $post_class = 'no-linkurl';
	if ($pf == 'quote' && !isset($gt3_theme_pagebuilder['post-formats']['quotetext'])) $post_class = 'no-quotetext';
	
global $more;
$more = 0;

	$excerpt = '<p>' . ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content())   . '</p>';
	
	$compile_bloglisting = '
		<div class="blog_post_preview format-' . $pf . ' ' . $post_class . '">';
			if ($pf !== 'audio') {
				$compile_bloglisting .= '<div class="blog_post_image">' . get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder)) . '</div>';
			}
			$compile_bloglisting .= '<div class="blog_content clearfix">';
				if ($pf == 'audio') {
					$compile_bloglisting .= '<div class="blog_post_format_label colored_bg"><i class="fa fa-volume-up"></i></div>';
				} else if (empty($gt3_theme_featured_image) && $pf !== 'quote' && $pf !== 'link') {
					$compile_bloglisting .= '<div class="blog_post_format_label colored_bg"><i class="fa fa-file-text-o"></i></div>';
				}
				$compile_bloglisting .= '<div class="listing_meta">
					<span><i class="fa fa-calendar"></i>' . get_the_time("M d, Y") . '</span>
					<span><i class="fa fa-user"></i><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_the_author_meta('display_name') . '</a></span>
					<span><i class="fa fa-comments-o"></i><a href="' . get_comments_link() . '">' . get_comments_number(get_the_ID()) . ' ' . $comments_text . '</a></span>
					' . $post_tags_compile . '
				</div>
				<h5 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
				if ($pf == 'audio') {
					$compile_bloglisting .= get_pf_type_output(array("pf" => get_post_format(), "gt3_theme_pagebuilder" => $gt3_theme_pagebuilder));
				}
				$compile_bloglisting .= '
				' . do_shortcode($excerpt). '
				<a class="blog_post_readmore" href="' . get_permalink() . '">' . esc_html__('Read More', 'elitemasters') . '<i class="fa fa-angle-double-right"></i></a>
			</div>    
		</div>
	';
	
	echo $compile_bloglisting;
?>