<?php 
	
	/* MENU PHONE */
	
	add_action( 'wd_before_header', 'wd_mobile_header_open_div', 1 );
	
	add_action( 'wd_before_header', 'wd_print_toggle_menu', 2 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_control', 3 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_bar_wrapper', 4 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_logo', 6 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_act_box_start', 7 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_user', 7 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_cart', 8 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_act_box_end', 8 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_search', 9 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 9 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 10 );
	
	
	function wd_mobile_header_act_box_start(){
		?>
		<div class="wd_mobile_header_act_box">
		<?php 
	}
	
	function wd_mobile_header_act_box_end(){
		echo "</div>";
	}
	
	function wd_print_toggle_menu(){
	?>		
	
	<div class="toggle-menu-wrapper visible-xs" style="background: #3d3b48;">
		<!--div class="toggle-menu-control-close"><span></span></div-->
		<?php 
		$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
		$myaccount_page_url = "#";
		if ( $myaccount_page_id ) {
			$myaccount_page_url = get_permalink( $myaccount_page_id );
		}
		
		$login_url = add_query_arg( 'action', 'login', esc_url($myaccount_page_url) );
		$regis_url = add_query_arg( 'action', 'register', esc_url($myaccount_page_url) );
		$_user_logged = is_user_logged_in();
		$logout_url = wp_logout_url();
		?>
		<?php if(is_user_logged_in()): ?>
		<ul class="my-account">
			<li>
				<a href="<?php echo esc_url($logout_url);?>">
					<i class="fa fa-user"></i><br />
					<span><?php _e("Sign out", 'wpdance');?></span>
				</a>
			</li>
		</ul>
		<?php else: ?>
		<ul class="my-account">
			<li>
				<a href="<?php echo esc_url($login_url);?>">
					<i class="fa fa-sign-in"></i><br />
					<span><?php _e("Sign in", 'wpdance');?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo esc_url($regis_url);?>">
					<i class="fa fa-hand-o-up"></i><br />
					<span><?php _e("Join for free", 'wpdance');?></span>
				</a>
				</a>
			</li>
		</ul>
		<?php endif;?>
		
		<?php 
		if( has_nav_menu( 'mobile' ) ){ 
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'mobile' ) ); 
		}
		else{
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'primary' ) ); 
		}
		?>
	</div>
	
	<?php
	}	
	
	add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
	add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );
	//add_filter( 'woocommerce_grouped_price_html', 'wc_wc20_variation_price_format', 10, 2 );
	function wc_wc20_variation_price_format( $price, $product ) {
		// Main Price
		$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
		$price = $prices[0] == $prices[1]? wc_price($prices[0]): $price = wc_price( $prices[0] ) . ' - ' .wc_price( $prices[1] );
		// Sale Price
		$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
		sort( $prices );
		
		$saleprice = $prices[0] == $prices[1]? $saleprice = wc_price( $prices[0] ): wc_price( $prices[0] ) . ' - ' .wc_price( $prices[1] );
		
		if ( $price !== $saleprice ) {
			$price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
		}
		return $price;
	}
	
	add_filter( 'woocommerce_grouped_price_html', 'wc_wc20_group_price_format', 10, 2 );
	function wc_wc20_group_price_format( $price, $product ) {
		$tax_display_mode = get_option( 'woocommerce_tax_display_shop' );
		$child_prices     = array();

		foreach ( $product->get_children() as $child_id )
			$child_prices[] = get_post_meta( $child_id, '_price', true );

		$child_prices     = array_unique( $child_prices );
		$get_price_method = 'get_price_' . $tax_display_mode . 'uding_tax';

		if ( ! empty( $child_prices ) ) {
			$min_price = min( $child_prices );
			$max_price = max( $child_prices );
		} else {
			$min_price = '';
			$max_price = '';
		}

		if ( $min_price ) {
			if ( $min_price == $max_price ) {
				$display_price = wc_price( $product->$get_price_method( 1, $min_price ) );
			} else {
				$from          = wc_price( $product->$get_price_method( 1, $min_price ) );
				$to            = wc_price( $product->$get_price_method( 1, $max_price ) );
				$display_price = $from . ' - ' . $to;
			}

			$price = $display_price . $product->get_price_suffix();

		}
		return $price;
		
	}
	
	
	//add_filter("widget_title", "wd_add_icon_to_widget_title");
	function wd_add_icon_to_widget_title($title){
		return '<span class="wd_wg_icon glyphicon glyphicon-plus"></span>' . $title;
	}
	
	if(!function_exists ('wd_mobile_header_bar_wrapper')){
		function wd_mobile_header_bar_wrapper(){
			global $wd_mega_menu_config_arr;
		?>	
		<div class="phone-header-bar-wrapper visible-xs">
		<!--div class="toggle-menu-control-open"><?php if( isset($wd_mega_menu_config_arr) && isset($wd_mega_menu_config_arr['menu_text']) && strlen( trim($wd_mega_menu_config_arr['menu_text']) ) > 0 ){ echo $wd_mega_menu_config_arr['menu_text']; } ?></div-->
		<div class="toggle-menu-control-open"><i class="fa fa-bars"></i></div>
		<?php
		}
	}	
	
	if(!function_exists ('wd_mobile_header_open_div')){
		function wd_mobile_header_open_div(){
	?>	
		<div class="phone-header visible-xs">
	<?php
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_control')){
		function wd_mobile_header_menu_control(){
			global $wd_mega_menu_config_arr;
	?>			
		
	<?php		
		}
	}	
	
	function wd_content($limit) {
	  $content = explode(' ', get_the_content(), $limit);
	  if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	  } else {
		$content = implode(" ",$content);
	  }	
	  $content = preg_replace('/\[.+\]/','', $content);
	  $content = apply_filters('the_content', $content); 
	  $content = str_replace(']]>', ']]&gt;', $content);
	  echo $content;
	}
	function wd_excerpt($limit) {
	  $excerpt = explode(' ', get_the_excerpt(), $limit);
	  if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	  } else {
		$excerpt = implode(" ",$excerpt);
	  }
	  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	  $excerpt = apply_filters('the_content', $excerpt);
	  echo $excerpt;
	}
	
	if(!function_exists ('wd_mobile_header_menu_user')){
		function wd_mobile_header_menu_user(){
			if(wd_is_woocommerce()) {
				$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
				$myaccount_page_url = "#";
				if ( $myaccount_page_id ) {
					$myaccount_page_url = get_permalink( $myaccount_page_id );
				}
				
				?>
				<div class="wd_mobile_account">
					<?php if(!is_user_logged_in()):?>
						
						<a class="sign-in-form-control" href="<?php echo esc_url($myaccount_page_url);?>" title="<?php _e('Log in/Sign up','wpdance');?>">
							<i class="fa fa-user"></i>
						</a>
						<span class="visible-xs login-drop-icon"></span>			
					<?php else:?>		
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>">
							<i class="fa fa-user"></i>
						</a>	
					<?php endif;?>
				</div>
				<?php
			}
			
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_cart')){
		function wd_mobile_header_menu_cart(){
			global $wd_data;
			if( !isset($wd_data['wd_enable_cart_header_top']) || absint($wd_data['wd_enable_cart_header_top']) ):
	?>	
		<div class="mobile_cart_container visible-xs">
			<div class="mobile_cart">
			<?php 
				if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
				$_cart_size_id = "cart_size_value_head-".rand();
				$cart_size_title = __('View your shopping bag','wpdance');
				?>
				
				<span class="cart_size">
					<a href="<?php echo WC()->cart->get_cart_url();?>" title="<?php echo esc_attr( $cart_size_title );?>">
					
					<span class="cart_size_value_head" id="<?php echo esc_attr($_cart_size_id); ?>">
						<i class="fa fa-shopping-cart"></i>
						<!--span class="cart_item"-->
							<span class="num_item">
								<?php 
								$number = WC()->cart->cart_contents_count;
								if( $number < 10 && $number != 0 )
									echo '0'.$number;
								else
									echo $number;
								?>
							</span>
						<!--/span-->
					</span>
					</a>
				</span>
				
				<?php } ?>
			</div>
		</div>	
	<?php	
			endif;
		}
	}		

	if(!function_exists ('wd_mobile_header_menu_search')){
		function wd_mobile_header_menu_search(){
			echo wd_get_mobile_search_form();
		}
	}

	if(!function_exists ('wd_mobile_header_logo')){
		function wd_mobile_header_logo(){
			theme_mobile_logo();
		}
	}
	
	if(!function_exists ('wd_mobile_header_close_div')){
		function wd_mobile_header_close_div(){
	?>	
	<div style="clear:both"></div>
	</div>
	<?php
		}
	}		
	/* END MENU PHONE */
	
	
	
	if(!function_exists ('get_user_role')){
		function get_user_role( $user_id ) {
			global $wpdb;
			$user = get_userdata( $user_id );
			$capabilities = $user->{$wpdb->prefix . 'capabilities'};
			if ( !isset( $wp_roles ) ){
				$wp_roles = new WP_Roles();
			}
			foreach ( $wp_roles->role_names as $role => $name ) {
				if ( array_key_exists( $role, $capabilities ) ) {
					return $role;
				}
			}
			return false;
		}
	}
	
	/**
	*	Combine a input array with defaut array
	*
	**/
	if(!function_exists ('wd_valid_color')){
		function wd_valid_color( $color = '' ) {
			if( strlen(trim($color)) > 0 ) {
				$named = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');
				if (in_array(strtolower($color), $named)) {
					return true;
				}else{
					return preg_match('/^#[a-f0-9]{6}$/i', $color);			
				}
			}
			return false;
		}
	}

	/**
	*	Combine a input array with defaut array
	*
	**/
	if(!function_exists ('wd_array_atts')){
		function wd_array_atts($pairs, $atts) {
			$atts = (array)$atts;
			$out = array();
		   foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) ){
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
				else{
					$out[$name] = $default;
				}	
			}
			return $out;
		}
	}
	
	if(!function_exists ('wd_array_atts_str')){
		function wd_array_atts_str($pairs, $atts) {
			$atts = (array)$atts;
			$out = array();
		   foreach($pairs as $name => $default) {
				if ( array_key_exists($name, $atts) ){
					if( strlen(trim($atts[$name])) > 0 ){
						$out[$name] = $atts[$name];
					}else{
						$out[$name] = $default;
					}
				}
				else{
					$out[$name] = $default;
				}	
			}
			return $out;
		}
	}	
	
	if(!function_exists ('wd_get_all_post_list')){
		function wd_get_all_post_list( $_post_type = "post" ){
			wp_reset_query();
			$args = array(
				'post_type'=> $_post_type
				,'posts_per_page'  => -1
			);
			$_post_lists = get_posts( $args );
			
			if( $_post_lists ){
				foreach ( $_post_lists as $post ) {
					setup_postdata($post);
					$ret_array[] = array(
						$post->ID
						,get_the_title($post->ID)
					);
				}
			}else{
				$ret_array = array();
			}
			wp_reset_query();	
			return $ret_array ;
			
		}
	}	
	
	if(!function_exists ('show_page_slider')){
		function show_page_slider(){
			global $page_datas;
			$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
			switch ($page_datas['page_slider']) {
				case 'revolution':
					if( $revolution_exists )
						RevSliderOutput::putSlider($page_datas['page_revolution'],"");
					break;
				case 'flex':
					/*show_flex_slider($page_datas['page_flex']);*/
					echo "show_flex_slider not support";
					break;	
				case 'layerslider':
					echo do_shortcode('[layerslider id="'.$page_datas['page_layerslider'].'"]');
					break;	
				case 'nivo':
					/*show_nivo_slider($page_datas['page_nivo']);*/
					echo "show_nivo_slider not support!";
					break;							
				case 'none' :
					break;							
				default:
				   break;
			}	
		}
	}
	
	if(!function_exists('wd_page_layout_class')){
		function wd_page_layout_class($layout_name='', $echo = true, $extra_class = ''){
			global $page_datas;
			$layout_class = "";
			switch($page_datas['page_layout']){
				case 'box':
					$layout_class = "wd_box";
					break;
				default:
					$layout_class = "wd_wide";
			}
			if( $extra_class != '' ){
				$layout_class .= ' '.$extra_class;
			}
			if($echo){
				echo $layout_class;
			}
			else{
				return $layout_class;
			}
		}
	}
	
	add_action( 'wd_before_main_container', 'wd_print_top_content_widget_area', 15 );
	if(!function_exists ('wd_print_top_content_widget_area')) {
		function wd_print_top_content_widget_area(){
			global $wd_data, $page_datas;
			if ( is_active_sidebar( 'wd-top-content-wider-area' ) && isset($page_datas['hide_top_content']) && (int)$page_datas['hide_top_content'] == 0 ) :
			?>
				<div class="wd_top_content_widget_area_wrapper <?php wd_page_layout_class(); ?>">
					<div class="wd_top_content">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'wd-top-content-wider-area' ); ?>
						</ul>
					</div>
				</div>		
			<?php 
			endif;
		}
	}
	
	add_action( 'wd_before_main_container', 'wd_print_inline_script', 10 );
	if(!function_exists ('wd_print_inline_script')){
		function wd_print_inline_script(){
	?>	
		<script type="text/javascript">
			_ajax_uri = '<?php echo admin_url('admin-ajax.php');?>';
			_on_phone = <?php echo WD_IS_MOBILE === true ? 1 : 0 ;?>;
			_on_tablet = <?php echo WD_IS_TABLET === true ? 1 : 0 ;?>;
			theme_ajax = '<?php echo admin_url( 'admin-ajax.php' )?>';
			//if(navigator.userAgent.indexOf(\"Mac OS X\") != -1)
			//	console.log(navigator.userAgent);
			<?php 
				global $wd_data;
				
			?>
			var _enable_sticky_menu = <?php echo absint($wd_data['wd_sticky_menu']); ?>;
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
	<?php
		}
	}	
	//add_action( 'wd_before_main_container', 'wd_print_ads_block', 20 );
	if(!function_exists ('wd_print_ads_block')){
		function wd_print_ads_block(){
			global $page_datas;
	?>	
			<div class="header_ads_wrapper">
				<?php 
					if( !is_home() && !is_front_page() ){
						if( !is_page() ){
							printHeaderAds();
						}else{
							if( isset($page_datas['hide_ads']) && absint($page_datas['hide_ads']) == 0 )
								printHeaderAds();
						}
						
					}
						
				?>
			</div>
	<?php
		}
	}	

	
	add_action( 'wd_before_body_end', 'wd_before_body_end_widget_area', 10 );
	if(!function_exists ('wd_before_body_end_widget_area')){
		function wd_before_body_end_widget_area(){
	?>	
	
		<div class="container">
				<div class="body-end-widget-area">
					<?php
						if ( is_active_sidebar( 'body-end-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'body-end-widget-area' ); ?>
							</ul>
						<?php endif; ?>						
				</div><!-- end #footer-first-area -->
		</div>	
		<?php wp_reset_query();?>
	
	<?php
		}
	}
	
	add_action( 'wd_before_footer_end', 'wd_before_body_end_content', 10 );
	if(!function_exists ('wd_before_body_end_content')){
		function wd_before_body_end_content(){
		global $wd_data;
	?>	
		
		<?php if(!wp_is_mobile() && $wd_data['wd_totop']): ?>
		<div id="to-top" class="scroll-button">
			<a class="scroll-button" href="javascript:void(0)" title="<?php _e('Back to Top','wpdance');?>"></a>
		</div>
		<?php endif; ?>
		
		<!--<div class="loading-mark-up">
			<span class="loading-image"></span>
		</div>
		<span class="loading-text"></span>-->
	
	<?php
		}
	}

	
if ( ! function_exists( 'wd_woocommerce_product_loop_start' ) ) {

	function wd_woocommerce_product_loop_start( $style = '', $echo = true ) {
		ob_start();
		wc_get_template( 'loop/wd-loop-start.php', array( 'style' => $style) );
		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}
	
	
if( !function_exists('wd_myaccount_menu_custom') ){
	function wd_myaccount_menu_custom(){
		$_user_logged = is_user_logged_in();
		ob_start();
		$my_account = get_permalink( get_option('woocommerce_myaccount_page_id') );
		$login_url = add_query_arg( 'action', 'login', esc_url($my_account) );
		$regis_url = add_query_arg( 'action', 'register', esc_url($my_account) );
		?>
		<div class="wd_myaccount_menu">
			<div class="title"><?php _e('Account','wpdance'); ?></div>
			<div class="content">
				<ul>
					<?php if( $_user_logged ){ ?>
					<li><a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>"><?php _e('Logout','wpdance') ?></a></li>
					<li><a href="<?php echo esc_url($my_account) ?>"><?php _e('My Account','wpdance'); ?></a></li>
					<li><a href="<?php echo esc_url(wc_customer_edit_account_url()); ?>"><?php _e('Edit account','wpdance') ?></a></li>
					<?php } else { ?>
					<li><a href="<?php echo esc_url($login_url); ?>"><?php _e('Login','wpdance'); ?></a></li>
					<li><a href="<?php echo esc_url($regis_url); ?>"><?php _e('Register','wpdance'); ?></a></li>
					<li><a href="<?php echo wp_lostpassword_url(); ?>"><?php _e('Forgotten Password','wpdance'); ?></a></li>
					<?php } ?>
					<li><a href="<?php echo esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ); ?>"><?php _e('Wishlist','wpdance'); ?></a></li>
				</ul>
			</div>
		</div>
		<?php
		echo ob_get_clean();
	}
}


if( !function_exists('wd_show_variation_product_same_price') ){
	function wd_show_variation_product_same_price($value, $object = null, $variation = null){
		if ($value['price_html'] == '') {
			$value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
		}
		return $value;
	}
}
add_filter('woocommerce_available_variation','wd_show_variation_product_same_price',10,3);


function wd_add_number_product_list(){
	global $wd_count;
	?><span class="product_count"><?php echo absint($wd_count++);?></span><?php 
}
function wd_add_oembed_soundcloud(){
	wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://soundcloud.com/oembed' );
}
add_action('init','wd_add_oembed_soundcloud');


function wd_update_post_views(){
	if( is_single() && get_post_type() == "post" ){
		$post_id = get_the_ID();
		$key = "wd_total_views";
		$views = get_post_meta($post_id, $key, true);
		if( strlen($views) > 0 ) {
			$views = absint($views) + 1;
			update_post_meta( $post_id, $key, $views);
		} else {
			$views = 1;
			delete_post_meta($post_id, $key);
			add_post_meta($post_id, $key, $views);
		}
		
	}
}

add_action("wp_head", "wd_update_post_views");


add_filter( 'manage_posts_columns' , 'wd_add_recommended_column');
add_action( 'manage_posts_custom_column' , 'wd_add_recommended_custom_columns', 10, 2 );

function wd_add_recommended_column( $columns ){
	return array_merge( $columns, array('wd_recommend' => __('<i class="fa fa-star" style="font-size: 1.3em;"></i>')) );
}

function wd_add_recommended_custom_columns( $column, $post_id ){
	if( strcmp( $column, 'wd_recommend' ) == 0 ) {
		$val = get_post_meta($post_id, 'wd_post_recommended',true);
		if( absint( $val ) )
			echo "<i data-val=\"0\" data-id=\"{$post_id}\" style=\"font-size: 1.3em;cursor: pointer; color: #0073aa;\" data-action=\"wd_ajax_update_recommend\" class=\"wd_update_recomment_action fa fa-star\"></i>";
		else
			echo "<i data-val=\"1\" data-id=\"{$post_id}\" style=\"font-size: 1.3em;cursor: pointer; color: #0073aa;\" data-action=\"wd_ajax_update_recommend\" class=\"wd_update_recomment_action fa fa-star-o\"></i>";
	}
}

add_action( 'wp_ajax_wd_ajax_update_recommend', 'wd_ajax_update_recommend' );
function wd_ajax_update_recommend(){
	$id = $_POST['id'];
	$val = $_POST['val'];
	update_post_meta( $id, 'wd_post_recommended', $val );
	echo absint($val) == 1? '0': '1'; die();
}


if( !function_exists( 'wd_readableColour' ) ) {
	function wd_readableColour( $color, $rgb = 0 ){
		$color = trim( $color );
		if( strcmp(substr($color,0,1), '#') == 0) $color = substr($color,1);
		if(strlen($color) > 3) {
			$r = hexdec(substr($color,0,2));
			$g = hexdec(substr($color,2,2));
			$b = hexdec(substr($color,4,2));
		} else {
			$r = hexdec(str_repeat(substr($color, 0, 1), 2));
			$g = hexdec(str_repeat(substr($color, 1, 1), 2));
			$b = hexdec(str_repeat(substr($color, 2, 1), 2));
		}
		
		if( $rgb > 0 ) return "rgba({$r}, {$g}, {$b}, {$rgb})";
		
		$contrast = sqrt($r * $r * 0.241 + $g * $g * 0.691 + $b * $b * 0.068);
		
		if($contrast > 130) return '#000000';
		else return '#FFFFFF';
	}
	
}
if( !function_exists( 'wd_upload_mimes' ) ) {
	add_filter('upload_mimes', 'wd_upload_mimes');
	
	function wd_upload_mimes( $existing_mimes=array() ){
		$existing_mimes['svg'] = 'image/svg+xml';
		$existing_mimes['svgz'] = 'image/svg+xml';
		return $existing_mimes;
	}
}


?>