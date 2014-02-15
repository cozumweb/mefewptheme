// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.mefe_button', {
        init : function(ed, url) {
            ed.addButton('mefe_button', {
                title : 'Shortcodes',
                image : url+'/mefe_button.png',
                onclick : function() {
				
					
				
				
				
					modal = jQuery('.mefe_sc_dialog').clone().html();

					jQuery('body').prepend('<div class="mefe_mask"></div>');

					//Get the screen height and width
					var maskHeight = jQuery(document).height();
					var maskWidth = jQuery(window).width();

					//Set height and width to mask to fill up the whole screen
					jQuery('.mefe_mask').css({'width':maskWidth,'height':maskHeight});
					 
					//transition effect    
					jQuery('.mefe_mask').fadeTo("slow",0.8);  
							
					jQuery('body').prepend('<div class="mefe_modal_container"><div class="mefe_modal_header"><span class="mefe_close_modal">x</span></div></div>');
					//jQuery('.mefe_modal_container').append(modal);
					jQuery(modal).appendTo('.mefe_modal_container');

					//Get the window height and width
					var winH = jQuery(window).height();
					var winW = jQuery(window).width();
						   
					//Set the popup window to center
					jQuery('.mefe_modal_container').css('top',  winH/2-jQuery('.mefe_modal_container').height()/2);
					jQuery('.mefe_modal_container').css('left', winW/2-jQuery('.mefe_modal_container').width()/2);
		
					jQuery('.mefe_sc_title').click( function(){
						
						var sc = jQuery(this).next('.mefe_shortcode_text').html();
						//alert(sc);

						
						ed.selection.setContent(sc);
						var sc = '';
						// Close the modal and remove it from DOM
						jQuery('.mefe_mask').detach();
						jQuery('.mefe_modal_container').detach();
					});
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('mefe_button', tinymce.plugins.mefe_button);
	
	
	
})();