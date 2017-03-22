<?php
/*
Template Name: Onepage Scroll Template
*/
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
the_post();
if ( !post_password_required() ) {
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
	<div class="custom_page_slider <?php echo esc_attr($gt3_theme_pagebuilder['slider']['custclass']); ?>">
		<?php if (isset($gt3_theme_pagebuilder['slider']['shortcode']) && $gt3_theme_pagebuilder['slider']['shortcode'] !== '') { ?>
			<?php echo do_shortcode($gt3_theme_pagebuilder['slider']['shortcode']) ?>
		<?php } ?>
	</div>
	<?php wp_footer(); ?>
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