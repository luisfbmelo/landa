<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce,$wd_data;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails list_carousel height_auto <?php echo 'columns-' . $columns; ?>">
		<div class="product_thumbnails_slider wd-loading">
			<ul class="product_thumbnails">
				<?php 
				
					foreach ( $attachment_ids as $attachment_id ) {

						//$classes = array( 'zoom' );
						$classes = array(  );

						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = 'first';

						if ( ( $loop + 1 ) % $columns == 0 )
							$classes[] = 'last';

						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;
							
							
						$image_class = esc_attr( implode( ' ', $classes ) );
						if($wd_data['wd_prod_cloudzoom'] == 1){
							//$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ),array( 'alt' => $image_title, 'title' => $image_title ) );
							$image_title 		= esc_attr( $product->get_title() );
							$_thumb_size =  apply_filters( 'single_product_large_thumbnail_size', 'shop_single' );
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'wd_single_product_thumbnail_' ),array( 'alt' => $image_title, 'title' => $image_title ) );
							$image_src   = wp_get_attachment_image_src( $attachment_id, $_thumb_size );
							
							$image_class = $image_class." pop_cloud_zoom cloud-zoom-gallery";
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" class="%s" title="%s"  rel="useZoom: \'zoom1\', smallImage: \'%s\'">%s</a></li>', $image_link, $image_class, $image_title, $image_src[0], $image ), $attachment_id, $post->ID, $image_class );
						} else {
							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'wd_single_product_thumbnail_' ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" class="%s" title="%s"  data-rel="prettyPhoto[product-gallery]">%s</a></li>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
						}
						$loop++;
					}

				?>
			</ul>		
			<?php //endif; ?>
		</div>
	</div>
	
	<?php if( count($attachment_ids) > 0 ) : ?>
	
	<?php 
		$_found_post = count($attachment_ids);
		$_found_post = $_found_post > 4 ? 4 : $_found_post;	
		global $wd_data;
		/*$_layout_config = explode("-",$wd_data['wd_layout_style']);
		$_left_sidebar = (int)$_layout_config[0];
		$_right_sidebar = (int)$_layout_config[2];
		$number_item = 3;*/
		//if(($_left_sidebar && $_right_sidebar) || (!$_left_sidebar && !$_right_sidebar)) {
		//	$number_item = 4;
		//}
	?>

		<script type="text/javascript" language="javascript">
		//<![CDATA[
			jQuery(function() {
				var $_this = jQuery('.product_thumbnails');
				var owl = $_this.owlCarousel({
					item : 4
					,responsive		:{
						0:{
							items:2
						},
						480:{
							items:4
						},
						768:{
							items: 3
						},
						992:{
							items: 4
						},
						1200:{
							items:4
						}
					}
					,onInitialized: function(){
						$_this.parent().addClass('wd-loaded').removeClass('wd-loading');
					}
					
					,nav : true
					,navText		: [ '<', '>' ]
					,dots			: false
					,loop			: true
					,lazyload		:true
				});			
			});	
		//]]>		
		</script>
	<?php endif;?>	
		
	<?php
}