<?php

// **********************************************************************// 

// ! Register New Element: WD Portfolio

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Portfolio
// **********************************************************************//
if( class_exists('WD_Portfolio') ){
	
	$portfolio_params = array(
		"name" => __("Portfolio", 'wpdance'),
		"base" => "wd-portfolio",
		"icon" => "icon-wpb-wpdance",
		"category" => __('WPDance Elements', 'wpdance'),
		"params" => array(
		
			// Heading
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Columns", 'wpdance'),
				"admin_label" => true,
				"param_name" => "columns",
				"value" => '4',
				"description" => '',
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Style", 'wpdance'),
				"admin_label" => true,
				"param_name" => "portf_style",
				"value" => array(
						'Full Style' => 'full',
						'Wide style' => 'wide'
					),
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Filter", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_filter",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Title", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_title",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				"dependency" => Array('element' => "portf_style", 'value' => array('full'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Description", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_desc",
				"value" => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				"dependency" => Array('element' => "portf_style", 'value' => array('full'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "count",
				"value" => '-1',
				"description" => ''
			),
		)
	);
	vc_map( $portfolio_params );
}
?>