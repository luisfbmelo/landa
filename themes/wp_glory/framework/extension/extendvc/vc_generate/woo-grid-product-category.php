<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
$woo_grid_product_category_params = array(
	"name" => __("Grid Categories", 'wpdance'),
	"base" => "wd_grid_product_cat",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> __('', 'wpdance'),
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "limit",
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
			"value" => "3",
			"description" => ''
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
vc_map( $woo_grid_product_category_params );
?>