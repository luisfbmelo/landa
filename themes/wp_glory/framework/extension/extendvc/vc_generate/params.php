<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
//***********************************************************************


/*VC TABS*/

vc_add_param("vc_tabs", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Responsive Tab Items", 'wpdance'),
	"value" => array(__( "Responsive Tab Items full width?" , "wpdance") => "wd_responsive_fully_tabs_title" ),
	"param_name" => "wd_tab_items_full",
	"description" => "",
));

// Row
//***********************************************************************
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => __("Row Type", 'wpdance'),
	"param_name" => "row_type",
	"value" => array(
		"Row" => "row",
		"Section" => "section"
	)
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Layout", 'wpdance'),
	"param_name" => "layout",
	"value" => array(
		"Wide" => "row-wide",
		"Box" => "row-boxed"	
	),
	"dependency" => Array('element' => "row_type", 'value' => array('row'))
));


vc_add_param("vc_row", array(
	"type" => "textfield",
	"heading" => __("Minimum height", 'wpdance'),
	"param_name" => "min_height",
	"description" => __("You can use pixels (px) or percents (%).", 'wpdance')
));
// hidden phone
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Hidden on Phones", 'wpdance'),
	"param_name" => "hidden_on_phones",
	"value" => array(
		"" => "true"
	),
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Type", 'wpdance'),
	"param_name" => "type",
	"value" => array(
		"In Grid" => "grid",
		"Full Width" => "full"	
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));


vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Content In Grid", 'wpdance'),
	"param_name" => "content_grid",
	"value" => array(
		"" => "false"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));


vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Enable Fullpage", 'wpdance'),
	"param_name" => "use_fullpage",
	"value" => array(
		"" => "false"
	),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Screen title", 'wpdance'),
	"param_name" => "screen_title",
	"value" => "",
	"dependency" => array(
		"element" => "use_fullpage",
		"not_empty" => true
	)
));
// parallax speed
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Enable parallax", 'wpdance'),
	"param_name" => "enable_parallax",
	"value" => array(
		"" => "false"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Fixed image", 'wpdance'),
	"param_name" => "parallax_fixed",
	"value" => array(
		"" => "true"
	),
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Parallax speed", 'wpdance'),
	"param_name" => "parallax_speed",
	"value" => "0.1",
	"dependency" => array(
		"element" => "enable_parallax",
		"not_empty" => true
	)
));



vc_add_param("vc_column", array(
		'type' => 'colorpicker',
		'heading' => __( 'Font Color', 'wpdance' ),
		'param_name' => 'font_color',
		'description' => __( 'Select font color', 'wpdance' ),
		'edit_field_class' => 'vc_col-md-6 vc_column'
));

vc_add_param("vc_column", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __( "Animate", "wpdance"),
	"value" => array(__( "Use Animate?" , "wpdance") => "show_animate" ),
	"param_name" => "show_animate",
	"description" => "",
));

vc_add_param("vc_column", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __( "Middle content", "wpdance"),
	"value" => array(__( "Content in middle?" , "wpdance") => "content_middle" ),
	"param_name" => "content_middle",
	"description" => "",
));

global $wd_effect_arg;

vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __( "Animate Type", "wpdance" ),
	"param_name" => "animate_type",
	"value" => $wd_effect_arg,
	"dependency" => Array('element' => "show_animate", 'value' => array('show_animate'))
));

vc_add_param("vc_column", array(
	"type" => "textfield",
	"class" => "",
	"heading" => __( "Animated Time", "wpdance" ),
	"value" => "600",
	"param_name" => "animate_time",
	"description" => "",
	"dependency" => Array('element' => "show_animate", 'value' => array('show_animate'))
));

/***  TOUR   vc_tour***/

$tour_new_params = array(
	array(
		"type" 			=> "dropdown",
		"class" 		=> "",
		"heading" 		=> __( "Type", "wpdance" ),
		"value" 		=> array(
			"Default"			=> 'default',
			"WD Product style"	=> 'wd_prod_style',
		),
		"param_name" 	=> "wd_type",
		"weight"		=> 1,
		"description" 	=> "",
	),
	array(
		'type'			=> 'colorpicker',
		"heading" 		=> __( "Heading Background", "wpdance" ),
		"value"			=> '#333333',
		"param_name"	=> "wd_head_backg",
		"dependency" 	=> Array('element' => "wd_type", 'value' => array('wd_prod_style'))
	),
	array(
		'type'			=> 'textfield',
		"heading" 		=> __( "Tabs box Background url", "wpdance" ),
		"value"			=> '',
		"param_name"	=> "wd_tab_box_backg",
		"dependency" 	=> Array('element' => "wd_type", 'value' => array('wd_prod_style'))
	),
);
vc_add_params( "vc_tour", $tour_new_params );


?>