<?php get_header(); ?>
    	<div class="container">
			<div class="wrapper_404 text-center">
				<h1 class="color"><?php echo esc_html__('404', 'elitemasters'); ?></h1>
                <h2><?php echo esc_html__('Oops, Sorry We Can’t Find That Page!', 'elitemasters'); ?></h2>
                <p><?php echo esc_html__('Either Something Get Wrong or the Page Doesn’t Exist Anymore. Visit Our Homepage or Search the Best Match Below.', 'elitemasters'); ?></p>
                <div class="shortcode_subscribe">
					<form name="search_form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input type="text" name="s" value="" placeholder="" />
						<div class="subscribe_btn">
							<input type="submit" value="<?php esc_html_e('Search the Site', 'elitemasters'); ?>" />
						</div>
					</form>
				</div>
            </div>
        </div>                        
<?php get_footer(); ?>