<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_blog',
        'name' => esc_html__('Blog Posts', 'elitemasters'),
        "description" => esc_html__("Display blog posts", "elitemasters"),
        'category' => esc_html__('GT3 Modules', 'elitemasters'),
        'icon' => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        'params' => array(
            array(
                'type' => 'loop',
                'heading' => esc_html__('Blog Items', 'elitemasters'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'post', 'hidden' => false),
                    'categories' => array('hidden' => false),
                    'tags' => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'elitemasters')
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Blog extends WPBakeryShortCode
    {
    }
}