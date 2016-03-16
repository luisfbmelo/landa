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
<ul class="list-posts <?php echo isset($wd_data['wd_blog_list_style']) && strcmp( $wd_data['wd_blog_list_style'], 'def' ) !== 0? esc_attr($wd_data['wd_blog_list_style']): '';?>">
	<?php	
	$count=0;
	if(have_posts()) : while(have_posts()) : the_post(); global $post;$count++;global $wp_query;
			if($count == 1) 
				$_sub_class =  " first";
			if($count == $wp_query->post_count) 
				$_sub_class = " last";
				
		$_post_config = get_post_meta($post->ID,THEME_SLUG.'custom_post_config',true);
		if( strlen($_post_config) > 0 ){
			$_post_config = unserialize($_post_config);
		}
		?>
		<li <?php post_class("home-features-item". esc_attr($_sub_class));?>>
			<div class="item-content">
			<?php if( has_post_thumbnail($post->ID) ) : ?>
			<div class="post-info-thumbnail">
				
					<div class="thumbnail-content">
						<div class="post-icon-box">
							<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-star-o"></i></div>
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
						
						<?php 
							$video_url = get_post_meta( $post->ID, THEME_SLUG.'url_video', true);
							if( $video_url!= ''){
								echo wd_get_embbed_video( $video_url, 420, 300 );
							}
							else{
								?>
									<a class="thumbnail effect_color effect_color_1" href="<?php the_permalink() ; ?>">
									<?php 
										if ( has_post_thumbnail($post->ID) ) {
											the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog')); 
										} else { ?>
											<img alt="<?php the_title(); ?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
									<?php	}										
									?>
									<div class="effect_hover_image"></div>									
									</a>
								<?php
							}
						?>	
					</div>
				
			</div>
			<?php endif;?>
			<div class="post-info-content">
				<div class="post-title">
					<h2 class="heading-title"><a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a></h2>
					<?php  if( !has_post_thumbnail($post->ID)) :?>
							<div class="post-icon-box">
							<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-star-o"></i></div>
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
					<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
					
				</div>
				<div class="post-info-meta">	
					<?php if( $wd_data['wd_blog_time'] == 1 ) : ?>	
						<div class="entry-date"><?php echo get_the_date('F d, Y'); ?></div>
					<?php endif;?>
					
					<?php if( $wd_data['wd_blog_comment_number'] == 1 ) : ?>	
						<div class="comments-count"><?php $comments_count = wp_count_comments($post->ID);
						if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
						else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?></div>
					<?php endif;?>

				</div>
				<?php if( $wd_data['wd_blog_excerpt'] == 1 ) : 
					$words_limit = ($wd_data['wd_blog_excerpt_words_limit']!=='' && is_numeric($wd_data['wd_blog_excerpt_words_limit']))? absint($wd_data['wd_blog_excerpt_words_limit']): 60;
				?>
					<div class="short-content"><?php the_excerpt_max_words($words_limit,$post); ?></div>
				<?php endif; ?>
				<?php if( $wd_data['wd_blog_readmore'] == 1 ) : ?>
					<div class="read-more"><a class="button" href="<?php the_permalink() ; ?>"><?php _e('Read more','wpdance'); ?></a></div>
				<?php endif; ?>					
				
				<?php wp_link_pages(); ?>
				</div>
			</div><!-- end post ... -->
		</li>
	<?php						
	endwhile;
	else : echo "<div class=\"alpha omega\"><div class=\"alert alert-error alpha omega\">Sorry. There are no posts to display</div></div>";
	endif;	
	?>	
</ul>