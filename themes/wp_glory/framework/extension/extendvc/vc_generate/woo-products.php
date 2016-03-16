<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//
$woo_products_params = array(
	"name" => __("Products", 'wpdance'),
	"base" => "products",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> '',
	"params" => array(		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Skus", 'wpdance'),
			"admin_label" => true,
			"param_name" => "sku",
			"value" => "",
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("IDs", 'wpdance'),
			"admin_label" => true,
			"param_name" => "id",
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
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order By", 'wpdance'),
			"admin_label" => true,
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Title" => "title",
				"Rand" => "rand"
			),
			"description" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", 'wpdance'),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'wpdance')
		),
	)
);
vc_map( $woo_products_params );
?>