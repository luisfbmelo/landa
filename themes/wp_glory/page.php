<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */
get_header();
global $page_datas,$post;

$page_title = '<h1 class="heading-title page-title">'.get_the_title().'</h1>';

$brd_data = array(
		'has_breadcrumb'	=> (isset($page_datas['hide_breadcrumb']) && absint($page_datas['hide_breadcrumb']) == 0),
		'has_page_title' 	=> ( (!is_home() && !is_front_page()) && absint($page_datas['hide_title']) == 0 ),
		'title'				=> $page_title,
);
wd_printf_breadcrumb($brd_data);

?>
<?php
	
	$_layout_config = explode("-",$page_datas['page_column']);
	$_left_sidebar = (int)$_layout_config[0];
	$_right_sidebar = (int)$_layout_config[2];
	$_main_class = ( $_left_sidebar + $_right_sidebar ) == 2 ? "col-sm-12" : ( ( $_left_sidebar + $_right_sidebar ) == 1 ? "col-sm-18" : "col-sm-24" );		
?>

<div id="wd-container" class="content-wrapper page-template container">
	
	<div id="content-inner" class="row">
		<?php if( $_left_sidebar ): ?>
			<div id="left-content" class="col-sm-6">
				<div class="sidebar-content wd-sidebar">
					<?php
						if ( is_active_sidebar( $page_datas['left_sidebar'] ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( $page_datas['left_sidebar'] ); ?>
							</ul>
					<?php endif; ?>
				</div>
			</div><!-- end left sidebar -->		
			<?php wp_reset_query();?>
		<?php endif;?>	
		<div id="main-content" class="<?php echo esc_attr($_main_class);?> container">
			<?php
				// Start the Loop.
				if( have_posts() ) : the_post();
					get_template_part( 'content', 'page' );	
				endif;
			?>
		</div><!-- end content -->
		<?php if( $_right_sidebar ): ?>
			<div id="right-content" class="col-sm-6">
				<div class="sidebar-content wd-sidebar">
				<?php
					if ( is_active_sidebar( $page_datas['right_sidebar'] ) ) : ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( $page_datas['right_sidebar'] ); ?>
						</ul>
				<?php endif; ?>
				</div>
			</div><!-- end right sidebar -->
			<?php wp_reset_query();?>
		<?php endif;?>
	</div><!-- end container -->
</div><!-- #main-content -->

<?php
get_footer();
