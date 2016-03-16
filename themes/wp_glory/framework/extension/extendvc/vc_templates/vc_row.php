<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'bg_image'        => '',
    'bg_color'        => '',
    'bg_image_repeat' => '',
    'font_color'      => '',
    'padding'         => '',
    'margin_bottom'   => '',
	
	'use_fullpage'		=> '',
	'screen_title'		=> '',
	
	'row_type' => 'row',
	'layout'          => 'row-wide',
	'type' => '',
	'hidden_on_phones' => '',
	
	'content_grid' => false,
	
	'bg_video' => '',
	'bg_video_overlay' => '',
	'bg_video_src_webm' => '',
	'bg_video_src_mp4' => '',
	'bg_video_src_ogv' => '',
	
	'parallax_speed' => '',
	'parallax_fixed' => '',
	'enable_parallax' => '',
	
	'min_height' => '',
	'css' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

if($hidden_on_phones) {
	$el_class .= ' hidden-xs';
}

$fullpage = ( $use_fullpage )? "section ": '';
if($row_type == "row"){
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, "{$fullpage}wpb_row ".get_row_css_class().$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
	//$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);
	
	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
	if($min_height != ''){
		if($style != ''){
			$style = rtrim($style, '"');
			$style .= 'min-height:' . $min_height .'px;"';
		}
		else
			$style .= ' style="min-height:' . $min_height .';"';
	}
	
	

	$output .= '<div class="'.$css_class.'"'.$style.'>';
	
	if(strpos($css,'background-image:'))
		$output .= '<div class="row-bg-mask"></div>';
		
	$output .= '<div class="'.$layout.'"><div class="wd_row_content">';
	$output .= wpb_js_remove_wpautop($content);
	$output .= '</div></div>';
	
	$output .= '</div>'.$this->endBlockComment('row');
}

if($row_type == "section") {
	$stripe_classes = array( 'stripe' );
	$stripe_classes[] = 'stripe-style-' . esc_attr($type);
	$bg_video_output = '';
	
	if($bg_video){
		
		if($bg_video_src_mp4 != '' || $bg_video_src_ogv != '' || $bg_video_src_webm != '') {
			if($video_poster != '') { 
				$video_poster = wd_get_image($video_poster);
				$bg_video_output .= '
					<div class="section-video-poster" style="background-image: url('.$video_poster.')"></div>
				';
			}

			$bg_video_output .= '
			<div class="section-back-video hidden-tablet hidden-phone">
				<video autoplay="autoplay" loop="loop" muted="muted" style="">
					<source src="'.$bg_video_src_mp4.'" type="video/mp4">
					<source src="'.$bg_video_src_ogv.'" type="video/ogv">
					<source src="'.$bg_video_src_webm.'" type="video/webm">
				</video>
			</div>';
			
			if($bg_video_overlay){
				$bg_video_output .= '<div class="section-video-mask"></div>';
			}
		}

		$stripe_classes[] = 'stripe-video-bg';
	}
	
	$data_attr = '';
	if ( '' != $parallax_speed && $enable_parallax && !wp_is_mobile() ) {

		$parallax_speed = floatval($parallax_speed);
		if ( false == $parallax_speed ) {
			$parallax_speed = 0.1;
		}

		$stripe_classes[] = 'stripe-parallax-bg';
		$data_attr .= ' data-prlx-speed="' . $parallax_speed . '"';
		
	}
	$data_attr .= ' data-prlx-fixed="' . $parallax_fixed . '"';

	if ( '' !== $min_height ) {
		$data_attr .= ' data-min-height="' . esc_attr( $min_height ) . '"';
	}
	$stripe_classes[] = $fullpage;
	//$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, "wpb_row ".get_row_css_class().$el_class, $this->settings['base']);
	
	$wd_csses = substr( $css, strpos($css, '{', 1)+1);
	$wd_csses = substr( $wd_csses, 0, strlen( $wd_csses ) - 1);
	
	$wd_csses = explode(';',$wd_csses);
	$wd_bg = '';
	foreach( $wd_csses as $wdcss ) {
		$csses = explode(':', $wdcss);
		if( strcmp( trim($csses[0]), 'background' ) == 0 ) {
			$wd_bg = substr( trim($csses[1]), 0, 7);
		}
		if( strcmp( trim($csses[0]), 'background-color' ) == 0 ) {
			$wd_bg = substr( trim($csses[1]), 0, 7);
		}
	}
	
	$wd_readable_cl = '';
	
	if( isset( $wd_bg ) && strlen(trim($wd_bg)) > 0 ) {
		$wd_readable_cl = wd_readableColour( $wd_bg );
		if( strcmp( $wd_readable_cl, '#000000' ) == 0 ) {
			$wd_readable_cl = 'black';
		} else {
			$wd_readable_cl = 'white';
		}
	}
	
	$data_attr .= strlen($wd_readable_cl) > 0? " data-screen_readable=\"".esc_attr($wd_readable_cl)."\"": '';
	
	$data_attr .= strlen($screen_title) > 0? " data-screen_title=\"".esc_attr($screen_title)."\"": '';
	
	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
	
	$output .= '<div class="' . esc_attr(implode(' ', $stripe_classes)) . vc_shortcode_custom_css_class($css, ' ') . '"' . $data_attr . $style . '>';
	
	$output .= $bg_video_output;
	$output .= '<div class="'.$css_class.'">';
	
	if(strpos($css,'background-image:'))
		$output .= '<div class="row-bg-mask"></div>';
	
	if($content_grid) $output .= '<div class="container">';
	
	$output .= wpb_js_remove_wpautop($content);
	
	if($content_grid) $output .= '</div>';
	
	$output .= '</div>'.$this->endBlockComment('row');	
	$output .= '</div>';
}


echo $output;