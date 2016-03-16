<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$recent_product_by_category_params = array(
	"name" => __("WD Recent Products - SD", 'wpdance'),
	"base" => "recent_product_by_categories_slider",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Slider', 'wpdance'),
	"description"	=> '',
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Heading", 'wpdance'),
			"admin_label" => true,
			"param_name" => "title",
			"value" => "",
			"description" => ''
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
		
		// desc
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => __("Description", 'wpdance'),
			"param_name" => "desc",
			"value" => "",
			"description" => ''
		),
		
		// Columns
		
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "4",
			"description" => __("product number visible on slider", 'wpdance')
		),
		
		// add Row
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Row", 'wpdance'),
			"param_name" => "row",
			"value" => "1",
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
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "8",
			"description" => __("Limit number of products", 'wpdance')
		),
		
		array(
			"type" => "wd_taxonomy",
			"taxonomy" => "product_cat",
			"class" => "",
			"heading" => __("Category Slug", 'wpdance'),
			"admin_label" => true,
			"param_name" => "cat_slug",
			"value" => "",
			"description" => ''
		),
		// product_tag
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Product Tags", "wpdance"),
			"admin_label" => true,
			"param_name" => "product_tag",
			"value" => "",
			"description" => __("Get all products have this tag", "wpdance")
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
			)
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
			"dependency" => Array('element' => "slider", 'value' => array('1'))
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Autoplay", 'wpdance'),
			"admin_label" => true,
			"param_name" => "autoplay",
			"value" => array(
				"No" => "0",
				"Yes" => "1",
			),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Slider base this element", "wpdance"),
			"admin_label" => true,
			"param_name" => "slider_base_e",
			"value" => array(
				"No" => "0",
				"Yes" => "1"
			),
			"description" => ""
		),
		
	)
);
vc_map( $recent_product_by_category_params );
?>