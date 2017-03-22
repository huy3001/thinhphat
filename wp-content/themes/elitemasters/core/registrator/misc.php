<?php
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails', array('post', 'page', 'portfolio', 'team', 'testimonials', 'partners', 'product', 'offers'));
    add_theme_support('automatic-feed-links');
    add_theme_support('revisions');
}

function gt3_adjust_post_formats() {
    if (isset($_GET['post'])) {
        $post = get_post($_GET['post']);
        if ($post)
            $post_type = $post->post_type;
    } elseif ( !isset($_GET['post_type']) )
        $post_type = 'post';
    elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
        $post_type = $_GET['post_type'];
    else
        return;

    if ( 'portfolio' == $post_type )
        add_theme_support('post-formats', array('image', 'video'));
    elseif ( 'post' == $post_type )
        add_theme_support('post-formats', array('image', 'video', 'link', 'quote', 'audio'));
}
add_action( 'load-post.php','gt3_adjust_post_formats' );
add_action( 'load-post-new.php','gt3_adjust_post_formats' );

#Support menus
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'main_menu' => 'Main menu',
            'footer_menu' => 'Footer menu (Footer type 2 only)'
        )
    );
}

#Enable shortcodes in sidebar
add_filter('widget_text', 'do_shortcode');

#ADD localization folder
add_action('init', 'enable_pomo_translation');
function enable_pomo_translation()
{
    load_theme_textdomain('elitemasters', get_template_directory() . '/core/languages/');
}

add_action('admin_head', 'reg_font_js');
function reg_font_js()
{
    global $gt3_themeconfig;
    ?>
    <script type="text/javascript">
        <?php
            $compile = array();
            echo "var fontsarray = '';";
        ?>
    </script>
<?php
}

add_action('add_meta_boxes', 'side_sidebar_settings_meta_box');
function side_sidebar_settings_meta_box()
{
    $types = array('post', 'page', 'portfolio');

    foreach ($types as $type) {
        add_meta_box(
            'side_sidebar_settings_meta_box',
            esc_html__('Custom Sidebars', 'elitemasters'),
            'side_sidebar_settings_meta_box_cb',
            $type,
            'side',
            'low'
        );
    }
}

function side_sidebar_settings_meta_box_cb($post)
{
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder($post->ID, array("not_prepare_sidebars" => "true"));
    $available_sidebars = array("default" => "Default", "no-sidebar" => "None", "left-sidebar" => "Left", "right-sidebar" => "Right");

    echo '<div class="select_sidebar_layout sidebar_option sidebar_no_border"><span class="htitle">' . esc_html__('Sidebar layout:', 'elitemasters') . '</span><select name="pagebuilder[settings][layout-sidebars]" class="sidebar_layout admin_newselect">';
    foreach ($available_sidebars as $sidebar_id => $sidebar_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['layout-sidebars']) && $gt3_theme_pagebuilder['settings']['layout-sidebars'] == $sidebar_id) ? 'selected="selected"' : '') . " value='$sidebar_id'>$sidebar_caption</option>";
    }
    echo '</select></div>';

    $all_available_sidebars = array("Default");
    $theme_sidebars = gt3_get_theme_option("theme_sidebars");
    if (!is_array($theme_sidebars)) {
        $theme_sidebars = array();
    }

    $i = 1;
    foreach ($theme_sidebars as $theme_sidebar) {
        $all_available_sidebars[$i] = $theme_sidebar;
        $i++;
    }
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        $all_available_sidebars[$i] = "WooCommerce";
        $i++;
    }

    echo '<div class="select_sidebar sidebar_option last sidebar_with_border ' . (gt3_get_theme_option("default_sidebar_layout") == "no-sidebar" ? "sidebar_none" : "") . '"><span class="htitle">' . esc_html__('Select sidebar:', 'elitemasters') . '</span><select name="pagebuilder[settings][selected-sidebar-name]" class="sidebar_name admin_newselect">';
    foreach ($all_available_sidebars as $sidebar_id => $sidebar_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['selected-sidebar-name']) && $gt3_theme_pagebuilder['settings']['selected-sidebar-name'] == $sidebar_caption) ? 'selected="selected"' : '') . " value='$sidebar_caption'>$sidebar_caption</option>";
    }
    echo '</select></div>';
}

#Work with Custom background
add_action('add_meta_boxes', 'side_bg_settings_meta_box');
function side_bg_settings_meta_box()
{
    $types = array('post', 'page', 'portfolio');

    foreach ($types as $type) {
        add_meta_box(
            'side_bg_settings_meta_box',
            esc_html__('Custom Layout', 'elitemasters'),
            'side_bg_settings_meta_box_cb',
            $type,
            'side',
            'low'
        );
    }
}

function side_bg_settings_meta_box_cb($post)
{
    $gt3_theme_pagebuilder = gt3_get_theme_pagebuilder($post->ID);

    if (!get_page_template_slug() == "page-onepage-scroll.php") {
        $available_layouts = array("default" => "Default", "clean" => "Clean", "boxed" => "Boxed (pattern or color)", "bgimage" => "Fullscreen Background Image");

        echo '<div class="sidebar_option custom_select_bcarea">' . esc_html__('Page layout:', 'elitemasters') . '<br><select name="pagebuilder[page_settings][page_layout][layout_type]" class="admin_newselect page_layout">';
        foreach ($available_layouts as $layout_id => $layout_caption) {
            echo "<option " . ((isset($gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type']) && $gt3_theme_pagebuilder['page_settings']['page_layout']['layout_type'] == $layout_id) ? 'selected="selected"' : '') . " value='$layout_id'>$layout_caption</option>";
        }
        echo '</select>';

        echo '<div class="boxed_options layout_boxed_options no_boxed">
                <input type="hidden" class="custom_select_img_attachid" name="pagebuilder[page_settings][page_layout][img][attachid]" value="' . (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid']) ? $gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'] : '') . '">
                <div class="custom_select_img_preview">';
            if (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'])) {
                $img_attachment = wp_get_attachment_image_src($gt3_theme_pagebuilder['page_settings']['page_layout']['img']['attachid'], "medium");
                if ($img_attachment[0] == '') {
                } else {
                    echo '<img src="' . $img_attachment[0] . '" alt="">';
                }
            }
            echo '
                </div>
            <div class="custom_select_image">
                <span class="add_image_from_wordpress_library_popup">' . esc_html__('Add Image', 'elitemasters') . '</span>
            </div>';

            echo '
            <div id="pb_section" class="custom_select_bgcolor">
                <div class="custom_select_color">
                    <div class="color_picker_block ">
                        <input type="text" class="cpicker" name="pagebuilder[page_settings][page_layout][color][hash]" value="' . (isset($gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash']) ? $gt3_theme_pagebuilder['page_settings']['page_layout']['color']['hash'] : '') . '">
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div></div>';

    }

    echo '<div class="custom_select_bcarea">';

    echo '<span class="htitle">' . esc_html__('Title:', 'elitemasters') . '</span><select name="pagebuilder[settings][show_title_area]" class="admin_newselect">';
    $available_variants = array("yes" => "Show", "no" => "Hide");
    foreach ($available_variants as $var_id => $var_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['show_title_area']) && $gt3_theme_pagebuilder['settings']['show_title_area'] == $var_id) ? 'selected="selected"' : '') . " value='$var_id'>$var_caption</option>";
    }
    echo '</select>';

    echo '
    </div>

	<div class="custom_select_bcarea">';

    echo '<span class="htitle">' . esc_html__('Breadcrumb area:', 'elitemasters') . '</span><select name="pagebuilder[settings][show_breadcrumb_area]" class="admin_newselect">';
    $available_bc_variants = array("yes" => "Show", "no" => "Hide");
    foreach ($available_bc_variants as $var_bc_id => $var_bc_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['show_breadcrumb_area']) && $gt3_theme_pagebuilder['settings']['show_breadcrumb_area'] == $var_bc_id) ? 'selected="selected"' : '') . " value='$var_bc_id'>$var_bc_caption</option>";
    }
    echo '</select>';

    echo '
    </div>
	
	<div class="custom_select_bcarea">';

    echo '<span class="htitle">' . esc_html__('Header Type:', 'elitemasters') . '</span><select name="pagebuilder[settings][header_type]" class="admin_newselect">';
    $available_headder_variants = array("default" => "Default", "type1" => "Type1", "type2" => "Type2", "type3" => "Type3", "type4" => "Type4");
    foreach ($available_headder_variants as $var_headder_id => $var_headder_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['header_type']) && $gt3_theme_pagebuilder['settings']['header_type'] == $var_headder_id) ? 'selected="selected"' : '') . " value='$var_headder_id'>$var_headder_caption</option>";
    }
    echo '</select>';

    echo '
    </div>';

    if (get_post_type($post) == "page") {
        echo '<div class="custom_select_bcarea">';
        echo '<span class="htitle">' . esc_html__('Transparent Header:', 'elitemasters') . '</span><select name="pagebuilder[settings][transpheader_type]" class="admin_newselect">';
        $available_transpheader_variants = array("disabled" => "Disabled", "enabled" => "Enabled");
        foreach ($available_transpheader_variants as $var_transpheader_id => $var_transpheader_caption) {
            echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['transpheader_type']) && $gt3_theme_pagebuilder['settings']['transpheader_type'] == $var_transpheader_id) ? 'selected="selected"' : '') . " value='$var_transpheader_id'>$var_transpheader_caption</option>";
        }
        echo '</select>';
        echo '</div>';
    }

    echo '<div class="custom_select_bcarea">';

    echo '<span class="htitle">' . esc_html__('Footer Type:', 'elitemasters') . '</span><select name="pagebuilder[settings][footer_type]" class="admin_newselect">';
    $available_footer_variants = array("default" => "Default", "type1" => "Type1", "type2" => "Type2");
    foreach ($available_footer_variants as $var_footer_id => $var_footer_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['footer_type']) && $gt3_theme_pagebuilder['settings']['footer_type'] == $var_footer_id) ? 'selected="selected"' : '') . " value='$var_footer_id'>$var_footer_caption</option>";
    }
    echo '</select>';

    echo '
    </div>

    <div class="custom_select_bcarea">';

    echo '<span class="htitle">' . esc_html__('Pre Footer Bg Image Status:', 'elitemasters') . '</span><select name="pagebuilder[settings][prefooter_status]" class="admin_newselect">';
    $available_prefooter_variants = array("default" => "Default", "disabled" => "Disabled", "enabled" => "Enabled");
    foreach ($available_prefooter_variants as $var_prefooter_id => $var_prefooter_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['prefooter_status']) && $gt3_theme_pagebuilder['settings']['prefooter_status'] == $var_prefooter_id) ? 'selected="selected"' : '') . " value='$var_prefooter_id'>$var_prefooter_caption</option>";
    }
    echo '</select>';

    echo '
    </div>
	
	<div class="custom_select_bcarea last">';

    echo '<span class="htitle">' . esc_html__('Tagline area:', 'elitemasters') . '</span><select name="pagebuilder[settings][show_tagline_area]" class="admin_newselect">';
    $available_tgl_variants = array("yes" => "Show", "no" => "Hide");
    foreach ($available_tgl_variants as $var_tgl_id => $var_tgl_caption) {
        echo "<option " . ((isset($gt3_theme_pagebuilder['settings']['show_tagline_area']) && $gt3_theme_pagebuilder['settings']['show_tagline_area'] == $var_tgl_id) ? 'selected="selected"' : '') . " value='$var_tgl_id'>$var_tgl_caption</option>";
    }
    echo '</select>';

    echo '
    </div>
		
    <div class="clear"></div>
    ';
}


if (!defined("GT3PBVERSION")) {
    function gt3_update_theme_pagebuilder_without_plugin($post_id, $variableName, $gt3_theme_pagebuilderArray)
    {
        update_post_meta($post_id, $variableName, $gt3_theme_pagebuilderArray);
        return true;
    }

    add_action('save_post', 'save_postdata_in_theme');
    function save_postdata_in_theme($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        #CHECK PERMISSIONS
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        #START SAVING
        if (!isset($_POST['pagebuilder'])) {
            $pbsavedata = array();
        } else {
            $pbsavedata = $_POST['pagebuilder'];
            gt3_update_theme_pagebuilder_without_plugin($post_id, "pagebuilder", $pbsavedata);
        }
    }
}


#Enable autogenerate custom.css for developers
#gt3_update_theme_option("always_generate_custom_css_js", "true");
if (gt3_get_theme_option("always_generate_custom_css_js") == "true") {
    $gt3_custom_css->putDataIntoFile();
}

?>