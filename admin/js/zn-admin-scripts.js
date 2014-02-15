(function ($) { /*global $, jQuery*/








    /* HIDE OPTIONS BASED ON mefe_HIDE*/

    jQuery.fn.mefe_hide_options = function () {

        this.each(function () {

            var mefe_this_rel = $(this).attr('rel'),

                mefe_this_value = $(this).attr('value'),

                mefe_all_options = $(this).parent('div'),

                e = jQuery(this),

                values = [];

            jQuery(mefe_all_options).children('input').each(function (i, selected) {

                values[i] = $(selected).val();

                if (jQuery(e).parents('.mefe_accordion').length === 0) { /*Show only the selected option with class*/

                    jQuery('.' + mefe_this_rel + '-' + values[i] + '').hide();

                } else { /*Show only the selected option with class*/

                    jQuery(e).parents('.mefe_slide').find('.' + mefe_this_rel + '-' + values[i] + '').hide();

                }

            }); /*Show only the selected option with class*/

            if (jQuery(this).parents('.mefe_accordion').length === 0) { /*Show only the selected option with class*/

                jQuery('.' + mefe_this_rel + '-' + mefe_this_value + '').show();

            } else { /*Show only the selected option with class*/

                jQuery(this).parents('.mefe_slide').find('.' + mefe_this_rel + '-' + mefe_this_value + '').show();

            }

            jQuery('.slide_body').hide();

        });

    };

    jQuery(document).ready(function ($) { /* Fix firefox forms*/
	
	
/* Install dummy data */

	/* save everything */
	$('.mefe_install_dummy').live('click',function() {
			
			
		if (jQuery(this).hasClass('mefe_inactive')) {

			return false;

		}

        var theAnswer = confirm("Are you sure you want to install the dummy data?");
			
        if (!theAnswer){
            return false;
        }

    
		var nonce = $('#security').val();
					
		$('.ajax-loading-img').fadeIn();
										
		var serializedReturn = $('#mefe_form :input[name][name!="security"][name!="of_reset"]').serialize();
										
		//alert(serializedReturn);
						
		var data = {
			type: 'install_dummy',
			action: 'mefe_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {

				jQuery('.mefe_response').html('').hide();
				jQuery('.mefe_response').append(response);
				document.location.reload(true);


		});
			
	return false; 
					
	});   
	
/* Install dummy data */

    /* save everything */
    $('#mefe_form').on('click','.mefe_backup_options',function() {
            
            
        if (jQuery(this).hasClass('mefe_inactive')) {
            return false;
        }

        var nonce = $('#security').val(),
            loading = $('.ajax-loading-img'),
            bak_list = $('.mefe_backup_list'),
            no_bak = $('.no_backups_text');

        // Show the hourglass
        loading.fadeIn();
                                        
        var serializedReturn = $('#mefe_form :input[name][name!="security"][name!="of_reset"]').serialize();
                                        
        //alert(serializedReturn);
                        
        var data = {
            type: 'mefe_backup_options',
            action: 'mefe_ajax_post_action',
            security: nonce,
            data: serializedReturn
        };
                    
        $.post(ajaxurl, data, function(response) {
            bak_list.append('<li><a class="mefe_question mefe_restore_option" data-backup="'+response+'" original-title="Restore this backup ?" href="#">'+response+'</a><span data-backup="'+response+'" class="mefe_question mefe_delete_backup mefe_delete" original-title="Delete this backup ?">x</span><li>');
            no_bak.remove();
            loading.fadeOut();
        });
            
    return false; 
                    
    });

    /* Restore backup everything */
    $('#mefe_form').on('click','.mefe_restore_option',function() {
            
        var nonce     = $('#security').val(),
            loading   = $('.ajax-loading-img'),
            restore_options     = jQuery(this).data('backup'),
            theAnswer = confirm("Are you sure you want to restore this backup?");

        // Do nothing if it was a mistake
        if (!theAnswer){
            return false;
        }

        // Show the hourglass
        loading.fadeIn();
     
        var data = {
            type: 'mefe_restore_options',
            action: 'mefe_ajax_post_action',
            security: nonce,
            data : restore_options
        };
                    
        $.post(ajaxurl, data, function(response) {
            alert('Options successfully restored. The page will now refresh !');
            loading.fadeOut();
            document.location.reload(true);
        });
            
        return false; 
                    
    });

    /* Delete backup  */
    $('#mefe_form').on('click','.mefe_delete_backup',function() {
            
        var nonce     = $('#security').val(),
            loading   = $('.ajax-loading-img'),
            el        = jQuery(this),
            restore_options     = el.data('backup'),
            theAnswer = confirm("Are you sure you want to delete this backup?"),
            no_bak = $('.no_backups_text');

        // Do nothing if it was a mistake
        if (!theAnswer){
            return false;
        }

        // Show the hourglass
        loading.fadeIn();
     
        var data = {
            type: 'mefe_delete_backup',
            action: 'mefe_ajax_post_action',
            security: nonce,
            data : restore_options
        };
                    
        $.post(ajaxurl, data, function(response) {
            //alert('Options successfully deleted');
            el.parent('li').remove();
            if (el.closest('ul').children().length < 1 ) {
                no_bak.show();
            }
            loading.fadeOut();
        });
            
        return false; 
                    
    });


        jQuery.browser.mozilla && jQuery('#mefe_form input:radio').each(function () {

            this.checked = this.defaultChecked;

        }); 
        /* Start datepicker*/
        jQuery(".mefe_date_picker").datepicker({
            dateFormat: "mm/dd/yy"
        });

        jQuery('.mefe_time_picker').timepicker({
            'timeFormat': 'H:i'
        }); 

        /***********************************************************   Tooltips**********************************************************/
        $('.mefe_question').tipsy({
            live: true,
            html: true,
            gravity: 'w'
        }); 

        /***********************************************************   Set-up footer positions**********************************************************/
        jQuery(".mefe_mp .mefe_nop ul li").live('click', function () {

            var val = jQuery(this).html(),

                option = jQuery(this).closest('.mefe_mp'),

                json = option.find('.mefe_all_options').html(),

                all_styles = jQuery.parseJSON(json),

                divs = jQuery(this).closest('.mefe_mp').find('.mefe_positions_display'); /* Add active class to current option*/

            jQuery(this).closest('.mefe_nop').children('input').attr("value", val); /* ADD ATTRIBUTE FOR NUMBER OF COLUMNS*/

            option.find('.mefe_positions .mefe_widgets_positions').attr("data-columns", val);

            var new_value = {};

            new_value[val] = [all_styles[val][0]]; /* UPDATE INPUT VALUE BASED ON SELECTION*/

            option.find('.mefe_positions .mefe_widgets_positions').attr("value", JSON.stringify(new_value));

            jQuery(this).closest('.mefe_nop').find('li').removeClass('active');

            jQuery(this).addClass('active'); /* Hide the extra divs*/

            divs.children().removeClass('hidden');

            divs.children().slice(val).addClass('hidden');

            for (i = 0; i < all_styles[val][0].length; i++) {

                option.find('.mefe_position:nth-child(' + (i + 1) + ')').attr("class", "mefe_position zn-grid-" + all_styles[val][0][i] + "");

            } /* Show the proper styles*/

            option.find('.mefe_position_var_options .mefe_number_list').html('');

            for (i = 0; i < all_styles[val].length; i++) {

                css = '';

                if (i == 0) {

                    css = 'class="active"';

                }

                option.find('.mefe_position_var_options .mefe_number_list').append('<li ' + css + '>' + (i + 1) + '</li>');

            }

            return false;

        });

        jQuery(".mefe_mp .mefe_positions .mefe_position_var_options ul li").live('click', function () { /* GET SELECTED MODULE VARIATION*/

            val = jQuery(this).html(); /* get selected module variation*/

            option = jQuery(this).closest('.mefe_mp'); /* get option top parent*/

            divs = option.find('.mefe_positions_display'); /* get all div's*/

            /* GET THE SELECTED NUMBER OF COLUMNS*/

            all_val = option.find('.mefe_positions .mefe_widgets_positions').attr("data-columns"); /* GET ALL POSSIBLE COMBINATIONS*/

            json = option.find('.mefe_all_options').html();

            all_styles = jQuery.parseJSON(json); /* CREATE NEW JSON ARRAY TO POPULATE THE INPUT*/

            var new_value = {};

            new_value[all_val] = [all_styles[all_val][(val - 1)]]; /* UPDATE THE INPUT WITH SELECTED COMBINATION*/

            jQuery(this).closest('.mefe_positions').children('input').val(JSON.stringify(new_value));

            jQuery(this).closest('.mefe_number_list').find('li').removeClass('active');

            jQuery(this).addClass('active'); /* Hide the extra divs*/

            divs.children().removeClass('hidden');

            divs.children().slice(all_val).addClass('hidden');

            for (var i = 0; i < all_styles[all_val][(val - 1)].length; i++) {

                option.find('.mefe_position:nth-child(' + (i + 1) + ')').attr("class", "mefe_position zn-grid-" + all_styles[all_val][(val - 1)][i] + "");

            }

            return false;

        }); /***********************************************************	Set-up the sliders / Accordions**********************************************************/

        jQuery(".mefe_accordion .mefe_slide_edit_button , .mefe_single_toggle .mefe_slide_edit_button").live('click', function () {

            jQuery(this).parents('.mefe_slide_header').toggleClass("active").next().slideToggle("fast");

            return false;

        }); /***********************************************************	Sort the sliders / accordions**********************************************************/





        function create_sortable() {

            jQuery('.mefe_accordion').find('ul').each(function () {

                var id = jQuery(this).attr('id');

                $('.mefe_sortable').sortable({

                    forcePlaceholderSize: false,

                    placeholder: 'placeholder',

                    opacity: 0.6,

                    handle: '.mefe_slide_header',

                    start: function (event, ui) {
                    	
                        var el_width = ui.item.width();

                        var el_height = ui.item.height();

                        jQuery('.placeholder').width(el_width - 12);

                        jQuery('.placeholder').height(el_height);

                    },

                    update: function () {

                        jQuery(this).mefe_recalculate_input_name()

                    }

                });

            });

        }

        create_sortable(); /***********************************************************	Remove slide**********************************************************/

        $('.mefe_slide_delete_button').live('click', function () { /* We will pass this value to the function that set's the input names*/

            var containing_ul = jQuery(this).closest('ul');

            var agree = confirm("Are you sure you wish to delete this ?");

            if (agree) {

                $(this).closest('li').remove(); /* Remove the containing li*/

                jQuery(containing_ul).mefe_recalculate_input_name(); /* Recalculate the input's names*/

                return false;

            } else {

                return false;

            }

        }); /***********************************************************	Add slide**********************************************************/

        $(".mefe_slide_add_button").live('click', function () {

            if (jQuery(this).hasClass('mefe_inactive')) {

                return false;

            }

            var this_button = jQuery(this);

            jQuery(this_button).addClass('mefe_inactive zn-gray');

            jQuery(this_button).append('<span class="mefe_ajax_loading"></span>'); /* Removed ul.mefe_sortable !*/

            if ($(this).parents('.zn-dynamic-edit-mode').length == 0 && $(this).parents('.mefe_options_container').length == 0 && jQuery(this).parents('.mefe_meta_boxmefe_dynamic_list').length > 0) {

                var slidesContainer = $(this).parents('.mefe_page_area').children('ul , ul.mefe_dynamic_list_container'); /* Get the container of all elements where we will append the new element*/

                var mefe_add_type = jQuery(this).parents('.mefe_pb_area_name').children('.mefe_add_type').html();

                var mefe_pb_area = jQuery(this).attr("data-pbarea");

            } else {

                var slidesContainer = $(this).parent().children('ul , ul.mefe_dynamic_list_container'); /* Get the container of all elements where we will append the new element*/

                var mefe_add_type = jQuery(this).parent().children('.mefe_add_type').html();

                var mefe_pb_area = '';

            }

            var nonce = $('#security').val();

            $('.mefe_ajax_loading').fadeIn();

            var element_type = 'element_type=' + mefe_add_type + '&pb_area=' + mefe_pb_area;

            var data = {

                type: 'add_element',

                action: 'mefe_ajax_post_action',

                security: nonce,

                data: element_type

            };

            $.post(ajaxurl, data, function (response) {

                var success = $('.zn-save-popup');

                var fail = $('.zn-fail-popup');

                var loading = $('.ajax-loading-img');

                loading.fadeOut(); /*response.find('.mefe_radio').buttonset();*/

                slidesContainer = slidesContainer.append(response).mefe_recalculate_input_name();

                jQuery('.mefe_dynamic_list_container').each(function () {

                    jQuery(this).mefe_recalculate_input_name();

                });

                styleSelect.init();

                jQuery('.mefe_hide .mefe_radio input:checked').mefe_hide_options();

                jQuery(".mefe_radio").buttonset();

                jQuery(".mefe_radio input").hide(); /*remove the button inactive class*/

                jQuery(this_button).removeClass('mefe_inactive zn-gray'); /* Remove the loading*/

                jQuery(this_button).children('.mefe_ajax_loading').remove();

                if (response) {

                    mefe_color_picker();

                    create_sortable();

                    jQuery(".mefe_date_picker").datepicker({

                        dateFormat: "mm/dd/yy"

                    });

                    jQuery('.mefe_time_picker').timepicker({

                        'timeFormat': 'H:i'

                    }); 

                } else {

                    fail.fadeIn();

                }

                window.setTimeout(function () {

                    success.fadeOut();

                    fail.fadeOut();

                }, 2000); /* Check if has a limit*/

                var limit = jQuery(this_button).attr('data-limit');

                var num_elements = jQuery(this_button).parents('.mefe_page_area').children('ul.mefe_dynamic_list_container').children().length;

                if (limit <= num_elements) {

                    jQuery(this_button).addClass('mefe_inactive zn-gray');

                }

            });

            return false;

        }); /***********************************************************	Start Dynamic template**********************************************************/

        jQuery(".mefe_select_dynamic").live('change', function () {

            var selected_value = jQuery(':selected', this).val();

            var limit = jQuery(this).parents('.mefe_pb_area_name').children('a.mefe_slide_add_button').attr('data-limit');

            var num_elements = jQuery(this).parents('.mefe_page_area').children('ul').children().length;

            if (selected_value == 'Select an element' || limit <= num_elements) {

                jQuery(this).parents('.mefe_pb_area_name').children('a.mefe_slide_add_button').addClass('mefe_inactive zn-gray');

                return false;

            } else {

                jQuery(this).parents('.mefe_pb_area_name').children('span.mefe_add_type').html(selected_value);

                jQuery(this).parents('.mefe_pb_area_name').children('a.mefe_slide_add_button').removeClass('mefe_inactive zn-gray');

            }

        });

        jQuery('.mefe_dynamic_list_container').each(function () {

            jQuery(this).mefe_recalculate_input_name();

        }); /***********************************************************	Increase/Decrease sizes **********************************************************/

        var sizes = {

            'four': '1/4',

            'one-third': '1/3',

            'eight': '1/2',

            'two-thirds': '2/3',

            'twelve': '3/4',

            'sixteen': '1/1'

        };

        jQuery('.mefe_slide_increase_button').live('click', function () {

            if (jQuery(this).hasClass('zn-size-inactive')) {

                return false;

            }

            var element = jQuery(this).parents('.mefe_slide');

            var size_input = jQuery(this).parents('.mefe_slide_header').next('.mefe_slide_body').children('.mefe_size_input');

            var size_container = jQuery(this).parents('.mefe_slide_buttons').children('.mefe_slide_size');

            var current_size = '';

            var is_not_max = false;

            var allowed_sizes = jQuery(this).parents('.mefe_slide_buttons').children('.mefe_slide_size').attr('data-sizes');

            var new_sizes = allowed_sizes.split(",");

            for (var i = 0; i < new_sizes.length - 1; i++) {

                if (element.hasClass(new_sizes[i])) {

                    var current_size = new_sizes[i];

                    var is_not_max = true;

                }

                if (is_not_max) {

                    if (i == new_sizes.length - 2) {

                        jQuery(element).removeClass(new_sizes[i]);

                        jQuery(element).addClass(new_sizes[i + 1]);

                        jQuery(size_container).html(sizes[new_sizes[i + 1]]);

                        jQuery(size_input).val(new_sizes[i + 1]);

                        jQuery(this).addClass('zn-size-inactive');

                        jQuery(this).prev().removeClass('zn-size-inactive');

                    } else {

                        jQuery(element).removeClass(new_sizes[i]);

                        jQuery(element).addClass(new_sizes[i + 1]);

                        jQuery(size_container).html(sizes[new_sizes[i + 1]]);

                        jQuery(size_input).val(new_sizes[i + 1]);

                        jQuery(this).prev().removeClass('zn-size-inactive');

                    }

                    break;

                }

            }

            return false;

        });

        jQuery('.mefe_slide_decrease_button').live('click', function () {

            if (jQuery(this).hasClass('zn-size-inactive')) {

                return false;

            }

            var element = jQuery(this).parents('.mefe_slide');

            var size_input = jQuery(this).parents('.mefe_slide_header').next('.mefe_slide_body').children('.mefe_size_input');

            var size_container = jQuery(this).parents('.mefe_slide_buttons').children('.mefe_slide_size');

            var current_size = '';

            var is_not_max = false;

            var allowed_sizes = jQuery(this).parents('.mefe_slide_buttons').children('.mefe_slide_size').attr('data-sizes');

            var new_sizes = allowed_sizes.split(",");

            for (var i = new_sizes.length - 1; i > 0; i--) {

                if (element.hasClass(new_sizes[i])) {

                    var current_size = new_sizes[i];

                    var is_not_max = true;

                }

                if (is_not_max) {

                    if (i == 1) {

                        jQuery(element).removeClass(new_sizes[i]);

                        jQuery(element).addClass(new_sizes[i - 1]);

                        jQuery(size_container).html(sizes[new_sizes[i - 1]]);

                        jQuery(size_input).val(new_sizes[i - 1]);

                        jQuery(this).addClass('zn-size-inactive');

                        jQuery(this).next().removeClass('zn-size-inactive');

                    } else {

                        jQuery(element).removeClass(new_sizes[i]);

                        jQuery(element).addClass(new_sizes[i - 1]);

                        jQuery(size_container).html(sizes[new_sizes[i - 1]]);

                        jQuery(size_input).val(new_sizes[i - 1]);

                        jQuery(this).next().removeClass('zn-size-inactive');

                    }

                    break;

                }

            }

            return false;

        }); /***********************************************************	Make Dynamic template slides sortable**********************************************************/

        jQuery('.mefe_dynamic_accordion').find('ul.mefe_dynamic_list_container').each(function () { /*var id = jQuery(this).attr('id');*/

            jQuery('.mefe_dynamic_list_container').sortable({

                forcePlaceholderSize: false,

                /*containment: '.mefe_dynamic_list_container',*/

                items: 'li',

                handle: '.mefe_dynamic_handle',

                placeholder: 'placeholder left',

                start: function (event, ui) {

                    var el_width = ui.item.width();

                    var el_height = ui.item.height();

                    jQuery('.placeholder').width(el_width - 12);

                    jQuery('.placeholder').height(el_height - 12);

                },

                update: function () {

                    jQuery(this).mefe_recalculate_input_name()

                }

            });

        }); /***********************************************************	Toggle Dynamic list template edit**********************************************************/

        $(".mefe_dynamic_accordion .mefe_dynamic_list_container li .mefe_dynamic_handle .mefe_slide_edit_button").live('click', function () { /* Hide all li's*/

            jQuery(this).parents('.mefe_dynamic_list_container').children('li').hide(); /*jQuery('.mefe_slide_body').hide();*/

            /* Show current li and add the edit class and show the slide body*/

            jQuery(this).parents('li').show().addClass('zn-dynamic-edit-mode zn-zindexed').children('.mefe_slide_body').find('.mefe_slide_body').hide(); /* Add an overlay*/

            jQuery(document.body).prepend('<div class="zn-overlay"></div>');

            jQuery('.zn-overlay').css({

                opacity: 0.7

            });

            return false;

        }); /***********************************************************	Close Dynamic list template edit**********************************************************/

        $(".mefe_dynamic_accordion .mefe_slide_close_button").live('click', function () { /* Show all li's*/

            jQuery(this).parents('.mefe_dynamic_list_container').children('li').show(); /* Remove the edit class */

            jQuery(this).parents('li').removeClass('zn-dynamic-edit-mode zn-zindexed'); /* Remove the overlay*/

            jQuery('.zn-overlay').remove();

            return false;

        }); /***********************************************************	Admin menu js**********************************************************/

        jQuery('#zn-nav li a').click(function () {

            jQuery('#zn-nav li a').removeClass('active');

            jQuery(this).addClass('active');

            var page = jQuery(this).attr('href');

            jQuery('.mefe_slide_body').hide();

            jQuery('.mefe_page').hide();

            jQuery(page).fadeIn(100);

            return false;

        });

        jQuery('#zn-nav .parent > a').click(function () {

            jQuery(this).next('ul').slideDown();

            jQuery('#zn-nav li a').removeClass('active');

            jQuery(this).next('ul').find('a.normal:first').addClass('active');

            var page = jQuery(this).next('ul').find('a.normal').attr('href');

            jQuery('.mefe_slide_body').hide();

            jQuery('.mefe_page').hide();

            jQuery(page).fadeIn(100);

            return false;

        });

        jQuery('#zn-nav > ul > li > a.normal').click(function () {

            jQuery('#zn-nav li a').removeClass('active');

            jQuery('#zn-nav .parent ul').slideUp();

            jQuery(this).addClass('active');

            var page = jQuery(this).attr('href');

            jQuery('.mefe_page').hide();

            jQuery('.mefe_slide_body').hide();

            jQuery(page).fadeIn(100);

            return false;

        });

        jQuery('.mefe_activate_nav li a').live('click', function () {

            jQuery('.mefe_activate_nav li a').removeClass('active');

            jQuery(this).addClass('active');

            var page = jQuery(this).attr('href');

            jQuery('.mefe_slide_body').hide();

            jQuery('.mefe_page').hide();

            jQuery(page).fadeIn(100);

            return false;

        });

        $('.mefe_page:first').fadeIn('100'); /***********************************************************	Hide options based on other options**********************************************************/

        /* Show/Hide the options based on the selectbox option value*/



        mefe_color_picker(); /********************************************************************	Hide image tiles*******************************************************************/

        jQuery('.mefe_tiles').hover(function () {

            var height = $('div.tiles_inner', this).height();

            $(this).stop().animate({

                height: height

            });

        }, function () {

            $(this).stop().animate({

                height: '60px'

            });

        }); /*Masked Inputs (background images as radio buttons)*/

        $('.zn-radio-tile-img').click(function () {

            $(this).parent().parent().find('.zn-radio-tile-img').removeClass('zn-radio-tile-selected');

            $(this).addClass('zn-radio-tile-selected');

        });

        $('.zn-radio-tile-label').hide();

        $('.zn-radio-tile-img').show();

        $('.zn-radio-tile-radio').hide(); /*-----------------------------------------------------------------------------------*/

        /* Zauan Slider UI options/*-----------------------------------------------------------------------------------*/

        /* jQuery UI Slider*/





        function mefe_ui_slider() {

            jQuery('.uislider').live().each(function () {

                var Othis = this; /*cache a copy of the this variable for use inside nested function*/

                var slide_value = jQuery(Othis).attr('rel');

                var slide_duration_min = jQuery(Othis).children('.min').html();

                var slide_duration_max = jQuery(Othis).children('.max').html();

                jQuery(this).slider({

                    min: parseInt(slide_duration_min),

                    max: parseInt(slide_duration_max),

                    value: parseInt(slide_value),

                    slide: function (event, ui) { /*get the id of this slider*/

                        var id = $(this).attr("id"); /*select the input box that has the same id as the slider within it and set it's value to the current slider value. */

                        jQuery(Othis).next('input').val(ui.value);

                    }

                });

            }); /*end UI Slider*/

        }

        mefe_ui_slider(); /* Start the color picker*/

        /* Set the slider value based on the input value*/

        jQuery('.ui_slider_input').live().change(function () {

            var znsthis = $(this);

            var slide_duration_min = jQuery(znsthis).prev('div').children('.min').html();

            var slide_duration_max = jQuery(znsthis).prev('div').children('.max').html();

            var znsthisval = $(this).attr('value');

            var znt = 100 * ((znsthisval - slide_duration_min) / (slide_duration_max - slide_duration_min));

            if (parseInt(znsthisval) < parseInt(slide_duration_min)) {

                znsthis.attr('value', parseInt(slide_duration_min));

                znt = '0';

            }

            if (parseInt(znsthisval) > parseInt(slide_duration_max)) {

                znsthis.attr('value', parseInt(slide_duration_max));

                znt = '100';

            }

            jQuery(znsthis).prev('div').children('a').css({

                'left': znt + '%'

            });

        }); /********************************************************************	Iphone buttons*******************************************************************/

        jQuery('.mefe_hide select').each(function () {

            jQuery(this).change(function () {

                var mefe_this_id = $(this).attr('id');

                var mefe_this_value = $(this).attr('value'); /* Get all values and hides the options with this class*/

                values = [];

                jQuery('option', this).each(function (i, selected) {

                    values[i] = $(selected).val();

                    jQuery('.' + mefe_this_id + '-' + values[i] + '').hide();

                }); /*Show only the selected option with class*/

                jQuery('.' + mefe_this_id + '-' + mefe_this_value + '').show(); /*$(".mefe_acc_header").next().hide();*/

            });

        });

        jQuery('.mefe_hide select option:selected').each(function () {

            var mefe_this_id = $(this).parent('select').attr('id');

            var mefe_this_value = $(this).attr('value');

            var mefe_all_options = $(this).parent('select'); /* Get all values and hides the options with this class*/

            values = [];

            jQuery('option', mefe_all_options).each(function (i, selected) {

                values[i] = $(selected).val();

                jQuery('.' + mefe_this_id + '-' + values[i] + '').hide();

            }); /*Show only the selected option with class*/

            jQuery('.' + mefe_this_id + '-' + mefe_this_value + '').show();

        });
		
		
        jQuery(".mefe_radio").buttonset();

        jQuery(".mefe_radio input").hide(); /* Show/Hide the options based on the selectbox option value*/

        jQuery(document).on('change', '.mefe_hide .mefe_radio input', function () {

            var mefe_this_rel = $(this).attr('rel');

            var mefe_this_value = $(this).attr('value');

            var e = jQuery(this); /* Get all values and hides the options with this class*/

            values = [];

            jQuery(this).parent().children('input').each(function (i, selected) {

                values[i] = $(selected).val();

                if (jQuery(e).parents('.mefe_accordion').length == 0) { /*Show only the selected option with class*/

                    jQuery('.' + mefe_this_rel + '-' + values[i] + '').hide();

                } else { /*Show only the selected option with class*/

                    jQuery(e).parents('.mefe_slide').find('.' + mefe_this_rel + '-' + values[i] + '').hide();

                }

            });

            if (jQuery(this).parents('.mefe_accordion').length == 0) { /*Show only the selected option with class*/

                jQuery('.' + mefe_this_rel + '-' + mefe_this_value + '').show();

            } else { /*Show only the selected option with class*/

                jQuery(this).parents('.mefe_slide').find('.' + mefe_this_rel + '-' + mefe_this_value + '').show();

            }

        });

        jQuery('.mefe_hide .mefe_radio input:checked').mefe_hide_options(); 
		
		/***********************************************************	Create a modal for social icons**********************************************************/

        $(".mefe_select_icon_font").live('click', function () {

            modal = jQuery(this).parent().children('.icon_modal').clone().show();

            image_container = jQuery(this).parent().children('.zn-image-holder');

            icon_input = jQuery(this).parent().children('.mefe_font_icon_input');

            $('body').prepend('<div class="mefe_mask"></div>'); /*Get the screen height and width*/

            var maskHeight = jQuery(document).height();

            var maskWidth = jQuery(window).width(); /*Set height and width to mask to fill up the whole screen*/

            jQuery('.mefe_mask').css({

                'width': maskWidth,

                'height': maskHeight

            }); /*transition effect*/

            jQuery('.mefe_mask').fadeTo("slow", 0.8);

            $('body').prepend('<div class="mefe_modal_container"><div class="mefe_modal_header"><span class="mefe_close_modal">x</span></div></div>');

            $('.mefe_modal_container').append(modal); /*Get the window height and width*/

            var winH = $(window).height();

            var winW = $(window).width(); /*Set the popup window to center*/

            $('.mefe_modal_container').css('top', winH / 2 - $('.mefe_modal_container').height() / 2);

            $('.mefe_modal_container').css('left', winW / 2 - $('.mefe_modal_container').width() / 2);

            jQuery('.icon_modal ul li a').live('click', function () {

                icon = jQuery(this).html();

                icon_style = jQuery(this).closest('ul').attr('class'); /*alert(icon_style);*/

                icon_span = '';

                icon_class = icon; /* Clear the icon holder*/

                jQuery(image_container).html(''); /* Add the icon to the icon holder*/

                jQuery(image_container).html(icon_span + '<ul class="' + icon_style + '"><li class="' + icon + '"><a></a></li></ul><a class="zn-remove-image" href="#">remove</a>');

                jQuery(icon_input).val(icon); /* Close the modal and remove it from DOM*/

                jQuery('.mefe_mask').remove();

                jQuery('.mefe_modal_container').remove();

            });

            return false;

        });

        jQuery('.mefe_mask ,.mefe_close_modal').live('click', function () {

            jQuery('.mefe_mask').remove();

            jQuery('.mefe_modal_container').remove();

        });

    });

    (function ($) {

        styleSelect = {

            init: function () {

                $('.select_wrapper').each(function () {

                    $(this).prepend('<span></span>');

                    $(this).find('.select').prev('span').replaceWith('<span>' + $(this).find('.select option:selected').text() + '</span>');

                });

                $('.select').live('change', function () {

                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');

                });

                $('.select').bind($.browser.msie ? 'click' : 'change', function (event) {

                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');

                });

            }

        };

        $(document).ready(function () {

            styleSelect.init();

        })

    })(jQuery); /********************************************************************	Clear the name array number so the items can be re-aranged*******************************************************************/

    jQuery.fn.mefe_recalculate_input_name = function () {

        var number_of_elements = jQuery('li', this).length;

        if (this.find('ul.mefe_sortable').length) {

            this.children('li').each(function (index) {

                var a = jQuery(this).index();

                jQuery(this).find(':input').each(function () {

                    if (jQuery(this).attr('name') !== "undefined" && jQuery(this).attr('name')) {

                        var clearName = jQuery(this).attr('name').replace(/\[[0-9]+\](.*)/g, "[" + a + "]$1");

                    }

                    jQuery(this).attr('name', clearName);

                });

            });

        } else {

            this.find('li').each(function (index) {

                var a = jQuery(this).index();

                jQuery(this).find(':input').each(function () {

                    if (jQuery(this).attr('name') !== "undefined" && jQuery(this).attr('name')) {

                        var clearName = jQuery(this).attr('name').replace(/(.*)\[[0-9]+\]/g, "$1[" + a + "]");

                    }

                    jQuery(this).attr('name', clearName);

                });

            });

        }
	
    }; /********************************************************************	Color Picker*******************************************************************/





    function mefe_color_picker() {

        jQuery('.colorSelector').live().each(function () {

            var Othis = this;

            jQuery(this).ColorPicker({

                color: '<?php if(isset($color)) echo $color; ?>',

                onShow: function (colpkr) {

                    jQuery(colpkr).fadeIn(500);

                    return false;

                },

                onHide: function (colpkr) {

                    jQuery(colpkr).fadeOut(500);

                    return false;

                },

                onChange: function (hsb, hex, rgb) {

                    jQuery(Othis).children('div').css('backgroundColor', '#' + hex);

                    jQuery(Othis).next('input').attr('value', '#' + hex);

                }

            });

        });

    }

})(jQuery);