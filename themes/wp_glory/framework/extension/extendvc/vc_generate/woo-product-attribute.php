<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
// **********************************************************************// 
// ! Register New Element: WD Recent Products By Category Products
// **********************************************************************//
$woo_product_attribute_params = array(
	"name" => __("Product Attribute", 'wpdance'),
	"base" => "product_attribute",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> '',
	"params" => array(		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "limit",
			"value" => "",
			"description" => ''
		),
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
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Attribute", 'wpdance'),
			"admin_label" => true,
			"param_name" => "attribute",
			"value" => "",
			"description" => __("Example [product_attribute attribute='color' filter='black']", 'wpdance')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Filter", 'wpdance'),
			"admin_label" => true,
			"param_name" => "filter",
			"value" => "",
			"description" => __("Example [product_attribute attribute='color' filter='black']", 'wpdance')
		),
	)
);
vc_map( $woo_feature_products_params );
?>