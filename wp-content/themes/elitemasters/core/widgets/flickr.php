<?php

class flickr extends WP_Widget {

	function flickr() {
		parent::__construct( false, 'Flickr (current theme)' );
	}

	function widget( $args, $instance ) {
		extract($args);

		echo $before_widget; 
		echo $before_title;
        echo esc_attr($instance['widget_title']);
		echo $after_title;

		$flickr_id = mt_rand(1000, 9999);

		echo '<div class="flickr_widget_wrapper_' . $flickr_id . '"></div>
		<script>
			(function($) {
				"use strict";
				$(document).ready(function(){
					$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id='.$instance['flickr_widget_id'].'&lang=en-us&format=json&jsoncallback=?", function(data){
						$.each(data.items, function(i,item){
							if(i<'.$instance['flickr_widget_number'].'){
								$("<img/>").attr("src", item.media.m).appendTo(".flickr_widget_wrapper_' . $flickr_id . '").wrap("<div class=\'flickr_badge_image\'><a href=\'" + item.link + "\' target=\'_blank\' title=\'Flickr\'></a></div>");
							}
						});
					});
				});

			})(jQuery);
		</script>';

		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr( $new_instance['widget_title'] );
        $instance['flickr_widget_number'] = absint( $new_instance['flickr_widget_number'] );
        $instance['flickr_widget_id'] = esc_attr( $new_instance['flickr_widget_id'] );

        return $instance;
	}

	function form($instance) {
        $defaultValues = array(
            'widget_title' => 'Photo Stream',
            'flickr_widget_number' => '8',
            'flickr_widget_id' => '91205275@N03'
        );
        $instance = wp_parse_args((array) $instance, $defaultValues);


	?>
		<table class="fullwidth">
			<tr>
				<td>Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>' value='<?php echo esc_attr($instance['widget_title']); ?>'/></td>
			</tr>
			<tr>
				<td>Flickr ID:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'flickr_widget_id' )); ?>' value='<?php echo esc_attr($instance['flickr_widget_id']); ?>'/></td>
			</tr>
			<tr>
				<td>Number:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'flickr_widget_number' )); ?>' value='<?php echo esc_attr($instance['flickr_widget_number']); ?>'/></td>
			</tr>
		</table>
	<?php
	}
}

function flickr_register_widgets() { register_widget( 'flickr' ); } 
add_action( 'widgets_init', 'flickr_register_widgets' );

?>