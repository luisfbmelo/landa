<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product;
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" data-product-id="<?php echo esc_attr($product_id); ?>" data-product-type="<?php echo esc_attr($product_type);?>" class="<?php echo esc_attr($link_classes); ?>" >
    <?php echo $icon ?>
    <?php echo $label ?>
</a>
<img src="<?php echo esc_url( THEME_URI . "/images/ajax-loader-2.gif" ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />