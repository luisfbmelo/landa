jQuery(document).ready(function(){
    "use strict";/*Custom*/
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
        jQuery( "select#page_template" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Portfolio Template'){
                jQuery("li.portfolio_columns").show();
            } else {
                jQuery("li.portfolio_columns").hide();
            }
        });
    }
	/* attach event to  page attributes changed */ 
    if(jQuery("select#page_template").length > 0 ){
		var old_option = jQuery.trim(jQuery( 'select#page_template' ).find('option:selected').html());
		if( old_option == 'Contact Template' || old_option == 'Fullwidth Template' || old_option == 'Sitemap Template' || old_option == 'Archive Template'){
			jQuery("#page_config").hide();
		}
		if( old_option == 'Blog Template' || old_option == 'Portfolio Template'){
			jQuery("li.sub_layout").hide();
		}
        jQuery( "select#page_template" ).on( "change", function() {
			var option = jQuery.trim(jQuery( this ).find('option:selected').html());
            if( option == 'Contact Template' || option == 'Fullwidth Template' || option == 'Sitemap Template' || option == 'Archive Template'){
                jQuery("#page_config").hide();
            } else if( option == 'Blog Template' || option == 'Portfolio Template'){
				jQuery("#page_config").show();
				jQuery("li.sub_layout").hide();
			}
			else {
                jQuery("#page_config").show();
				jQuery("li.sub_layout").show();
            }
			 
        });
    }
	if(jQuery("select#page_layout").length > 0 ){
        jQuery( "select#page_layout" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').html()) == 'Wide'){
				var option = jQuery.trim(jQuery( "select#page_template" ).find('option:selected').html());
				if( option != 'Blog Template' && option != 'Portfolio Template'){
					jQuery("li.sub_layout").show();
				}
            } else {
                jQuery("li.sub_layout").hide();
            }
        });
    }
	
	
	if(jQuery("select.global_config").length > 0 ){
		
		var $_list = jQuery( "select.global_config" );
		
		$_list.each(function(){
			var $_val1 = jQuery(this).val();
			var $_config1 = jQuery(this).attr('data-config');
			$_config1 += $_val1;
			jQuery($_config1).show();
			
			jQuery(this).on( "change", function() {
				var $_val = jQuery(this).find("option:selected").val();
				var $_config = jQuery(this).attr('data-config');
				var $_sub = $_config + 'sub';
				
				$_config += $_val;
				
				jQuery($_sub).hide();
				jQuery($_config).show();
			});
			
		});
    }
	
	/*
	if(jQuery("select#page_type").length > 0 ){
        jQuery( "select#page_type" ).on( "change", function() {
            if( jQuery.trim(jQuery( this ).find('option:selected').val()) == 1){
                jQuery("ul.page_config_list li").not('.wd_slider_config').hide();
            } else {	
				jQuery("ul.page_config_list li").show();
			}
        });
    }
	*/
});