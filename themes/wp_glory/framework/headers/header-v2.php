<div class="wd-sticky" id="wd-sticky">
	<div class="container">
	<div class="row">
	
<div class="header-middle hidden-xs col-sm-4">
	<div class="header-middle-content">
		<?php theme_logo();?>
		
		<div class="clear"></div>
	</div>
</div><!-- end .header-middle -->	
<?php wp_reset_query();?>


<div class="header-bottom hidden-xs col-sm-20" id="header-bottom">
	<div class="header-bottom-content">
		<div class="container">
			<div class="nav wd_mega_menu_wrapper">
				<?php 
					if ( has_nav_menu( 'primary' )) {
						wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary','walker' => new WD_Walker_Nav_Menu() ) );
					}else{
						wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper', 'walker' => new WD_Walker_Nav_Menu() ) );
					}
				?>
				
				<div class="wd-header-bottom-search-control" style="position: relative;">
					<span class="wd-open-control-panel" data-position="right" data-element=".wd-search-box"><i class="fa fa-search"></i></span>
					<?php global $wd_data;
					if( isset($wd_data['wd_tini_cart_pos']) && strcmp( $wd_data['wd_tini_cart_pos'], 'menu' ) ==0 ):
					?>
						<span class="wd-open-control-panel" data-position="right" data-element=".wd-cart-list-box"><i class="fa fa-shopping-cart"></i></span>
					<?php endif;?>
				</div>
				
			</div>
		</div>
	</div>
</div>
	</div>
	</div>
</div>