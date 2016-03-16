<?php global $product, $post; ?>
<li>
	<a class="thumbnail" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
	</a>
	<div class="content">
		<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="product-title-widget" ><?php echo esc_attr(get_the_title($post->ID)); ?></a>
		<?php echo $product->get_rating_html(); ?>
		<?php echo $product->get_price_html();?>
	</div>
	
</li>
