<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */

get_header();

$page_title  = '<h1 class="heading-title page-title">';
$page_title .= get_the_title();
$page_title .= '</h1>';
$brd_data = array(
	'has_breadcrumb'	=> true,
	'has_page_title' 	=> ( apply_filters( 'woocommerce_show_page_title', true ) ),
	'title'				=> $page_title,
);
wd_printf_breadcrumb($brd_data);
	
?>
	
	<div id="wd-container" class="blog-template content-wrapper content-area container">
		<div id="content-inner" class="row">
			<?php
				global $wd_data;
				
				$_layout_config = explode("-",'0-1-0');
				$_left_sidebar = (int)$_layout_config[0];
				$_right_sidebar = (int)$_layout_config[2];
				$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );
			?>
			
			<div id="main-content" class="<?php echo esc_attr( $_main_class) ?>">	
				
				<div class="single-content">
					<?php	
						if(have_posts()) : while(have_posts()) : the_post(); 
						global $post,$wd_data;										
						?>
								<div class="custom_code">
									<?php if( isset($wd_data['wd_top_blog_code']) && $wd_data['wd_top_blog_code'] != 'null') echo stripslashes($wd_data['wd_top_blog_code']);?>
								</div>
							
							<?php if( 1||$data['wd_blog_details_thumbnail'] == 1 ) : ?>
									<div class="thumbnail">
										<?php 
											$video_url = get_post_meta( $post->ID, THEME_SLUG.'url_video', true);
											if( $video_url!= ''){
												echo get_embbed_video( $video_url, 280, 246 );
											}
											else{
												?>
												<div class="image">
													
													<?php 
														if ( has_post_thumbnail() ) {
															the_post_thumbnail('blog_single',array('class' => 'thumbnail-blog'));
															
														} 			
													?>	
														
												</div>
												<?php
											}
										?>	
									</div>
								<?php endif;?>
							<div class="post-title">
								<h2 class="heading-title"><?php the_title(); ?></h2>
								<div class="navi">
									<div class="navi-next"><?php next_post_link('%link', 'Next'); ?></div>
									<div class="navi-prev"><?php previous_post_link('%link', 'Previous'); ?> </div>
								</div>
								<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
							</div>	
							
							<div <?php post_class("single-post");?>>
								
								<div class="post_inner">	
								
									<div class="post-info-meta-top post-info-meta">
										<?php if( absint($wd_data['wd_blog_details_time']) == 1 ) : ?>			
											<div class="entry-date"><?php echo get_the_date('F d, Y') ?></div>
										<?php endif; ?>

										<?php if( absint($wd_data['wd_blog_details_comment']) == 1 ) : ?>
											<div class="comments-count"><?php $comments_count = wp_count_comments($post->ID);
											if(absint($comments_count->approved) == 0) echo absint($comments_count->approved) . ' ' . __('Comment', 'wpdance');
											else echo absint($comments_count->approved) . ' ' . _n( "Comment", "Comments", absint($comments_count->approved), 'wpdance');?></div>
										<?php endif; ?>
									</div>
									
								
									
									<div class="post-info-content">
										<div class="post-description"><?php the_content(); ?></div>
										
										<?php wp_link_pages(); ?>
										
									</div>
											
								</div>
								<div class="post-info-meta-bottom">	
								<!--Category List-->
									<?php if( $wd_data['wd_blog_details_categories'] == 1 ) : ?>
										<?php 
										
										$cat_post =  wp_get_post_terms(get_the_ID(),'wd-portfolio-category');
										//print_r($cat_post);										
										if(is_array($cat_post)){
											$categories = '';
											foreach($cat_post as $cat){
													$temp  = '<a href="'.get_term_link($cat->slug,$cat->taxonomy).'">'.$cat->name.'</a>'. ', ';
													$categories .= $temp ;
											}      
										}
										$categories = substr($categories,0,-2) .''  ;
										
										if ( $categories ){
										?>
											<div class="categories">
												<span class="cat-links">
													<?php printf( __( '<span class="%1$s heading-title">Categories:</span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories );?>
												</span>
											</div>
											<?php
										}
										
									 endif;?>	
									
									<?php if( absint($wd_data['wd_blog_details_tags']) == 1 ) : ?>
										<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
										<?php
											/* translators: used between list items, there is a space after the comma */
											$tags_list = get_the_tag_list('',', ','');
											 
											if ( $tags_list ):
											?>
												<div class="tags">
													<span class="tag-title"><?php _e('Tags','wpdance');?></span>
													<span class="tag-links">
														<?php //_e( '<span class="entry-utility-prep entry-utility-prep-tag-links"></span>'.$tags_list, 'wpdance' );  ?>
														<?php printf( __( '<span class="%s"></span>: %s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
														$show_sep = true; ?>
													</span>
													
													<?php if( absint($wd_data['wd_blog_details_socialsharing']) == 1 ) : ?>
														<ul  class="share-list">
															<li>
																<div id="fb-root"></div>
																<script>(function(d, s, id) {
																  var js, fjs = d.getElementsByTagName(s)[0];
																  if (d.getElementById(id)) return;
																  js = d.createElement(s); js.id = id;
																  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
																  fjs.parentNode.insertBefore(js, fjs);
																}(document, 'script', 'facebook-jssdk'));</script>
																<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
															</li>
															
															<li>
																<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink();?>">Tweet</a>
																<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
															</li>
															
															<li>
																<script src="https://apis.google.com/js/platform.js" async defer></script>
																<div class="g-plusone" data-size="medium"></div>
															</li>
															
														</ul>
													<?php endif;?>
												</div>
											<?php endif; // End if $tags_list ?>
										<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>
									<?php endif; ?>
									
									
																				
								</div>
							</div>
							
								
								<?php if( absint($wd_data['wd_blog_details_authorbox']) == 1 ) : ?>
									<div id="entry-author-info">
										<div class="author-inner">
											<div id="author-avatar" class="image-style">
												<?php echo get_avatar( get_the_author_meta( 'user_email' ), 133, '' ); ?>
											</div><!-- #author-avatar -->		
											<div class="author-desc">		
												<ul class="author-detail">
													<li class="first"><?php the_author_posts_link();?></li>
													<li class="second">
														<?php echo get_user_role(get_the_author_meta('ID'));?>
													</li>
												</ul>
												<p><?php the_author_meta( 'description' ); ?><p>
											</div>
										</div><!-- #author-inner -->
									</div><!-- #entry-author-info -->
								<?php endif; ?>	
								<?php if( absint($wd_data['wd_blog_details_related']) == 1 ) : ?>
									<?php 
										get_template_part( 'templates/related_posts' );
									?>
								<?php endif;?>
								
								<?php comments_template( '', true );?>
								<div class="custom-bottom-code">
								<?php if($wd_data['wd_bottom_blog_code'] != 'null') echo stripslashes($wd_data['wd_bottom_blog_code']);?>	
								</div>
							
						<?php						
						endwhile;
						endif;	
						wp_reset_query();
					?>	
				</div>
				
			</div>
			
		</div>
	</div><!-- #primary -->

<?php
get_footer();
