<?php

$gt3_tabs_admin_theme = new Tabs_admin_theme();

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'General',
    'icon' => 'fa fa-cogs'
), array(
    new image_admin_theme(array(
        'name' => 'Header logo',
        'id' => 'logo2',
        'button_caption' => 'Add Image',
        'desc' => '<span class="gt3_help_block">Default: 274px x 28px</span>',
        'default' => THEMEROOTURL . '/img/logo.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'name' => 'Logo (Retina)',
        'id' => 'logo_retina',
        'desc' => '<span class="gt3_help_block">Default: 548px x 56px</span>',
        'default' => THEMEROOTURL . '/img/retina/logo.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Header logo width',
        'id' => 'header_logo_standart_width',
        'not_empty' => true,
        'default' => '274',
        'min' => '10',
        'max' => '500',
        'step' => '1',
		'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 274px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-right: 10px;'
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Header logo height',
        'id' => 'header_logo_standart_height',
        'not_empty' => true,
        'default' => '28',
        'min' => '10',
        'max' => '200',
        'step' => '1',
		'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 28px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-left: 10px;'
    )),
    new image_admin_theme(array(
        'name' => 'Transparent Header logo',
        'id' => 'transparent_logo',
        'button_caption' => 'Add Image',
        'desc' => '<span class="gt3_help_block">Default: 274px x 28px</span>',
        'default' => THEMEROOTURL . '/img/logo_footer.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'name' => 'Transparent Header Logo (Retina)',
        'id' => 'transparent_logo_retina',
        'desc' => '<span class="gt3_help_block">Default: 548px x 56px</span>',
        'default' => THEMEROOTURL . '/img/retina/logo_footer.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Transparent Header logo width',
        'id' => 'transparent_logo_standart_width',
        'not_empty' => true,
        'default' => '274',
        'min' => '10',
        'max' => '500',
        'step' => '1',
        'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 274px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-right: 10px;'
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Transparent Header logo height',
        'id' => 'transparent_logo_standart_height',
        'not_empty' => true,
        'default' => '28',
        'min' => '10',
        'max' => '200',
        'step' => '1',
        'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 28px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-left: 10px;'
    )),
    new image_admin_theme(array(
        'name' => 'Footer logo (Footer type 2 only)',
        'id' => 'footer_logo',
        'button_caption' => 'Add Image',
        'desc' => '<span class="gt3_help_block">Default: 274px x 28px</span>',
        'default' => THEMEROOTURL . '/img/logo_footer.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'name' => 'Footer Logo (Retina)',
        'id' => 'footer_logo_retina',
        'desc' => '<span class="gt3_help_block">Default: 548px x 56px</span>',
        'default' => THEMEROOTURL . '/img/retina/logo_footer.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Footer logo width',
        'id' => 'footer_logo_standart_width',
        'not_empty' => true,
        'default' => '274',
        'min' => '10',
        'max' => '500',
        'step' => '1',
        'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 274px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-right: 10px;'
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Footer logo height',
        'id' => 'footer_logo_standart_height',
        'not_empty' => true,
        'default' => '28',
        'min' => '10',
        'max' => '200',
        'step' => '1',
        'unit' => 'px',
        'desc' => '<span class="gt3_help_block">Default: 28px</span>',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-left: 10px;'
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Favicon',
        'id' => 'favicon',
        'desc' => '<span class="gt3_help_block">Icon must be 16x16px or 32x32px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/favicon.ico',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (57px)',
        'id' => 'apple_touch_57',
        'desc' => '<span class="gt3_help_block">Icon must be 57x57px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_57x57.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (72px)',
        'id' => 'apple_touch_72',
        'desc' => '<span class="gt3_help_block">Icon must be 72x72px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_72x72.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (114px)',
        'id' => 'apple_touch_114',
        'desc' => '<span class="gt3_help_block">Icon must be 114x114px. Please note that if you\'ve already uploaded the Site Icon in the Theme Customizer (Appearance -> Customize), the settings from the theme options panel will be ignored.</span>',
        'default' => THEMEROOTURL . '/img/apple_icons_114x114.png',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Any code (before &lt;/head&gt;)',
        'id' => 'code_before_head',
		'desc' => '',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Any code (before &lt;/body&gt;)',
        'id' => 'code_before_body',
		'desc' => '<span class="gt3_help_block">You can use any code on the page which is required to be placed before &lt;/body&gt;.</span>',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Copyright',
        'id' => 'copyright',
		'desc' => '<span class="gt3_help_block">You can add any information to the copyright section of your web site.</span>',
        'default' => 'Copyright &copy; 2020 Elite Masters. All Rights Reserved.',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Sidebars',
    'icon' => 'fa fa-trello'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Default sidebar layout',
        'id' => 'default_sidebar_layout',
        'default' => 'no-sidebar',
        'options' => array(
            'left-sidebar' => 'Left sidebar',
            'right-sidebar' => 'Right sidebar',
            'no-sidebar' => 'Without sidebar'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SidebarManager_admin_theme(array(
        'name' => 'Sidebar manager',
        'id' => 'sidebar_manager',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Fonts',
    'icon' => 'fa fa-font'
), array(
    new FontSelector_admin_theme(array(
        'name' => 'Main font',
        'id' => 'main_font',
        'default' => 'Roboto',
        'options' => get_fonts_array_only_key_name(),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'Main font parameters',
        'id' => 'google_font_parameters_main_font',
        'not_empty' => true,
        'default' => ':400,300,300italic,400italic,500,700,900',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => '<span class="gt3_help_block">Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H1 font-size',
        'id' => 'h1_font_size',
        'not_empty' => true,
        'default' => '46px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H1 line-height',
        'id' => 'h1_line_height',
        'not_empty' => true,
        'default' => '52px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H2 font-size',
        'id' => 'h2_font_size',
        'not_empty' => true,
        'default' => '36px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H2 line-height',
        'id' => 'h2_line_height',
        'not_empty' => true,
        'default' => '43px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H3 font-size',
        'id' => 'h3_font_size',
        'not_empty' => true,
        'default' => '30px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H3 line-height',
        'id' => 'h3_line_height',
        'not_empty' => true,
        'default' => '37px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H4 font-size',
        'id' => 'h4_font_size',
        'not_empty' => true,
        'default' => '28px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H4 line-height',
        'id' => 'h4_line_height',
        'not_empty' => true,
        'default' => '36px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H5 font-size',
        'id' => 'h5_font_size',
        'not_empty' => true,
        'default' => '24px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H5 line-height',
        'id' => 'h5_line_height',
        'not_empty' => true,
        'default' => '32px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H6 font-size',
        'id' => 'h6_font_size',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new textOption_admin_theme(array(
        'name' => 'H6 line-height',
        'id' => 'h6_line_height',
        'not_empty' => true,
        'default' => '28px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Content font-size',
        'id' => 'content_font_size',
        'not_empty' => true,
        'default' => '14px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Content line-height',
        'id' => 'content_line_height',
        'not_empty' => true,
        'default' => '22px',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new textOption_admin_theme(array(
        'name' => 'Content font-weight',
        'id' => 'content_font_weight',
        'not_empty' => true,
        'default' => '300',
        'width' => '100px',
        'textalign' => 'center',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Socials',
    'icon' => 'fa fa-users'
), array(
    new TextOption_admin_theme(array(
        'name' => 'Flickr',
        'id' => 'social_flickr',
        'default' => 'https://www.flickr.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Pinterest',
        'id' => 'social_pinterest',
        'default' => 'http://pinterest.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'YouTube',
        'id' => 'social_youtube',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Instagram',
        'id' => 'social_instagram',
        'default' => 'https://instagram.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Dribbble',
        'id' => 'social_dribbble',
        'default' => 'https://dribbble.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Facebook',
        'id' => 'social_facebook',
        'default' => 'http://facebook.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Twitter',
        'id' => 'social_twitter',
        'default' => 'http://twitter.com',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'LinkedIn',
        'id' => 'social_linked_in',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Tumblr',
        'id' => 'social_tumblr',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextOption_admin_theme(array(
        'name' => 'Google Plus',
        'id' => 'social_gplus',
        'default' => '',
        'desc' => '<span class="gt3_help_block">Please specify http:// to the URL</span>',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Contacts',
    'icon' => 'fa fa-envelope'
), array(
    new TextOption_admin_theme(array(
        'name' => 'Phone number',
        'id' => 'phone',
        'default' => '+1 (800) 456 37 96',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new TextOption_admin_theme(array(
        'name' => 'Send mails to',
        'id' => 'contacts_to',
        'default' => get_option("admin_email"),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'View Options',
    'icon' => 'fa fa-file-image-o'
), array(
    new SelectOption_admin_theme(array(
        'name' => 'Responsive',
        'id' => 'responsive',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new SelectOption_admin_theme(array(
        'name' => 'Default Header Type',
        'id' => 'default_header',
        'default' => 'type1',
        'options' => array(
            'type1' => 'Type1',
            'type2' => 'Type2',
            'type3' => 'Type3',
            'type4' => 'Type4'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Default Footer Type',
        'id' => 'default_footer',
        'default' => 'type1',
        'options' => array(
            'type1' => 'Type1',
            'type2' => 'Type2'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Title Area',
        'id' => 'show_title_area',
        'default' => 'yes',
        'options' => array(
            'yes' => 'Show',
            'no' => 'Hide'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Breadcrumb Area',
        'id' => 'show_breadcrumb_area',
        'default' => 'yes',
        'options' => array(
            'yes' => 'Show',
            'no' => 'Hide'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new SelectOption_admin_theme(array(
        'name' => 'Tagline Area',
        'id' => 'show_tagline_area',
        'default' => 'yes',
        'options' => array(
            'yes' => 'Show',
            'no' => 'Hide'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new SelectOption_admin_theme(array(
        'name' => 'Sticky menu',
        'id' => 'sticky_menu',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => 'margin-right: 10px;'
    )),
    new rangeOption_admin_theme(array(
        'name' => 'Sticky Menu Opacity (%)',
        'id' => 'sticky_menu_opacity',
        'not_empty' => true,
        'default' => '90',
        'min' => '0',
        'max' => '100',
        'step' => '5',
        'unit' => '%',
        'desc' => '',
        'option_style' => 'width: 50%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Default theme layout',
        'id' => 'default_layout',
        'default' => 'clean',
        'options' => array(
            'clean' => 'Clean',
            'boxed' => 'Boxed (pattern or color)',
            'bgimage' => 'Fullscreen Background Image'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Default background image',
        'id' => 'bg_img',
        'default' => THEMEROOTURL . '/img/def_bg.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Default background pattern',
        'id' => 'bg_pattern',
        'default' => THEMEROOTURL . '/img/def_pattern.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Default boxed version background color',
        'id' => 'default_bg_color_boxed',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Pre Footer Area',
        'id' => 'footer_widgets_area',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Pre Footer Background Image Status',
        'id' => 'prefooter_img_status',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new image_admin_theme(array(
        'type' => 'upload',
        'name' => 'Pre Footer Background Image',
        'id' => 'bg_img_pre_footer',
        'default' => THEMEROOTURL . '/img/pre_footer.jpg',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Pre Footer Background Image Type',
        'id' => 'prefooter_img_type',
        'default' => 'stretch',
        'options' => array(
            'stretch' => 'Stretch',
            'pattern' => 'Pattern'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Related Posts',
        'id' => 'related_posts',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Related Portfolio Posts',
        'id' => 'related_portfolio_posts',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Related Offers',
        'id' => 'related_offers',
        'default' => 'on',
        'options' => array(
            'on' => 'On',
            'off' => 'Off'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Portfolio comments',
        'id' => 'portfolio_comments',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new SelectOption_admin_theme(array(
        'name' => 'Page comments',
        'id' => 'page_comments',
        'default' => 'disabled',
        'options' => array(
            'disabled' => 'Disabled',
            'enabled' => 'Enabled'
        ),
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new TextareaOption_admin_theme(array(
        'name' => 'Custom CSS',
        'id' => 'custom_css',
        'default' => '',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
)));


$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Color Options',
    'icon' => 'fa fa-paint-brush'
), array(
    new ColorOption_admin_theme(array(
        'name' => 'Theme color',
        'id' => 'color_theme',
        'not_empty' => 'true',
        'default' => '#08c1f3',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new ColorOption_admin_theme(array(
        'name' => 'Main text color',
        'id' => 'main_text_color',
        'not_empty' => 'true',
        'default' => '#9da1ad',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new ColorOption_admin_theme(array(
        'name' => 'Heading color',
        'id' => 'headings_color',
        'not_empty' => 'true',
        'default' => '#222629',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
    new ColorOption_admin_theme(array(
        'name' => 'Content Background Color',
        'id' => 'default_bg_color',
        'not_empty' => 'true',
        'default' => '#ffffff',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),	
    new ColorOption_admin_theme(array(
        'name' => 'Header background color',
        'id' => 'header_bg_color',
        'not_empty' => 'true',
        'default' => '#222629',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Tagline background color',
        'id' => 'tagline_bg_color',
        'not_empty' => 'true',
        'default' => '#262b2e',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Tagline text color',
        'id' => 'tagline_text_color',
        'not_empty' => 'true',
        'default' => '#6d707a',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new ColorOption_admin_theme(array(
        'name' => 'Main menu text color',
        'id' => 'main_menu_text_color',
        'not_empty' => 'true',
        'default' => '#9da1ad',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
	new ColorOption_admin_theme(array(
        'name' => 'PreFooter background color',
        'id' => 'prefooter_bg_color',
        'not_empty' => 'true',
        'default' => '#25292c',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer background color',
        'id' => 'footer_bg_color',
        'not_empty' => 'true',
        'default' => '#212528',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
    new ColorOption_admin_theme(array(
        'name' => 'Footer text color',
        'id' => 'footer_text_color',
        'not_empty' => 'true',
        'default' => '#6d707a',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    ))
)));

$gt3_tabs_admin_theme->add(new Tab_admin_theme(array(
    'name' => 'Import/Export',
    'icon' => 'fa fa-file-text-o'
), array(
    new import_export_settings_admin_theme(array(
        'name' => 'Import and Export Admin Settings',
        'id' => 'import_export_settings',
        'option_style' => 'width: 100%;',
        'innerpadding_option_style' => ''
    )),
)));

?>