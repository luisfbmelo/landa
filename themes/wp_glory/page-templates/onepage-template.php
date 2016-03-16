<?php
/*
*	Template Name: One-Page Template
*/
get_header(); 
?>

<div id="wd-container" class="content-wrapper onepage-template<?php echo wp_is_mobile()? " disable_mobile":' enable_pc';?>">
	<?php
	if( have_posts() ) : the_post();
		get_template_part( 'content', 'onepage' );	
	endif;
	?>
</div>


<?php get_footer(); ?>