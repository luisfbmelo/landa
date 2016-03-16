<div class="wd-sticky" id="wd-sticky">
	<div class="header-middle">
		<div class="header-middle-content">
				<div class="header-middle-left">	
					<div class="menu-extra-content">
						<div class="wd-header-bottom-search-control">
							<span class="wd-open-control-panel" data-position="right" data-element=".wd-search-box"><i class="fa fa-search"></i></span>
							<?php global $wd_data;
							if( isset($wd_data['wd_tini_cart_pos']) && strcmp( $wd_data['wd_tini_cart_pos'], 'menu' ) ==0 ):
							?>
								<span class="wd-open-control-panel" data-position="right" data-element=".wd-cart-list-box"><i class="fa fa-shopping-cart"></i></span>
							<?php endif;?>
						</div>			
					</div>
				</div>	
				<div class="header-middle-center">
					<div class="container">
						<div>
							<div class="account-wishlist col-md-9 col-sm-8">
								<?php if ( wd_is_woocommerce() && defined('YITH_WCWL') ) { ?>
									<div class="wd_tini_wishlist_wrapper hidden-xs"><?php echo wd_tini_wishlist(); ?></div>
								<?php } ?>
								<div class="header-account hidden-xs">
									<?php echo wd_tini_account();//TODO : account form goes here?>
								</div>
								<div class="clear"></div>
							</div>
							<div class="header-logo col-md-6 col-sm-8 hidden-xs">
								<?php theme_logo();?>
							</div>	
							<?php if ( is_active_sidebar( 'wd-header-top-wider-area-right' )): ?>
								<div class="header-custom-sidebar hidden-xs col-md-9 col-sm-8">
									<div>
										<div>
											<ul class="xoxo">
												<?php dynamic_sidebar( 'wd-header-top-wider-area-right' ); ?>
											</ul>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="header-middle-right">	
					<div class="menu-extra-content">
						<?php if( (!isset($wd_data['wd_header_style']) || $wd_data['wd_header_style'] !== 'v4') && ( !isset($wd_data['wd_tini_cart_pos']) || strcmp( $wd_data['wd_tini_cart_pos'], 'top' ) ==0 )):?>
							<div class="shopping-cart shopping-cart-wrapper hidden-xs <?php echo ( isset($wd_data['wd_enable_cart_header_top']) && !absint($wd_data['wd_enable_cart_header_top']) )? 'wd_cart_disable':'';?>">
								<?php if( (!isset($wd_data['wd_enable_cart_header_top']) || absint($wd_data['wd_enable_cart_header_top'])) ) echo wd_tini_cart_v6();?>
							</div>
						<?php endif;?>				
					</div>
				</div>	
		</div>
	</div>
	<div class="header-bottom hidden-xs" id="header-bottom">
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
				</div>
			</div>
		</div>
	</div>
</div>