<?php

// **********************************************************************// 

// ! Register New Element: WD Heading

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Heading
// **********************************************************************//
$heading_params = array(
	"name" => __("Heading", 'wpdance'),
	"base" => "wd_heading",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		// Heading
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'wpdance'),
			"admin_label" => true,
			"param_name" => "size",
			"value" => array(
				"H1" => 'h1',
				"H2" => 'h2',
				"H3" => 'h3',
				"H4" => 'h4',
				"H5" => 'h5',
				"H6" => 'h6'
			),
			"description" => '',
		),
		
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),
	)
);
vc_map( $heading_params );
?>