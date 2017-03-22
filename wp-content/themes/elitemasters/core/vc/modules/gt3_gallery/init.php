<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_gallery',
        'name' => esc_html__('Gallery', 'elitemasters'),
        "description" => esc_html__("Display custom gallery", "elitemasters"),
        'category' => esc_html__('GT3 Modules', 'elitemasters'),
        'icon' => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Gallery', 'elitemasters'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => true, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'gallery', 'hidden' => false),
                    'categories' => array('hidden' => true),
                    'tags' => array('hidden' => true)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.<br>You can use only one gallery!!!', 'elitemasters')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Images in row', 'elitemasters'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__("1", "elitemasters") => '1',
                    esc_html__("2", "elitemasters") => '2',
                    esc_html__("3", "elitemasters") => '3',
                    esc_html__("4", "elitemasters") => '4',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Featured Image Type', 'elitemasters'),
                'param_name' => 'featured_image_type',
                'admin_label' => true,
                'value' => array(
                    esc_html__("Rectangle", "elitemasters") => 'rectangle',
                    esc_html__("Circle", "elitemasters") => 'circle',
                    esc_html__("Masonry", "elitemasters") => 'masonry',
                ),
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Gallery extends WPBakeryShortCode
    {
    }
}