<?php

// **********************************************************************// 

// ! Register New Element: WD Icon

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Icon
// **********************************************************************//
$icon_params = array(
	"name" => __("Awesome Icon", 'wpdance'),
	"base" => "wd_icon",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	'params' => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => "",
			"description" => "blank if you don't want to display"
		),
		array(
			"type" => "dropdown",
			"admin_label" => true,
			"class" => "wd_awesome",
			"heading" => __("Size", 'wpdance'),
			"param_name" => "size",
			"value" => array(
				"Tiny" => "fa-lg",
				"Small" => "fa-2x",
				"Medium" => "fa-3x",	
				"Large" => "fa-4x",
				"Very Large" => "fa-5x"	
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"admin_label" => true,
			"class" => "",
			"heading" => __("Custom Size (px)", 'wpdance'),
			"param_name" => "custom_size",
			"value" => ""
		),
		array(
			"type" => "wd_icon",
			"class" => "",
			"heading" => __("Icon", 'wpdance'),
			"param_name" => "icon",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Type", 'wpdance'),
			"param_name" => "type",
			"value" => array(
				"Normal" => "normal",
				"Circle" => "circle",
				"Square" => "square"	
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Border Width", 'wpdance'),
			"param_name" => "border_width",
			"value" => '0',
			"description" => __("Blank or 0 if you don't want to show border", 'wpdance'),
			"dependency" => Array('element' => "type", 'value' => array('square'))
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Border Color", 'wpdance'),
			"param_name" => "border_color",
			"description" => __("Only for Square type", 'wpdance'),
			"dependency" => Array('element' => "type", 'value' => array('square'))
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon Color", 'wpdance'),
			"param_name" => "icon_color",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Background Color", 'wpdance'),
			"param_name" => "background_color",
			"description" => "",
			"dependency" => Array('element' => "type", 'value' => array('square','circle'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Margin (px)", 'wpdance'),
			"param_name" => "margin",
			"description" => __("Margin (top right bottom left - 5px 5px 5px 5px)", 'wpdance')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Distance (px)", 'wpdance'),
			"param_name" => "distance",
			"description" => __("For example: 10", 'wpdance')
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("CSS Animation", 'wpdance'),
			"param_name" => "css_animation",
			"value" => array(
				"No" => "",
				"Top to bottom" => "top-to-bottom",
				"Bottom to top" => "bottom-to-top",
				"Left to right" => "left-to-right",
				"Right to left" => "right-to-left",
				"Appear from center" => "appear"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link", 'wpdance'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Target", 'wpdance'),
			"param_name" => "target",
			"value" => array(
				"Self" => "_self",
				"Blank" => "_blank",
				"Parent" => "_parent"	
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'wpdance'),
			"param_name" => "class",
			"description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'wpdance')
		)
	)
);
vc_map( $icon_params );
?>