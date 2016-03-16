<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
$woo_product_add_to_cart_params = array(
	"name" => __("Add To Cart", 'wpdance'),
	"base" => "add_to_cart",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> '',
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

		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("ID", 'wpdance'),
			"admin_label" => true,
			"param_name" => "id",
			"value" => "",
			"description" => ''
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Style", 'wpdance'),
			"param_name" => "style",
			"value" => "border:4px solid #ccc; padding: 12px;",
			"description" => ""
		),
		// add dropdown
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show Price", 'wpdance'),
			"admin_label" => true,
			"param_name" => "show_price",
			"value" => array(
				"Yes" => "1",
				"No" => "0"
			),
			"description" => ''
		),
	)
);
vc_map( $woo_product_add_to_cart_params );


$woo_product_add_to_cart_url_params = array(
	"name" => __("Add To Cart Url", 'wpdance'),
	"base" => "add_to_cart_url",
	"icon" => "icon-wpb-woo",
	"category" => __('Woocommerce', 'wpdance'),
	"description"	=> '',
	"params" => array(		
		// Columns
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("ID", 'wpdance'),
			"admin_label" => true,
			"param_name" => "id",
			"value" => "",
			"description" => ''
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sku", 'wpdance'),
			"admin_label" => true,
			"param_name" => "sku",
			"value" => "",
			"description" => ''
		)
	)
);
vc_map( $woo_product_add_to_cart_url_params );
?>