<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_portfolio',
        'name' => esc_html__('Portfolio Posts', 'elitemasters'),
        "description" => esc_html__("Display portfolio posts", "elitemasters"),
        'category' => esc_html__('GT3 Modules', 'elitemasters'),
        'icon' => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Portfolio Items', 'elitemasters'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'portfolio', 'hidden' => false),
                    'categories' => array('hidden' => true),
                    'tags' => array('hidden' => true)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'elitemasters')
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('View Type', 'elitemasters'),
                'param_name' => 'view_type',
                'admin_label' => true,
                'value' => array(
                    esc_html__("Grid", "elitemasters") => 'grid',
                    esc_html__("Masonry", "elitemasters") => 'masonry',
                    esc_html__("Wall", "elitemasters") => 'wall',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Ajax', 'elitemasters'),
                'param_name' => 'ajax',
                'admin_label' => true,
                'value' => array(
                    esc_html__("On", "elitemasters") => 'on',
                    esc_html__("Off", "elitemasters") => 'off',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items on load', 'elitemasters'),
                'param_name' => 'items_on_load',
                'description' => esc_html__('Note, indicate the items quantity if you selected Ajax="On" in the field above.', 'elitemasters'),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items per click', 'elitemasters'),
                'param_name' => 'items_per_click',
                'description' => esc_html__('Note, indicate the items quantity if you selected Ajax="On" in the field above.', 'elitemasters'),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Filter', 'elitemasters'),
                'param_name' => 'filter',
                'admin_label' => true,
                'value' => array(
                    esc_html__("On", "elitemasters") => 'on',
                    esc_html__("Off", "elitemasters") => 'off',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'elitemasters'),
                'param_name' => 'posts_per_line',
                'admin_label' => true,
                'value' => array(
                    esc_html__("1", "elitemasters") => '1',
                    esc_html__("2", "elitemasters") => '2',
                    esc_html__("3", "elitemasters") => '3',
                    esc_html__("4", "elitemasters") => '4',
                    esc_html__("5", "elitemasters") => '5',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Featured Image Type', 'elitemasters'),
                'param_name' => 'featured_image_type',
                'admin_label' => true,
                'value' => array(
                    esc_html__("Rectangle", "elitemasters") => 'square_type',
                    esc_html__("Circle", "elitemasters") => 'round_type',
                ),
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Portfolio extends WPBakeryShortCode
    {
    }
}