<?php

// **********************************************************************// 

// ! Register New Element: WD Gallery

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD WD Gallery
// **********************************************************************//

$wd_gallery = array(
	"name" => __("WD Gallery", 'wpdance'),
	"base" => "wd_gallery",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
		
		array(
			"type" => "attach_images",
			"class" => "",
			"heading" => __("Image", 'wpdance'),
			"param_name" => "images",
			"value" => "",
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Size", 'wpdance'),
			"admin_label" => true,
			"param_name" => "size",
			"value" => "",
			"description" => __('1 = 600x600, 2 = 600x300, 3 = 300x300,...','wpdance')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "",
			"description" => __('1 = 100%, 2 = 50%, 4 = 25%,...','wpdance')
		),
		
	)
);
vc_map( $wd_gallery );
?>