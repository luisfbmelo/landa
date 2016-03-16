<?php

// **********************************************************************// 

// ! Register New Element: WD Recent Blogs

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Recent Blogs
// **********************************************************************//

$wd_video_params = array(
	"name" => __("WD Video Background", 'wpdance'),
	"base" => "wd_video",
	"icon" => "icon-wpb-wpdance",
	"category" => __('WPDance Elements', 'wpdance'),
	"params" => array(
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("use cover", 'wpdance'),
			"admin_label" => true,
			"param_name" => "use_cover",
			"value" => array(
					'yes' 		=> '1',
					'no' 		=> '0'
			)
		),
		
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Cover url", 'wpdance'),
			"param_name" => "cover_url",
			"value" => "",
			"dependency" => Array('element' => "use_cover", 'value' => array('1'))
		),
		
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'wpdance'),
			"param_name" => "bg_color",
			"value" => "",
			"dependency" => Array('element' => "use_cover", 'value' => array('1'))
		),
		
		array(
			"type" => "vc_link",
			"class" => "",
			"heading" => __("MP4 url", 'wpdance'),
			"param_name" => "mp4",
			"value" => "",
		),
		
		array(
			"type" => "vc_link",
			"class" => "",
			"heading" => __("Webm url", 'wpdance'),
			"param_name" => "webm",
			"value" => "",
		),
		
		array(
			"type" => "vc_link",
			"class" => "",
			"heading" => __("Ogv url", 'wpdance'),
			"param_name" => "ogv",
			"value" => "",
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Height", 'wpdance'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "480px",
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Video color", 'wpdance'),
			"param_name" => "v_bg_color",
			"value" => array(
				'None' 			=> 'none',
				'Dark' 		=> 'black',
				'Light' 		=> 'White'
			)
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Opacity", 'wpdance'),
			"param_name" => "bg_opacity",
			"value" => "0.15",
			"dependency" => Array('element' => "v_bg_color", 'value' => array('black','White'))
		),
		
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Play Button Margin top", 'wpdance'),
			"param_name" => "v_margin_top",
			"value" => "",
		),
		
		array(
			"type" => "textarea_html",
			"class" => "",
			"heading" => __("Content", 'wpdance'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Auto play", 'wpdance'),
			"admin_label" => true,
			"param_name" => "auto_play",
			"value" => array(
					'No' 		=> '0',
					'Yes' 		=> '1'
			)
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loop", 'wpdance'),
			"admin_label" => true,
			"param_name" => "loop",
			"value" => array(
				'Yes' 		=> '1',
				'No' 		=> '0'	
			)
		),
		
	)
);
vc_map( $wd_video_params );
?>