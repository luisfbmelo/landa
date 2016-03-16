<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage RoeDok
 * @since WD_Responsive
 */	
get_header(); ?>
<?php global $wd_data;
	$style = '';
	if( isset( $wd_data['wd_404_backg'] ) && $wd_data['wd_404_backg'] !== '' ) {
		$style = 'background-image: url('. esc_url($wd_data['wd_404_backg']).');';
	}
?>

	<div class="swapper-404 background-404" style="<?php echo esc_attr($style);?>">
		<div  class="content-wrapper container-404 container">
			<div id="content-inner" class="row">
				<?php 
				if(isset($wd_data['wd_header_style']) && $wd_data['wd_header_style'] == 'v2' && !wp_is_mobile()): ?>
				<div style="height: 116px; width: 100%;"></div>
				<?php endif;?>
				<div  class="col-sm-24">
					<div class="entry-content table-cell">
						
						<div>
							<h2 class="heading_404">404</h2>
							<div>
								<h2><strong>
									<?php _e( 'Oops! That page can’t be found', 'wpdance');	?>
								</strong></h2>
								<p>
									<?php _e('It looks like nothing was found at this location. Maybe try to use a search?', 'wpdance' );?>
								</p>
								
							</div>
							<?php if(isset($wd_data['wd_page404_content'])) echo do_shortcode(stripslashes($wd_data['wd_page404_content']));?>
						</div>
					</div>
				</div>
			</div><!-- #content -->
		</div><!-- #container -->
	</div><!--swapper-404-->
<?php get_footer(); ?>
