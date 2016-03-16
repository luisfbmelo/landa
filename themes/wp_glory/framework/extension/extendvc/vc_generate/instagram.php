<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$instagram_params = array(
	"name" => __("WD Instagram", 'wpdance'),
	"base" => "wd_instagram",
	"icon" => "icon-wpb-wpdance-banner",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
	
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'wpdance'),
			"param_name" => "title",
			"value" => "",
			"description" => '',
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Limit", 'wpdance'),
			"param_name" => "limit",
			"admin_label" => true,
			"value" => "6",
			"description" => '',
		),
		/*array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Columns", 'wpdance'),
			"param_name" => "columns",
			"admin_label" => true,
			"value" => "6",
			"description" => '',
		),*/
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Username/Hashtag", 'wpdance'),
			"param_name" => "instag_user",
			"value" => "#wpdance",
			"admin_label" => true,
			"description" => '',
		),
		
		
	)
);
vc_map( $instagram_params );
?>