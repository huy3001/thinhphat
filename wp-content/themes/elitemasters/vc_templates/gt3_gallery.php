<?php

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '1',
    'featured_image_type' => 'rectangle'
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);
$compile = '';

$arg_s = explode("|", $build_query);
$arg_id = $arg_s[2];
$post_id = substr($arg_id, strrpos($arg_id, ':')+1);

wp_enqueue_script('gt3_mfp_js', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array(), false, false);

$isotope_class = '';
$sorting_container = '';

if ($featured_image_type == "masonry") {
    wp_enqueue_script('gt3_isotope_js', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
    $isotope_class = 'element';
    $sorting_container = 'sorting_block';
}
	 
?>
<div class="vc_row">
    <div class="vc_col-sm-12 module_gallery">
        <div class="list-of-images items<?php echo $posts_per_line; ?> <?php echo $featured_image_type; ?> photo_gallery <?php echo $sorting_container; ?>">
            <?php				
                $galleryid = $post_id;
                
				if ($featured_image_type == "circle") {
					if ($posts_per_line == "4") {
						$width = 270;
               			$height = 270;
					}
					if ($posts_per_line == "3") {
						$width = 370;
               			$height = 370;
					}								
					if ($posts_per_line == "2") {
						$width = 570;
               			$height = 570;
					}
					if ($posts_per_line == "1") {
						$width = 1170;
               			$height = 1170;
					} 
				} else {
					if ($posts_per_line == "4") {
						$width = 270;
               			$height = 200;
					}
					if ($posts_per_line == "3") {
						$width = 370;
               			$height = 275;
					}								
					if ($posts_per_line == "2") {
						$width = 570;
               			$height = 420;
					}
					if ($posts_per_line == "1") {
						$width = 1170;
               			$height = 950;
					} 
				}
				
                $width = $width . "px";
                $height = $height . "px";

                if ($featured_image_type == "masonry") {
                    $height = '';
                }
                
                $galleryPageBuilder = gt3pb_get_plugin_pagebuilder($galleryid);
                
                if (isset($galleryPageBuilder['sliders']['fullscreen']['slides']) && is_array($galleryPageBuilder['sliders']['fullscreen']['slides'])) {
                    foreach ($galleryPageBuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {

                        if ($image['slide_type'] == "video") {
                            $thishref = $image['src'];
                            $thisvideoclass = 'mfp-iframe';
                        } else {
                            $thishref = wp_get_attachment_url($image['attach_id']);
                            $thisvideoclass = '';
                        }
    
                        if (isset($image['title']['value']) && strlen($image['title']['value']) > 0) {
                            $photoTitleOutput = $image['title']['value'];
                        } else {
                            $photoTitleOutput = "";
                        }
                                    
                        $compile .= '		
							<div class="gallery_item ' . $isotope_class . '">
                            	<div class="gallery_item_padding">
                                	<div class="img_block">
                                    	<img src="' . aq_resize(wp_get_attachment_url($image['attach_id']), $width, $height, true, true, true) . '" alt="" />
                                        <a href="' . $thishref . '" class="view_link photozoom ' . $thisvideoclass . '" title="'. $photoTitleOutput .'"></a>
                                    </div>
                                </div>
                            </div>';							   
                    }
                    
                }  

                echo $compile;
                
                $GLOBALS['showOnlyOneTimeJS']['mfp'] = '
                <script>
                    jQuery(document).ready(function () {
                        "use strict";
                        // Magnific Popup
                        var photo_class = jQuery(".photozoom");
                        if (photo_class.size() > 0) {
                            if (photo_class.parents(".photo_gallery").hasClass("photo_gallery")) {
                                jQuery(".photo_gallery").each(function() {
                                    jQuery(this).magnificPopup({
                                        delegate: \'a\',
                                        type: \'image\',
                                        gallery: {
                                            enabled: true
                                        },
                                        iframe: {
                                            markup: \'<div class="mfp-iframe-scaler">\'+\'<div class="mfp-close"></div>\'+\'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>\'+\'<div class="mfp-counter"></div>\'+\'<div class="mfp-title">Some caption</div>\'+\'</div>\'
                                        },
										callbacks: {
											markupParse: function(template, values, item) {
											 values.title = item.el.attr(\'title\');
											}
										}
                                    });
                                });
                            } else {
                                photo_class.magnificPopup({type:\'image\'});
                            }
                        }
                    });			
                </script>
                ';

                if ($featured_image_type == "masonry") {
                    $GLOBALS['showOnlyOneTimeJS']['isotope_gallery'] = '
                        <script>
                            function gallery_is_masonry() {
                                "use strict";
                                jQuery(".sorting_block").isotope();
                            }
                            jQuery(window).load(function () {
                                "use strict";
                                gallery_is_masonry();
                            });

                            jQuery(window).resize(function(){
                                "use strict";
                                gallery_is_masonry();
                            });
                        </script>
                    ';
                }
            ?>
        </div>            
    </div>
</div>