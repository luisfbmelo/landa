<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
$woo_product_category_params = array(
	"name" => __("Product Category", 'wpdance'),
	"base" => "product_category",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> __('List products in a category shortcode', 'wpdance'),
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "per_page",
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
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Category", 'wpdance'),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => ''
		),
		
	)
);
vc_map( $woo_product_category_params );


$wd_product_categories_params = array(
	"name" => __("WD Product Categories", 'wpdance'),
	"base" => "wd_product_cat_slider",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> __('List categories in store shortcode', 'wpdance'),
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "limit",
			"value" => "6",
			"description" => ''
		),
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"admin_label" => true,
			"param_name" => "columns",
			"value" => "3",
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Rows", 'wpdance'),
			"admin_label" => true,
			"param_name" => "rows",
			"value" => "",
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'wpdance'),
			"admin_label" => true,
			"param_name" => "style",
			"value" => array(
				"Style 1"	=> 'style-1',
				"Style 2"	=> 'style-2',
			),
		),
		/*array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Color style", 'wpdance'),
			"admin_label" => true,
			"param_name" => "backg_hover",
			"value" => array(
				"Dark"	=> 'dark',
				"Light"	=> 'light',
			),
			"dependency" => Array('element' => "style", 'value' => array('style-2'))
		),*/
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Nav", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_nav",
			"value" => array(
				"Yes"	=> '1',
				"No"	=> '0',
			),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Autoplay", 'wpdance'),
			"admin_label" => true,
			"param_name" => "autoplay",
			"value" => array(
				"No"	=> '0',
				"Yes"	=> '1'
			),
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Hide empty", 'wpdance'),
			"admin_label" => true,
			"param_name" => "hide_empty",
			"value" => array(
				"Yes"	=> '1',
				"No"	=> '0',
			),
		),
		
	)
);
vc_map( $wd_product_categories_params );


?>