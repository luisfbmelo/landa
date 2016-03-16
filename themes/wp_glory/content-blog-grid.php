<?php
/**
 * The template for displaying Content.
 *
 * @package WordPress
 * @subpackage Goodly
 * @since WD_Responsive
 */
?>
<?php
	global $wd_data;
?>
	<?php	
	$i=0;
	
	$columns = get_post_meta( get_the_ID(), 'blog_grid_columns', true )? get_post_meta(get_the_ID(), 'blog_grid_columns', true): 2;
	
	$span_class = "col-lg-".(24/$columns);
	$span_class .= ' col-md-'.(24/ round( $columns * 992 / 1200));
	$span_class .= ' col-sm-'.(24/round( $columns * 768 / 1200));
	$span_class .= ' col-xs-'.(24/2);
	$span_class .= ' col-mb-12';
	
	$num_count = $wp_query->post_count;
	
	if(have_posts()) : 
	$id_widget = 'list-post-'.rand(0,1000);
	echo '<div id="'. $id_widget .'" class="shortcode-recent-blogs display-flex grid-posts columns-'.$columns.'">';
	while(have_posts()) :
		the_post(); global $post;global $wp_query;
		
		$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
		if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
		}
	?>
		<div class="item <?php echo esc_attr($span_class); ?><?php if( $i == 0 || $i % $columns == 0 ) echo ' first';?><?php if( $i == $num_count-1 || $i % $columns == $columns-1 ) echo ' last';?>">
					
			<div class="item-content<?php echo is_sticky()? ' sticky' : ''?>">
				<?php if( has_post_thumbnail($post->ID) ) : ?>
				<div class="post-info-thumbnail display-flex ">
					<div class="post-icon-box">
						<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-thumb-tack"></i></div>
						<?php endif;?>
						<?php if(isset($_post_config['post_type'])):?>
						<?php 
							switch($_post_config['post_type']){
								case 'video':
									?><div class="sticky-post video"><i class="fa fa-film"></i></div><?php 
									break;
								case 'audio':
									?><div class="sticky-post audio"><i class="fa fa-play-circle-o"></i></div><?php 
									break;
								case 'shortcode':
									?><div class="sticky-post shortcode"><i class="fa fa-cog"></i></div><?php 
									break;
							}
						?>
						<?php endif;?>
						
					</div>
					
					
					<a class="thumbnail effect_color" href="<?php the_permalink(); ?>">
						<?php 
							$post_thumbnail_type = "blog_shortcode_auto";
							the_post_thumbnail( $post_thumbnail_type,array('class' => 'thumbnail-effect-1') );
						?>
									<!--div class="effect_hover_image"></div-->
					</a>
				</div>
				<?php endif;?>
				
				<div class="meta-post post-info-content">
					<h3 class="heading-title"><a href="<?php echo get_permalink($post->ID); ?>" class="wpt_title" title="<?php echo esc_attr(get_the_title($post->ID));?>" ><?php echo get_the_title($post->ID); ?></a></h3>
					<?php  if( !has_post_thumbnail($post->ID) ) :?>
						<div class="post-icon-box">
							<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-thumb-tack"></i></div>
							<?php endif;?>
							<?php if(isset($_post_config['post_type'])):?>
							<?php 
								switch($_post_config['post_type']){
									case 'video':
										?><div class="sticky-post video"><i class="fa fa-film"></i></div><?php 
										break;
									case 'audio':
										?><div class="sticky-post audio"><i class="fa fa-play-circle-o"></i></div><?php 
										break;
									case 'shortcode':
										?><div class="sticky-post shortcode"><i class="fa fa-cog"></i></div><?php 
										break;
								}
							?>
							<?php endif;?>
							</div>
					<?php endif;?>
					
					<div class="post-info-meta-top post-info-meta">
						<?php if( $wd_data['wd_blog_time'] == 1 ) : ?>
						<div class="entry-date"><?php echo get_the_date('F d, Y') ?></div>
						<?php endif;?>
						<?php if( $wd_data['wd_blog_comment_number'] == 1 ) : ?>
						<div class="comments-count"><?php $comments_count = wp_count_comments($post->ID);
						if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
						else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?>
						</div>
						<?php endif;?>
					</div>
					<?php if( $wd_data['wd_blog_excerpt'] == 1 ) : ?>
					<p class="excerpt"><?php 
						$words_limit = ($wd_data['wd_blog_excerpt_words_limit']!=='' && is_numeric($wd_data['wd_blog_excerpt_words_limit']))? absint($wd_data['wd_blog_excerpt_words_limit']): 60;
						the_excerpt_max_words($words_limit,$post); ?>
					</p>
					<?php endif;?>
					<?php if( $wd_data['wd_blog_readmore'] == 1 ) : ?>		
					<a class="button" href="<?php the_permalink(); ?>"><?php _e("Read more", "wpdance");?></a>
					<?php endif;?>
								
				</div>	
			</div>
		</div>
	<?php 	$i++;
	endwhile;
	echo '</div>';
	else : echo "<div class=\"alpha omega\"><div class=\"alert alert-error alpha omega\">Sorry. There are no posts to display</div></div>";
	endif;	
	?>	
	
	<script type='text/javascript'>
			//<![CDATA[
			jQuery(document).ready(function() {
				"use strict";
				jQuery('#<?php echo esc_attr($id_widget);?>').isotope({
					itemSelector: '.item',
					layoutMode: 'masonry'
				});
				jQuery('img').load(function(){
					jQuery('#<?php echo esc_attr($id_widget);?>').isotope({
						itemSelector: '.item',
						layoutMode: 'masonry'
					});
				});
			});
			//]]>	
			</script>