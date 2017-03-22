<?php

class gt3_contacts extends WP_Widget {

	function gt3_contacts() {
		parent::__construct( false, 'Contacts (current theme)' );
	}

	function widget( $args, $instance ) {
		extract($args);

		echo $before_widget; 
		echo $before_title;
        echo esc_attr($instance['widget_title']);
		echo $after_title;

        echo '<div class="widget_text contact_text">';

		if (isset($instance['gt3_contacts_text']) && strlen($instance['gt3_contacts_text'])>0) {
			echo '<div class="section section_info"><p>'.$instance['gt3_contacts_text'].'</p></div>';
		}

		if (isset($instance['gt3_contacts_phone']) && strlen($instance['gt3_contacts_phone'])>0 || isset($instance['gt3_phone_section_title']) && strlen($instance['gt3_phone_section_title'])>0) {
			echo '<div class="section">';
				if (isset($instance['gt3_phone_section_title']) && strlen($instance['gt3_phone_section_title'])>0) {
					echo '<p>'.$instance['gt3_phone_section_title'].'</p>';
				}
				if (isset($instance['gt3_contacts_phone']) && strlen($instance['gt3_contacts_phone'])>0) {
					echo '<p>'.$instance['gt3_contacts_phone'].'</p>';
				}
			echo '<i class="fa fa-phone"></i></div>';
		}
		if (isset($instance['gt3_contacts_office']) && strlen($instance['gt3_contacts_office'])>0 || isset($instance['gt3_location_section_title']) && strlen($instance['gt3_location_section_title'])>0) {
			echo '<div class="section">';
			if (isset($instance['gt3_location_section_title']) && strlen($instance['gt3_location_section_title'])>0) {
				echo '<p>'.$instance['gt3_location_section_title'].'</p>';
			}
			if (isset($instance['gt3_contacts_office']) && strlen($instance['gt3_contacts_office'])>0) {
				echo '<p>'.$instance['gt3_contacts_office'].'</p>';
			}
			echo '<i class="fa fa-map-marker"></i></div>';
		}
		if (isset($instance['gt3_contacts_email']) && strlen($instance['gt3_contacts_email'])>0 || isset($instance['gt3_email_section_title']) && strlen($instance['gt3_email_section_title'])>0) {
			echo '<div class="section">';
			if (isset($instance['gt3_email_section_title']) && strlen($instance['gt3_email_section_title'])>0) {
				echo '<p>'.$instance['gt3_email_section_title'].'</p>';
			}
			if (isset($instance['gt3_contacts_email']) && strlen($instance['gt3_contacts_email'])>0) {
				echo '<p><a href="mailto:'.$instance['gt3_contacts_email'].'">'.$instance['gt3_contacts_email'].'</a></p>';
			}
			echo '<i class="fa fa-envelope"></i></div>';
		}

		echo '</div>';

		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['widget_title'] = esc_attr( $new_instance['widget_title'] );
		$instance['gt3_contacts_text'] = esc_attr( $new_instance['gt3_contacts_text'] );
		$instance['gt3_phone_section_title'] = esc_attr( $new_instance['gt3_phone_section_title'] );
        $instance['gt3_contacts_phone'] = esc_attr( $new_instance['gt3_contacts_phone'] );
		$instance['gt3_location_section_title'] = esc_attr( $new_instance['gt3_location_section_title'] );
        $instance['gt3_contacts_office'] = esc_attr( $new_instance['gt3_contacts_office'] );
		$instance['gt3_email_section_title'] = esc_attr( $new_instance['gt3_email_section_title'] );
        $instance['gt3_contacts_email'] = esc_attr( $new_instance['gt3_contacts_email'] );

        return $instance;
	}

	function form($instance) {
        $defaultValues = array(
            'widget_title' => 'Contact Info',
			'gt3_phone_section_title' => 'Phone Number:',
            'gt3_contacts_phone' => '+1 (800) 456 37 96',
            'gt3_contacts_text' => 'Welcome to our Website. We are glad to have you around. If you need to contact us, you can use the details below.',
			'gt3_location_section_title' => 'Office:',
			'gt3_contacts_office' => '74 West 55 Street, New York, NY',
			'gt3_email_section_title' => 'Email:',
            'gt3_contacts_email' => 'info@yourdomain.com'
        );
        $instance = wp_parse_args((array) $instance, $defaultValues);


	?>
		<table class="fullwidth">
			<tr>
				<td>Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'widget_title' )); ?>' value='<?php echo esc_attr($instance['widget_title']); ?>'/></td>
			</tr>
			<tr>
				<td>Text:</td>
				<td><textarea class="fullwidth contact_textarea" name='<?php echo esc_attr($this->get_field_name( 'gt3_contacts_text' )); ?>'><?php echo esc_attr($instance['gt3_contacts_text']); ?></textarea></td>
			</tr>
			<tr>
				<td>Phone Section Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_phone_section_title' )); ?>' value='<?php echo esc_attr($instance['gt3_phone_section_title']); ?>'/></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_contacts_phone' )); ?>' value='<?php echo esc_attr($instance['gt3_contacts_phone']); ?>'/></td>
			</tr>
			<tr>
				<td>Location Section Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_location_section_title' )); ?>' value='<?php echo esc_attr($instance['gt3_location_section_title']); ?>'/></td>
			</tr>
			<tr>
				<td>Office:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_contacts_office' )); ?>' value='<?php echo esc_attr($instance['gt3_contacts_office']); ?>'/></td>
			</tr>
			<tr>
				<td>Email Section Title:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_email_section_title' )); ?>' value='<?php echo esc_attr($instance['gt3_email_section_title']); ?>'/></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type='text' class="fullwidth" name='<?php echo esc_attr($this->get_field_name( 'gt3_contacts_email' )); ?>' value='<?php echo esc_attr($instance['gt3_contacts_email']); ?>'/></td>
			</tr>
		</table>
	<?php
	}
}

function gt3_contacts_register_widgets() { register_widget( 'gt3_contacts' ); } 
add_action( 'widgets_init', 'gt3_contacts_register_widgets' );

?>