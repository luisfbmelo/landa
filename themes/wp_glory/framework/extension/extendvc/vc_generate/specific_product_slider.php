<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Specific Product

// **********************************************************************//

$specipic_product_params = array(
	"name" => __("WD Custom Products - SD", 'wpdance'),
	"base" => "wd_custom_product_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => "WPDance Slider",
	"params" => array(
	
		// Heading
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Box style", "wpdance"),
			"admin_label" => true,
			"param_name" => "box_style",
			"value" => array(
				"No box" => "style-1",
				"Box" => "style-2"
			),
			"description" => ""
		),
		
		// Heading
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"admin_label" => true,
			"param_name" => "desc",
			"value" => "",
			"description" => '',
		),
		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "4",
			"description" => '',
		),
				
		// add Row
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Row", 'wpdance'),
			"admin_label" => true,
			"param_name" => "row",
			"value" => "1",
			"description" => ''
		),
		
		// Product List
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product List", 'wpdance'),
			"admin_label" => true,
			"param_name" => "product_list",
			"value" => "",
			"description" => __('Enter product id & Separator by "," sign', 'wpdance')
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show type", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_type",
			"value" => array(
				"Grid" => "grid",
				"List" => "list",
				"Widget" => "widget"
			),
			"description" => ''
		),		
		
		// Big product
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Big Product", 'wpdance'),
			"admin_label" => true,
			"param_name" => "big_product",
			"value" => "",
			"description" => '',
		),
		
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Title", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		
		// add Price dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Price", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		// add Rating dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Rating", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_rating",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		// add add to cart
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show product buttons", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_prod_buttons",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		// add Label dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Product Label", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_label",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Excerpt word number", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_except_limit",
			"value" => "15",
			"description" => __("Limit number of Excerpt words", 'wpdance'),
			"dependency" => Array('element' => "show_type", 'value' => array('list'))
		),

		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ''
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Nav Position", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav_pos",
			"value" => array(
				"Pos 1 (Top Right)" 	=> "top_right",
                "Pos 2 (Middle center)" => "middle_center",
                "Pos 3 (Bottom Center)" => "bottom_center",
			),
			"dependency" => Array('element' => "show_nav", 'value' => array('1'))
		),
		
		// add icon nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Pagination", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_icon_nav",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ''
		),
		
		// add nav dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Autoplay", 'wpdance'),
			"admin_label" => true,
			"param_name" => "autoplay",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ''
		),
		
	)
);
vc_map( $specipic_product_params );
?>