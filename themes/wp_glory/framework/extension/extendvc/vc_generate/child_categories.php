<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Child categories

// **********************************************************************//

$child_categories_params = array(
	"name" => __("WD Child Categories", 'wpdance'),
	"base" => "wd_child_categories",
	"icon" => "icon-wpb-wpdance-banner",
	"category" => __('WPDance Products', 'wpdance'),
	'params' => array(

		/*array(
			"type" => "wd_taxonomy",
			"taxonomy" => "product_cat",
			"class" => "",
			"heading" => __("Category Slug", "wpdance"),
			"admin_label" => true,
			"param_name" => "category",
			"value" => "",
			"description" => ""
		)*/
		array(
			'type' => 'exploded_textarea'
			,'heading' => __( 'Product Categories', 'wpdance' )
			,'param_name' => 'category'
			,'admin_label' => true
			,'value' => ''
			,'description' => __('A comma separated list of parent product category slugs', 'wpdance')
		 )
		 ,array(
			'type' => 'textfield'
			,'heading' => __( 'Columns', 'wpdance' )
			,'param_name' => 'columns'
			,'admin_label' => true
			,'value' => 3
			,'description' => ''
		 )
		,array(
			'type' => 'textfield'
			,'heading' => __( 'Number of sub categories', 'wpdance' )
			,'param_name' => 'limit'
			,'admin_label' => true
			,'value' => 5
			,'description' => ''
		 )
		 ,array(
			'type' => 'textarea'
			,'heading' => __( 'Description', 'wpdance' )
			,'param_name' => 'desc'
			,'admin_label' => true
			,'value' => ''
			,'description' => __('Input your description or it will load description of category', 'wpdance')
		 )
		 ,array(
			'type' => 'colorpicker'
			,'heading' => __( 'Background color', 'wpdance' )
			,'param_name' => 'bg_color'
			,'admin_label' => true
			,'value' => ''
			,'description' => ''
		 )
		 ,array(
			'type' => 'colorpicker'
			,'heading' => __( 'Text color', 'wpdance' )
			,'param_name' => 'text_color'
			,'admin_label' => true
			,'value' => ''
			,'description' => ''
		 )
		 ,array(
			'type' => 'textfield'
			,'heading' => __( 'Height', 'wpdance' )
			,'param_name' => 'height'
			,'admin_label' => true
			,'value' => ''
			,'description' => __('Ex: 400px, 5em, ...', 'wpdance')
		 )	
		 ,array(
			'type' => 'textfield'
			,'heading' => __( 'Button text', 'wpdance' )
			,'param_name' => 'button_text'
			,'admin_label' => true
			,'value' => 'View All'
			,'description' => ''
		 )
		 ,array(
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
		)
		
		,array(
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
		)
	)
);
vc_map( $child_categories_params );
?>