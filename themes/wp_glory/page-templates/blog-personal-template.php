<?php
/**
 *	Template Name: Blog Personal Template
 */	
get_header(); ?>

	<?php 
	global $page_datas, $wd_data;
	$has_breadcrumb = (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0);
	$has_page_title = ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 );
	$page_title  = '<h1 class="heading-title page-title">';
	$page_title .= get_the_title();
	$page_title .= '</h1>';
	
	$brd_data = array(
		'has_breadcrumb'	=> $has_breadcrumb,
		'has_page_title' 	=> $has_page_title,
		'title'				=> $page_title,
	);
	wd_printf_breadcrumb($brd_data);
	
	if( isset($page_datas) ){
		$_layout_config = explode("-", $page_datas['page_column']);
		$_left_sidebar_name = $page_datas['left_sidebar'];
		$_right_sidebar_name = $page_datas['right_sidebar'];
	} else {
		$_layout_config = explode("-", $wd_data['wd_blog_layout']);
		$_left_sidebar_name = $wd_data['wd_blog_left_sidebar'];
		$_right_sidebar_name = $wd_data['wd_blog_right_sidebar'];
	}
	$_left_sidebar = (int)$_layout_config[0];
	$_right_sidebar = (int)$_layout_config[2];
	$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
	
	?>
	
		<div id="wd-container" class="page-template blog-personal-template container">
			
			<div id="content-inner" class="row">
				<?php if( $_left_sidebar ): ?>
						<div id="left-content" class="col-sm-6">
							<div class="sidebar-content wd-sidebar">
								<?php
									if ( is_active_sidebar( $_left_sidebar_name ) ) : ?>
										<ul class="xoxo">
											<?php dynamic_sidebar( $_left_sidebar_name ); ?>
										</ul>
								<?php endif; ?>
							</div>
						</div>
					<?php wp_reset_query();?>
				<?php endif;?>					
				
				<div id="main-content" class="<?php echo esc_attr($_main_class);?>">
					<div class="main-content">				
						
						<?php	
							$count=0;
							global $wp_query;
							query_posts('post_type=post'.'&paged='.get_query_var('page'));			
							get_template_part( 'content', 'personal' ); 
						?>
						
						<div class="page_navi">
							<div class="nav-content"><div class="wp-pagenavi"><?php ew_pagination();?></div></div>
							<?php wp_reset_query();?>
						</div>

					</div>
				</div>
				
				
				<?php if( $_right_sidebar ): ?>
					<div id="right-content" class="col-sm-6">
						<div class="sidebar-content wd-sidebar">
						<?php
							if ( is_active_sidebar( $_right_sidebar_name ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( $_right_sidebar_name ); ?>
								</ul>
						<?php endif; ?>
						</div>
					</div>
					<?php wp_reset_query();?>
				<?php endif;?>		
		
			</div>
		</div>
		
		<div class="page-content">
			<div class="content-inner"><?php the_content();?></div>
		</div>
		
<?php get_footer(); ?>