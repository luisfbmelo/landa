<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Specific Product

// **********************************************************************//

$specipic_product_params = array(
	"name" => __("WD Banner", 'wpdance'),
	"base" => "banner",
	"icon" => "icon-wpb-wpdance-banner",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link", 'wpdance'),
			"param_name" => "link_url",
			"value" => "#",
			"description" => '',
			
		),
		
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'wpdance'),
			"param_name" => "bg_color",
			"value" => "#000000",
			"description" => '',
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Background Image", 'wpdance'),
			"param_name" => "bg_image",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"param_name" => "content",
			"value" => "",
			"description" => '',
		),
		
		/*array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text align", 'wpdance'),
				"admin_label" => true,
				"param_name" => "text_align",
				"value" => array(
					"Left"	=> 'left',
					"Center"	=> 'center',
					"Right"	=> 'right',
				),
				"description" => ''
			),*/
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button text", 'wpdance'),
			"admin_label" => true,
			"param_name" => "button_text",
			"value" => "",
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button class", 'wpdance'),
			"admin_label" => true,
			"param_name" => "button_class",
			"value" => 'button-white',
		),
		
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Top", 'wpdance'),
			"admin_label" => true,
			"param_name" => "padding_top",
			"value" => "0px",
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Left/right", 'wpdance'),
			"admin_label" => true,
			"param_name" => "left_right",
			"value" => "15px",
			"description" => '',
		),
		
		/*array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Height", 'wpdance'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "300px",
			"description" => '',
		),*/
		
		
	)
);
vc_map( $specipic_product_params );
?>