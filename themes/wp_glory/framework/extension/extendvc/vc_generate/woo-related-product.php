<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
$woo_related_products_params = array(
	"name" => __("Related Product", 'wpdance'),
	"base" => "related_products",
	"icon" => "icon-wpb-woo",
	"category" => 'Woocommerce',
	"description"	=> '',
	"params" => array(		
		// Title
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"admin_label" => true,
			"param_name" => "posts_per_page",
			"value" => "2",
			"description" => ''
		),
	)
);
vc_map( $woo_related_products_params );
?>