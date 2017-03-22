<?php
/*
Template Name: Countdown Template
*/
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
the_post();
if ( !post_password_required() ) {	
wp_enqueue_script('gt3_countdown_js', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, true);
if (isset($gt3_theme_pagebuilder['countdown']['year'])) $year = esc_attr($gt3_theme_pagebuilder['countdown']['year']);
if (isset($gt3_theme_pagebuilder['countdown']['day'])) $day = esc_attr($gt3_theme_pagebuilder['countdown']['day']);
if (isset($gt3_theme_pagebuilder['countdown']['month'])) $month = esc_attr($gt3_theme_pagebuilder['countdown']['month']);
if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'])) $img_attachment = wp_get_attachment_image_src($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'], "full");
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((gt3_get_theme_option("responsive") == "on") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <link rel="shortcut icon" href="<?php echo esc_url(gt3_get_theme_option('favicon')); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_57')); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_72')); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url(gt3_get_theme_option('apple_touch_114')); ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php echo gt3_get_if_strlen(gt3_get_theme_option("custom_css"), "<style>", "</style>") . gt3_get_if_strlen(gt3_get_theme_option("code_before_head"));
    globalJsMessage::getInstance()->render();
    wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="global_count_wrapper">
    
    	<div class="count_title">
        	<div class="container">
        		<h1><?php echo $gt3_theme_pagebuilder['countdown']['count_title'] ?></h1>
        		<h4><?php echo $gt3_theme_pagebuilder['countdown']['count_subtitle'] ?></h4>
            </div>
        </div>       
        					
        <?php if (isset($year) && isset($day) && isset($month) && $year !== "" && $day !== "" && $month !== "") { ?>
			<div class="countdown_wrapper">
                <div id="countdown"></div>
            </div>
            <script>
			   jQuery(function () {
					"use strict";
					var austDay = new Date(<?php echo $year ?>, <?php echo $month ?>-1, <?php echo $day ?>); //year, month-1, day
					jQuery('#countdown').countdown({
						until: austDay,
						padZeroes: true
					});
				});
			</script>
        <?php } else { ?>
            <div class="countdown_wrapper">
                <h1 class="count_error light"><?php esc_html_e('Date has not been entered', 'elitemasters'); ?></h1>
            </div>
        <?php } ?>
            
		<div class="count_container_wrapper">
            <div class="container">
            	<div class="shortcode_subscribe">
                    <h5 class="light"><?php echo $gt3_theme_pagebuilder['countdown']['shortcode_title'] ?></h5>
                    <?php if (isset($gt3_theme_pagebuilder['countdown']['shortcode']) && $gt3_theme_pagebuilder['countdown']['shortcode'] !== '') { ?>
                        <?php echo do_shortcode($gt3_theme_pagebuilder['countdown']['shortcode']) ?>
                    <?php } ?>
                </div>                     
            </div>
        </div>
        
		<div class="coming_bottom">
			<div class="coming_soon_socials">
				<ul>
					<?php echo gt3_show_social_icons(array(							
						array(
							"uniqid" => "social_facebook",
							"class" => "facebook",
							"title" => "Facebook",
							"target" => "_blank",
						),
						array(
							"uniqid" => "social_twitter",
							"class" => "twitter",
							"title" => "Twitter",
							"target" => "_blank",
						),
						array(
							"uniqid" => "social_gplus",
							"class" => "google-plus",
							"title" => "Google+",
							"target" => "_blank",
						),
						array(
							"uniqid" => "social_dribbble",
							"class" => "dribbble",
							"title" => "Dribbble",
							"target" => "_blank",
						),
						array(
							"uniqid" => "social_pinterest",
							"class" => "pinterest",
							"title" => "Pinterest",
							"target" => "_blank",
						),
						array(
							"uniqid" => "social_instagram",
							"class" => "instagram",
							"title" => "Instagram",
							"target" => "_blank",
						),							
						array(
							"uniqid" => "social_youtube",
							"class" => "youtube",
							"title" => "Youtube",
							"target" => "_blank",
						),													
						array(
							"uniqid" => "social_tumblr",
							"class" => "tumblr",
							"title" => "Tumblr",
							"target" => "_blank",
						),							
						array(
							"uniqid" => "social_linked_in",
							"class" => "linkedin",
							"title" => "Linked In",
							"target" => "_blank",
						),							
						array(
							"uniqid" => "social_flickr",
							"class" => "flickr",
							"title" => "Flickr",
							"target" => "_blank",
						)
					));
					?>
				</ul>
			</div>
			<div class="copyright"><?php echo $gt3_theme_pagebuilder['countdown']['copyright_text'] ?></div>
        </div>
    </div>
    
    <div class="custom_bg img_bg coming_soon" style="background-image: url('<?php echo $img_attachment[0] ?>')"></div>  
	<script>
   		function centerWindow() {
			"use strict";
			var globalWrap = jQuery('.global_count_wrapper');
			var countWrapper = jQuery('.countdown_wrapper');
			var countTitle = jQuery('.count_title');
			var window_h = jQuery(window).height();
			var countContainer = jQuery('.count_container_wrapper');		
			var freeSpace = (window_h - countWrapper.height() - countTitle.height() - countContainer.height())/2.566;		
			countTitle.css('top', freeSpace+'px');
			countContainer.css('bottom', freeSpace +'px');			
			globalWrap.css('height', window_h + 'px');					
			var setMiddle = freeSpace*1.218 + countTitle.height();		
			countWrapper.css('top', setMiddle+'px');			
		}			
		jQuery(document).ready(function(){
			"use strict";
			var centertimer = setTimeout(function(){
				centerWindow();
				clearTimeout(centertimer);
			}, 500);			
		});
		jQuery(window).resize(function(){
			"use strict";
			centerWindow();
		});     
    </script>
<?php
    wp_footer();
?>
	</body>
</html>
<?php	
} else {
    get_header();
?>
	<div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title_area']) || ($gt3_theme_pagebuilder['settings']['show_title_area'] !== "no" && gt3_get_theme_option("show_title_area") !== "no")) { ?>
                <div class="page_title"><h1><?php  esc_html_e('This Content is Password Protected', 'elitemasters') ?></h1></div>
            <?php } ?>
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea pass_protected">
                        	<?php the_content(); ?>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "</div>" : ""); ?>        
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>    	    
    </div> 
    <script>
        jQuery(document).ready(function(){
            jQuery('.post-password-form').find('label').find('input').attr('placeholder', '<?php  esc_html_e('Enter The Password...', 'elitemasters') ?>');
        });
    </script>
<?php
    get_footer();
}
?>