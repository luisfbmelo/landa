<?php 
if(!class_exists('WP_Widget_Instagram')){
	class WP_Widget_Instagram extends WP_Widget {
		public function __construct(){
			$widget_ops = array('description' => 'This widget show recent products in each category you select.' );
			parent::__construct('wd_instagram', 'WD - Instagram', $widget_ops);

		}
	  
		function widget($args, $instance){
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
			$limit = absint($instance['num_popular']);
			$instag_user = esc_attr( $instance['instag_user'] );
			
			if( strlen( $instag_user ) > 0 ) {
				$instagram = new Instagram(array(
					'apiKey'      => '5a9055959fc847e79466bda92f3ec685',
					'apiSecret'   => '42c523441bca4cac89be952e1a519f1a',
					'apiCallback' => ''
				));
				
				$user = $instagram->searchUser( $instag_user );
				$media = $instagram->getUserMedia( $user->data[0]->id, $limit );
			} else {
				return;
			}
			
			$rand_id = "wd_instagram_". rand(0,1000);
			
			?>
			<div class="wd_instagram_photos_slider" id="<?php echo esc_attr( $rand_id );?>">
				<?php 
				foreach( $media->data as $photo ){
				?>
				<a target="_blank" title="<?php echo esc_attr( $photo->caption );?>" href="<?php echo esc_url( $photo->link );?>">
				<img src="<?php echo esc_url( $photo->images->low_resolution->url );?>" alt="instag image" />
				</a>
				<?php }?>
			</div>

			<script type='text/javascript'>
			//<![CDATA[
				jQuery(document).ready(function() {
					"use strict";
					var temp_visible = 4;
					
					var row = 1;
					var item_width = 70;
					
					var show_nav = true;
					var prev,next,pagination;

					var show_icon_nav = false;
					
					var object_selector = "#<?php echo $rand_id?>";
                    var autoplay = false;
					generate_horizontal_slide(temp_visible,row,item_width,show_nav,show_icon_nav,autoplay,object_selector, true, [2,2,3,4,4]);
				});
			//]]>	
			</script>
			<?php 
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '' , 'limit' => 6, 'instag_user' => '' ) );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$instag_user = esc_attr( $instance['instag_user'] );
			
			?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:','wpdance' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('instag_user'); ?>"><?php _e( 'Username:','wpdance' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instag_user'); ?>" name="<?php echo $this->get_field_name('instag_user'); ?>" type="text" value="<?php echo $instag_user; ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit:','wpdance' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $limit; ?>" /></p>
			<?php 
		}
	}
}
?>