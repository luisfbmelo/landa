// The toggle

jQuery(document).ready(function($){

    jQuery('#grid').click(function() {
		jQuery.cookie('gridcookie','grid', { path: '/' });
		jQuery('.grid-list-action .products').addClass('grid').removeClass('list');
		jQuery('.grid-list-action .products > .product').addClass($_sub_class);
		jQuery('.grid-list-action .products > .product').find('.product_short_content').hide();
		return false;
	});

	jQuery('#list').click(function() {
		jQuery.cookie('gridcookie','list', { path: '/' });
		jQuery('.grid-list-action .products').removeClass('grid').addClass('list');
		jQuery('.grid-list-action .products > .product').removeClass($_sub_class);
		jQuery('.grid-list-action .products > .product').find('.product_short_content').show();
		return false;
	});

	if (jQuery.cookie('gridcookie')) {
        jQuery('.grid-list-action .products').addClass(jQuery.cookie('gridcookie'));
    }

    if (jQuery.cookie('gridcookie') == 'grid') {
        jQuery('.gridlist-toggle #grid').addClass('active');
        jQuery('.gridlist-toggle #list').removeClass('active');
		jQuery('.grid-list-action .products > .product').addClass($_sub_class);
		jQuery('.grid-list-action .products > .product').find('.product_short_content').hide();
    }

    if (jQuery.cookie('gridcookie') == 'list') {
        jQuery('.gridlist-toggle #list').addClass('active');
        jQuery('.gridlist-toggle #grid').removeClass('active');
		jQuery('.grid-list-action .products > .product').removeClass($_sub_class);
		jQuery('.grid-list-action .products > .product').find('.product_short_content').show();
    }
});