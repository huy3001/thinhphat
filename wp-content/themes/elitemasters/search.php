<?php get_header();
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
?>

    <div class="container">
        <div class="content_block row <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "<div class='row'>" : ""); ?>
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                            <div class="contentarea">
                                <?php
								if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") {
									$blog_pad = 'pb55';
								} else {
									$blog_pad = 'pb75';
								}
                                echo '<div class="row"><div class="col-sm-12 ' . $blog_pad . '">';

                                if (isset($_GET['s']) && strlen($_GET['s']) > 0) {

                                    global $paged;
                                    $foundSomething = false;

                                    if ($paged < 1) {
                                        $args = array(
                                            'numberposts' => -1,
                                            'post_type' => 'any',
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'pagebuilder',
                                                    'value' => get_search_query(),
                                                    'compare' => 'LIKE',
                                                    'type' => 'CHAR'
                                                )
                                            )
                                        );
                                        $query = new WP_Query($args);
                                        while ($query->have_posts()) : $query->the_post();
                                            ?>
                                            <div <?php post_class("blog_post_preview"); ?>>
                                                <div class="blog_content">
                                                    <h2 class="blogpost_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                    <div class="listing_meta">
                                                    <span class="author">
                                                        <?php echo esc_html__('by', 'elitemasters'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $foundSomething = true;
                                        endwhile;
                                        wp_reset_postdata();
                                    }

                                    $defaults = array('numberposts' => 10, 'post_type' => 'any', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false, 's' => get_search_query(), 'paged' => $paged);
                                    $query = http_build_query($defaults);
                                    $posts = get_posts($query);

                                    foreach ($posts as $post) {
                                        setup_postdata($post);
                                        ?>
                                        <div <?php post_class("blog_post_preview"); ?>>
                                            <div class="blog_content">
                                                <h2 class="blogpost_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                <div class="listing_meta">
                                                <span class="author">
                                                    <?php echo esc_html__('by', 'elitemasters'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('display_name'); ?></a>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php

                                        $foundSomething = true;
                                    }
                                    echo gt3_get_theme_pagination();

                                    if ($foundSomething == false) { ?>

                                        <div class="block404">
                                            <h2><?php echo esc_html__('Oops!', 'elitemasters'); ?> <?php echo esc_html__('Not Found!', 'elitemasters'); ?></h2>
                                            <p><?php echo esc_html__('Apologies, but we were unable to find what you were looking for.', 'elitemasters'); ?></p>
                                            <?php get_search_form(true); ?>
                                        </div>


                                    <?php
                                    }

                                } else { ?>

                                    <div class="block404">
                                        <h2><?php echo esc_html__('Search Results', 'elitemasters'); ?></h2>
                                        <p><?php echo esc_html__('Sorry, but you\'ve entered invalid search term. Please try a new search.', 'elitemasters'); ?></p>
                                        <?php get_search_form(true); ?>
                                    </div>

                                <?php }

								echo '</div><div class="clear"></div></div>';

                                ?>
                            </div>
                        </div>
                    <?php get_sidebar('left'); ?>
                <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "</div>" : ""); ?>        
            </div>
            <?php get_sidebar('right'); ?>
            <div class="clear"></div>
        </div>    	    
    </div>

<?php get_footer(); ?>