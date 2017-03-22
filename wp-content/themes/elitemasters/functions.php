<?php

if (!isset($content_width)) $content_width = 940;

if (!function_exists('gt3_get_theme_pagebuilder')) {
    function gt3_get_theme_pagebuilder($postid, $args = array())
    {
        $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
        if (!is_array($gt3_theme_pagebuilder)) {
            $gt3_theme_pagebuilder = array();
        }

        if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
            $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
            $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_title_area'])) {
            $gt3_theme_pagebuilder['settings']['show_title_area'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_breadcrumb_area'])) {
            $gt3_theme_pagebuilder['settings']['show_breadcrumb_area'] = "yes";
        }
        if (!isset($gt3_theme_pagebuilder['settings']['show_tagline_area'])) {
            $gt3_theme_pagebuilder['settings']['show_tagline_area'] = "yes";
        }
        if (isset($args['not_prepare_sidebars']) && $args['not_prepare_sidebars'] == "true") {

        } else {
            if (!isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "default") {
                $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
            }
        }

        return $gt3_theme_pagebuilder;
    }
}

if (!function_exists('gt3_get_theme_sidebars_for_admin')) {
    function gt3_get_theme_sidebars_for_admin()
    {
        $theme_sidebars = gt3_get_theme_option("theme_sidebars");
        if (!is_array($theme_sidebars)) {
            $theme_sidebars = array();
        }

        return $theme_sidebars;
    }
}

if (!function_exists('gt3_get_theme_option')) {
    function gt3_get_theme_option($optionname, $defaultValue = null)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options");

        if (isset($gt3_options[$optionname])) {
            if (gettype($gt3_options[$optionname]) == "string") {
                return stripslashes($gt3_options[$optionname]);
            } else {
                return $gt3_options[$optionname];
            }
        } else {
            return $defaultValue;
        }
    }
}

if (!function_exists('gt3_delete_theme_option')) {
    function gt3_delete_theme_option($optionname)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        if (isset($gt3_options[$optionname])) {
            unset($gt3_options[$optionname]);
        }

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            return true;
        }
    }
}

if (!function_exists('gt3_update_theme_option')) {
    function gt3_update_theme_option($optionname, $optionvalue)
    {
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        $gt3_options[$optionname] = $optionvalue;

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            return true;
        }
    }
}

if (!function_exists('gt3_theme_comment')) {
    function gt3_theme_comment($comment, $args, $depth)
    {
        $max_depth_comment = ($args['max_depth'] > 4 ? 4 : $args['max_depth']);

        $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
            <div class="thiscommentbody">
                <div class="commentava wrapped_img">
                    <?php echo get_avatar($comment->comment_author_email, 50); ?>
                </div>
                <div class="comment_info">
                    <div class="comment_meta clearfix">
                        <h6 class="comment_author_name"><?php printf('%s', get_comment_author_link()) ?><?php edit_comment_link('(Edit)', '  ', '') ?></h6>
						<span class="date"><?php printf('%1$s', get_comment_date("F d, Y")) ?></span>
                    </div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <p><em><?php esc_html_e('Your comment is awaiting moderation.', 'elitemasters'); ?></em></p>
                    <?php endif; ?>
                    <?php comment_text() ?>
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'reply_text' => '<i class="fa fa-mail-reply-all"></i> ' . esc_html__('Reply', 'elitemasters'), 'max_depth' => $max_depth_comment))) ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <?php
    }
}

#Custom paging
if (!function_exists('gt3_get_theme_pagination')) {
    function gt3_get_theme_pagination($range = 5, $type = "")
    {
        if ($type == "show_in_shortcodes") {
            global $paged, $gt3_wp_query_in_shortcodes;
            $wp_query = $gt3_wp_query_in_shortcodes;
        } else {
            global $paged, $wp_query;
        }

        if (empty($paged)) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $compile = '';

        $max_page = $wp_query->max_num_pages;
        if ($max_page > 1) {
            $compile .= '<ul class="pagerblock text-center">';
        }
		if($paged > 1) $compile .= '<li><a class="prev_page" href="' .get_pagenum_link($paged - 1) . '"><i class="fa fa-caret-left"></i>' . esc_html__('Prev','elitemasters') . '</a></li>';
        if ($max_page > 1) {
            if (!$paged) {
                $paged = 1;
            }
            if ($max_page > $range) {
                if ($paged < $range) {
                    for ($i = 1; $i <= ($range + 1); $i++) {
                        $compile .= "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                    for ($i = $max_page - $range; $i <= $max_page; $i++) {
                        $compile .= "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                    for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                        $compile .= "<li><a href='" . get_pagenum_link($i) . "'";
                        if ($i == $paged) $compile .= " class='current'";
                        $compile .= ">$i</a></li>";
                    }
                }
            } else {
                for ($i = 1; $i <= $max_page; $i++) {
                    $compile .= "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) $compile .= " class='current'";
                    $compile .= ">$i</a></li>";
                }
            }
        }
		if ($paged < $max_page) $compile .= '<li><a class="next_page" href="' . get_pagenum_link($paged + 1) . '">' . esc_html__('Next','elitemasters') . '<i class="fa fa-caret-right"></i></a></li>';
        if ($max_page > 1) {
            $compile .= '</ul>';
        }

		return $compile;
    }
}

function gt3_the_pb_custom_bg_and_color($gt3_theme_pagebuilder, $args = array())
{
    if (!isset($gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'])) {
        $gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'] = "default";
    }

    if ($gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'] == "default") {
        $layout_type = gt3_get_theme_option("default_layout");
        $bgimg_url = gt3_get_theme_option("bg_img");
        $bgpattern_url = gt3_get_theme_option("bg_pattern");
        $bgcolor_hash = gt3_get_theme_option("default_bg_color_boxed");
    } else {
        $layout_type = $gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'];
        $bgimg_url = wp_get_attachment_url($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']);
        $bgpattern_url = wp_get_attachment_url($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']);
        $bgcolor_hash = $gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash'];
    }

    if ($layout_type == "bgimage") {
        echo '<div class="custom_bg img_bg" style="background-image: url(\'' . $bgimg_url . '\'); background-color:' . $bgcolor_hash . ';"></div>';
        return true;
    }
    if ($layout_type == "boxed") {
        echo '<div class="custom_bg pattern_bg" style="background-image: url(\'' . $bgpattern_url . '\'); background-color:' . $bgcolor_hash . ';"></div>';
        return true;
    }
    if ($layout_type == "clean") {
        echo '<div class="custom_bg clean_bg"></div>';
        return true;
    }
}

if (!function_exists('gt3_get_default_pb_settings')) {
    function gt3_get_default_pb_settings()
    {

        $gt3_theme_pagebuilder['settings']['layout-sidebars'] = gt3_get_theme_option("default_sidebar_layout");
        $gt3_theme_pagebuilder['settings']['left-sidebar'] = "Default";
        $gt3_theme_pagebuilder['settings']['right-sidebar'] = "Default";
        $gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'] = gt3_get_theme_option("default_layout");
        $gt3_theme_pagebuilder['settings']['header_type'] = gt3_get_theme_option("default_header");
        $gt3_theme_pagebuilder['settings']['footer_type'] = gt3_get_theme_option("default_footer");
        $gt3_theme_pagebuilder['settings']['transpheader_type'] = "disabled";
        $gt3_theme_pagebuilder['settings']['prefooter_status'] = gt3_get_theme_option("prefooter_img_status");

        return $gt3_theme_pagebuilder;
    }
}

if (!function_exists('gt3_get_selected_pf_images')) {
    function gt3_get_selected_pf_images($gt3_theme_pagebuilder)
    {
        if (!isset($compile)) {
            $compile = '';
        }
        if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
            if (count($gt3_theme_pagebuilder['post-formats']['images']) == 1) {
                $onlyOneImage = "oneImage";
            } else {
                $onlyOneImage = "";
            }
            $compile .= '
                <div class="blog_post_format_label colored_bg"><i class="fa fa-photo"></i></div>
				<div class="slider-wrapper theme-default ' . $onlyOneImage . '">
                    <div class="nivoSlider">
            ';

            if (is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
                foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
                    $compile .= '<img src="' . aq_resize(wp_get_attachment_url($img['attach_id']), "1170", "630", true, true, true) . '" data-thumb="' . aq_resize(wp_get_attachment_url($img['attach_id']), "1170", "630", true, true, true) . '" alt="" />
                    ';
                }
            }

            $compile .= '
                    </div>
                </div>
            ';

        }

        $GLOBALS['showOnlyOneTimeJS']['nivo_slider'] = "
        <script>
            jQuery(document).ready(function($) {
                'use strict';
                jQuery('.nivoSlider').each(function(){
                    jQuery(this).nivoSlider({
						directionNav: false,
						controlNav: true,
						effect:'fade',
						pauseTime:4000,
						slices: 1
					});
                });
            });
        </script>
        ";

        wp_enqueue_script('gt3_nivo_js', get_template_directory_uri() . '/js/nivo.js', array(), false, true);
        return $compile;
    }
}

if (!function_exists('gt3_HexToRGB')) {
    function gt3_HexToRGB($hex = "#ffffff")
    {
        $color = array();
        if (strlen($hex) < 1) {
            $hex = "#ffffff";
        }

        $color['r'] = hexdec(substr($hex, 1, 2));
        $color['g'] = hexdec(substr($hex, 3, 2));
        $color['b'] = hexdec(substr($hex, 5, 2));

        return $color['r'] . "," . $color['g'] . "," . $color['b'];
    }
}

if (!function_exists('gt3_smarty_modifier_truncate')) {
    function gt3_smarty_modifier_truncate($string, $length = 80, $etc = '... ',
                                          $break_words = false)
    {
        if ($length == 0)
            return '';

        if (mb_strlen($string, 'utf8') > $length) {
            $length -= mb_strlen($etc, 'utf8');
            if (!$break_words) {
                $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
            }
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return $string;
        }
    }
}

add_action("wp_head", "wp_head_mix_var");
if (!function_exists('wp_head_mix_var')) {
    function wp_head_mix_var()
    {
        echo "<script>var " . GT3_THEMESHORT . "var = true;</script>";
    }
}

function replace_br_to_rn_in_multiarray(&$item, $key)
{
    $item = str_replace(array("<br>", "<br />"), "\n", $item);
}

function gt3pb_get_plugin_pagebuilder($postid)
{
    $gt3_theme_pagebuilder = get_post_meta($postid, "pagebuilder", true);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }

    if (!isset($gt3_theme_pagebuilder['settings']['show_content_area'])) {
        $gt3_theme_pagebuilder['settings']['show_content_area'] = "yes";
    }
    if (!isset($gt3_theme_pagebuilder['settings']['show_page_title'])) {
        $gt3_theme_pagebuilder['settings']['show_page_title'] = "yes";
    }

    array_walk_recursive($gt3_theme_pagebuilder, 'stripslashes_in_array');

    return $gt3_theme_pagebuilder;
}

function replace_rn_to_br_in_multiarray(&$item, $key)
{
    if ($key !== "html") {
        $item = nl2br($item);
        $item = str_replace(array("\r\n", "\r", "\n"), '', $item);
    }
}

function before_save_pagebuilder_array(&$item, $key)
{
    if (
        $key == "heading_text" ||
        $key == "main_text" ||
        $key == "additional_text" ||
        $key == "iconbox_heading" ||
        $key == "block_name" ||
        $key == "block_price" ||
        $key == "block_period" ||
        $key == "get_it_now_caption" ||
        $key == "title" ||
        $key == "button_text"
    ) {
        $item = str_replace("'", "&#039;", $item);
        $item = str_replace('"', "&quot;", $item);
    }
}

function stripslashes_in_array(&$item)
{
    $item = stripslashes($item);
}

function gt3pb_update_theme_pagebuilder($post_id, $variableName, $gt3_theme_pagebuilderArray)
{
    array_walk_recursive($gt3_theme_pagebuilderArray, 'before_save_pagebuilder_array');
    update_post_meta($post_id, $variableName, $gt3_theme_pagebuilderArray);
    return true;
}

if (!function_exists('get_pf_type_output')) {
    function get_pf_type_output($args)
    {
        $compile = "";
        extract($args);
		
		$gt3_theme_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');

        if (isset($pf)) {
            //$compile .= '<div class="pf_output_container">';

            /* Image */
            if ($pf == 'image') {
                $compile .= '<div class="pf_output_container">';
                $compile .= gt3_get_selected_pf_images($gt3_theme_pagebuilder);
                $compile .= '</div>';
            } else if ($pf == "video") {

                $uniqid = mt_rand(0, 9999);
                global $gt3_YTApiLoaded, $gt3_allYTVideos;
                if (empty($gt3_YTApiLoaded)) {
                    $gt3_YTApiLoaded = false;
                }
                if (empty($gt3_allYTVideos)) {
                    $gt3_allYTVideos = array();
                }

                $video_url = ((isset($gt3_theme_pagebuilder['post-formats']['videourl']) && strlen($gt3_theme_pagebuilder['post-formats']['videourl']) > 0) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "");

                $video_height = 480;

                #YOUTUBE
                $is_youtube = substr_count($video_url, "youtu");
                if ($is_youtube > 0) {
                    $videoid = substr(strstr($video_url, "="), 1);
                    $compile .= "<div class='pf_output_container'><div id='player{$uniqid}'></div></div>";

                    array_push($gt3_allYTVideos, array("h" => $video_height, "w" => "100%", "videoid" => $videoid, "uniqid" => $uniqid));
                }

                #VIMEO
                $is_vimeo = substr_count($video_url, "vimeo");
                if ($is_vimeo > 0) {
                    $videoid = substr(strstr($video_url, "m/"), 2);
                    $compile .= "
            <div class=\"pf_output_container\"><iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"100%\" height=\"" . $video_height . "\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
        ";
                }
            } else if ($pf == 'link' && isset($gt3_theme_pagebuilder['post-formats']['linkurl'])) {
				$compile .= '
					<div class="postformats_cont blog_post_link">
						<div class="blog_post_format_label colored_bg"><i class="fa fa-link"></i></div>
						<div class="blog_post_link_cont">
							<h2 class="post_format_link_title">' . $gt3_theme_pagebuilder['post-formats']['linktitle'] . '</h2>
							<a class="post_format_link_href color" href="' . $gt3_theme_pagebuilder['post-formats']['linkurl'] . '" target="_blank">' . $gt3_theme_pagebuilder['post-formats']['linkurl'] . '</a>
						</div>
						<div class="blog_post_link_bg_image"';
							if (strlen($gt3_theme_featured_image[0]) > 0) {
								$compile .= ' style="background-image:url(' . $gt3_theme_featured_image[0] . ');"';
							}
					$compile .= '></div>
					</div>
				';
			} else if ($pf == 'quote' && isset($gt3_theme_pagebuilder['post-formats']['quotetext'])) {
				$compile .= '
					<div class="postformats_cont blog_post_quote">
						<div class="blog_post_format_label colored_bg"><i class="fa fa-quote-left"></i></div>
						<div class="blog_post_quote_cont">
							<h2 class="post_format_quote_title">' . $gt3_theme_pagebuilder['post-formats']['quotetext'] . '</h2>
						</div>
						<div class="blog_post_quote_bg_image"';
							if (strlen($gt3_theme_featured_image[0]) > 0) {
								$compile .= ' style="background-image:url(' . $gt3_theme_featured_image[0] . ');"';
							}
					$compile .= '></div>
					</div>
				';
			} else if ($pf == 'audio' && isset($gt3_theme_pagebuilder['post-formats']['audiourl'])) {
				$compile .= $gt3_theme_pagebuilder['post-formats']['audiourl'];
			} else {
                if (strlen($gt3_theme_featured_image[0]) > 0) {
					$compile .= '
						<div class="pf_output_container">
							<div class="blog_post_format_label colored_bg"><i class="fa fa-camera-retro"></i></div>';
							if (!is_single()) {
								$compile .= '<a href="' . get_permalink() . '">';
							}
									$compile .= '<img class="featured_image_standalone" src="' . aq_resize($gt3_theme_featured_image[0], "1170", "630", true, true, true) . '" alt="" />';
							if (!is_single()) {
								$compile .= '</a>';
							}
						$compile .= '</div>';
                } else {
					$compile .= '<div class="blog_post_format_label colored_bg"><i class="fa fa-file-text-o"></i></div>';
				}
            }

            //$compile .= '</div>';
        }

        $GLOBALS['showOnlyOneTimeJS']['post_video_js'] = "
	<script>
		function video_size() {
		    'use strict';
			jQuery('.pf_output_container').each(function(){
                jQuery(this).find('iframe').css({'height': jQuery(this).width()*9/16 + 'px'});
            });
		}
		jQuery(window).load(function () {
		    'use strict';
			video_size();
		});
		jQuery(window).resize(function () {
		    'use strict';
			video_size();
		});
	</script>
	";

        return $compile;
    }
}

function init_YTvideo_in_footer()
{
    global $gt3_allYTVideos;
    $compile = "";
    $result = "";
    if (is_array($gt3_allYTVideos) && count($gt3_allYTVideos) > 0) {
        $compile .= "
        <script>
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        function onPlayerReady(event) {}
        function onPlayerStateChange(event) {}
        function stopVideo() {
            player.stopVideo();
        }
        ";

        foreach ($gt3_allYTVideos as $key => $value) {
            $result .= "
            new YT.Player('player{$value['uniqid']}', {
                height: '{$value['h']}',
                width: '{$value['w']}',
                playerVars: { 'autoplay': 0, 'controls': 1 },
                videoId: '{$value['videoid']}',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
            ";
        }
        $compile .= "function onYouTubeIframeAPIReady() {" . $result . "}</script>";
    }
    echo $compile;
}

add_action('wp_footer', 'init_YTvideo_in_footer');

if (!function_exists('gt3_get_field_media_and_attach_id')) {
    function gt3_get_field_media_and_attach_id($name, $attach_id, $previewW = "200px", $previewH = null, $classname = "")
    {
        return "<div class='select_image_root " . $classname . "'>
        <input type='hidden' name='" . $name . "' value='" . $attach_id . "' class='select_img_attachid'>
        <div class='select_img_preview'><img src='" . ($attach_id > 0 ? aq_resize(wp_get_attachment_url($attach_id), $previewW, $previewH, true, true, true) : "") . "' alt=''></div>
        <input type='button' class='button button-secondary button-large select_attach_id_from_media_library' value='Select'>
    </div>";
    }
}

if (!function_exists('gt3_the_breadcrumb')) {
    function gt3_the_breadcrumb()
    {
        $showOnHome = 1;
        $delimiter = '';
        $home = esc_html__('Home', 'elitemasters');
        $showCurrent = 1;
        $before = '<span>';
        $after = '</span>';

        global $post;
        $homeLink = esc_url(home_url('/'));

        if (is_home() || is_front_page()) {

            //if ($showOnHome == 1) echo '<div class="breadcrumbs"><div class="container">' . $home . '</div></div>';
            if ($showOnHome == 1) echo '';

        } else {

            echo '<div class="breadcrumbs"><div class="container"><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . 'Archive "' . single_cat_title('', false) . '"' . $after;

            } #PORTFOLIO
            elseif (get_post_type() == 'portfolio') {

                the_terms($post->ID, 'portfolio_category', '', '', '');

                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif (is_search()) {
                echo $before . 'Search for "' . get_search_query() . '"' . $after;

            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;

            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;

            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;

            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {

                    $parent_id = $post->post_parent;
                    if ($parent_id > 0) {
                        $breadcrumbs = array();
                        while ($parent_id) {
                            $page = get_page($parent_id);
                            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                            $parent_id = $page->post_parent;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for ($i = 0; $i < count($breadcrumbs); $i++) {
                            echo $breadcrumbs[$i];
                            if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                        }
                        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    } else {
                        echo $before . get_the_title() . $after;
                    }

                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }

            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					echo $before . $post_type->labels->singular_name . $after;
				}                

            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                #$cat = get_the_category($parent->ID);
                #$cat = $cat[0];
                #echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                #echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1) echo $before . get_the_title() . $after;

            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo '' . $delimiter . '' . $before . get_the_title() . $after;

            } elseif (is_tag()) {
                echo $before . 'Tag "' . single_tag_title('', false) . '"' . $after;

            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Author "' . $userdata->display_name . '"' . $after;

            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }

            echo '</div></div>';

        }
    }
}

if (!function_exists('gt3_showJSInFooter')) {
    function gt3_showJSInFooter()
    {
        if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
            foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
                echo $js;
            }
        }
    }
}
add_action('wp_footer', 'gt3_showJSInFooter');


if (!function_exists('gt3_get_dynamic_sidebar')) {
    function gt3_get_dynamic_sidebar($index)
    {
        $sidebar_contents = "";
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();
        return $sidebar_contents;
    }
}

function gt3_theme_slug_setup()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'gt3_theme_slug_setup');

if (!function_exists('_wp_render_title_tag')) {
    function theme_slug_render_title()
    {
        ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <?php
    }

    add_action('wp_head', 'theme_slug_render_title');
}

if (!function_exists('gt3_availbale_post_categories_array')) {
    function gt3_availbale_post_categories_array()
    {
        $gt3_categories = get_categories(array('type' => 'post'));
        $gt3_available_categories = array('All' => 0);

        if (is_array($gt3_categories)) {
            foreach ($gt3_categories as $cat) {
                if (is_object($cat)) {
                    $gt3_available_categories[$cat->name] = $cat->cat_ID;
                }
            }
        }

        return $gt3_available_categories;
    }
}

require_once(get_template_directory() . "/core/loader.php");

add_action('init', 'gt3_page_init');
if (!function_exists('gt3_page_init')) {
    function gt3_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('gt3_select_image_from_media_button')) {
    function gt3_select_image_from_media_button($fieldname, $fieldvalue, $button_caption, $default_value)
    {
        if (wp_get_attachment_url($fieldvalue)) {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . wp_get_attachment_url($fieldvalue) . '" target="_blank"><img src="' . wp_get_attachment_url($fieldvalue) . '" alt="" /></a>';
        } else {
            $compile = '<input class="gt3_image_selected_id" name="' . $fieldname . '" type="hidden" value="' . $fieldvalue . '" />';
            $compile .= '<input type="button" name="button_caption1" class="gt3_admin_button gt3_select_image_from_media" value="' . $button_caption . '">';
            $compile .= '<input type="button" name="button_caption2" class="gt3_admin_button gt3_admin_danger_btn gt3_image_from_media_remove" value="Remove">';
            $compile .= '<a class="admin_selected_image" href="' . $default_value . '" target="_blank"><img src="' . $default_value . '" alt="" /></a>';
        }
        return $compile;
    }
}

if (!function_exists('gt3_pre')) {
    function gt3_pre($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
}

/// Post Page Settings ///

#Get media for postid
add_action('wp_ajax_get_media_for_postid', 'gt3pb_get_media_for_postid');
if (!function_exists('gt3pb_get_media_for_postid')) {
    function gt3pb_get_media_for_postid()
    {
        $postid = absint($_POST['post_id']);
        $page = esc_attr($_POST['page']);
        $media_for_this_post = gt3pb_get_media_for_this_post($postid, $page);
        if (is_array($media_for_this_post) && count($media_for_this_post) > 0) {
            echo gt3pb_get_media_html($media_for_this_post, "small");
        } else {
            echo "no_items";
        }

        die();
    }
}

function gt3pb_get_media_for_this_post($postid, $page = "1")
{
    $args = array(
        'post_type' => 'attachment',
        'numberposts' => $GLOBALS["pbconfig"]['images_from_media_library'],
        'post_status' => null,
        'order' => 'DESC',
        'paged' => $page
    );
    $images = get_posts($args);
    if (is_array($images) && $images) {
        foreach ($images as $image) {
            $meta = wp_get_attachment_metadata($image->ID);
            if ((isset($meta['width']) && $meta['width'] > 0) && !isset($meta['audio'])) {
                $imgpack[] = array("guid" => $image->guid, "width" => $meta['width'], "height" => $meta['height'], "attach_id" => $image->ID);
            }
        }
        return $imgpack;
    }
    return false;
}

function gt3pb_get_selected_pf_images_for_admin($gt3_theme_pagebuilder)
{
    if (!isset($compile)) {
        $compile = '';
    }
    if (isset($gt3_theme_pagebuilder['post-formats']['images']) && is_array($gt3_theme_pagebuilder['post-formats']['images'])) {
        foreach ($gt3_theme_pagebuilder['post-formats']['images'] as $imgid => $img) {
            $compile .= "<div class='img-item style_small'><div class='img-preview'><img src='" . aq_resize(wp_get_attachment_url($img['attach_id']), "62", "62", true) . "' data-full-url='" . wp_get_attachment_url($img['attach_id']) . "' data-thumb-url='" . aq_resize(wp_get_attachment_url($img['attach_id']), "158", "107", true, true, true) . "' alt='' class='previmg'><div class='hover-container'></div><div class='deldel-container'></div></div><input type='hidden' name='pagebuilder[post-formats][images][" . $imgid . "][attach_id]' value='{$img['attach_id']}'></div>";
        }
    }
    return $compile;
}

function gt3pb_get_media_html($media_array, $style = "small")
{
    if (is_array($media_array) && count($media_array) > 0) {

        $compile = "<span class='available_media_arrow left_arrow'></span><span class='available_media_arrow right_arrow'></span><div class='clear'></div>";

        foreach ($media_array as $media_item) {

            $media_url = $media_item['guid'];
            $media_width = $media_item['width'];
            $media_height = $media_item['height'];
            $attach_id = $media_item['attach_id'];

            #style 1
            if ($style == "small") {
                $compile .= "
                <div class='img-item style_small available_media_item'>
                    <div class='img-preview'>
                        <img class='previmg' alt='' data-thumb-url='" . aq_resize($media_url, "158", "107", true, true, true) . "' data-full-url='" . $media_url . "' data-attach-id='" . $attach_id . "' src='" . aq_resize($media_url, "62", "62", true, true, true) . "'>
                        <div class='hover-container'>
                            <div class='media_size'>" . $media_width . "px<br>x<br>" . $media_height . "px</div>
                        </div>
                    </div>
                </div><!-- .img-item -->
                ";
            }
        }

        return "";
    }

    return false;
}

#Return html for add images
add_action('wp_ajax_gt3_generate_inserted_media_to_slider', 'gt3_generate_inserted_media_to_slider');
if (!function_exists('gt3_generate_inserted_media_to_slider')) {
    function gt3_generate_inserted_media_to_slider()
    {
        if (is_admin()) {
            $type = esc_attr($_POST['type']); #v1 = gallery, v2 = post_formats
            $itemsIDs = esc_attr($_POST['itemsIDs']);
            $settings_type = esc_attr($_POST['settings_type']);

            $array = explode(',', $itemsIDs);

            if (is_array($array)) {
                foreach ($array as $tempid => $attach_id) {

                    $lastid = gt3pb_get_option("last_slide_id");
                    if ($lastid < 3) {
                        $lastid = 2;
                    }
                    $lastid++;

                    gt3pb_update_option("last_slide_id", $lastid);

                    $featured_image = wp_get_attachment_image_src($attach_id, 'large');

                    #For gallery
                    if ($type == "v1") {
                        echo '
                    <li>
                        <div class="img-item item-with-settings append_animation">
                            <input type="hidden" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][attach_id]" value="' . $attach_id . '">
                            <input type="hidden" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][slide_type]" value="image">
                            <div class="img-preview">
                                <img src="' . aq_resize($featured_image[0], "158", "107", true, true, true) . '" alt="">
                                <div class="hover-container">
                                    <div class="inter_x"></div>
                                    <div class="inter_drag"></div>
                                    <div class="inter_edit"></div>
                                </div>
                            </div>
                            <div class="edit_popup">
                                <h2>Image Settings</h2>
                                <span class="edit_popup_close"></span>
                                <div class="this-option img-in-slider">
                                    <div class="padding-cont">
                                        <div class="fl w9">
                                            <h4>Title</h4>
                                            <input name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][title][value]" type="text" value="" class="textoption type1">
                                        </div>
                                        <div class="right_block fl w1">
                                            <h4>color</h4>
                                            <div class="color_picker_block">
                                                <span class="sharp">#</span>
                                                <input type="text" value="" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][title][color]" maxlength="25" class="medium cpicker textoption type1">
                                                <input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled">
                                            </div>
                                        </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="hr_double"></div>
                                <div class="padding-cont no_caption">
                                    <div class="fl w9">
                                        <h4>Caption</h4>
                                        <textarea name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][caption][value]" type="text" class="textoption type1 big"></textarea>
                                    </div>
                                    <div class="right_block fl w1">
                                        <h4>color</h4>
                                        <div class="color_picker_block">
                                            <span class="sharp">#</span>
                                            <input type="text" value="" name="pagebuilder[sliders][' . $settings_type . '][slides][' . $lastid . '][caption][color]" maxlength="25" class="medium cpicker textoption type1">
                                            <input type="text" value="" class="textoption type1 cpicker_preview" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="padding-cont">
                                <input type="button" value="Done" class="done-btn green-btn" name="ignore_this_button">
                                <div class="clear"></div>
                            </div>
                        </div>
                        </div>
                    </li>
                    ';
                    }

                    #For post formats
                    if ($type == "v2") {
                        echo '
                        <div class="img-item style_small">
                            <div class="img-preview">
                                <img src="' . aq_resize($featured_image[0], "62", "62", true, true, true) . '" data-full-url="' . $featured_image[0] . '" data-thumb-url="' . aq_resize($featured_image[0], "158", "107", true, true, true) . '" alt="" class="previmg">
                                <div class="hover-container"></div>
                                <div class="deldel-container"></div>
                            </div>
                            <input type="hidden" name="pagebuilder[post-formats][images][' . $lastid . '][attach_id]" value="' . $attach_id . '">
                        </div>
                    ';
                    }
                }
            }
        }

        die();
    }
}

/*Work with options*/
if (!function_exists('gt3pb_get_option')) {
    function gt3pb_get_option($optionname, $defaultValue = "")
    {
        $returnedValue = get_option("gt3pb_" . $optionname, $defaultValue);

        if (gettype($returnedValue) == "string") {
            return stripslashes($returnedValue);
        } else {
            return $returnedValue;
        }
    }
}

if (!function_exists('gt3pb_delete_option')) {
    function gt3pb_delete_option($optionname)
    {
        return delete_option("gt3pb_" . $optionname);
    }
}

if (!function_exists('gt3pb_update_option')) {
    function gt3pb_update_option($optionname, $optionvalue)
    {
        if (update_option("gt3pb_" . $optionname, $optionvalue)) {
            return true;
        }
    }
}

if (!function_exists('gt3pb_showportfolio_categorys')) {
    function gt3pb_showportfolio_categorys($post_type_terms = "")
    {
        if (!isset($term_list)) {
            $term_list = '';
        }

        $permalink = get_permalink();
        $args = array('taxonomy' => 'Category', 'include' => $post_type_terms);
        $terms = get_terms('portfolio_category', $args);
        $count = count($terms);
        $i = 0;
        $iterm = 1;

        if ($count > 0) {
            $cape_list = '';
            if ($count > 1) {
                $term_list .= '<li class="' . (!isset($_GET['slug']) ? 'selected' : '') . '">';

                $args_for_count_all_terms = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish'
                );
                $query_for_count_all_terms = new WP_Query($args_for_count_all_terms);

                $term_list .= '<a href="#filter" data-option-value="*" data-catname="all" data-title="' . $query_for_count_all_terms->post_count . '">' . esc_html__('All Works', 'elitemasters') . '</a>
				</li>';
            }
            $termcount = count($terms);
            if (is_array($terms)) {
                foreach ($terms as $term) {

                    $args_for_count_all_terms = array(
                        'post_type' => 'portfolio',
                        'post_status' => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio_category',
                                'field' => 'id',
                                'terms' => $term->term_id
                            )
                        )
                    );
                    $query_for_count_all_terms = new WP_Query($args_for_count_all_terms);

                    $i++;
                    $permalink = esc_url(add_query_arg("slug", $term->term_id, $permalink));
                    $term_list .= '<li ';
                    if (isset($_GET['slug'])) {
                        $getslug = $_GET['slug'];
                    } else {
                        $getslug = '';
                    }

                    if (strnatcasecmp($getslug, $term->term_id) == 0) $term_list .= 'class="selected"';

                    $tempname = strtr($term->name, array(
                        ' ' => '-',
                    ));
                    $tempname = strtolower($tempname);
                    $term_list .= '><a data-option-value=".' . $tempname . '" data-catname="' . $tempname . '" href="#filter"  data-title="' . $query_for_count_all_terms->post_count . '">' . $term->name . '</a>
                </li>';
                    if ($count != $i) $term_list .= ' '; else $term_list .= '';

                    $iterm++;
                }
            }
            return '<div class="filter_block"><div class="filter_navigation"><ul id="options" class="splitter"><li><ul data-option-key="filter" class="optionset">' . $term_list . '</ul></li></ul></div></div>';
        }
    }
}


function gt3pb_colorpicker_block($name, $value, $additional_class = "")
{
    return "
    <div class='color_picker_block {$additional_class}'>
        <span class='sharp'>#</span>
        <input type='text' value='{$value}' name='{$name}' maxlength='25' class='medium cpicker textoption type1'>
        <input type='text' value='' class='textoption type1 cpicker_preview' disabled='disabled'>
    </div>
    ";
}

#GET ITEMS FOR SLIDER (ADMIN)
function gt3pb_get_slider_items($slider_type, $array)
{
    if (is_array($array)) {

        $compile = "";

        foreach ($array as $key => $slide) {
            if (!isset($slide['title']['value'])) {
                $slide['title']['value'] = "";
            }
            if (!isset($slide['caption']['value'])) {
                $slide['caption']['value'] = "";
            }

            #fullscreen slider
            if ($slider_type == "fullscreen") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][attach_id]' value='{$slide['attach_id']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize(wp_get_attachment_url($slide['attach_id']), "158", "107", true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>Image Settings</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Title', 'elitemasters') . "</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Caption', 'elitemasters') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullscreen][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . THEMEROOTURL . "/core/admin/img/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . gt3pb_show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Video settings', 'elitemasters') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>" . esc_html__('Video URL (YouTube or Vimeo)', 'elitemasters') . "</h4>
                                    <input name='pagebuilder[sliders][fullscreen][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        " . esc_html__('Examples:', 'elitemasters') . "<br>
                                        Youtube - http://www.youtube.com/watch?v=6v2L2UGZJAM<br>
                                        Vimeo - http://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont' style='padding-top:0;'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>" . esc_html__('Title and thumbnail', 'elitemasters') . "</h4>
                                        <input name='pagebuilder[sliders][fullscreen][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
			                            " . gt3_get_field_media_and_attach_id("pagebuilder[sliders][fullscreen][slides][{$key}][attach_id]", $slide['attach_id']) . "
                                        <div class='clear'></div>
		                            </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9' style='width:601px;'>
                                        <!--h4>" . esc_html__('Caption', 'elitemasters') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullscreen][slides][{$key}][caption][value]' type='text' class='textoption type1 big' style='height:70px;'>{$slide['caption']['value']}</textarea-->
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullscreen][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }

            #fullwidth slider
            if ($slider_type == "fullwidth") {
                $compile .= "<li>";
                #IF SLIDE IS IMAGE
                if ($slide['slide_type'] == "image") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='image'>
                        <div class='img-preview'>
                            <img alt='' src='" . aq_resize($slide['src'], "158", "107", true, true, true) . "'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Image Settings', 'elitemasters') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option img-in-slider'>
                                <div class='padding-cont'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Title', 'elitemasters') . "</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9'>
                                        <h4>" . esc_html__('Caption', 'elitemasters') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                #IF SLIDE IS VIDEO
                if ($slide['slide_type'] == "video") {
                    $compile .= "
                    <div class='img-item item-with-settings'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' value='{$slide['src']}'>
                        <input type='hidden' name='pagebuilder[sliders][fullwidth][slides][{$key}][slide_type]' value='video'>
                        <div class='img-preview'>
                            <img alt='' src='" . THEMEROOTURL . "/core/admin/img/video_item.png'>
                            <div class='hover-container'>
                                <div class='inter_x'></div>
                                <div class='inter_drag'></div>
                                <div class='inter_edit'></div>
                            </div>
                            " . gt3pb_show_video_preview($slide['src']) . "
                        </div>
                        <div class='edit_popup'>
                            <h2>" . esc_html__('Video settings', 'elitemasters') . "</h2>
                            <span class='edit_popup_close'></span>
                            <div class='this-option'>
                                <div class='padding-cont'>
                                    <h4>" . esc_html__('Video URL (YouTube or Vimeo)', 'elitemasters') . "</h4>
                                    <input name='pagebuilder[sliders][fullwidth][slides][{$key}][src]' type='text' value='{$slide['src']}' class='textoption type1'>
                                    <div class='example'>
                                        " . esc_html__('Examples:', 'elitemasters') . "<br>
                                        Youtube - http://www.youtube.com/watch?v=6v2L2UGZJAM<br>
                                        Vimeo - http://vimeo.com/47989207
                                    </div>
                                </div>
                                <div class='padding-cont' style='padding-top:0;'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>" . esc_html__('Title and thumbnail', 'elitemasters') . "</h4>
                                        <input name='pagebuilder[sliders][fullwidth][slides][{$key}][title][value]' type='text' value='{$slide['title']['value']}' class='textoption type1'>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][title][color]", $slide['title']['color']) . "
                                    </div>
                                   <div class='preview_img_video_cont'>
                                        <input type='text' value='{$slide['thumbnail']['value']}' id='slide_{$key}_upload' name='pagebuilder[sliders][fullwidth][slides][{$key}][thumbnail][value]' class='textoption type1' style='width:601px;float:left;'>
                                        <div class='up_btns'>
                                            <span id='slide_{$key}' class='button btn_upload_image style2 but_slide_{$key}'>" . esc_html__('Upload Image', 'elitemasters') . "</span>
                                        </div>
                                        <div class='clear'></div>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                <div class='hr_double'></div>
                                <div class='padding-cont no_caption'>
                                    <div class='fl w9' style='width:601px;'>
                                        <h4>" . esc_html__('Caption', 'elitemasters') . "</h4>
                                        <textarea name='pagebuilder[sliders][fullwidth][slides][{$key}][caption][value]' type='text' class='textoption type1 big' style='height:70px;'>{$slide['caption']['value']}</textarea>
                                    </div>
                                    <div class='right_block fl w1' style='width:115px;'>
                                        <h4>" . esc_html__('color', 'elitemasters') . "</h4>
                                        " . gt3pb_colorpicker_block("pagebuilder[sliders][fullwidth][slides][{$key}][caption][color]", $slide['caption']['color']) . "
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div class='hr_double'></div>
                            <div class='padding-cont'>
                                <input type='button' value='Done' class='done-btn green-btn' name='ignore_this_button'>
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div><!-- .img-item -->
                    ";
                }
                $compile .= "</li>";
            }
        }

        return $compile;
    }

    return false;
}

/* SHOW VIDEO PREVIEW IN POPUP (admin area) */
function gt3pb_show_video_preview($videourl)
{
    $compile_inner = "";

    #YOUTUBE
    $is_youtube = substr_count($videourl, "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($videourl, "="), 1);
        $compile_inner = "
            <iframe width=\"395\" height=\"295\" src=\"http://www.youtube.com/embed/" . $videoid . "\" frameborder=\"0\" allowfullscreen></iframe>
        ";
    }

    #VIMEO
    $is_vimeo = substr_count($videourl, "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($videourl, "m/"), 2);
        $compile_inner = "
            <iframe src=\"http://player.vimeo.com/video/" . $videoid . "\" width=\"395\" height=\"295\" frameborder=\"0\" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        ";
    }

    $compile = "
        <div class='video_preview'>
            <div class='video_inner'>
                {$compile_inner}
            </div>
        </div>
    ";

    return $compile;
}


function gt3pb_toggle_radio_yes_no($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{

    if (!isset($checked_state_yes)) {
        $checked_state_yes = '';
    }
    if (!isset($checked_state_no)) {
        $checked_state_no = '';
    }

    if ($default_state == "yes") {
        $checked_state_yes = "checked='checked'";
    }
    if ($default_state == "no") {
        $checked_state_no = "checked='checked'";
    }

    if ($settingstate == "yes") {
        $checked_state_yes = "checked='checked'";
        $checked_state_no = "";
    }
    if ($settingstate == "no") {
        $checked_state_no = "checked='checked'";
        $checked_state_yes = "";
    }
    return "
<div class='radio_toggle_cont {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_yes} value='yes' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_no} value='no' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}


function gt3pb_pb_setting_input($settingsname, $settingstate, $default_state = "yes", $additional_class = "")
{
    if ($settingstate == "") {
        $settingstate = $default_state;
    }
    return "
    <input type='text' class='textoption type1 settings_input {$additional_class}' value='{$settingstate}' name='{$settingsname}'>
";
}

function gt3pb_toggle_radio_on_off($settingsname, $settingstate, $default_state = "on", $additional_class = "")
{
    if (!isset($checked_state_on)) {
        $checked_state_on = '';
    }
    if (!isset($checked_state_off)) {
        $checked_state_off = '';
    }

    if ($default_state == "on") {
        $checked_state_on = "checked='checked'";
    }
    if ($default_state == "off") {
        $checked_state_off = "checked='checked'";
    }

    if ($settingstate == "on") {
        $checked_state_on = "checked='checked'";
        $checked_state_off = "";
    }
    if ($settingstate == "off") {
        $checked_state_off = "checked='checked'";
        $checked_state_on = "";
    }
    return "
<div class='radio_toggle_cont on_off_style {$additional_class}'>
    <input type='radio' class='checkbox_slide yes_state' {$checked_state_on} value='on' name='{$settingsname}'>
    <input type='radio' class='checkbox_slide no_state' {$checked_state_off} value='off' name='{$settingsname}'>
    <div class='radio_toggle_mirage'></div>
</div>
";
}

/* Social Icons */
function gt3_show_social_icons($array)
{
    $compile = "";
    foreach ($array as $key => $value) {
        if (strlen(gt3_get_theme_option($value['uniqid'])) > 0) {
            $compile .= "<li><a class='" . $value['class'] . "' target='" . $value['target'] . "' href='" . gt3_get_theme_option($value['uniqid']) . "' title='" . $value['title'] . "'><i class='fa fa-" . $value['class'] . "'></i></a></li>";
        }
    }
    $compile .= "";
    if (is_array($array) && count($array) > 0) {
        return $compile;
    } else {
        return "";
    }
}

function gt3_the_pb_custom_header($gt3_theme_pagebuilder, $args = array())
{
    if (!isset($gt3_theme_pagebuilder['settings']['header_type'])) {
        $gt3_theme_pagebuilder['settings']['header_type'] = "default";
    }
    if ($gt3_theme_pagebuilder['settings']['header_type'] == "default") {
        $header_type = gt3_get_theme_option("default_header");
    } else {
        $header_type = $gt3_theme_pagebuilder['settings']['header_type'];
    }

    if ($header_type == "type1") {
        echo 'type1';
        return true;
    }
    if ($header_type == "type2") {
        echo 'type2';
        return true;
    }
    if ($header_type == "type3") {
        echo 'type3';
        return true;
    }
    if ($header_type == "type4") {
        echo 'type4';
        return true;
    }
}

function gt3_the_pb_custom_footer($gt3_theme_pagebuilder, $args = array())
{
    if (!isset($gt3_theme_pagebuilder['settings']['footer_type'])) {
        $gt3_theme_pagebuilder['settings']['footer_type'] = "default";
    }
    if ($gt3_theme_pagebuilder['settings']['footer_type'] == "default") {
        $footer_type = gt3_get_theme_option("default_footer");
    } else {
        $footer_type = $gt3_theme_pagebuilder['settings']['footer_type'];
    }

    if ($footer_type == "type1" || $footer_type == "type2") {
        return $footer_type;
    }
}

function gt3_the_pb_custom_transpheader($gt3_theme_pagebuilder, $args = array())
{
    if (!isset($gt3_theme_pagebuilder['settings']['transpheader_type'])) {
        $gt3_theme_pagebuilder['settings']['transpheader_type'] = "disabled";
    }
    if ($gt3_theme_pagebuilder['settings']['transpheader_type'] == "disabled") {
        $transpheader_type = "disabled";
    } else {
        $transpheader_type = $gt3_theme_pagebuilder['settings']['transpheader_type'];
    }

    if ($transpheader_type == "disabled") {
        return 'page_without_abs_header';
    }
    if ($transpheader_type == "enabled") {
        return 'page_with_abs_header';
    }
}

function gt3_the_pb_custom_prefooter($gt3_theme_pagebuilder, $args = array())
{
    if (!isset($gt3_theme_pagebuilder['settings']['prefooter_status'])) {
        $gt3_theme_pagebuilder['settings']['prefooter_status'] = "default";
    }
    if ($gt3_theme_pagebuilder['settings']['prefooter_status'] == "default") {
        $prefooter_status = gt3_get_theme_option("prefooter_img_status");
    } else {
        $prefooter_status = $gt3_theme_pagebuilder['settings']['prefooter_status'];
    }

    if ($prefooter_status == "disabled") {
        return 'prefooter_bgcolor';
    }
    if ($prefooter_status == "enabled") {
        return 'prefooter_bgimg';
    }
}

function gt3_get_if_strlen($str, $beforeoutput = "", $afteroutput = "")
{
    if (strlen($str) > 0) {
        return $beforeoutput . $str . $afteroutput;
    }
}

/* AJAX PART */
add_action('wp_ajax_gt3_get_posts', 'gt3_get_posts');
add_action('wp_ajax_nopriv_gt3_get_posts', 'gt3_get_posts');
function gt3_get_posts()
{
    if ($_REQUEST['post_type'] == "portfolio") {

        $wp_query_get_blog_posts = new WP_Query();
        $args = array(
            'post_type' => esc_attr($_REQUEST['post_type']),
            'offset' => absint($_REQUEST['posts_already_showed']),
            'post_status' => 'publish',
            'posts_per_page' => absint($_REQUEST['posts_count'])
        );

        if (isset($_POST['selected_terms'])) {
            $selected_terms = esc_attr($_POST['selected_terms']);

            if (strlen($selected_terms) > 0) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'id',
                        'terms' => explode(',', $selected_terms)
                    )
                );
            }

        }

        $wp_query_get_blog_posts->query($args);
        $compile = '';
        while ($wp_query_get_blog_posts->have_posts()) : $wp_query_get_blog_posts->the_post();

            $pf = get_post_format();
            if (empty($pf)) $pf = "text";

            $post_excerpt = (gt3_smarty_modifier_truncate(get_the_excerpt(), 1265));					
			$gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder(get_the_ID());
			
			$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
			if (strlen($featured_image[0]) < 1) {
				$featured_image[0] = "";
			}
			
			if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) && strlen($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) > 0) {
				$linkToTheWork = esc_url($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']);
				$target = "target='_blank'";
			} else {
				$linkToTheWork = get_permalink();
				$target = "";
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
			
			if ($_REQUEST['posts_per_line'] == "5") {
				$columns = '2 col-sm-2_4';
			} else {
				$columns = 12/$_REQUEST['posts_per_line'];
			}

            /* Grid or Masonry (Items Per Line - 1) */	
			if ($_REQUEST['template'] == "grid" && $_REQUEST['posts_per_line'] == "1" || $_REQUEST['template'] == "masonry" && $_REQUEST['posts_per_line'] == "1") {
				$compile .= '						
					<div class="col-sm-12 ' . $echoallterm . ' element">                    
						<div class="portfolio_item">
							<div class="row">';
								 if (strlen($featured_image[0]) > 0) {
									$compile .= '
										<div class="col-sm-6">
											<div class="portf_img">
												<a ' . $target . ' href="' . $linkToTheWork . '">'; 
													if ($_REQUEST['featured_image_type'] == "round_type") {                                                      
														$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="" />';
													} else {
														$compile .= '<img src="' . aq_resize($featured_image[0], 570, 420, true, true, true) . '" alt="" />';
													}
												$compile .= '</a>
											</div>
										</div>';
								}										
								$compile .= '<div class="' . (strlen($featured_image[0]) > 0 ? "col-sm-6" : "col-sm-12") . '">
									<h2 class="portf_title"><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h2>
									<div class="listing_meta">
										<span><i class="fa fa-calendar"></i>' . get_the_time("M d, Y") . '</span>
										<span><i class="fa fa-bookmark-o"></i>' . strtolower($on_draught) . '</span>';
										if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
											foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $skillkey => $skillvalue) {
												$compile .='
													<span>
														' . ((isset($skillvalue['value']) && strlen($skillvalue['value']) > 0) && (isset($skillvalue['icon']) && strlen($skillvalue['icon']) > 0) ? "<i class='" . esc_attr($skillvalue['icon']) . "'></i>" : "") . esc_attr($skillvalue['value']) . '
													</span>
												';
											}
										}
									$compile .= '</div>
									<div class="content_info"><p>' . $post_excerpt . '</p></div>
									<a class="blog_post_readmore" ' . $target . ' href="' . $linkToTheWork . '">' . esc_html__("Read More", "elitemasters") . '<i class="fa fa-angle-double-right"></i></a>
								</div>                                        
							</div>                                                                        	
						</div>                                   
					</div>
				';
			}
			/* Wall */			
			elseif ($_REQUEST['template'] == "wall") {
				$compile .= '
					<div class="' . $echoallterm . ' element">                    
						<div class="portfolio_item">';
							if (strlen($featured_image[0]) > 0) {                                 
								$compile .= '<div class="portf_img">
									<a ' . $target . ' href="' . $linkToTheWork . '">';
										if ($_REQUEST['featured_image_type'] == "round_type") {                                                      
											$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="">';
										} else {
											$compile .= '<img src="' . aq_resize($featured_image[0], 570, 420, true, true, true) . '" alt="">';
										}
									$compile .= '</a>
								</div>';
							}
							$compile .= '
							<div class="portf_descr">
								<h6 class="portf_title"><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h6>
								<div class="listing_meta">
									<span><i class="fa fa-bookmark-o"></i>' . $on_draught . '</span>
								</div>
							</div>
						</div>                                  
					</div>
				';
			} 
			/* 2-5 Columns */
			else {
				$compile .= '
					<div class="col-sm-' . $columns . ' ' . $echoallterm . ' element">                    
						<div class="portfolio_item">';                                  
							if (strlen($featured_image[0]) > 0) {                                 
								$compile .= '<div class="portf_img">
									<a ' . $target . ' href="' . $linkToTheWork . '">';
										if ($_REQUEST['featured_image_type'] == "round_type") {                                                      
											$compile .= '<img src="' . aq_resize($featured_image[0], 570, 570, true, true, true) . '" alt="">';
										} elseif ($_REQUEST['template'] == "masonry") {
											$compile .= '<img src="' . aq_resize($featured_image[0], 570, '', true, true, true) . '" alt="">';
										} else {
											$compile .= '<img src="' . aq_resize($featured_image[0], 570, 420, true, true, true) . '" alt="">';
										}
									$compile .= '</a>
								</div>';
							}                                                   
							$compile .= '
							<div class="portf_descr">
								<h6 class="portf_title"><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h6>
								<div class="listing_meta">
									<span><i class="fa fa-bookmark-o"></i>' . $on_draught . '</span>
								</div>
							</div>
						</div>                                   
					</div>
				';
			}

        endwhile;
        wp_reset_postdata();

        echo $compile;
    }
    die();
}

# - WOOCOMMERCE PART
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
	// Woocommerce Theme Support
	add_theme_support('woocommerce');
	
	// Woocommerce Related Products (3)
	function woocommerce_output_related_products() {
		$args = array(
			'posts_per_page' => 3
		);
		woocommerce_related_products($args);
	}	
	
	// Woocommerce Products per Page (9)
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 ); 
	
	// Woocommerce Remove
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	
	//	WooCommerce Product Item
	add_action('woocommerce_before_shop_loop_item', 'gt3_before_shop_loop_item',5);
	add_action('woocommerce_after_shop_loop_item', 'gt3_after_shop_loop_item',5);
	
	//	add to cart button
    add_filter( 'woocommerce_product_add_to_cart_text', 'gt3_add_to_cart_text' );
	if ( ! function_exists( 'gt3_add_to_cart_text' ) ) {
		function gt3_add_to_cart_text() {
			global $product;

			if ( $product->product_type != 'external' ) {
				$text = '';
			}
			return $text;
		}
	}
	
	if ( ! function_exists( 'gt3_before_shop_loop_item' ) ) {
		function gt3_before_shop_loop_item() {
			global $woocommerce, $product;
			?>
			<div class="item">
				<div class="shop_list_product_image">
					<a class="shop_list_product_image" href="<?php the_permalink()?>"><?php echo woocommerce_get_product_thumbnail();?></a>
					<?php woocommerce_get_template( 'loop/sale-flash.php' ); ?>
				</div>
				<div class="shop_list_info">
					<div class="product-title">
						<h6><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h6>
						<div class="shop_list_cat">
							<i class="fa fa-bookmark-o"></i>
							<?php echo $product->get_categories(); ?>
						</div>
					</div>
					<div class="clearfix shop_list_details">
						<span class="price color pull-left"><?php echo $product->get_price_html(); ?></span>
						<?php woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
					</div>
				</div>

				<div class="hide">
				<?php
		}
	}

	if ( ! function_exists( 'gt3_after_shop_loop_item' ) ) {
		function gt3_after_shop_loop_item() {
			?>
				</div>
			</div>
			<?php
		}
	}
	
	// Woocommerce Header cart
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	function woocommerce_header_add_to_cart_fragment($fragments) {
		global $woocommerce;
		ob_start();
		?>
		<a class="cart-contents view_cart_btn" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php esc_html_e('View your shopping cart', 'elitemasters'); ?>"><i class="fa fa-shopping-cart"></i><span class="total_price"><?php echo $woocommerce->cart->get_cart_total(); ?><span class="price_count">(<?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'elitemasters'), $woocommerce->cart->cart_contents_count);?>)</span></span></a>
        <?php
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
	
	//	Woocommerce Product image
	function gt3_woocommerce_image_dimensions() {
		$catalog = array(
			'width' 	=> '270',	// px
			'height'	=> '350',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '370',	// px
			'height'	=> '500',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '120',	// px
			'height'	=> '120',	// px
			'crop'		=> 1 		// true
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	add_action( 'init', 'gt3_woocommerce_image_dimensions' );
	
	// Custom Shop Pagination
	remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
	add_action('woocommerce_after_shop_loop', 'gt3_get_shop_pagination', 10);
	
	function gt3_get_shop_pagination() {
		echo gt3_get_theme_pagination();
	}
	
	//	Single Meta
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'gt3_woocommerce_template_single_meta', 40);
	
	function gt3_woocommerce_template_single_meta(){
		global $post, $product;
		
		$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		?>
		<div class="product_meta">

			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

				<span class="sku_wrapper"><i class="fa fa-barcode"></i><span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

			<?php endif; ?>

			<span class="posted_in"><i class="fa fa-bookmark-o"></i><?php echo $product->get_categories(); ?></span>

			<span class="tagged_as"><i class="fa fa-tag"></i><?php echo $product->get_tags(); ?></span>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>

		</div>
	<?php }
	
}
