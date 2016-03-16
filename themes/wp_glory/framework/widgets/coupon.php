<?php
/**
 * EW Social Widget
 */
if(!class_exists('WP_Widget_Coupon')){
	class WP_Widget_Coupon extends WP_Widget {

		public function __construct(){
			$widgetOps = array('classname' => 'widget_coupon', 'description' => __('Display coupon form','wpdance'));
			$controlOps = array('width' => 400, 'height' => 350);
			parent::__construct('ew_social', __('WD - Coupon','wpdance'), $widgetOps, $controlOps);

		}
		function widget( $args, $instance ) {
			extract($args);
			$title = esc_attr(apply_filters( 'widget_title', $instance['title'] ));
			
			global $woocommerce;
			
			if ( ! WC()->cart->coupons_enabled() || is_null(WC()->checkout()))
				return;
			$checkout_link =  WC()->cart->get_checkout_url();
			$pageURL = 'http';
			
			if ($_SERVER["HTTPS"] == "on") {
				$pageURL .= "s";
			}
			$pageURL .="://";
			$pageURL .= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
			if(strcasecmp($checkout_link, $pageURL) !== 0){
				return;
			}			
			?>

			<form class="wd_checkout_coupon" method="post">
				<p class="form-row form-row-first"><span class="question_coupon"><?php _e( 'Have a coupon?', 'wpdance' ); ?></span><span class="click_coupon"><?php _e( 'Click here to enter code', 'wpdance' ); ?></span></p>
				<p class="form-row">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'wpdance' ); ?>" id="coupon_code" value="" />
				</p>

				<p class="form-row form-row-last">
					<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Login', 'wpdance' ); ?>" />
				</p>

				<div class="clear"></div>
			</form>
			
			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;			
			return $instance;
		}

		function form( $instance ) { 
		}
	}
}

