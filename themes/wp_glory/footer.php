<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage wp_glory
 * @since Wpdance Glory
 */
?>
		<?php do_action( 'wd_before_body_end' ); ?>
		</div><!-- #main -->
		<?php
			global $wd_data;
			$footer_layout = '';
			if($wd_data['wd_layout_footer'] != '' && $wd_data['wd_layout_footer'] == 'boxed'){
				$footer_layout = 'class="wd-'.$wd_data['wd_layout_footer'].'"';
			}
		?>
		<?php if ( !is_page_template('page-templates/comming-soon.php') ) :?>
			<footer id="footer" <?php echo esc_attr($footer_layout); ?> role="contentinfo">

				<div class="footer-container">
				
					<?php do_action( 'wd_footer_init' ); ?>
					
				</div>
				
			</footer><!-- #colophon -->
		<?php endif; ?>
		<?php do_action( 'wd_before_footer_end' ); ?>
		
	</div><!-- #page -->
	
	<div class="wd-right-control-panel" style="display:none">
		<div class="wd-search-box"><?php wd_get_search_form(); ?></div>
		<div class="wd-cart-list-box shopping-cart"><?php echo wd_ajax_tini_cart(); ?></div>
	</div>
	
</div><!-- #body-wrapper -->
	<?php if(isset($wd_data['wd_before_body_end_code'])) echo stripslashes(trim($wd_data['wd_before_body_end_code']));?>
	
	<?php if(isset($wd_data['wd_google_analytic_code'])) echo stripslashes(trim($wd_data['wd_google_analytic_code']));?>
	
	<?php wp_footer(); ?>
</body>
</html>