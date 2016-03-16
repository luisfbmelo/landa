<?php

// **********************************************************************// 

// ! Register New Element: WD Feature

// **********************************************************************//

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 
// ! Register New Element: WD Feature
// **********************************************************************//
$wd_is_feature = true;
$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if ( !in_array( "features-by-woothemes/woothemes-features.php", $_actived ) ) {
		$wd_is_feature = false;
	}
if( $wd_is_feature ){
	$features = woothemes_get_features( array('limit' => -1,'size' => 'feature-thumbnail' ));
	$list_features = array();
	if( is_array($features) ){
		foreach( $features as $feature ){
			$list_features[$feature->post_title] = $feature->ID;
		}
	}
	
	$feature_params = array(
		"name" => __("Feature", 'wpdance'),
		"base" => "wd_feature",
		"icon" => "icon-wpb-wpdance",
		"category" => __('WPDance Elements', 'wpdance'),
		"params" => array(
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
				"class" => "",
				"heading" => __("Style", 'wpdance'),
				"admin_label" => true,
				"param_name" => "style",
				"value" => array(
					"Style 1"	=> 'style-1',
					"Style 2"	=> 'style-2',
					"Style 3"	=> 'style-3',
					"Style 4"	=> 'style-4',
				),
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Feature", 'wpdance'),
				"admin_label" => true,
				"param_name" => "id",
				"value" => $list_features,
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "limit",
				"value" => '6',
				"description" => '',
				"dependency" => Array('element' => "wd_query_type", 'value' => array('slider'))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon Feature", 'wpdance'),
				"admin_label" => true,
				"param_name" => "icon_image",
				"value" => "",
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple')),
				"description" => __("Use font Awesome icon, image url or media image id.", 'wpdance')
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon color", 'wpdance'),
				"admin_label" => true,
				"param_name" => "icon_color",
				"value" => "",
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple')),
			),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text color", 'wpdance'),
				"admin_label" => true,
				"param_name" => "text_color",
				"value" => "",
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple')),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Icon", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_icon",
				"value" => array(
						'Yes' => '1',
						'No' => '0'
					),
				"group"		=> __('Show/Hide', 'wpdance'),
				"dependency" => Array('element' => "wd_query_type", 'value' => array('simple'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Title", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_title",
				"group"		=> __('Show/Hide', 'wpdance'),
				"value" => array(
						'Yes' => '1',
						'No' => '0'
					),
				"description" => ''
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Excerpt", 'wpdance'),
				"admin_label" => true,
				"param_name" => "show_excerpt",
				"group"		=> __('Show/Hide', 'wpdance'),
				"value" => array(
						'Yes' => '1',
						'No' => '0'
					),
				"description" => ''
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Excerpt Words Limit", 'wpdance'),
				"admin_label" => true,
				"param_name" => "excerpt_words",
				"value" => '10',
				"description" => '',
				"dependency" => Array('element' => "show_excerpt", 'value' => array('1'))
			),
			
		)
	);
	vc_map( $feature_params );
}
?>