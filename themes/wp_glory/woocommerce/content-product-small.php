<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $wd_data;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	
	// Ensure visibility
if ( ! $product && ! $product->is_visible() )
	return;	
	
//>=1200 >=992 >=768 >=480 >=320
$_sub_class = "wd-col-lg-4 wd-col-md-4 wd-col-sm-3 wd-col-xs-2 wd-col-mb-1";



/*if( absint($wd_data['wd_prod_cat_column']) > 0 ){
	$_columns = absint($wd_data['wd_prod_cat_column']);
	$_sub_class = "wd-col-lg-".$_columns;
	$_sub_class .= ' wd-col-md-'.floor($_columns * 992 / 1200);
	$_sub_class .= ' wd-col-sm-'.floor($_columns * 768 / 1200);
	$_sub_class .= ' wd-col-xs-'.floor($_columns * 480 / 1200);
	$_sub_class .= ' wd-col-mb-1';
}else{*/
	$_columns = absint($woocommerce_loop['columns']);
	$moble_count = (round( $_columns * 480 / 1200 ) > 3)? round( $_columns * 480 / 1200 ): 3 ;
	$mb = absint($_columns) > 1? 2: 1;
	$_sub_class = "wd-col-lg-".$_columns;
	$_sub_class .= ' wd-col-md-'.round( $_columns * 992 / 1200);
	$_sub_class .= ' wd-col-sm-'.round( $_columns * 768 / 1200);
	$_sub_class .= ' wd-col-xs-'.$moble_count;
	$_sub_class .= ' wd-col-mb-2';
	
//}	

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

//add on column class on cat page	
$classes[] = $_sub_class ;
$classes[] = 'product';
$classes[] = 'product-small';

?>
<section <?php post_class( $classes ); ?>>
	
	<!--div class="product-hover-box"-->
	
	<div class="product-thumbnail-wrapper wd_sec_border">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
		<a href="<?php the_permalink(); ?>">

			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'wd_small_woocommerce_before_shop_loop_item_title' );
			?>
		</a>
		
		<?php do_action( 'wd_woocommerce_shop_loop_buttons' ); ?>
		
	</div>
	<div class="product-meta-wrapper">
		<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	
		<?php if( empty($shortc_limit)) $shortc_limit = 0;?>
		<?php do_action( 'wd_small_woocommerce_after_shop_loop_item' ); ?>
	</div>
	
	
	
</section>