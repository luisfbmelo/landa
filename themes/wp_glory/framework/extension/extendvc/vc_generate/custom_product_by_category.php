<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//

$custom_product_by_category_params = array(
	"name" => __("WD Custom Products by Category", 'wpdance'),
	"base" => "custom_product_by_category",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"description"	=> '',
	"params" => array(		
	/*	
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
	*/
		
		// Per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
			"value" => "10",
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
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Category Name", "wpdance"),
			"admin_label" => true,
			"param_name" => "show_cat_title",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ""
		),
		
		/*
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
		*/
		
	)
);
vc_map( $custom_product_by_category_params );
?>