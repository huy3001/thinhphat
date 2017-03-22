</div><!-- .wrapper -->
<?php $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(@get_the_ID()); ?>

<div class="footer <?php echo gt3_the_pb_custom_footer($gt3_theme_pagebuilder); ?>">
	<?php
	if (gt3_get_theme_option("footer_widgets_area") == "on" && gt3_the_pb_custom_footer($gt3_theme_pagebuilder) == "type1") { ?>
    <div class="pre_footer <?php echo esc_attr(gt3_the_pb_custom_prefooter($gt3_theme_pagebuilder)); echo esc_attr(gt3_get_theme_option("prefooter_img_type")); ?>">
        <div class="container">
            <div class="row">
                <?php get_sidebar('footer'); ?>
            </div>
        </div>
    </div>   
    <?php } ?>
	<div class="footer_bottom">
		<div class="container">
			<div class="foot_info_block">
				<?php if (gt3_the_pb_custom_footer($gt3_theme_pagebuilder) == "type2") { ?>
				<div class="logo_sect">
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
						<?php
						if (wp_get_attachment_url(gt3_get_theme_option("footer_logo"))) { ?>
							<img src="<?php echo esc_url(wp_get_attachment_url(gt3_get_theme_option("footer_logo"))); ?>" width="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_width")); ?>" height="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_height")); ?>" class="logo_def" alt="" />
						<?php
						} else {
						?>
							<img src="<?php echo esc_url(gt3_get_theme_option("footer_logo")); ?>" width="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_width")); ?>" height="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_height")); ?>" class="logo_def" alt="" />
						<?php
						}
						if (wp_get_attachment_url(gt3_get_theme_option("footer_logo_retina"))) { ?>
							<img src="<?php echo wp_get_attachment_url(gt3_get_theme_option("footer_logo_retina")); ?>" class="logo_retina" width="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_width")); ?>" height="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_height")); ?>" alt="" />
						<?php
						} else {
						?>
							<img src="<?php echo esc_url(gt3_get_theme_option("footer_logo_retina")); ?>" class="logo_retina" width="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_width")); ?>" height="<?php echo esc_attr(gt3_get_theme_option("footer_logo_standart_height")); ?>" alt="" />
						<?php }	?>
					</a>
				</div>
				<?php } ?>
				<?php if (gt3_the_pb_custom_footer($gt3_theme_pagebuilder) == "type1") { ?>
				<div class="copyright"><?php echo esc_attr(gt3_get_theme_option("copyright")); ?></div>
				<?php } ?>
				<?php if (gt3_the_pb_custom_footer($gt3_theme_pagebuilder) == "type2") { ?>
				<div class="foot_slogan"><?php echo esc_attr(gt3_get_theme_option("copyright")); ?></div>
				<div class="foot_menu">
					<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'menu', 'depth' => '1', 'walker' => new gt3_menu_walker($showtitles = false))); ?>
				</div>
				<?php } ?>
			</div>
			<div class="social_icons">
				<ul>
					<li><span><?php echo esc_html__('Follow:', 'elitemasters'); ?></span></li>
					<?php echo gt3_show_social_icons(array(
						array(
							"uniqid" => "social_facebook",
							"class" => "facebook-square",
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
							"uniqid" => "social_instagram",
							"class" => "instagram",
							"title" => "Instagram",
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
			<div class="clear"></div>
		</div>
	</div>
</div>

<div class="fixed-menu <?php echo(gt3_get_theme_option("sticky_menu") == "on" ? "true_fixed_menu" : ""); ?>"></div>
</div>
<?php
	gt3_the_pb_custom_bg_and_color(gt3_get_theme_pagebuilder(@get_the_ID()));
	echo gt3_get_if_strlen(gt3_get_theme_option("code_before_body"));
	wp_footer();
?>
</body>
</html>