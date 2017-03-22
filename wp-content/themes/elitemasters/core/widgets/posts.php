<?php

class posts extends WP_Widget
{

    function posts()
    {
        parent::__construct(false, 'Posts (current theme)');
    }

    function widget($args, $instance)
    {
        extract($args);

        echo $before_widget;
        echo $before_title;
        echo esc_attr($instance['widget_title']);
        echo $after_title;

        $postsArgs = array(
            'showposts' => $instance['posts_widget_number'],
            'offset' => 0,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => 'post',
            'post_status' => 'publish'
        );

        $firstCat = get_the_category(get_the_ID());
        $readmorelinktext = esc_html__('Read more!', 'elitemasters');
        $compilepopular = '';

        $wp_query_posts = new WP_Query();
        $wp_query_posts->query($postsArgs);
        while ($wp_query_posts->have_posts()) : $wp_query_posts->the_post();
            $gt3_theme_featured_image_latest = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));

            if (get_the_category()) $categories = get_the_category();
            $post_categ = '';
            $separator = ', ';
            if ($categories) {
                foreach ($categories as $category) {
                    $post_categ = $post_categ . '<a href="' . get_category_link($category->term_id) . '">' . $category->cat_name . '</a>' . $separator;
                }
            }

            $compilepopular .= '
			<li ' . ((!empty($gt3_theme_featured_image_latest)) ? 'class="with_img"' : '') . '>';
            if (empty($gt3_theme_featured_image_latest)) {
                $widg_img = '';
            } else {
				$widg_img = '<img src="' . aq_resize($gt3_theme_featured_image_latest[0], "60", "60", true, true, true) . '" alt="' . get_the_title() . '">';
			}
			$comments_num = '' . get_comments_number(get_the_ID()) . '';
			if ($comments_num == 1) {
				$comments_text = '' . esc_html__('comment', 'elitemasters') . '';
			} else {
				$comments_text = '' . esc_html__('comments', 'elitemasters') . '';
			}

            $content_show = ((strlen(get_the_excerpt()) > 0) ? get_the_excerpt() : get_the_content());

            $compilepopular .= '
                <div class="recent_posts_content">
					' . $widg_img . '
					<a class="title" href="' . get_permalink() . '">' . get_the_title() . '</a>
					<div class="recent_posts_info">
					' . get_the_time("F d, Y") . '
					</div>
                </div>
			</li>
		';

        endwhile;
        wp_reset_postdata();

        echo '
			<ul class="recent_posts">
				' . $compilepopular . '
			</ul>
		';
		
		#END OUTPUT

        echo $after_widget;
    }


    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr($new_instance['widget_title']);
        $instance['posts_widget_number'] = absint($new_instance['posts_widget_number']);

        return $instance;
    }

    function form($instance)
    {
        $defaultValues = array(
            'widget_title' => 'Posts',
            'posts_widget_number' => '2'
        );
        $instance = wp_parse_args((array)$instance, $defaultValues);
        ?>
        <table class="fullwidth">
            <tr>
                <td>Title:</td>
                <td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name('widget_title')); ?>'
                           value='<?php echo esc_attr($instance['widget_title']); ?>'/></td>
            </tr>
            <tr>
                <td>Number:</td>
                <td><input type='text' class="fullwidth"
                           name='<?php echo esc_attr($this->get_field_name('posts_widget_number')); ?>'
                           value='<?php echo esc_attr($instance['posts_widget_number']); ?>'/></td>
            </tr>
        </table>
    <?php
    }
}

function posts_register_widgets()
{
    register_widget('posts');
}

add_action('widgets_init', 'posts_register_widgets');

?>