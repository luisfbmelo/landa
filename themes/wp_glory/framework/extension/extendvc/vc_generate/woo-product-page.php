<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
$woo_product_page_params = array(
	"name" => __("Product Page", 'wpdance'),
	"base" => "product_page",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> __('Show a single product page', 'wpdance'),
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "sku",
			"value" => "",
			"description" => ''
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("ID", 'wpdance'),
			"admin_label" => true,
			"param_name" => "id",
			"value" => "",
			"description" => ''
		),
	)
);
vc_map( $woo_product_page_params );
?>