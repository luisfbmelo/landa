<?php get_header(); ?>
<?php	
global $wd_data, $page_datas;
$_layout_config = explode("-",$wd_data['wd_forum_layout']);
$_left_sidebar = (int)$_layout_config[0];
$_right_sidebar = (int)$_layout_config[2];
$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
$main_content_layout = 'wd_wide';
?>

<?php 
	$has_breadcrumb = (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0);
	$has_page_title = ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 );
	if( $has_breadcrumb || $has_page_title ){
		global $wd_data;
		$style = ''; $break_pace ="";$height ='';
		if( isset($wd_data['wd_bg_breadcrumbs']) && $wd_data['wd_bg_breadcrumbs'] != '' ){
			if(isset($wd_data['wd_header_style']) && $wd_data['wd_header_style'] == 'v2' && !wp_is_mobile()) $height = "height: 330px;";
			$style = 'style="background: url('.esc_url($wd_data['wd_bg_breadcrumbs']).'); '.trim($height).'"';
		}
		if(isset($wd_data['wd_header_style']) && $wd_data['wd_header_style'] == 'v2' && !wp_is_mobile()){
			$break_pace = "<div style=\"height: 116px; width: 100%;\"></div>";
		}
		
		echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.trim($style).'>';
		echo $break_pace;
		if( $has_page_title ) echo '<h1 class="heading-title page-title">'.get_the_title().'</h1>';
		wd_bbp_breadcrumb();
		echo '</div></div>';
	}
	?>



<div id="wd-container" class="forum-template thanhdoi content-wrapper container <?php echo esc_attr($main_content_layout); ?>">
	<div id="content-inner" class="row">
	<?php if( $_left_sidebar == 1 ): ?>
		<div id="left-content" class="col-sm-6">
			<div class="sidebar-content wd-sidebar">
				<?php
					if ( is_active_sidebar( $wd_data['wd_forum_left_sidebar'] ) ) : ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( $wd_data['wd_forum_left_sidebar'] ); ?>
						</ul>
				<?php endif; ?>
			</div>
		</div><!-- end left sidebar -->		
	<?php wp_reset_query();?>
	<?php endif;?>	
		<div id="main-content" class="<?php echo esc_attr( $_main_class );?>">					
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content-post">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="forum-links">' . __( 'Forums:', 'wpdance' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</div><!-- #post -->					
		</div><!-- end content -->
		
	<?php if( $_right_sidebar == 1): ?>
		<div id="right-content" class="col-sm-6">
			<div class="sidebar-content wd-sidebar">
			<?php
				if ( is_active_sidebar( $wd_data['wd_forum_rigth_sidebar']) ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar( $wd_data['wd_forum_rigth_sidebar'] ); ?>
					</ul>
			<?php endif; ?>
			</div>
		</div><!-- end right sidebar -->
		<?php wp_reset_query();?>
	<?php endif;?>	
		
	</div>	
</div><!-- #container -->
<?php get_footer(); ?>