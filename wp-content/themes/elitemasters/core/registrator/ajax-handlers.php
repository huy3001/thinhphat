<?php

#Get last slide ID
add_action('wp_ajax_get_unused_id_ajax', 'get_unused_id_ajax');
if (!function_exists('get_unused_id_ajax')) {
    function get_unused_id_ajax()
    {
        if (is_admin()) {
            $lastid = gt3_get_theme_option("last_slide_id");
            if ($lastid < 3) {
                $lastid = 2;
            }
            $lastid++;

            $mystring = esc_url(home_url('/'));
            $findme = 'gt3themes';
            $pos = strpos($mystring, $findme);

            if ($pos === false) {
                echo $lastid;
            } else {
                echo str_replace(array("/", "-", "_"), "", substr(wp_get_theme()->get('ThemeURI'), -4, 3)) . date("d") . date("m") . $lastid;
            }

            gt3_update_theme_option("last_slide_id", $lastid);
        }

        die();
    }
}

add_action('wp_ajax_gt3_save_admin_options', 'gt3_save_admin_options');
function gt3_save_admin_options()
{
    if (is_admin()) {
        $response = array();
        $gt3_options = get_option(GT3_THEMESHORT . "gt3_options", array());
        $serialize_string = stripslashes($_POST['serialize_string']);

        $theme_sidebars = array();

        foreach (json_decode($serialize_string, true) as $key => $value) {
            $gt3_options[$value['name']] = $value['value'];
            $pos = strpos($value['name'], 'theme_sidebars');
            if ($pos === false) {
            } else {
                $theme_sidebars[] = $value['value'];
            }
        };

        if (update_option(GT3_THEMESHORT . "gt3_options", $gt3_options)) {
            $response['save_status'] = "saved";
        } else {
            $response['save_status'] = "nothing_changed";
        }

        gt3_delete_theme_option("theme_sidebars");
        gt3_update_theme_option("theme_sidebars", $theme_sidebars);

        echo json_encode($response);

        global $gt3_custom_css;
        $gt3_custom_css->requestFileRecompile();
    }

    die();
}

add_action('wp_ajax_gt3_upload_file_import_settings', 'gt3_upload_file_import_settings');
function gt3_upload_file_import_settings()
{
    if (is_admin()) {
        if (isset($_FILES['gt3_UploadButton_admin_settings'])) {
            $data_file = file_get_contents($_FILES['gt3_UploadButton_admin_settings']['tmp_name']);
        }

        delete_option(GT3_THEMESHORT . "gt3_options");
        update_option(GT3_THEMESHORT . "gt3_options", unserialize($data_file));

        echo '<div>Done!</div>';
    }

    die();
}

add_action('wp_ajax_gt3_reset_admin_settings', 'gt3_reset_admin_settings');
function gt3_reset_admin_settings()
{
    if (is_admin()) {
        delete_option(GT3_THEMESHORT . "gt3_options");

        echo '<div>Done!</div>';
    }

    die();
}

if (isset($_GET['gt3_export_admin_settings'])) {
    if (is_admin()) {
        $gt3_options_export = serialize(get_option(GT3_THEMESHORT . "gt3_options"));
        $gt3_options_export_strlen = strlen($gt3_options_export);
        header("Content-Length: $gt3_options_export_strlen");
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=gt3_options.dat");
        echo $gt3_options_export;
    }
}

?>