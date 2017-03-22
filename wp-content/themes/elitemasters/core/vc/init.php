<?php

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (!is_plugin_active('js_composer/js_composer.php')) {
    return;
}

add_action('vc_before_init', 'gt3_vcSetAsTheme');
function gt3_vcSetAsTheme()
{
    vc_set_as_theme($disable_updater = true);
}

/* List of Active VC Modules */
$gt3_vc_modules = array(
    'gt3_featured_posts',
    'gt3_featured_portfolio',
    'gt3_heading',
    'gt3_gallery',
    'gt3_portfolio',
    'gt3_blog',
    'gt3_partners',
    'gt3_team',
    'gt3_testimonials',
	'gt3_colored_info_sections',
    'gt3_offers',
);

foreach ($gt3_vc_modules as $gt3_vc_module) {
    require_once get_template_directory() . '/core/vc/modules/' . $gt3_vc_module . '/init.php';
}