<?php
$output = $title = $interval = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'el_class' => '',
	'wd_tab_items_full' => '',
	'wd_type'			=> '',
	'wd_tab_box_backg'	=> '',
	'wd_head_backg'		=> '#333333',
), $atts ) );

wp_enqueue_script( 'jquery-ui-tabs' );

$el_class = $this->getExtraClass( $el_class );

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) {
	$element = "wpb_tour {$wd_type}";
} else {
	$wd_type = '';
}

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if( $wd_tab_items_full !== '' ) {
	$wd_tab_items_full = ' '.$wd_tab_items_full;
	$el_class .= $wd_tab_items_full;
}

if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$backg_image = '';
if( strcmp( $wd_type, 'wd_prod_style' ) == 0 ) {
	if( $wd_tab_box_backg !== '' ) {
		$backg_image = esc_url( $wd_tab_box_backg );
		$backg_image = "style=\"background: url({$backg_image}) bottom left no-repeat;\"";
	}
	
}
$tabs_nav .= '<ul class="wpb_tabs_nav ui-tabs-nav vc_clearfix">';
$i = 0;
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	$i++;$wd_li_class = '';
	if($i >= count($tab_titles)) $wd_li_class = 'last';
	if($i == 1) $wd_li_class = 'first';
	if(isset($tab_atts['title'])) {
		$tabs_nav .= '<li class="'.esc_attr($wd_li_class).'"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_atts['title'] . '</a></li>';
	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

$output .= "\n\t" . '<div class="' . $css_class . '" data-interval="' . $interval . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper wpb_tour_tabs_wrapper ui-tabs vc_clearfix" ' . $backg_image . '>';
if( strcmp( $wd_type, 'wd_prod_style' ) == 0 ) $output .= "\n\t\t\t<div class=\"vc_tours_heading_box\" style=\"background-color: {$wd_head_backg}\">";
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
if( strcmp( $wd_type, 'wd_prod_style' ) == 0 ) $output .= "\n\t\t\t</div><!--.vc_tours_heading_box-->";
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
if ( 'vc_tour' == $this->shortcode ) {
	$output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav vc_clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="' . __( 'Previous tab', 'wpdance' ) . '">' . __( 'Previous tab', 'wpdance' ) . '</a></span> <span class="wpb_next_slide"><a href="#next" title="' . __( 'Next tab', 'wpdance' ) . '">' . __( 'Next tab', 'wpdance' ) . '</a></span></div>';
}
$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $element );

echo $output;