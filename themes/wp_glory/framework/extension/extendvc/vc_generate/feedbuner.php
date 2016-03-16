<?php
// **********************************************************************// 
// ! Register New Element: Feedburner Subscription
// **********************************************************************//
vc_map( array(
		"name" => __("Feedburner Subscription", 'wpdance'),
		"base" => "wd_feedburner",
		"icon" => "icon-wpb-wpdance",
		"category" => __('WPDance Elements', 'wpdance'),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Feedburner ID", 'wpdance'),
				"param_name" => "feedburner",
				"value" => "",
				"description" => ""
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Content", 'wpdance'),
				"param_name" => "intro",
				"value" => "Sign-up for our newsletter. We promise only send good news!",
				"description" => ""
			),			
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Style", 'wpdance'),
				"admin_label" => true,
				"param_name" => "style",
				"value" => array(
					"Style 1" => "style-1",
					"Style 2" => "style-2"
				),
				"description" => ''
			),	
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Align", 'wpdance'),
				"admin_label" => true,
				"param_name" => "align",
				"value" => array(
					"Left" 		=> "text-left",
					"Center" 	=> "text-center",
					"Right" 	=> "text-right"
				),
				"description" => ''
			),	
			
			
		)
) );
?>