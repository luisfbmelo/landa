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
<ul class="list-posts post-personal-style">
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
		
		$blog_gallery = get_post_meta($post->ID, THEME_SLUG.'post_thumb_shortcode', true);
		$thumbnail_url = '';
		if( strcmp( trim($blog_gallery), 'breadcrumb' ) == 0 && has_post_thumbnail() ) {
			$thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			$thumbnail_url = "background: url({$thumbnail_url}) center center no-repeat;";
		}
		?>
		<li <?php post_class("home-features-item". esc_attr($_sub_class));?>>
			
			<div class="item-content<?php echo strcmp( trim($blog_gallery), 'breadcrumb' ) == 0? " breadcrumb": '';?>" style="<?php echo esc_attr($thumbnail_url);?>">
				
				<?php if( strlen( $thumbnail_url ) === 0 ): /*if not breadcrumb*/?>
				<div class="post-header">
					<div class="post-title">
						<?php if(is_sticky()): ?>
							<div class="sticky-post"><i class="fa fa-star-o"></i></div>
						<?php endif;?>
								
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
							<div class="entry-date"><i class="fa fa-calendar-o"></i> <?php echo get_the_date('F d, Y'); ?></div>
						<?php endif;?>
						
						<?php if( $wd_data['wd_blog_comment_number'] == 1 ) : ?>	
							<div class="comments-count"><i class="fa fa-comments-o"></i> <?php $comments_count = wp_count_comments($post->ID);
							if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
							else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?></div>
						<?php endif;?>
						
						<div class="post-cats"><i class="fa fa-pencil-square-o"></i> <?php _e( 'Category:', 'wpdance' );?> <?php echo get_the_category_list( ', ' ); ?></div>

					</div>
				</div>
			
				<?php if( has_post_thumbnail($post->ID) ) : ?>
				<div class="post-info-thumbnail">
					
					<div class="thumbnail-content">
						
						<?php 
							
							if( isset( $blog_gallery ) && !empty($blog_gallery) && $blog_gallery !=='breadcrumb' ) {
								echo "<div class=\"post-shortcode-thumb\">";
								echo do_shortcode( $blog_gallery );
								echo "</div><!--.post-shortcode-thumb-->";
							} elseif( isset($_post_config['post_type']) && strcmp( trim( $_post_config['post_type'] ), 'video' ) == 0 && isset($_post_config['video_url']) ){
								echo wd_get_embbed_video( $_post_config['video_url'], $_post_config['video_width'], $_post_config['video_height'] );
								
							} else{
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
					</div><!--.thumbnail-content-->
					
			</div>
			<?php endif;?>
			<?php endif; /*endif not breadcrumb*/?>
			
			<div class="post-info-content">
				
				<?php if( $wd_data['wd_blog_excerpt'] == 1 ) : 
					$words_limit = ($wd_data['wd_blog_excerpt_words_limit']!=='' && is_numeric($wd_data['wd_blog_excerpt_words_limit']))? absint($wd_data['wd_blog_excerpt_words_limit']): 60;
				?>
					<div class="short-content"><?php 
						$excerpt = get_the_excerpt();
						echo do_shortcode($excerpt);
					?></div>
				<?php endif; ?>
				<?php if( $wd_data['wd_blog_readmore'] == 1 && strcmp( trim($blog_gallery), 'breadcrumb' ) !== 0 ) : ?>
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