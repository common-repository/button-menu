/*jQuery(document).ready(function(){
	jQuery('.qc-menu-button-container .menu-item-has-children > a').on('click',function(e){
		var item_li = jQuery(this).parent('li');
		if( item_li.children('.sub-menu').length > 0 ){
			e.preventDefault();
			item_li.siblings('li').fadeOut();
			item_li.children('a').fadeOut(400, "swing", function(){
				item_li.children('.sub-menu').fadeIn();
			});
		}
	});
});*/

jQuery(document).ready(function(){
	jQuery('.qc-menu-button-container .menu-item-has-children > a').on('click',function(e){
		var item_li = jQuery(this).parent('li');

		if( jQuery(this).parents('.qc-menu-button-container').find('.qc-btn-menu-breadcrumb').length > 0 ){
			var breadcrumb = jQuery(this).parents('.qc-menu-button-container').find('.qc-btn-menu-breadcrumb');
			var current_text = jQuery(this).text();
			var breadcrumb_separator = breadcrumb.data('breadcrumb_separator');
			var breadcrumb_length = breadcrumb.find('.qc-btn-menu-breadcrumb-item').length;
			var link_item_id = jQuery(this).data('link-item-id');
			
			if( breadcrumb_length > 0 ){
				breadcrumb.append('<span class="qc-btn-menu-breadcrumb-item">'+'<span class="qc-btn-breadcrumb-icon">'+breadcrumb_separator+'</span><a data-link-id="'+link_item_id+'" data-depth="'+breadcrumb_length+'" href="#">'+current_text+'</a></span>');			
			}else{
				breadcrumb.append('<span class="qc-btn-menu-breadcrumb-item"><a data-link-id="'+link_item_id+'" data-depth="'+breadcrumb_length+'" href="#"><i class="qc-btn-menu-submenu-indicator fas fa-arrow-left"></i></a></span>');
			}

		}

		if( item_li.children('.sub-menu').length > 0 ){
			e.preventDefault();
			item_li.siblings('li').fadeOut();
			item_li.children('a').fadeOut(400, "swing", function(){
				item_li.children('.sub-menu').fadeIn();
			});
		}
	});

	jQuery('.qc-menu-button-container').on('click', '.qc-btn-menu-breadcrumb-item a', function(e){
		e.preventDefault();
		var item_link = jQuery(this).data('link-id');
		jQuery('.qc-btn-menu-link[data-link-item-id="'+item_link+'"]').parent().find('.sub-menu').hide();
		jQuery('.qc-btn-menu-link[data-link-item-id="'+item_link+'"]').parent().find('.sub-menu').find('li, li > a').show();

		jQuery('.qc-btn-menu-link[data-link-item-id="'+item_link+'"]').fadeIn();
		jQuery('.qc-btn-menu-link[data-link-item-id="'+item_link+'"]').parent().siblings('li').fadeIn();
		
		jQuery(this).parent('.qc-btn-menu-breadcrumb-item').nextAll('.qc-btn-menu-breadcrumb-item').remove();
		jQuery(this).parent('.qc-btn-menu-breadcrumb-item').remove();
	});

	jQuery('a[data-qc-btn-icon]').each(function(){
		var icon = jQuery(this).data('qc-btn-icon');
		jQuery(this).prepend('<i class="qc-btn-menu-icon '+icon+'"></i>');
	});
	jQuery('a[data-submenu-indicator]').each(function(){
		var icon = jQuery(this).data('submenu-indicator');
		jQuery(this).append('<i class="qc-btn-menu-submenu-indicator '+icon+'"></i>');
	});

	if ( jQuery.isFunction(jQuery({}).tooltipster) ) { 
		jQuery('.qc-btn-menu-tooltip').each(function(){
			jQuery(this).tooltipster({
			    contentCloning: true,
			    animation: 'grow',
			    selfDestruction: true,
			    theme: 'tooltipster-borderless',
			    trigger: 'hover',
			    zIndex: 99999999,
			});
		});
	}
	
});