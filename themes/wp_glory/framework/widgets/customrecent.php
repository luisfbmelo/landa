<?php 
if(!class_exists('WP_Widget_Customrecent')){
	class WP_Widget_Customrecent extends WP_Widget {
		public function __construct(){
			$widget_ops = array('description' => 'This widget show recent post in each category you select.' );
			parent::__construct('customrecent', 'WD - Recent Posts', $widget_ops);

		}
		function widget($args, $instance){
			/*global $wpdb;*/ /* call global for use in function*/
			
			$cache = wp_cache_get('customrecent', 'widget');			
			
			if ( ! is_array( $cache ) )
				$cache = array();

			if ( isset( $cache[$args['widget_id']] ) ) {
				echo $cache[$args['widget_id']];
				return;
			}

			ob_start();			
			
			extract($args); // gives us the default settings of widgets
			
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent','wpdance') : $instance['title']);
			
			$link = empty( $instance['link'] ) ? '#' : esc_url($instance['link']);
			$link = ( isset($link) && strlen($link) > 0 ) ? $link : "#" ;
			$show_image = ( isset($instance['show_image']) && strcmp(esc_attr($instance['show_image']), 'yes') == 0)? 1: 0;
			$style = ( isset($instance['style']) )? esc_attr($instance['style']): 'style-1';
			
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			
			echo $before_widget; // echos the container for the widget || obtained from $args
			if($title){
				echo $before_title . $title . $after_title;
			}
			
			wp_reset_query();
			wp_reset_postdata();	
			rewind_posts();			
			
			$num_count = count(query_posts("showposts={$_limit}&ignore_sticky_posts=1&post_type=post"));	
			if(have_posts())	{
				$id_widget = 'recent-'.rand(0,1000);
				echo '<ul class="recentposts" id="'.$id_widget.'">';
				$i = 0;
				while(have_posts()) {the_post();global $post;
					?>
					<li class="item<?php if($i == 0) echo ' first';?><?php if(++$i == $num_count) echo ' last';?> <?php echo esc_attr($style);?>">
						<div class="media">
							<?php if ( $show_image && has_post_thumbnail() ):?>
							<div class="wd_post_thumbnail">
								<a href="<?php the_permalink(); ?>" class="effect_color">
									<?php if(has_post_thumbnail()): ?>
										<?php 
										if( strcmp( $style, 'style-1' ) == 0 ) 
											echo get_the_post_thumbnail( $post->ID, 'blog_recent');
										else echo get_the_post_thumbnail( $post->ID, 'blog_recent_2');
										?>
									<?php else:?>
										<img alt="<?php the_title(); ?>" height="98" width="240" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
									<?php endif; ?>
								</a>
							</div>
							<?php endif;?>
							<div class="detail">
								<div class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
										<?php echo esc_attr(get_the_title()); ?>
									</a>
								</div>
								<p class="entry-meta">
									<?php
										if( strcmp( trim( $style ), 'style-1' ) == 0 ) echo get_the_date('F d, Y');
										else {
										?>
										<span><i class="fa fa-calendar-o"></i> <?php echo get_the_date('M d, Y');?></span>
										<span><i class="fa fa-comments-o"></i> <?php 
											$comments_count = wp_count_comments($post->ID);
											if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
											else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?></span>
										<?php 
										}
									?>
								</p>
								
							</div><!-- .detail -->
						</div>
					</li>
				
					
				<?php }
				echo '</ul>';
			}
			wp_reset_query();
			
			echo $after_widget; // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo $content;

			wp_cache_set('customrecent', $cache, 'widget');			
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {        

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'From Our Blog','link'=>'#', 'show_image' => 'yes','limit'=>4, 'style'=>'style-1') );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$link = esc_url( $instance['link'] );
			$show_image = esc_attr( $instance['show_image'] );
			$style = esc_attr( $instance['style'] );
			
			?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Title Link','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Style','wpdance' ); ?> : </label>
			<select class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<option value="style-1" <?php echo strcmp('style-1', esc_attr($style)) == 0? "selected": ''?>>Style 1</option>
				<option value="style-2" <?php echo strcmp('style-2', esc_attr($style)) == 0? "selected": ''?>>Style 2</option>
			</select></p>
			
			<p><label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show Image','wpdance' ); ?> : </label>
			<select class="widefat" id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>">
				<option value="yes" <?php echo strcmp('yes', esc_attr($show_image)) == 0? "selected": ''?>>Yes</option>
				<option value="no" <?php echo strcmp('no', esc_attr($show_image)) == 0? "selected": ''?>>No</option>
			</select></p>
			
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" min="2" max="10" value="<?php echo esc_attr($limit); ?>" /></p>
			
	<?php
		   
		}
	}
}
?>