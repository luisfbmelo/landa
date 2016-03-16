<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$wd_recent_products = array(
	"name" => __("WD Products Category", 'wpdance'),
	"base" => "wd_products_filter_by_cats",
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Cat slug", "wpdance"),
			"admin_label" => true,
			"param_name" => "cat_slug",
			"value" => "",
			"description" => "A comma separated list of product category slugs"
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Relation", "wpdance"),
			"admin_label" => true,
			"param_name" => "relation",
			"value" => array(
				"AND" => "and",
				"OR" => "or"
			)
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
			"param_name" => "shortc_limit",
			"value" => "15",
			"dependency" => Array('element' => "style", 'value' => array('list'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", "wpdance"),
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
?>