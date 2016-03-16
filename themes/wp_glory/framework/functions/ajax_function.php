<?php 
function wd_aj_data(){
	?>
	<script type="text/javascript">
		var wd_admin_ajax = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) );?>';
		var wd_loading_icon = '<?php echo esc_url(get_admin_url() . 'images/spinner-2x.gif');?>';
	</script>
	<?php 
}

add_action('wp_head', 'wd_aj_data');

add_action( 'wp_ajax_widget_product_slide_func1', 'widget_product_slide_function' );
add_action( 'wp_ajax_nopriv_widget_product_slide_func1', 'widget_product_slide_function' );



function widget_product_slide_function() {
    $prod_ID = $_REQUEST['prod_id'];
	$shortc_limit = $_REQUEST['shortc_limit'];
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 1,
		'no_found_rows' => 1,
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
	);
	
	if(isset($atts['sku'])){
		$args['meta_query'][] = array(
			'key' => '_sku',
			'value' => $atts['sku'],
			'compare' => '='
		);
	}
	
	if(isset($prod_ID)){
		$args['p'] = absint($prod_ID);
	}
	
	$products = new WP_Query( $args );
	ob_start();	
	if ( $products->have_posts() ) : 
	//wd_woocommerce_product_loop_start('list');
	?>
	<?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
	<?php 
		//remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart', 13 );
		remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_wishlist_button_to_product_list_shortocode', 15 );
		remove_action( 'wd_woocommerce_shop_loop_buttons', 'wd_add_compare_link', 14 );
		remove_action( 'woocommerce_after_shop_loop_item', 'wd_add_compare_link', 20 );
		global $_wd_quickshop;
		remove_action('woocommerce_after_shop_loop_item', array( $_wd_quickshop , 'add_quickshop_button'), 25 );
	?>
	<?php wc_get_template( 'content-product-custom.php', array( 'columns' => 1,'shortc_limit' => $shortc_limit) );?>
	<?php break; endwhile; // end of the loop. ?>
	<?php //woocommerce_product_loop_end(); ?>
	<?php 
	endif;
	
	die();
}

?>