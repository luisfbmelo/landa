<?php 
	
	
	add_action( 'wd_header_init', 'wd_print_header_top', 10 );
	
	
	if(!function_exists ('wd_print_header_top')){
		function wd_print_header_top(){ 
			global $wd_data;
			if( isset($wd_data['wd_enable_header_top']) && !absint($wd_data['wd_enable_header_top']) ) return;
		?>
			<div class="header-top hidden-xs">
				<div class="header-top-content container">
					<div class="row">
					<div class="header-top-left-area col-sm-8">
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-left' )): ?>
						<ul class="xoxo">
							<?php dynamic_sidebar( 'wd-header-top-wider-area-left' ); ?>
						</ul>
						<?php endif; ?>
					</div>
					<div class="header-top-right-area col-sm-16">
						
						<?php if( (!isset($wd_data['wd_header_style']) || $wd_data['wd_header_style'] !== 'v4') && ( !isset($wd_data['wd_tini_cart_pos']) || strcmp( $wd_data['wd_tini_cart_pos'], 'top' ) ==0 )):?>
						<div class="shopping-cart shopping-cart-wrapper hidden-xs <?php echo ( isset($wd_data['wd_enable_cart_header_top']) && !absint($wd_data['wd_enable_cart_header_top']) )? 'wd_cart_disable':'';?>">
							<?php if( (!isset($wd_data['wd_enable_cart_header_top']) || absint($wd_data['wd_enable_cart_header_top'])) ) echo wd_tini_cart();?>
						</div>
						<?php endif;?>
						
						<?php if ( is_active_sidebar( 'wd-header-top-wider-area-right' )): ?>
						<div class="header-top-custom-sidebar hidden-xs">
							<ul class="xoxo">
								<?php dynamic_sidebar( 'wd-header-top-wider-area-right' ); ?>
							</ul>
						</div>
						<?php endif; ?>
						
						<div class="header-top-account hidden-xs">
							<?php echo wd_tini_account();//TODO : account form goes here?>
						</div>
						<?php if ( wd_is_woocommerce() && defined('YITH_WCWL') ) { ?>
							<div class="wd_tini_wishlist_wrapper hidden-xs"><?php echo wd_tini_wishlist(); ?></div>
						<?php } ?>
						
						<?php if ( wd_is_woocommerce() ) { ?>
						<div class="phone_quick_menu_1 hidden-lg hidden-sm hidden-md">
							<div class="mobile_my_account">
								<?php if ( is_user_logged_in() ) { ?>
									<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>"><?php _e('My Account','wpdance'); ?></a>
								<?php }
								else { ?>
									<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','wpdance'); ?>"><?php _e('Login / Register','wpdance'); ?></a>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						<div class="mobile_cart_container  hidden-lg hidden-sm hidden-md">
							<div class="mobile_cart">
							<?php
								global $woocommerce;
								if( isset($woocommerce) && isset($woocommerce->cart) ){
									$cart_url = $woocommerce->cart->get_cart_url();
									echo "<a href='{$cart_url}' title='View Cart'>".__('View Cart','wpdance')."</a>";
								}

							?>
							</div>
							<div class="mobile_cart_number">0</div>
						</div>
						
					</div>
					</div>
				</div>
			</div>
		<?php
		
		}
	}	
		
	add_action( 'wd_header_init', 'wd_print_header_body', 20 );
	if(!function_exists ('wd_print_header_body')){
		function wd_print_header_body(){
			global $wd_data;
			
			get_template_part('framework/headers/header', $wd_data['wd_header_style']);
			
			menu_effect_js_var();
		}
	}
	
	function theme_logo(){
		global $wd_data, $page_datas;
		
		$header_type = 'wd_logo';	
		$logo = strlen(trim($wd_data[$header_type])) > 0 ? esc_url($wd_data[$header_type]) : '';
		$default_logo = get_template_directory_uri()."/images/logo_v1.png";
		$textlogo = stripslashes(esc_attr($wd_data['wd_text_logo']));
		
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){
				$lg_info = pathinfo($logo);
				
				if( strcmp($lg_info['extension'], 'svg') == 0) {
					?>
					<a href="<?php  echo home_url();?>"><?php echo file_get_contents($logo);?></a>
					<?php 
				} else {
				?>
					<a href="<?php  echo home_url();?>"><img src="<?php echo $logo;?>" alt="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>" title="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>"/></a>
				<?php 
				}
		?>
					
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php  echo home_url();?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php  echo home_url();?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
	<?php 
	}
	
	function theme_mobile_logo(){
		global $wd_data, $page_datas;
		
		$header_type = 'wd_logo_mobile';
		if(isset($wd_data['wd_logo_mobile']) && strlen(trim($wd_data['wd_logo_mobile'])) > 0 ){
			$logo = esc_url($wd_data['wd_logo_mobile']);
		} else {
			$logo = strlen(trim($wd_data['wd_logo'])) > 0 ? esc_url($wd_data['wd_logo']) : '';
		}
		
		$default_logo = get_template_directory_uri()."/images/logo-mobile.png";
		$textlogo = stripslashes(esc_attr($wd_data['wd_text_logo']));
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo home_url();?>"><img src="<?php echo $logo;?>" alt="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>" title="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>"/></a>	
		<?php } else {
			if($textlogo){
			?>
				<a href="<?php  echo home_url();?>" title="<?php echo esc_attr($textlogo);?>"><?php echo esc_html($textlogo);?></a>
			<?php }else{ ?>
				<a href="<?php  echo home_url();?>"><img src="<?php echo esc_url($default_logo); ?>"  alt="<?php echo get_bloginfo('name');?>" title="<?php echo get_bloginfo('name');?>"/></a>
			<?php
			}
		}?>	
		</div>
	<?php 
	}
	
	function theme_logo_fullwidth(){
		global $wd_data;
		$logo = strlen(trim($wd_data['wd_logo_fullwidth'])) > 0 ? esc_url($wd_data['wd_logo_fullwidth']) : '';
		$default_logo = get_template_directory_uri()."/images/logo.png";
		$textlogo = stripslashes(esc_attr($wd_data['wd_text_logo']));
	?>
		<div class="logo heading-title">
		<?php if( strlen( trim($logo) ) > 0 ){?>
				<a href="<?php  echo home_url();?>"><img src="<?php echo $logo;?>" alt="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>" title="<?php echo $textlogo ? $textlogo : get_bloginfo('name');?>"/></a>	
		<?php } ?>	
		</div>
	<?php 
	}
	if(!function_exists ('wd_get_search_form1')){
		function wd_get_search_form1(){
			ob_start();
		?>
			<div class="wd_woo_search_box">
				<h1 class="wd_search_heading text-center"><?php _e('Search', 'wpdance');?></h1>
				<div class="line line-30 line-margin text-center"></div>
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" name="s" id="s" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpdance' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('wd_get_mobile_search_form')){
		function wd_get_mobile_search_form(){
			ob_start();
		?>
			<div class="wd_woo_search_box">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="text" placeholder="<?php echo esc_attr__("Search here...", 'wpdance');?>" name="s" id="s" <?php if(isset($_GET['s'])) echo "value=\"".esc_attr($_GET['s']) . "\""; ?> />
					<div class="button_search"><button type="submit" title="<?php echo esc_attr__( 'Search', 'wpdance' ); ?>"><i class="fa fa-search"></i></button></div>
					<input type="hidden" name="post_type" value="<?php echo esc_attr((class_exists('WooCommerce'))? "product": 'post');?>" />
				</form>
			</div>
			
		<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	if(!function_exists ('wd_get_search_form')){
		function wd_get_search_form(){
			global $wd_data;
			//include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			//thanhdoi
			if(shortcode_exists('wd_woo_search')) {
				
				echo strcmp(trim($wd_data['wd_header_style']), 'v4') == 0? do_shortcode("[wd_woo_search use_header_v4='1']"): do_shortcode("[wd_woo_search]");
			}
				
			else echo wd_get_search_form1();
		}
	}
	
	
	
	function theme_icon(){
		global $wd_data;
		$icon = $wd_data['wd_icon'];
		if( strlen(trim($icon)) > 0 ):?>
			<link rel="shortcut icon" href="<?php echo esc_url($icon);?>" />
		<?php endif;
	}
	
	function wd_printf_breadcrumb($datas){
		if( $datas['has_breadcrumb'] || $datas['has_page_title'] ){
			global $wd_data;
			
			$wd_data['wd_bg_breadcrumbs'] = (isset($datas['backg_url']) && $datas['backg_url'] !=='') ? $datas['backg_url']: $wd_data['wd_bg_breadcrumbs'];
			$style = ''; $break_pace ="";$height ='';
			
			if( isset($wd_data['wd_bg_breadcrumbs']) && $wd_data['wd_bg_breadcrumbs'] != '' ){
				if(isset($wd_data['wd_header_style']) && $wd_data['wd_header_style'] == 'v2' && !wp_is_mobile()) $height = "height: 330px;";
				$style = 'style="background: url('.esc_url($wd_data['wd_bg_breadcrumbs']).');"';
			}
			if(isset($wd_data['wd_header_style']) && ($wd_data['wd_header_style'] == 'v2' || $wd_data['wd_header_style'] == 'v5') && !wp_is_mobile()){
				$break_pace = "<div style=\"height: 116px; width: 100%;\"></div>";
			}
			if( isset($datas['type']) && $datas['type'] === 'postdetail' && isset($datas['backg_url']) && $datas['backg_url'] !=='' ) {
				//$break_pace = "<div style=\"height: 166px; width: 100%;\"></div>";
			}
			
			echo '<div class="breadcrumb-title-wrapper"><div class="breadcrumb-title" '.trim($style).'>';
			echo $break_pace;
			if( $datas['has_page_title'] ) {
				echo $datas['title'];
			}
			
			if( $datas['has_breadcrumb'] ) wd_show_breadcrumbs();
			echo '</div></div>';
			
		}
	}
	
	
	function menu_effect_js_var(){
		global $wd_data;
	?>

		<script type="text/javascript">
			var _sub_menu_show_effect = '<?php echo isset($wd_data['wd_sub_menu_show_effect'])?$wd_data['wd_sub_menu_show_effect']:'dropdown'; ?>';
			var _sub_menu_show_duration = <?php echo (isset($wd_data['wd_sub_menu_show_duration']) && (int)$wd_data['wd_sub_menu_show_duration']>0)?(int)$wd_data['wd_sub_menu_show_duration']:'200'; ?>;
		</script>
	<?php }?>