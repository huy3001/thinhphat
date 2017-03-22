<?php
/*
Plugin Name: GT3 Custom Post Types
Plugin URI: http://www.gt3themes.com
Description: Register Custom Post Types for GT3 Themes.
Version: 1.1
Author: GT3 Themes
Author URI: http://www.gt3themes.com
*/

function gt3_post_types()
{
    if (!isset($GLOBALS['gt3_post_types'])) {$GLOBALS['gt3_post_types'] = array();}

    #Portfolio
    if (in_array("portfolio", $GLOBALS['gt3_post_types'])) {
        register_post_type('portfolio', array(
                'label' => __('Portfolio', 'gt3_builder'),
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'portfolio',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 5,
                'supports' => array(
                    'title',
                    'post-formats',
                    'comments',
                    'revisions',
                    'page-attributes',
                    'editor',
                    'excerpt',
                    'thumbnail')
            )
        );
        register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => __('Category', 'gt3_builder'), 'singular_name' => 'Category'));
    }

    #Team
    if (in_array("team", $GLOBALS['gt3_post_types'])) {
        register_post_type('team', array(
                'label' => __('Team', 'gt3_builder'),
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'team',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 6,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail')
            )
        );
    }

    #Gallery
    if (in_array("gallery", $GLOBALS['gt3_post_types'])) {
        register_post_type('gallery', array(
                'label' => __('Gallery', 'gt3_builder'),
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'gallery',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 4,
                'supports' => array(
                    'title'
                )
            )
        );
        #register_taxonomy('gallerycat', 'gallery', array('hierarchical' => true, 'label' => __('Category', 'gt3_builder'), 'singular_name' => 'Category'));
    }

    #Testimonials
    if (in_array("testimonials", $GLOBALS['gt3_post_types'])) {
        $labels = array(
            'name' => __('Testimonials', 'gt3_builder'),
            'add_new_item' => __('Add New', 'gt3_builder')
        );
        register_post_type('testimonials', array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'testimonials',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 7,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail'
                )
            )
        );
    }

    #Partners
    if (in_array("partners", $GLOBALS['gt3_post_types'])) {
        $labels = array(
            'name' => __('Partners', 'gt3_builder'),
            'add_new_item' => __('Add New', 'gt3_builder')
        );
        register_post_type('partners', array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'partners',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 8,
                'supports' => array(
                    'title',
                    'thumbnail'
                )
            )
        );
    }

    #Offers
    if (in_array("offers", $GLOBALS['gt3_post_types'])) {
        register_post_type('offers', array(
                'label' => __('Offers', 'gt3_builder'),
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'offers',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 9,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail')
            )
        );
    }
}

add_action('init', 'gt3_post_types');