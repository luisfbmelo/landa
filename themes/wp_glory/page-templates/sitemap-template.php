<?php
/*
*	Template Name: Sitemap Template
*/
get_header(); ?>

<?php global $page_datas;?>

	<?php 
	
	$page_title  = '<h1 class="heading-title page-title">';
	$page_title .= get_the_title();
	$page_title .= '</h1>';
	$brd_data = array(
		'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
	);
	wd_printf_breadcrumb($brd_data);
	
	?>

		<div id="wd-container" class="content-wrapper page-template container">
			<div id="content-inner" class="row" role="main">
				<div class="col-main" id="main-content">
					<div class="sitemap-content entry-content">
						<div class="col-sm-24">
								<?php the_content();?>
						</div>
						<!--Page-->
						<div class="col-sm-6">  
							<h3 class="heading-title"><?php _e( 'Pages', 'wpdance' ); ?></h3><div class="line line-30"></div>
							<ul class='sitemap-archive'>
								<?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>
							</ul>
						</div>
		
						<!--Categories-->
						<div class="col-sm-6">
							<h3 class="heading-title"><?php _e('Categories', 'wpdance'); ?></h3><div class="line line-30"></div>
							<ul class='sitemap-archive wp-categories'>
								<?php 
								wp_reset_query();	
								wp_list_categories('title_li=&show_count=true'); ?>
							</ul>
						</div>
						
						<!--Posts per category-->
						<div class="col-sm-12">
							<h3 class="heading-title"><?php _e( 'Posts per category', 'wpdance' ); ?></h3><div class="line line-30"></div>
							<?php
					
								$cats = get_categories();
								wp_reset_query();
								foreach ( $cats as $cat ) {
									query_posts( 'cat=' . $cat->cat_ID );
							?>
							<ul class='sitemap-archive' >
							<li class="cat-item"><strong class="text-uppercase"><?php echo $cat->cat_name; ?></strong>
							<ul class="children">
								<?php while ( have_posts() ) { the_post(); ?>
								 <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php _e( 'Comments', 'wpdance' ); ?> (<?php echo $post->comment_count; ?>)</li>
								 <?php }  ?>
							</ul></li>
							</ul>
							<?php } ?>
						</div>			
					</div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>