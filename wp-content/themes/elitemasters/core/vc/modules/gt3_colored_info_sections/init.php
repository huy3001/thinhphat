<?php
if (function_exists('vc_map')) {
    vc_map(array(
        "name" => esc_html__('Colored Info Sections', 'elitemasters'),
        "base" => 'gt3_colored_info_sections',
        "description" => esc_html__("Display custom colored info sections", "elitemasters"),
        "category" => esc_html__('GT3 Modules', 'elitemasters'),
        "icon" => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        "as_parent" => array('only' => 'gt3_colored_info_section_item'),
        "content_element" => true,
        "show_settings_on_create" => true,
        "params" => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Container Layout', 'elitemasters'),
                'param_name' => 'container_layout',
                'value' => array(
                    esc_html__("Wall", "elitemasters") => 'wall',
                    esc_html__("Grid", "elitemasters") => 'grid',
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Alignment", "elitemasters"),
                "param_name" => "alignment",
                "value" => array(
                    esc_html__("Center", "elitemasters") => 'center',
                    esc_html__("Left", "elitemasters") => 'left',
                    esc_html__("Right", "elitemasters") => 'right'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Items Per Line', 'elitemasters'),
                'param_name' => 'posts_per_line',
                'value' => array(
                    esc_html__("1", "elitemasters") => '1',
                    esc_html__("2", "elitemasters") => '2',
                    esc_html__("3", "elitemasters") => '3',
                    esc_html__("4", "elitemasters") => '4',
                ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "elitemasters"),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "elitemasters")
            ),
        ),
        "js_view" => 'VcColumnView'
    ));
// Add list item
    vc_map(array(
        "name" => esc_html__("Colored Info Section Item", "elitemasters"),
        "base" => "gt3_colored_info_section_item",
        "class" => "gt3_info_list",
        "category" => esc_html__('GT3 Modules', 'elitemasters'),
        "icon" => site_url(str_replace(ABSPATH, '', __DIR__ . '/')) . 'icon.png',
        "content_element" => true,
        "as_child" => array('only' => 'gt3_colored_info_sections'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Title", "elitemasters"),
                "param_name" => "list_title",
                "value" => "",
                "description" => esc_html__("Provide a title for this list item.", "elitemasters")
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => esc_html__("Description", "elitemasters"),
                "param_name" => "content",
                "value" => "",
                "description" => esc_html__("Description about this list item", "elitemasters")
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Background Color", "elitemasters"),
                "param_name" => "section_bg_color",
                "value" => "",
                "description" => esc_html__("Select background color for this item.", "elitemasters"),
            ),
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_html__("Text Color", "elitemasters"),
                "param_name" => "text_color",
                "value" => "",
                "description" => esc_html__("Select text color for this item.", "elitemasters"),
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Button", "elitemasters"),
                "param_name" => "info_list_link_apply",
                "value" => array(
                    esc_html__("Hide", "elitemasters") => "no-button",
                    esc_html__("Show", "elitemasters") => "show-button"
                )
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Button Title", "elitemasters"),
                "param_name" => "button_title",
                "value" => "",
                "dependency" => array("element" => "info_list_link_apply", "value" => array("show-button"))
            ),
            array(
                "type" => "vc_link",
                "heading" => esc_html__("Link", "elitemasters"),
                "param_name" => "info_list_link",
                "dependency" => array("element" => "info_list_link_apply", "value" => array("show-button"))
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Icon Position", "elitemasters"),
                "param_name" => "icon_position",
                "value" => array(
                    esc_html__("Icon at Left", "elitemasters") => 'left',
                    esc_html__("Icon at Right", "elitemasters") => 'right'
                ),
                "group" => "Icon",
                "dependency" => array("element" => "info_list_link_apply", "value" => array("show-button"))
            ),
            array(
                "type" => "icon_manager",
                "class" => "",
                "heading" => esc_html__("Select Icon ", "elitemasters"),
                "param_name" => "icon",
                "value" => "",
                "description" => esc_html__("Click and select icon of your choice. If you can't find the one that suits for your purpose, you can", "elitemasters") . " <a href='admin.php?page=font-icon-Manager' target='_blank'>" . esc_html__('add new here', 'elitemasters') . "</a>.",
                "group" => "Icon",
                "dependency" => array("element" => "info_list_link_apply", "value" => array("show-button"))
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", "elitemasters"),
                "param_name" => "item_el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "elitemasters")
            ),
        )
    ));

    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_Gt3_Colored_Info_Sections extends WPBakeryShortCodesContainer
        {
        }
    }
    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_Gt3_Colored_Info_Section_Item extends WPBakeryShortCode
        {
        }
    }
}