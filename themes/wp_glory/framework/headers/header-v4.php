<?php global $wd_data, $page_datas;?>

<div class="wd-sticky animated" id="wd-sticky">
	<div class="header-middle hidden-xs" style="float: none;">
		<div class="header-middle-content">
			<div class="container">
				<div class="row">
					<div class="header-middle-left col-sm-6">
					<?php theme_logo();?>
					</div>
					<div class="header-middle-right col-sm-18">						
						<?php wd_get_search_form(); ?>
						<div class="shopping-cart shopping-cart-wrapper hidden-xs <?php echo ( isset($wd_data['wd_enable_cart_header_top']) && !absint($wd_data['wd_enable_cart_header_top']) )? 'wd_cart_disable':'';?>">
							<?php if( !isset($wd_data['wd_enable_cart_header_top']) || absint($wd_data['wd_enable_cart_header_top']) ) echo wd_tini_cart();?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div><!-- end .header-middle -->	
	<?php wp_reset_query();?>

	<div class="header-bottom hidden-xs" style="float:none;" id="header-bottom">
		<div class="header-bottom-content">
			<div class="container">
				<div class="row">
					<?php $toggle_class = (is_page() && isset($page_datas['toggle_vertical_menu']) && absint($page_datas['toggle_vertical_menu']) == 0 && !wp_is_mobile() )? 'no_toggle': 'toggle_active'; 
					
					?>
					<div class="col-sm-3 col-md-6 col-xs-24">
						<div class="wd_vertical_cat <?php echo isset( $wd_data['wd_vertical_menu_scroll_style'] )? esc_attr($wd_data['wd_vertical_menu_scroll_style']): ''; ?> wd_vertical_control <?php echo esc_attr($toggle_class);?>">
							<?php echo isset($wd_data['wd_vertical_menu_heading'])? $wd_data['wd_vertical_menu_heading']: __('Categories', 'wpdance');?>
						</div>
					</div>
					<div class="nav wd_mega_menu_wrapper col-sm-21 col-md-18 col-xs-24">
						<?php 
							if ( has_nav_menu( 'primary' )) {
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary','walker' => new WD_Walker_Nav_Menu() ) );
							}else{
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper', 'walker' => new WD_Walker_Nav_Menu() ) );
							}
						?>
					</div>
								<!--div class="static_slideshow">
									<?php
										if ( is_active_sidebar( 'wd-header-middle-slidshow-wider-area' ) ) : ?>
										<ul class="xoxo">
											<?php //dynamic_sidebar( 'wd-header-middle-slidshow-wider-area' ); ?>
										</ul>
									<?php endif; ?>
								</div-->
					
				</div>
			</div>
		</div>
	</div><!-- end .header-bottom -->
	
	
</div><!-- #wd-sticky -->

<?php 
if(!is_page() || (!isset($page_datas['toggle_vertical_menu']) || absint($page_datas['toggle_vertical_menu']) == 1 ) || wp_is_mobile() ) {
	$hide_class = 'hide';
	$left_ = " col-sm-6 col-xs-24";
	$right_ = " col-sm-24 col-xs-24";
} else {
	$hide_class = '';
	$left_ = " col-sm-6 col-xs-24";
	$right_ = " col-sm-18 col-xs-24";
}

	$slideshow_show = (!is_page() || (!isset($page_datas['toggle_vertical_menu']) || absint($page_datas['toggle_vertical_menu']) == 1 ) )? false: true;
?>

	<div class="header-static-slideshow">
		<div class="container">
			<div class="row">
				<div class="wd_vertical_box <?php echo esc_attr($hide_class . $left_);?>">
					<div class="nav wd_vertical_cat_content <?php echo isset( $wd_data['wd_vertical_menu_scroll_style'] )? esc_attr($wd_data['wd_vertical_menu_scroll_style']): ''; ?> <?php echo esc_attr($toggle_class)?> animated">
						<div class="wd_vertical_control_sticky" style="display: none;"><i class="fa fa-bars"></i></div>
						<?php 
							if ( has_nav_menu( 'vertical_menu' ) ) {
								wp_nav_menu( array( 'container_class' => 'vertical-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'vertical_menu','walker' => new WD_Walker_Nav_Menu() ) );
							}else{
								wp_nav_menu( array( 'container_class' => 'vertical-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'vertical_menu' ) );
							}
						?>
					</div>
				</div>
				<?php if($slideshow_show):?>
				<div class="static_slideshow <?php echo esc_attr($right_);?>">
					<?php
						if ( is_active_sidebar( 'wd-header-middle-slidshow-wider-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-middle-slidshow-wider-area' ); ?>
							</ul>
						<?php endif; ?>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>