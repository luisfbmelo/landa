<?php 
if(!class_exists('WP_Widget_Recent_Post_Slider')){
	class WP_Widget_Recent_Post_Slider extends WP_Widget {
		public function __construct(){
			$widget_ops = array('description' => 'This widget show recent posts by slider.' )
			parent::__construct('recent_post_slider', 'WD - Recent Posts [Slider]', $widget_ops);

		}
		
		function widget($args, $instance){
			/*global $wpdb;*/ // call global for use in function
			
			
			$cache = wp_cache_get('recent_post_slider', 'widget');			
			
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
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			
			echo $before_widget; // echos the container for the widget || obtained from $args
			if($title){
				echo $before_title . $title . $after_title;
			}
			wp_reset_query();	
			$num_count = count(query_posts("showposts={$_limit}&ignore_sticky_posts=1"));	
			echo '<div class="recent_list_carousel height_auto">';
			if(have_posts())	{
				$id_widget = 'recent-'.rand(0,1000).time();
				echo '<div class="wd_recent_posts_'.$id_widget.'">';
				$i = 0;
				while(have_posts()) {the_post();global $post;
					?>
					<div class="item<?php //if($i == 0) echo ' first';?><?php //if(++$i == $num_count) echo ' last';?>">
						<div class="detail">
							<div class="post_thumbnail_wrapper">
								<div class="post_thumbnail">
									<a href="<?php the_permalink(); ?>" class="effect_color">
									<?php if(has_post_thumbnail()){ ?>
										<?php // the_post_thumbnail(array(240,98),array('title'=>get_the_title()));?>
										<?php echo get_the_post_thumbnail( $post->ID, 'blog_recent');?>
									<?php } else { ?>	
										<img alt="<?php the_title(); ?>" height="70" width="100" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
									<?php } ?>
									</a>
								</div>
								<div class="wd_recent_date">
									<span class="entry-date-year"><?php echo get_the_date('Y') ?></span>
									<p><span class="entry-date-month"><?php echo get_the_date('M') ?></span><span class="entry-date-day"><?php echo get_the_date('d') ?></span> </p>
								</div>
							</div>
							<div class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php echo esc_attr(get_the_title()); ?>
								</a>
								<p class="entry-desc">
									<?php echo the_excerpt_max_words(10,$post);?>
								</p>
							</div>
							<div class="author"><?php _e('POST BY','wpdance');?> <?php the_author_posts_link();?></div>
						</div><!-- .detail -->
						
					</div>
				
					
				<?php }
				echo '</div>';
				echo '<div class="clearfix"></div>';
			}
			echo '</div>';
			
			wp_reset_query();
			
			echo $after_widget; // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo $content;

			wp_cache_set('recent_post_slider', $cache, 'widget');			
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {        

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'From Our Blog','link'=>'#','limit'=>4) );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$link = esc_url( $instance['link'] );
			?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Title Link','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>
			
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($limit); ?>" /></p>
			
	<?php
		   
		}
	}
}
?>