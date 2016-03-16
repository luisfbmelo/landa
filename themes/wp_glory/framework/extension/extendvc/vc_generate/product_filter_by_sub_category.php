<?php
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// **********************************************************************// 

// ! Register New Element: WD Product filter by sub categories

// **********************************************************************//

$product_sub_category = array(
	'name' => __( 'WD Product Filter By Categories', 'wpdance' )
	,'base' => 'product_filter_by_sub_category'
	,"icon" => "icon-wpb-wpdance-banner"
	,"category" => __('WPDance Slider', 'wpdance')
	,'params' => array(		
		array(
			'type' => 'textfield'
			,'heading' => __( 'Block title', 'wpdance' )
			,'param_name' => 'title'
			,'admin_label' => true
			,'value' => ''
			,'description' => ''
		)
		,array(
			'type' => 'textarea'
			,'heading' => __( 'Block description', 'wpdance' )
			,'param_name' => 'desc'
			,'admin_label' => true
			,'value' => ''
			,'description' => ''
		)

		,array(
			'type' => 'textfield'
			,'heading' => __( 'Columns', 'wpdance' )
			,'param_name' => 'columns'
			,'admin_label' => true
			,'value' => '4'
			,'description' => ''
		)
		,array(
			'type' => 'textfield'
			,'heading' => __( 'Number of products for each sub category', 'wpdance' )
			,'param_name' => 'per_page'
			,'admin_label' => true
			,'value' => '4'
			,'description' => ''
		)
		,array(
			'type' => 'exploded_textarea'
			,'heading' => __( 'Product Categories', 'wpdance' )
			,'param_name' => 'product_cats'
			,'admin_label' => true
			,'value' => ''
			,'description' => __('A comma separated list of parent product category slugs', 'wpdance')
		 )
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show product image', 'wpdance' )
			,'param_name' => 'show_image'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
				)
			,'description' => ''
		 )
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show product title', 'wpdance' )
			,'param_name' => 'show_title'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
			)
			,'description' => ''
		 )
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show price', 'wpdance' )
			,'param_name' => 'show_price'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
			)
			,'description' => ''
		 )
		 
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show rating', 'wpdance' )
			,'param_name' => 'show_rating'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
			)
			,'description' => ''
		 )
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show label', 'wpdance' )
			,'param_name' => 'show_label'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
			)
			,'description' => ''
		 )
		 
		 ,array(
			'type' => 'dropdown'
			,'heading' => __( 'Show Product Button', 'wpdance' )
			,'param_name' => 'show_prod_buttons'
			,'admin_label' => true
			,'value' => array(
				'Yes'		=> 1
				,'No'		=> 0
			)
			,'description' => ''
		 )
	)
);
vc_map( $product_sub_category );
?>