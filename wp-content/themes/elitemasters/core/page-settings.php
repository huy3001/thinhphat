<?php

#REGISTER PAGE BUILDER
add_action('add_meta_boxes', 'gt3_page_settings_area');
function gt3_page_settings_area()
{
    if (is_array($GLOBALS["gt3_page_settings_area"])) {
        foreach ($GLOBALS["gt3_page_settings_area"] as $post_type) {
            add_meta_box(
                'pb_section',
                esc_html__('GT3 Page Settings', 'elitemasters'),
                'gt3_page_settings',
                $post_type
            );
        }
		if (get_page_template_slug() == "page-coming-soon.php" || get_page_template_slug() == "page-with-slider-above-content.php" || get_page_template_slug() == "page-onepage-scroll.php") {
			add_meta_box(
                'pb_section',
                esc_html__('GT3 Page Settings', 'elitemasters'),
                'gt3_page_settings',
                'page'
            );
		}
    }
}

function gt3_page_settings($post)
{
    $gt3_theme_pagebuilder = gt3pb_get_plugin_pagebuilder($post->ID);
    if (!is_array($gt3_theme_pagebuilder)) {
        $gt3_theme_pagebuilder = array();
    }
    $now_post_type = get_post_type();
	
	#get all sidebars
    $media_for_this_post = gt3pb_get_media_for_this_post(get_the_ID());
		$js_for_pb = "
		<script>
			var post_id = " . get_the_ID() . ";
			var show_img_media_library_page = 1;
		</script>";
	
		echo $js_for_pb;
		echo "
	<!-- popup background -->
	<div class='popup-bg'></div>
	<div class='waiting-bg'><div class='waiting-bg-img'></div></div>
	";

    #TEAM & OFFERS AREA
    if ($now_post_type == "team" || $now_post_type == "offers") {
        echo "
            <!-- TEAM & OFFERS SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . "'>

            <div class='partners_cont gt3settings_box'>
				<div class='gt3settings_box_title'><h2>" . esc_html__('Advanced options', 'elitemasters') . "</h2></div>
				<div class='gt3settings_box_content'>
					<div class='append_items'>
						<label for='position_link' class='label_type1'>";
						if ($now_post_type == "offers") {
							echo "" . esc_html__('Price:', 'elitemasters') . "";
						} else {
							echo "" . esc_html__('Position:', 'elitemasters') . "";
						}
						echo "
						</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['team']['position']) ? $gt3_theme_pagebuilder['page_settings']['team']['position'] : '') . "' id='position_link' name='pagebuilder[page_settings][team][position]' class='position_link itt_type1'>";
						if ($now_post_type == "offers") {
							echo "<div>
							<label for='offers_link' class='label_type1'>" . esc_html__('Link to Offer:', 'elitemasters') . "</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['offers']['offers_link']) ? $gt3_theme_pagebuilder['page_settings']['offers']['offers_link'] : '') . "' id='offers_link' name='pagebuilder[page_settings][offers][offers_link]' class='offers_link itt_type1'>
							</div>
							<div>
							<label for='offers_btn' class='label_type1'>" . esc_html__('Offer Button Text:', 'elitemasters') . "</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['offers']['offers_btn']) ? $gt3_theme_pagebuilder['page_settings']['offers']['offers_btn'] : '') . "' id='offers_btn' name='pagebuilder[page_settings][offers][offers_btn]' class='offers_btn itt_type1'>
							</div>
							<div class='hleft offers_target'>" . esc_html__('Target Button Type:', 'elitemasters') . "</div>
							<div class='hright offerrs_select'>
								<select name='pagebuilder[page_settings][offers][offers_target]' class='admin_newselect'>
									<option value='_blank' " . ((isset($gt3_theme_pagebuilder['page_settings']['offers']['offers_target']) && $gt3_theme_pagebuilder['page_settings']['offers']['offers_target'] == "_blank") ? 'selected="selected"' : '') . ">Blank</option>
									<option value='_self' " . ((isset($gt3_theme_pagebuilder['page_settings']['offers']['offers_target']) && $gt3_theme_pagebuilder['page_settings']['offers']['offers_target'] == "_self") ? 'selected="selected"' : '') . ">Self</option>
								</select>
							</div>
							<div class='clear' style='height:20px'></div>";
						}
						echo "
						<div>
							<div class='hleft' style='vertical-align:top;'>" . esc_html__('Social icons', 'elitemasters') . "</div>
							<div class='hright'>
								<div class='added_icons sortable_icons_list'>";

        if (isset($gt3_theme_pagebuilder['page_settings']['icons']) && is_array($gt3_theme_pagebuilder['page_settings']['icons'])) {
            foreach ($gt3_theme_pagebuilder['page_settings']['icons'] as $key => $value) {
                echo "
										<div class='stand_iconsweet ui-state-default'>
											<span class='stand_icon-container'><i class='stand_icon " . $value['data-icon-code'] . "'></i></span>
											<input type='hidden' name='pagebuilder[page_settings][icons][" . $key . "][data-icon-code]' value='" . $value['data-icon-code'] . "'>
											<input class='icon_name' type='text' name='pagebuilder[page_settings][icons][" . $key . "][name]' value='" . $value['name'] . "' placeholder='" . esc_html__('Give some name', 'elitemasters') . "'>
											<input class='icon_link' type='text' name='pagebuilder[page_settings][icons][" . $key . "][link]' value='" . $value['link'] . "' placeholder='" . esc_html__('Give some link', 'elitemasters') . "'>
											<input class='cpicker' type='text' name='pagebuilder[page_settings][icons][" . $key . "][fcolor]' value='" . $value['fcolor'] . "' placeholder='" . esc_html__('Foreground color', 'elitemasters') . "'>
											<span class='remove_me'><i class='stand_icon fa fa-remove'></i></span>
										</div>";
            }
        }

        echo "
								</div>
								<div class='social_list_for_select'>";

        foreach ($GLOBALS["pbconfig"]['all_available_font_icons'] as $icon) {
            echo "<div class='stand_social'><i data-icon-code='" . $icon . "' class='stand_icon " . $icon . "'></i></div>";
        }

        echo "
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>

            </div>
            <!-- END SETTINGS -->";
    }


    #GALLERY AREA
    if ($now_post_type == "gallery") {
        echo "
        <!-- FULLSCREEN SLIDER SETTINGS -->
                <div class='padding-cont  stand-s pt_" . $now_post_type . "'>
                    <div class='bg_or_slider_option slider_type active'>
                        <input type='hidden' name='settings_type' value='fullscreen' class='settings_type'>
                        <div class='hideable-area'>
                            <div class='padding-cont help text-shadow2'></div>
                            <div class='padding-cont'>
                                <div class='selected_media'>
                                    <div class='append_block'>
                                         <ul class='sortable-img-items'>
                                           " . gt3pb_get_slider_items("fullscreen", (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] : '')) . "
                                         </ul>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                            <div style='' class='hr_double style2'></div>
                            <div class='padding-cont' style='margin-top:20px; padding-bottom:20px;'>
								<div class='gt3settings_box no-margin'>
									<div class='gt3settings_box_title'><h2>" . esc_html__('Select media', 'elitemasters') . "</h2></div>
									<div class='gt3settings_box_content'>
										<div class='available_media'>
											<div class='ajax_cont'>
												" . gt3pb_get_media_html($media_for_this_post, "small") . "
											</div>
											<div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
												<div class='img-preview'>
													<img alt='' src='" . THEMEROOTURL . "/core/admin/img/add_image.png'>
												</div>
											</div><!-- .img-item -->
											<div class='img-item style_small add_video_slider'>
												<div class='img-preview'>
													<img alt='' class='previmg' data-full-url='" . THEMEROOTURL . "/core/admin/img/video_item.png' src='" . THEMEROOTURL . "/core/admin/img/add_video.png'>
												</div>
											</div><!-- .img-item -->
											<div class='clear'></div>
										</div>
									</div>
								</div>
                            </div>
                            <div class='hr_double style2'></div>
                            <div class='padding-cont'>
                                <div class='radio_block'>
                                    <div style='width: 190px;' class='caption'><h2 style='color:#A1A1A1;' class='text-shadow2'>" . esc_html__('show thumbnails', 'elitemasters') . "</h2></div>
                                    <div class='radio_selector'>
                                        " . gt3pb_toggle_radio_on_off('pagebuilder[sliders][fullscreen][thumbnails]', (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails']) ? $gt3_theme_pagebuilder['sliders']['fullscreen']['thumbnails'] : ''), 'on') . "
                                    </div>
                                    <div class='help_here help text-shadow2'>
                                        &nbsp;
                                    </div>
                                    <div class='clear'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END SETTINGS -->";
    }
	
	#PARTNERS AREA
    if ($now_post_type == "partners") {
        echo "
            <!-- PARTNERS SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . "'>

            <div class='partners_cont gt3settings_box'>
				<div class='gt3settings_box_title'><h2>" . esc_html__('Advanced options', 'elitemasters') . "</h2></div>
				<div class='gt3settings_box_content'>
					<div class='append_items'>
						<label for='partners_link' class='label_type1'>" . esc_html__('External link:', 'elitemasters') . "</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['partners']['partners_link']) ? $gt3_theme_pagebuilder['page_settings']['partners']['partners_link'] : '') . "' id='partners_link' name='pagebuilder[page_settings][partners][partners_link]' class='partners_link itt_type1'>
					</div>
				</div>
            </div>

            </div>
            <!-- END SETTINGS -->";
    }
	
	#TESTIMONIALS AREA
    if ($now_post_type == "testimonials") {
        echo "
            <!-- TESTIMONIALS SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . "'>

            <div class='testimonials_cont'>
                <div class='append_items'>
                    <label for='testimonials_author' class='label_type1'>" . esc_html__('Author:', 'elitemasters') . "</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['testimonials']['testimonials_author']) ? $gt3_theme_pagebuilder['page_settings']['testimonials']['testimonials_author'] : '') . "' id='testimonials_author' name='pagebuilder[page_settings][testimonials][testimonials_author]' class='testimonials_author itt_type1'><br>
                    <label for='testimonials_position' class='label_type1'>" . esc_html__('Company:', 'elitemasters') . "</label> <input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['testimonials']['company']) ? $gt3_theme_pagebuilder['page_settings']['testimonials']['company'] : '') . "' id='testimonials_company' name='pagebuilder[page_settings][testimonials][company]' class='testimonials_company itt_type1'>
                </div>
            </div>

            </div>
            <!-- END SETTINGS -->";
    }
	
	#POSTFORMATS - POST & PORTFOLIO
	if ($now_post_type == "post" || $now_post_type == "portfolio") {
		echo "
	<div class='pb-cont page-settings-container pf_" . $now_post_type . "'>
		<div class='pb10'>
			<div class='hideable-content'>
				<div class='post-formats-container'>
					<!-- Video post format -->
					<div id='video_sectionid_inner'>
						<div class='portslides_sectionid_title'><h2>" . esc_html__('Post format video URL:', 'elitemasters') . "</h2></div>
						<div class='video-pf'>
							<input type='text' class='medium textoption type1' name='pagebuilder[post-formats][videourl]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['videourl']) ? $gt3_theme_pagebuilder['post-formats']['videourl'] : "") . "'>
							<div class='example'>" . esc_html__('Examples:', 'elitemasters') . "<br>Youtube - http://www.youtube.com/watch?v=6v2L2UGZJAM<br>Vimeo - http://vimeo.com/47989207</div>
							<div class='clear'></div>
						</div>
					</div>
					<!-- Image post format -->
					<div id='portslides_sectionid_inner'>
						<div class='portslides_sectionid_title'><h2>" . esc_html__('Slider Images', 'elitemasters') . "</h2></div>
						<div class='selected-images-for-pf'>
							" . gt3pb_get_selected_pf_images_for_admin($gt3_theme_pagebuilder) . "
						</div>
						<hr class='img_seperator'>
						<div class='available-images-for-pf available_media'>
							<div class='ajax_cont'>
								" . gt3pb_get_media_html($media_for_this_post, "small") . "
							</div>
							<div class='for_post_fomrats img-item style_small add_image_to_sliders_available_media cboxElement'>
								<div class='img-preview'>
									<img alt='' src='" . THEMEROOTURL . "/core/admin/img/add_image.png'>
								</div>
							</div><!-- .img-item -->
						</div>
					</div>
					<!-- Link post format -->
					<div id='link_sectionid_inner'>
						<div class='portslides_sectionid_title'><h2>" . esc_html__('Post Format Link:', 'elitemasters') . "</h2></div>
						<div class='link-pf'>
							<input type='text' placeholder='Please Enter URL' class='medium textoption type1' name='pagebuilder[post-formats][linkurl]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['linkurl']) ? $gt3_theme_pagebuilder['post-formats']['linkurl'] : "") . "'>
							<input type='text' placeholder='Please Enter Link Title' class='medium textoption type1' name='pagebuilder[post-formats][linktitle]' value='" . (isset($gt3_theme_pagebuilder['post-formats']['linktitle']) ? $gt3_theme_pagebuilder['post-formats']['linktitle'] : "") . "'>
						</div>
					</div>
					<!-- Quote post format -->
					<div id='quote_sectionid_inner'>
						<div class='portslides_sectionid_title'><h2>" . esc_html__('Post Format Quote:', 'elitemasters') . "</h2></div>
						<div class='quote-pf'>
							<textarea class='medium textoption type1' name='pagebuilder[post-formats][quotetext]' cols='30' rows='4'>" . (isset($gt3_theme_pagebuilder['post-formats']['quotetext']) ? $gt3_theme_pagebuilder['post-formats']['quotetext'] : "") . "</textarea>
						</div>
					</div>
					<!-- Audio post format -->
					<div id='audio_sectionid_inner'>
						<div class='portslides_sectionid_title'><h2>" . esc_html__('Post Format Audio:', 'elitemasters') . "</h2></div>
						<div class='audio-pf'>
							<textarea class='medium textoption type1' name='pagebuilder[post-formats][audiourl]' cols='30' rows='4'>" . (isset($gt3_theme_pagebuilder['post-formats']['audiourl']) ? $gt3_theme_pagebuilder['post-formats']['audiourl'] : "") . "</textarea>
						</div>
					</div>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	</div>
				";	
	}
	
	#PORTFOLIO AREA
    if ($now_post_type == "portfolio") {
        echo "
            <div class='padding-cont pt_" . $now_post_type . "'>

            <div class='partners_cont gt3settings_box'>
				<div class='gt3settings_box_title'><h2>" . esc_html__('Advanced options', 'elitemasters') . "</h2></div>
				<div class='gt3settings_box_content'>
					<div class='append_items'>
						<label for='work_link' class='label_type1'>" . esc_html__('Link to the work:', 'elitemasters') . "</label><br><input type='text' value='" . (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) ? esc_url($gt3_theme_pagebuilder['page_settings']['portfolio']['work_link']) : '') . "' id='work_link' name='pagebuilder[page_settings][portfolio][work_link]' class='work_link itt_type1'>
					</div>
					<hr>
					<div class='port_skills_cont'>
                        <div class='item-with-settings'>
                            <div class='all_available_port_skills_icons edit_popup' style='background-color: #ffffff;'>";
                            foreach ($GLOBALS["pbconfig"]['all_available_font_icons'] as $av__ficon) {
                                echo "<i class='".$av__ficon."'></i>";
                            }
                            echo "
                            </div>
                        </div>
						<ul class='all_added_skills sortable_icons_list'>";
                        if (isset($gt3_theme_pagebuilder['page_settings']['portfolio']['skills']) && is_array($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'])) {
                            foreach ($gt3_theme_pagebuilder['page_settings']['portfolio']['skills'] as $key => $value) {
                                echo "<li class='stand_iconsweet ui-state-default'> <input type='text' class='itt_type1 ww10 select_icon_and_insert_here' name='pagebuilder[page_settings][portfolio][skills][{$key}][icon]' placeholder='Icon' value='{$value["icon"]}'> <input type='text' class='itt_type1 ww43 select_client_name_and_insert_here' name='pagebuilder[page_settings][portfolio][skills][{$key}][name]' placeholder='Field name' value='{$value["name"]}'> <input type='text' class='itt_type1 ww43' name='pagebuilder[page_settings][portfolio][skills][{$key}][value]' placeholder='Field value' value='{$value["value"]}'> <span class='remove_skill'><i class='stand_icon fa fa-times'></i></span></li>";
                            }
                        }
					echo "
						</ul>
						<div class='heading line_option visual_style1 small_type hovered clickable add_new_port_skills'>
							<div class='option_title text-shadow1'>" . esc_html__('Add Custom Field', 'elitemasters') . "</div>
							<div class='some-element cross'></div>
							<div class='pre_toggler'></div>
						</div>
					</div>
				</div>
			</div>

            </div>
            <!-- END SETTINGS -->";
    }

	# PAGE SUBTITLE
	if ($now_post_type == "page" && (get_page_template_slug() !== "page-coming-soon.php" && get_page_template_slug() !== "page-onepage-scroll.php")) {
		if ($now_post_type == "page" && get_page_template_slug() == "page-with-slider-above-content.php") {
			$sectn_pb = '';
		} else {
			$sectn_pb = 'pb20';
		}
		echo "
            <div class='padding-cont pt_" . $now_post_type . " pt20 " . $sectn_pb . "'>
                <div class='strip_cont gt3settings_box slider'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Page Subtitle', 'elitemasters') . "</h2></div>
                    <div class='gt3settings_box_content'>
                        <div class='boxed_options no_boxed'>
                            <textarea class='medium textoption type1' name='pagebuilder[page_settings][subtitle]' cols='30' rows='4'>" . (isset($gt3_theme_pagebuilder['page_settings']['subtitle']) ? $gt3_theme_pagebuilder['page_settings']['subtitle'] : "") . "</textarea>
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box slider -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
        ";
	}
	
	#COUNTDOWN TEMPLATE
    if ($now_post_type == "page" && get_page_template_slug() == "page-coming-soon.php") {

        echo "
            <!-- COMING SOON SETTINGS -->
            <div class='padding-cont pt_" . $now_post_type . " pt20 pb20'>
                <div class='strip_cont gt3settings_box countdown'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Page Options', 'elitemasters') . "</h2></div>
                    <div class='gt3settings_box_content'>                        
                        <h2 style='font-size:13px;'>" . esc_html__('Background Options:', 'elitemasters') . "</h2>
                        <div class='boxed_options no_boxed'>
                            <input type='hidden' class='custom_select_img_attachid' name='pagebuilder[page_settings][page_layout][img][attachid]' value='".(isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']) ? $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'] : '')."'>
                            <div class='custom_select_img_preview' style='width: 25%;'>";
								if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'])) {
									$img_attachment = wp_get_attachment_image_src( $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'], "large" );
									if ($img_attachment[0] == '') {
									} else {
										echo "<img style='width: 100%;' src='".$img_attachment[0]."' alt=''>";
									}
								}
								echo "
                            </div>
                            <div>
                                <div class='add_image_from_wordpress_library_popup'>" . esc_html__('Add Image', 'elitemasters') . "</div>
                            </div>
                            <div class='clear pb20'></div>
                            <hr class='date_hr'>
                            <h2>" . esc_html__('Counter Title:', 'elitemasters') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][count_title]' value='" . (isset($gt3_theme_pagebuilder['countdown']['count_title']) ? esc_attr($gt3_theme_pagebuilder['countdown']['count_title']) : "") . "'>
							<h2>" . esc_html__('Counter Subtitle:', 'elitemasters') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][count_subtitle]' value='" . (isset($gt3_theme_pagebuilder['countdown']['count_subtitle']) ? esc_attr($gt3_theme_pagebuilder['countdown']['count_subtitle']) : "") . "'>
                            <div class='subtitle_area pb20'>
                            <h2>" . esc_html__('Shortcode Title:', 'elitemasters') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][shortcode_title]' value='" . (isset($gt3_theme_pagebuilder['countdown']['shortcode_title']) ? esc_attr($gt3_theme_pagebuilder['countdown']['shortcode_title']) : "") . "'>
							<h2>" . esc_html__('Copyright Text:', 'elitemasters') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][copyright_text]' value='" . (isset($gt3_theme_pagebuilder['countdown']['copyright_text']) ? esc_attr($gt3_theme_pagebuilder['countdown']['copyright_text']) : "") . "'>
                            </div>
                            <hr class='date_hr'>
                            <div class='fs_fit_select pb20'>
                                <h2>" . esc_html__('Enter Date:', 'elitemasters') . "</h2>
                                <input type='text' placeholder='". esc_html__('Enter year. Ex.:2020', 'elitemasters') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][year]' value='" . (isset($gt3_theme_pagebuilder['countdown']['year']) ? esc_attr($gt3_theme_pagebuilder['countdown']['year']) : "") . "'>
                                <input type='text' placeholder='". esc_html__('Enter day. Ex.:27', 'elitemasters') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][day]' value='" . (isset($gt3_theme_pagebuilder['countdown']['day']) ? esc_attr($gt3_theme_pagebuilder['countdown']['day']) : "") . "'>
                                <input type='text' placeholder='". esc_html__('Enter month. Ex.:11', 'elitemasters') ."' class='medium textoption type1 date_input' name='pagebuilder[countdown][month]' value='" . (isset($gt3_theme_pagebuilder['countdown']['month']) ? esc_attr($gt3_theme_pagebuilder['countdown']['month']) : "") . "'>
                            </div>
                            <hr class='date_hr'>
                            <h2>" . esc_html__('Form Shortcode:', 'elitemasters') . "</h2>
                            <input type='text' class='medium textoption type1' name='pagebuilder[countdown][shortcode]' value='" . (isset($gt3_theme_pagebuilder['countdown']['shortcode']) ? esc_attr($gt3_theme_pagebuilder['countdown']['shortcode']) : "") . "'>                            
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box countdown -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
            <style>
                #postimagediv, #side_sidebar_settings_meta_box, #page_subtitle, #side_bg_settings_meta_box, .edit-form-section {
                    display: none;
                }
            </style>
        ";
    }
	
	#CUSTOM PAGE WITH ABOVE THE CONTENT SLIDER
    if ($now_post_type == "page" && (get_page_template_slug() == "page-with-slider-above-content.php" || get_page_template_slug() == "page-onepage-scroll.php")) {

        echo "
            <div class='padding-cont pt_" . $now_post_type . " pt20 pb20'>
                <div class='strip_cont gt3settings_box slider'>
                    <div class='gt3settings_box_title'><h2>" . esc_html__('Page Options', 'elitemasters') . "</h2></div>
                    <div class='gt3settings_box_content'>                        
                        <h2 style='font-size:13px;'>" . esc_html__('Shortcode:', 'elitemasters') . "</h2>
                        <div class='boxed_options no_boxed'>                            
                            <input type='text' class='medium textoption type1' name='pagebuilder[slider][shortcode]' value='" . (isset($gt3_theme_pagebuilder['slider']['shortcode']) ? esc_attr($gt3_theme_pagebuilder['slider']['shortcode']) : "") . "'>                            
                        </div><!-- boxed_options no_boxed -->
						<div class='clear pb20'></div>
                        <hr class='date_hr'>
						<h2 style='font-size:13px;'>" . esc_html__('Extra class name:', 'elitemasters') . "</h2>
                        <div class='boxed_options no_boxed'>                            
                            <input type='text' class='medium textoption type1' name='pagebuilder[slider][custclass]' value='" . (isset($gt3_theme_pagebuilder['slider']['custclass']) ? esc_attr($gt3_theme_pagebuilder['slider']['custclass']) : "") . "'>                            
                        </div><!-- boxed_options no_boxed -->
                    </div><!-- gt3settings_box_content -->
                </div><!-- strip_cont gt3settings_box slider -->
            </div><!-- padding-cont -->
            <!-- END SETTINGS -->
        ";
    }
	
}