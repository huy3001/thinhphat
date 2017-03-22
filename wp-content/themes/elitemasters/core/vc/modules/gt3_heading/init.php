<?php
if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'gt3_heading',
        'name' => esc_html__('Heading', 'elitemasters'),
        "description" => esc_html__("Add custom headings", "elitemasters"),
        'category' => esc_html__('GT3 Modules', 'elitemasters'),
        'icon' => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Text', 'elitemasters'),
                'param_name' => 'title',
                'admin_label' => true,
                'value' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Heading Tag', 'elitemasters'),
                'param_name' => 'heading_tag',
                'admin_label' => true,
                'value' => array(
                    esc_html__("H1", "elitemasters") => 'h1',
                    esc_html__("H2", "elitemasters") => 'h2',
                    esc_html__("H3", "elitemasters") => 'h3',
                    esc_html__("H4", "elitemasters") => 'h4',
                    esc_html__("H5", "elitemasters") => 'h5',
                    esc_html__("H6", "elitemasters") => 'h6',
                ),
            )
        )
    ));

    class WPBakeryShortCode_Gt3_Heading extends WPBakeryShortCode
    {
    }
}