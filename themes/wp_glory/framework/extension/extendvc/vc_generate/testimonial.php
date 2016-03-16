<?php

// **********************************************************************// 

// ! Register New Element: WD Testimonial

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Testimonial
// **********************************************************************//
$is_woo_testimonial = true;
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
	$is_woo_testimonial = false;
}
if( $is_woo_testimonial ){
	$testimonials = woothemes_get_testimonials(array('limit'=>-1, 'size' => 100));
	$list_testimonials = array();
	if(!empty($testimonials)) {
		foreach( $testimonials as $testimonial ){
			$list_testimonials[$testimonial->post_title] = $testimonial->ID;
		}
	}
	
	$testimonial_params = array(
		"name" => __("Testimonial", 'wpdance'),
		"base" => "wd_testimonial",
		"icon" => "icon-wpb-wpdance",
		"category" => "WPDance Elements",
		"params" => array(
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Heading", "wpdance"),
				"admin_label" => true,
				"param_name" => "title",
				"value" => "",
				"description" => "",
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Box style", "wpdance"),
				"admin_label" => true,
				"param_name" => "box_style",
				"value" => array(
					"No box" => "",
					"Boxed" => "style-boxed",
					"Focus - square" => "style-focus"
				),
				"description" => ""
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Type", 'wpdance'),
				"admin_label" => true,
				"param_name" => "wd_query_type",
				"value" => array(
					"Simple"	=> 'simple',
					"Slider"	=> 'slider',
				),
				"description" => ''
			),
			
			array(
				"type" => "dropdown",
				"heading" => __("Style", 'wpdance'),
				"param_name" => "style",
				"value" => array(
					"Meta style"	=> 'meta',
					"Avatar style"	=> 'avatar',
					"Widget"		=> 'widget',
				),
				"description" => '',
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple'))
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Testimonial", 'wpdance'),
				"admin_label" => true,
				"param_name" => "id",
				"value" => $list_testimonials,
				"description" => '',
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "limit",
				"value" => '3',
				"description" => '',
				"dependency" => Array('element' => "wd_query_type", 'value' => array('slider'))
			),
			
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Image", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_img",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Meta Time", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_date",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Short Content", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_short",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Excerpt word number", 'wpdance'),
				"admin_label" => true,
				"param_name" => "short_limit",
				"value" => "20",
				"description" => __("Limit number of Excerpt words", 'wpdance')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Nav", "wpdance"),
				"admin_label" => true,
				"param_name" => "show_nav",
				"value" => array(
					"Yes" => "1",
					"No" => "0"
				),
				"description" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Nav Position", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_nav_pos",
				"value" => array(
					"Pos 1 (Top Right)" 	=> "top_right",
                    "Pos 2 (Middle center)" => "middle_center",
                    "Pos 3 (Bottom Center)" => "bottom_center",
				),
				"dependency" => Array('element' => "show_nav", 'value' => array('1'))
			),
			
		)
	);
	vc_map( $testimonial_params );
}
?>