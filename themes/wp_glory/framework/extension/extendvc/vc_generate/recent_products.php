<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$wd_recent_products = array(
	"name" => __("WD Recent Products", 'wpdance'),
	"base" => "wd_recent_products",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Products', 'wpdance'),
	"description"	=> '',
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
				"No box" => "",
				"Boxed" => "style-boxed"
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
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", "wpdance"),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "4",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", "wpdance"),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "4",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", "wpdance"),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Grid" => "grid",
				"List" => "list",
				"Widget" => "widget"
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Small product", "wpdance"),
			"param_name" => "small_prod",
			"value" => array(
				"No"	=> '0',
				"Yes"	=> '1'
			),
			"dependency" => Array('element' => "style", 'value' => array('list', 'grid'))
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Shortcontent limit", "wpdance"),
			"admin_label" => true,
			"param_name" => "shortc_limit",
			"value" => "15",
			"dependency" => Array('element' => "style", 'value' => array('list'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", "wpdance"),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Title" => "title",
				"Rand" => "rand"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", "wpdance"),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"dependency" => Array('element' => "orderby", 'value' => array('date','title')),
			"description" => __("Designates the ascending or descending order.", "wpdance")
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Number", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_number",
			"value" => array(
				"No" => "0",
				"Yes" => "1"
			),
			"dependency" => Array('element' => "style", 'value' => array('widget')),
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
		
	)
);
vc_map( $wd_recent_products );





$wd_onepage_product = array(
	"name" => __("WD Onepage Product", 'wpdance'),
	"base" => "wd_onepage_product",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Products', 'wpdance'),
	"description"	=> '',
	"params" => array(		
		// Heading
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("ID", 'wpdance'),
			"admin_label" => true,
			"param_name" => "id",
			"value" => "",
			"description" => '',
		),
		
		// Heading
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("SKU", 'wpdance'),
			"admin_label" => true,
			"param_name" => "sku",
			"value" => "",
			"description" => '',
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Shortcontent limit", "wpdance"),
			"admin_label" => true,
			"param_name" => "shortc_limit",
			"value" => "40",
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Image", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_image",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
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
		
	)
);
vc_map( $wd_onepage_product );
?>