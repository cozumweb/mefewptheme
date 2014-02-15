<?php


	// Set the Options Array
	$data = get_option(OPTIONS);
	global $all_icon_sets,$bootstrap_icons;

	include_once(locate_template(array('admin/options/helper-icons.php'), false));
	

		$mefe_admin_menu = array();
		$mefe_admin_menu[] = array(
			"name" => "General Options",
			"id" => "general_options",
			"submenus" => array(
				array(
					"name" => "General options",
					"id" => "mefe_gen_options",
					"class" => "active"
				) ,
				array(
					"name" => "Logo options",
					"id" => "logo_options",
					"class" => "active"
				) ,
				array(
					"name" => "Favicon options",
					"id" => "favicon_options"
				) ,
				array(
					"name" => "WPML Options",
					"id" => "wpml_options"
				) ,
				array(
					"name" => "Header options",
					"id" => "theader_options"
				) ,
				array(
					"name" => "Footer options",
					"id" => "copyright_options"
				) ,
				array(
					"name" => "Default Header options",
					"id" => "def_header"
				) ,
				array(
					"name" => "Google Analytics",
					"id" => "google_analytics"
				) ,
				array(
					"name" => "Mailchimp",
					"id" => "mailchimp_api"
				) ,
				array(
					"name" => "Facebook",
					"id" => "facebook_options"
				),
				array(
					"name" => "reCaptcha",
					"id" => "recaptcha_options"
				)
			)
		);

		$mefe_admin_menu[] = 	array(
			"name" => "Font Options",
			"id" => "font_options",
			"submenus" => array(
				array(
					"name" => "General Font Options",
					"id" => "font_options"
				),
				array(
					"name" => "Headings",
					"id" => "font_heading_options"
				),
				array(
					"name" => "Body Fonts",
					"id" => "font_body_options"
				),
				array(
					"name" => "Main Menu",
					"id" => "font_menu_options"
				),
			)
		);

		$mefe_admin_menu[] = array(
			"name" => "Blog Options",
			"id" => "blog_options",
			"submenus" => array(
				array(
					"name" => "Archive options",
					"id" => "archive_blog_options"
				) ,
				array(
					"name" => "Single blog item options",
					"id" => "single_blog_option"
				)
			)
		);

		$mefe_admin_menu[] = array(
			"name" => "Page options",
			"id" => "page_default_options"
		);
		$mefe_admin_menu[] = array(
			"name" => "Portfolio options",
			"id" => "portfolio_options"
		);

		$mefe_admin_menu[] = array(
			"name" => "Documentation options",
			"id" => "documentation_options"
		);

		$mefe_admin_menu[] = array(
			"name" => "Layout options",
			"id" => "layout_options"
		);
		$mefe_admin_menu[] = array(
			"name" => "Color options",
			"id" => "color_options"
		);
		$mefe_admin_menu[] = array(
			"name" => "Unlimited headers",
			"id" => "uh_headers"
		);
		$mefe_admin_menu[] = array(
			"name" => "Unlimited sidebars",
			"id" => "sidebar_options"
		);
		$mefe_admin_menu[] = array(
			"name" => "Coming Soon Options",
			"id" => "cs_options"
		);
		$mefe_admin_menu[] = array(
			"name" => "404 Page Options",
			"id" => "404_options"
		);
		
		$mefe_admin_menu[] = array(
			"name" => "Advanced",
			"id" => "advanced_options"
		);
		

		$bg_images_path = get_stylesheet_directory() . '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri() . '/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		if (is_dir($bg_images_path))
		{
			if ($bg_images_dir = opendir($bg_images_path))
			{
				while (($bg_images_file = readdir($bg_images_dir)) !== false)
				{
					if (stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false)
					{
						$bg_images[] = $bg_images_url . $bg_images_file;
						natsort($bg_images);
					}
				}
			}
		}

/*--------------------------------------------------------------------------------------------------
	Get all dynamic headers
--------------------------------------------------------------------------------------------------*/
	$header_option = array();
	$header_option['mefe_def_header_style'] = 'Default style';
	if ( isset ( $data['header_generator'] ) && is_array ($data['header_generator']) ) {
		//$sidebars = $data['sidebar_generator'];
		foreach ($data['header_generator'] as $header) {
			if ( isset ( $header['uh_style_name'] ) && !empty ( $header['uh_style_name'] ) ) {
			
				$header_name = strtolower ( str_replace(' ','_',$header['uh_style_name'] ) );
				$header_option[$header_name] = $header['uh_style_name'];
				
			}
		}
		
	}


		global $mefe_options;
		$mefe_options = array();

		// SET THEME DEFAULTS

		$color1 = '#81C50A'; // GREEN
		$color2 = '#CCCCCC';
		$color3 = '#FFFFFF'; // WHITE
		$color4 = '#666666';
		$color5 = '#999999';
		$color6 = '#EBEBEB'; // Separator color
		$color7 = '#ADADAD'; // Blog info link color


		/*
		*			START GENERAL OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'mefe_gen_options'
		);

		$mefe_options[] = array(
			"name" => "Show Follow menu?",
			"description" => "Chose yes if you want the menu to follow the user on the page.",
			"id" => "menu_follow",
			"std" => '',
			"options" => array ( 'yes'=>"Yes" , 'no'=> "No"),
			"type" => "select"
		);
		
		$mefe_options[] = array(
			"name" => "Responsive menu style",
			"description" => "Please choose the responsive menu style you want to use.",
			"id" => "res_menu_style",
			"std" => 'select',
			"options" => array ( 'select'=>"Drop down" , 'smooth'=> "Smooth menu"),
			"type" => "select"
		);

		$mefe_options[] = array(
			"name" => "Use page preloader?",
			"description" => "Chose yes if you want to show a page preloader.",
			"id" => "page_preloader",
			"std" => 'no',
			"options" => array ( 'yes'=>"Yes" , 'no'=> "No"),
			"type" => "select"
		);

		$mefe_options[] = array(
			"name" => "Hide page subheader?",
			"description" => "Chose yes if you want to hide the page subheader ( including sliders ). Please note that this option can be overriten from each page/post",
			"id" => "mefe_disable_subheader",
			"std" => 'no',
			"options" => array ( 'yes'=>"Yes" , 'no'=> "No"),
			"type" => "select"
		);

		$mefe_options[] = array(
			"name" => "Use first attached image ?",
			"description" => "Chose yes if you want the theme to display the first image inside a page if no featured image is present",
			"id" => "mefe_use_first_image",
			"std" => 'yes',
			"options" => array ( 'yes'=>"Yes" , 'no'=> "No"),
			"type" => "select"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			START LOGO OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'logo_options'
		);

		// Logo Upload

		$mefe_options[] = array(
			"name" => "Logo Upload",
			"description" => "Upload your logo.",
			"id" => "logo_upload",
			"std" => '',
			"type" => "media"
		);

		// Logo auto size ?

		$logo_size = array(
			"yes" => "Auto resize logo",
			"no" => "Custom size",
			"contain" => "Contain in header",
		);
		$mefe_options[] = array(
			"name" => "Logo Size :",
			"description" => "Auto resize logo will use the image dimensions, Custom size let's you set the desired logo size and Contain in header will select the proper logo size so that it will be displayed in the header.",
			"id" => "logo_size",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => $logo_size,
			"class" => "mefe_hide"
		);

		// Logo Dimensions

		$default_size = array(
			'height' => '42',
			'width' => '126'
		);
		$mefe_options[] = array(
			"name" => "Logo manual sizes",
			"description" => "Please insert your desired logo size in pixels ( for example \"35\" )",
			"id" => "logo_manual_size",
			"std" => $default_size,
			"type" => "image_size",
			"class" => "logo_size-no"
		);

		// Logo typography for link

		$mefe_options[] = array(
			"name" => "Logo Link Options",
			"description" => "Specify the logo typography properties. Will only work if you don't upload a logo image.",
			"id" => "logo_font",
			"std" => array(
				'size' => '36px',
				'face' => 'Open Sans',
				'style' => 'normal',
				'color' => '#000',
				'height' => '40px'
			) ,
			"type" => "typography"
		);

		// Logo Hover Typography

		$mefe_options[] = array(
			"name" => "Logo Link Hover Color",
			"description" => "Specify the logo hover color. Will only work if you don't upload a logo image. ",
			"id" => "logo_hover",
			"std" => array(
				'color' => '#CD2122',
				'face' => ''
			) ,
			"type" => "typography"
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start FAVICON OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'favicon_options'
		);
		$mefe_options[] = array(
			"name" => "Favicon Image",
			"description" => "Upload your desired favicon image.",
			"id" => "custom_favicon",
			"std" => '',
			"type" => "media"
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);



		/*
		*			Start GENERAL FONT OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'font_options'
		);

		$mefe_options[] = array(
			"name" => "Google fonts subsets",
			"description" => "Here you can add your google fonts subsets that you want to use (like Latin and Cyrillic for example). Please note that each subset must be divided by a comma and there should be no empty space between them.",
			"id" => "g_fonts_subset",
			"std" => '',
			"type" => "text"
		);


// GET THE FONTS

		/*	Load Google Fonts if they are needed */
		$normal_faces = array('arial','verdana','trebuchet','georgia','times','tahoma','palatino','helvetica');
	
		if( is_array( $data['fonts'] ) ) {
			$data['fonts'] = array_diff(array_unique( $data['fonts'] ), $normal_faces);
		}
		else {
			$data['fonts'] = array();
		}
		
		$mefe_options[] = array(
			"name" => "Google fonts set-up",
			"description" => "DESC.",
			"id" => "g_fonts_setup",
			"std" => $data['fonts'],
			"fonts" => $data['fonts'],
			"type" => "mefe_g_fonts"
		);


		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start FONT HEADINGS OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'font_heading_options'
		);

		$mefe_options[] = array(
			"name" => "H1 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h1_typo",
			"std" => array(
				'size' => '36px',
				'face' => 'Open Sans',
				'height' => '40px'
			) ,
			"type" => "typography"
		);

		$mefe_options[] = array(
			"name" => "H2 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h2_typo",
			"std" => array(
				'size' => '30px',
				'face' => 'Open Sans',
				'height' => '40px'
			) ,
			"type" => "typography"
		);

		$mefe_options[] = array(
			"name" => "H3 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h3_typo",
			"std" => array(
				'size' => '24px',
				'face' => 'Open Sans',
				'height' => '40px'
			) ,
			"type" => "typography"
		);

		$mefe_options[] = array(
			"name" => "H4 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h4_typo",
			"std" => array(
				'size' => '14px',
				'face' => 'Open Sans',
				'height' => '20px'
			) ,
			"type" => "typography"
		);

		$mefe_options[] = array(
			"name" => "H5 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h5_typo",
			"std" => array(
				'size' => '12px',
				'face' => 'Open Sans',
				'height' => '20px'
			) ,
			"type" => "typography"
		);

		$mefe_options[] = array(
			"name" => "H6 Typography",
			"description" => "Specify the typography properties for headings.",
			"id" => "h6_typo",
			"std" => array(
				'size' => '12px',
				'face' => 'Open Sans',
				'height' => '20px'
			) ,
			"type" => "typography"
		);


		$mefe_options[] = array(
			"type" => 'option_page_end'
		);


		/*
		*			Start FONT BODY OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'font_body_options'
		);


		// Body font options

		$mefe_options[] = array(
			"name" => "Body Font Options",
			"description" => "Specify the typography properties for the body section ( this will apply to all the content on the page ).",
			"id" => "body_font",
			"std" => array(
				'size' => '13px',
				'face' => 'Open Sans',
				'height' => '19px',
				'color' => ''
			) ,
			"type" => "typography"
		);

		// Grey area font options

		$mefe_options[] = array(
			"name" => "Grey Area Font Options",
			"description" => "Specify the typography properties for the grey area section.",
			"id" => "ga_font",
			"std" => array(
				'size' => '13px',
				'face' => 'Open Sans',
				'height' => '19px',
				'color' => ''
			) ,
			"type" => "typography"
		);

		// Footer font options
		$mefe_options[] = array(
			"name" => "Footer Font Options",
			"description" => "Specify the typography properties for the Footer.",
			"id" => "footer_font",
			"std" => array(
				'size' => '13px',
				'face' => 'Open Sans',
				'height' => '19px',
				'color' => ''
			) ,
			"type" => "typography"
		);



		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start FONT MENU OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'font_menu_options'
		);

$menu_color = '#fff';
if ( !empty ( $data['mefe_mainmenu_color'] ) ) { $menu_color = $data['mefe_mainmenu_color'];  }

		// Menu TYPOGRAPHY
		$mefe_options[] = array(
			"name" => "Menu Font Options",
			"description" => "Specify the typography properties for the Main Menu.",
			"id" => "menu_font",
			"std" => array(
				'size' => '14px',
				'face' => 'Lato',
				'height' => '14px',
				'color' => $menu_color,
				'style' => 'bold'
			) ,
			"type" => "typography"
		);


		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start WPML
		------------------------------------------------------------*/
		
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'wpml_options'
		);

		// Show LINK to LOGIN

		$mefe_options[] = array(
			"name" => "Show WPML languages ?",
			"description" => "Choose yes if you want to show WPML languages in header. Please note that you will need WPML installed.",
			"id" => "head_show_flags",
			"std" => "1",
			"type" => "mefe_radio",
			"options" => array(
				"1" => "Show",
				"0" => "Hide"
			)
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		
		/*
		*			Start TOP HEADER OPTIONS
		------------------------------------------------------------*/
		
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'theader_options'
		);

		$mefe_options[] = array( 
			"name" => "Header Layout",
			"description" => "Please choose the desired header layout.",
			"id" => "mefe_header_layout",
			"std" => "style2",
			"options" => array ( 'style1' => 'Style 1' , 'style2' => 'Style 2 (default)' , 'style3' => 'Style 3' , 'style4' => 'Style 4'  ),
			"type" => "select"
		);
		
		// HEADER STYLE
		$mefe_options[] = array(
			"name" => "Header Style",
			"description" => "Select the desired style for the header",
			"id" => "header_style",
			"std" => "default",
			"type" => "mefe_radio",
			"options" => array( 'default' => "Default", 'image_color'=>'Background Image & color' ),
			"class" => "mefe_hide"
		);

		// HEADER IMAGE
		$mefe_options[] = array(
			"name" => "Header Background Image",
			"description" => "Please choose your desired image to be used as a background",
			"id" => "header_style_image",
			"std" => '',
			"options" => array( "repeat" => true , "position" => true , "attachment" => true ),
			"type" => "background",
			"class" => "header_style-image_color"
		);
		
		// HEADER Color
		$mefe_options[] = array(
			"name" => "Background Color",
			"description" => "Please choose your desired background color for the header",
			"id" => "header_style_color",
			"std" => '#000',
			"type" => "color",
			"class" => "header_style-image_color"
		);
		
		// Show LINK to LOGIN
		$mefe_options[] = array(
			"name" => "Show Login in header",
			"description" => "Choose yes if you want to show a link that will let users login/register or retrieve their lost password. Please note that in order to show the registration page, you need to allow user registration from General settings.",
			"id" => "head_show_login",
			"std" => "1",
			"type" => "mefe_radio",
			"options" => array(
				"1" => "Show",
				"0" => "Hide"
			)
		);
		
		// Show LOGO In header
		$mefe_options[] = array(
			"name" => "Show LOGO in header",
			"description" => "Please choose if you want to display the logo or not.",
			"id" => "head_show_logo",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => array(
				"yes" => "Show",
				"no" => "Hide"
			)
		);

		// Show SEARCH In header
		$mefe_options[] = array(
			"name" => "Show SEARCH in header",
			"description" => "Please choose if you want to display the search button or not.",
			"id" => "head_show_search",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => array(
				"yes" => "Show",
				"no" => "Hide"
			)
		);
		
		$mefe_options[] = array(
			"name" => "Social Icons",
			"description" => "Here you can configure what social icons to appear on the right side of the header.",
			"id" => "header_social_icons",
			"std" => "",
			"type" => "group",
			"add_text" => "Social Icon",
			"use_name" => "header_social_title",
			"remove_text" => "Social Icon",
			"subelements" => array(
				array(
					"name" => "Icon title",
					"description" => "Here you can enter a title for this social icon.Please note that this is just for your information as this text will not be visible on the site.",
					"id" => "header_social_title",
					"std" => "",
					"type" => "text"
				) ,
				array(
					"name" => "Social icon link",
					"description" => "Please enter your desired link for the social icon. If this field is left blank, the icon will not be linked.",
					"id" => "header_social_link",
					"std" => "",
					"type" => "link",
					"options" => array(
						'_blank' => "New window",
						'_self' => "Same window"
					)
				) ,
				array(
					"name" => "Social icon",
					"description" => "Select your desired social icon.",
					"id" => "header_social_icon",
					"std" => "",
					"options" => $all_icon_sets,
					"type" => "mefe_icon_font"
				)
			) ,
			"class" => ""
		);
		$footer_colored_icons = array(
			'normal' => 'Normal Icons',
			'colored' => 'Colored icons'
		);
		$mefe_options[] = array(
			"name" => "Use normal or colored social icons?",
			"description" => "Here you can choose to use the normal social icons or the colored version of each icon.",
			"id" => "header_which_icons_set",
			"std" => "",
			"type" => "select",
			"options" => $footer_colored_icons,
			"class" => ""
		);
		
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		
		
		/*
		*			Start COPYRIGHT OPTIONS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'copyright_options'
		);
		
		// Show Footer
		$mefe_options[] = array(
			"name" => "Show Footer",
			"description" => "Using this option you can choose to display the footer or not.",
			"id" => "footer_show",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => array(
				"yes" => "Show",
				"no" => "Hide"
			)
		);
		
		$mefe_options[] = array(
			"name" => "Copyright text",
			"description" => "Enter your desired copyright text. Please note that you can copy ' &copy; ' and place it in the text.",
			"id" => "copyright_text",
			"std" => "&copy; 2013 Copyright by ZnThemes. All rights reserved.",
			"type" => "textarea"
		);

		// Show Footer ROW 1
		$mefe_options[] = array(
			"name" => "Show Row 1 widgets ?",
			"description" => "Select yes if you want to show the first row of widgets.",
			"id" => "footer_row1_show",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => array(
				"yes" => "Show",
				"no" => "Hide"
			)
		);


		$mefe_options[] = array(
			"name" => "Footer Row 1 Widget positions",
			"description" => "Here you can select how your footer row 1 widgets will be displayed. You can select to use up to 4 widgets positions in various sizes.",
			"id" => "footer_row1_widget_positions",
			"std" => '{"3":[["4","4","4"]]}',
			"type" => "widget_positions",
			"number_of_columns" => "4",
			"columns_positions" => array(
				"1" => array(
					array(
						"12"
					)
				) ,
				"2" => array(
					array(
						"6",
						"6"
					)
				) ,
				"3" => array(
					array(
						"4",
						"4",
						"4"
					) ,
					array(
						"5",
						"4",
						"3"
					) ,
					array(
						"5",
						"3",
						"4"
					) ,
					array(
						"4",
						"5",
						"3"
					) ,
					array(
						"4",
						"3",
						"5"
					) ,
					array(
						"3",
						"4",
						"5"
					) ,
					array(
						"3",
						"5",
						"4"
					)
				) ,
				"4" => array(
					array(
						"3",
						"3",
						"3",
						"3"
					) ,
					array(
						"5",
						"4",
						"2",
						"1"
					)
				)
			)
		);

		// Show Footer ROW 2
		$mefe_options[] = array(
			"name" => "Show Row 2 widgets ?",
			"description" => "Select yes if you want to show the second row of widgets.",
			"id" => "footer_row2_show",
			"std" => "yes",
			"type" => "mefe_radio",
			"options" => array(
				"yes" => "Show",
				"no" => "Hide"
			)
		);

		$mefe_options[] = array(
			"name" => "Footer Row 2 Widget positions",
			"description" => "Here you can select how your footer row 2 widgets will be displayed. You can select to use up to 4 widgets positions in various sizes.",
			"id" => "footer_row2_widget_positions",
			"std" => '{"2":[["6","6"]]}',
			"type" => "widget_positions",
			"number_of_columns" => "4",
			"columns_positions" => array(
				"1" => array(
					array(
						"12"
					)
				) ,
				"2" => array(
					array(
						"6",
						"6"
					)
				) ,
				"3" => array(
					array(
						"4",
						"4",
						"4"
					) ,
					array(
						"5",
						"4",
						"3"
					) ,
					array(
						"5",
						"3",
						"4"
					) ,
					array(
						"4",
						"5",
						"3"
					) ,
					array(
						"4",
						"3",
						"5"
					) ,
					array(
						"3",
						"4",
						"5"
					) ,
					array(
						"3",
						"5",
						"4"
					)
				) ,
				"4" => array(
					array(
						"3",
						"3",
						"3",
						"3"
					) ,
					array(
						"5",
						"4",
						"2",
						"1"
					)
				)
			)
		);
		$mefe_options[] = array(
			"name" => "Copyright Logo image",
			"description" => "Upload your desired logo image that will appear on the left side of the copyright text.",
			"id" => "footer_logo",
			"std" => '',
			"type" => "media"
		);
		
		// FOOTER STYLE
		$mefe_options[] = array(
			"name" => "Style",
			"description" => "Select the desired style for the footer",
			"id" => "footer_style",
			"std" => "default",
			"type" => "mefe_radio",
			"options" => array( 'default' => "Default", 'image_color'=>'Background Image & color' ),
			"class" => "mefe_hide"
		);

		// FOOTER IMAGE
		$mefe_options[] = array(
			"name" => "Background Image",
			"description" => "Please choose your desired image to be used as a background",
			"id" => "footer_style_image",
			"std" => '',
			"options" => array( "repeat" => true , "position" => true , "attachment" => true ),
			"type" => "background",
			"class" => "footer_style-image_color"
		);
		
		// FOOTER Color
		$mefe_options[] = array(
			"name" => "Background Color",
			"description" => "Please choose your desired background color for the footer",
			"id" => "footer_style_color",
			"std" => '#000',
			"type" => "color",
			"class" => "footer_style-image_color"
		);
		
		// FOOTER Color
		$mefe_options[] = array(
			"name" => "Border Color",
			"description" => "Please choose your desired color for the footer border",
			"id" => "footer_border_color",
			"std" => '#484848',
			"type" => "color"
		);
		
		$mefe_options[] = array(
			"name" => "Social Icons",
			"description" => "Here you can configure what social icons to appear on the right side of the copyright text.",
			"id" => "footer_social_icons",
			"std" => "",
			"type" => "group",
			"add_text" => "Social Icon",
			"use_name" => "footer_social_title",
			"remove_text" => "Social Icon",
			"subelements" => array(
				array(
					"name" => "Icon title",
					"description" => "Here you can enter a title for this social icon.Please note that this is just for your information as this text will not be visible on the site.",
					"id" => "footer_social_title",
					"std" => "",
					"type" => "text"
				) ,
				array(
					"name" => "Social icon link",
					"description" => "Please enter your desired link for the social icon. If this field is left blank, the icon will not be linked.",
					"id" => "footer_social_link",
					"std" => "",
					"type" => "link",
					"options" => array(
						'_blank' => "New window",
						'_self' => "Same window"
					)
				) ,
				array(
					"name" => "Social icon",
					"description" => "Select your desired social icon.",
					"id" => "footer_social_icon",
					"std" => "",
					"options" => $all_icon_sets,
					"type" => "mefe_icon_font"
				)
			) ,
			"class" => ""
		);
		$footer_colored_icons = array(
			'normal' => 'Normal Icons',
			'colored' => 'Colored icons'
		);
		$mefe_options[] = array(
			"name" => "Use normal or colored social icons?",
			"description" => "Here you can choose to use the normal social icons or the colored version of each icon.",
			"id" => "footer_which_icons_set",
			"std" => "",
			"type" => "select",
			"options" => $footer_colored_icons,
			"class" => ""
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start DEFAULT HEADER
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'def_header'
		);

		// Header background image

		$mefe_options[] = array(
			"name" => "Header Background image",
			"description" => "Upload your desired background image for the header.",
			"id" => "def_header_background",
			"std" => '',
			"type" => "media"
		);

		// Header background color

		$mefe_options[] = array(
			"name" => "Header Background Color",
			"description" => "Here you can choose a default color for your header.If you do not select a background image, this color will be used as background.",
			"id" => "def_header_color",
			"std" => '#AAAAAA',
			"type" => "color"
		);

		$mefe_options[] = array(
					"name" => "Add gradient over color ?",
					"description" => "Select yes if you want add a gradien over the selected color",
					"id" => "def_grad_bg",
					"std" => "1",
					"type" => "select",
					"options" => array(
						"1" => "Yes",
						"0" => "No"
					) ,
					"class" => ""
				);

		// HEADER - Animate

		$def_header_anim = array(
			'1' => 'Yes',
			'0' => 'No'
		);
		$mefe_options[] = array(
			"name" => "Use animated header",
			"description" => "Select if you want to add an animation on top of your image/color.",
			"id" => "def_header_animate",
			"std" => "0",
			"type" => "select",
			"options" => $def_header_anim,
			"class" => ""
		);

		$mefe_options[] = array(
					"name" => "Add Glare effect ?",
					"description" => "Select yes if you want to add a glare effect over the background",
					"id" => "def_glare",
					"std" => "0",
					"type" => "select",
					"options" => array(
						"1" => "Yes",
						"0" => "No"
					) ,
					"class" => ""
			);

		$mefe_options[] = array(
					"name" => "Bottom style ?",
					"description" => "Select the header bottom style you want to use",
					"id" => "def_bottom_style",
					"std" => "0",
					"type" => "select",
					"options" => array(
						"none" => "None",
						"shadow" => "Shadow Up",
						"shadow_ud" => "Shadow Up and down",
						"mask1" => "Bottom mask 1",
						"mask2" => "Bottom mask 2"
					)
					);


		// HEADER show breadcrumbs

		$def_header_bread = array(
			'1' => 'Show',
			'0' => 'Hide'
		);
		$mefe_options[] = array(
			"name" => "Show Breadcrumbs",
			"description" => "Select if you want to show the breadcrumbs or not.",
			"id" => "def_header_bread",
			"std" => "",
			"type" => "select",
			"options" => $def_header_bread,
			"class" => ""
		);

		// HEADER show date

		$def_header_date = array(
			'1' => 'Show',
			'0' => 'Hide'
		);
		$mefe_options[] = array(
			"name" => "Show Date",
			"description" => "Select if you want to show the current date under breadcrumbs or not.",
			"id" => "def_header_date",
			"std" => "",
			"type" => "select",
			"options" => $def_header_date,
			"class" => ""
		);

		// HEADER show title

		$def_header_title = array(
			'1' => 'Show',
			'0' => 'Hide'
		);
		$mefe_options[] = array(
			"name" => "Show Page Title",
			"description" => "Select if you want to show the page title or not.",
			"id" => "def_header_title",
			"std" => "",
			"type" => "select",
			"options" => $def_header_title,
			"class" => ""
		);

		// HEADER show subtitle

		$def_header_subtitle = array(
			'1' => 'Show',
			'0' => 'Hide'
		);
		$mefe_options[] = array(
			"name" => "Show Page Subtitle",
			"description" => "Select if you want to show the page subtitle or not.",
			"id" => "def_header_subtitle",
			"std" => "",
			"type" => "select",
			"options" => $def_header_subtitle,
			"class" => ""
		);




		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start GOOGLE ANALYTICS
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'google_analytics'
		);
		$mefe_options[] = array(
			"name" => "Google Analytics Code",
			"description" => "Paste your google analytics code bellow.",
			"id" => "google_analytics",
			"std" => '',
			"type" => "textarea"
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start MAILCHIMP API
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'mailchimp_api'
		);
		$mefe_options[] = array(
			"name" => "Mailchimp API KEY",
			"description" => "Paste your mailchimp api key that will be used by the mailchimp widget.",
			"id" => "mailchimp_api",
			"std" => '',
			"type" => "text"
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start General Blog options
		------------------------------------------------------------*/
		$sidebar_option = array();
		$sidebar_option['defaultsidebar'] = 'Default Sidebar';
		if (isset($data['sidebar_generator']) && is_array($data['sidebar_generator']))
		{
			$sidebars = $data['sidebar_generator'];
			foreach($data['sidebar_generator'] as $sidebar)
			{
				if ($sidebar['sidebar_name'])
				{
					$sidebar_option[$sidebar['sidebar_name']] = $sidebar['sidebar_name'];
				}
			}
		}

		// Add default sidebar

		/*
		*			Start Archive Blog options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'archive_blog_options'
		);

		$mefe_options[] = array(
			"name" => "Blog Columns",
			"description" => "Select the number of columns you want to use.",
			"id" => "blog_style_layout",
			"std" => "1",
			"type" => "select",
			"options" => array(
				'1' => "1",
				'2' => "2",
				'3' => "3",
				'4' => "4",
			) ,
			"class" => ""
		);

		$mefe_options[] = array(
			"name" => "Archive Page Title",
			"description" => "Enter the desired page title for the blog archive page.",
			"id" => "archive_page_title",
			"std" => "BLOG & Gossip",
			"type" => "text",
			"translate_name" => "Archive Page Title",
			"class" => ""
		);
		$mefe_options[] = array(
			"name" => "Archive Page Subitle",
			"description" => "Enter the desired page subtitle for the blog archive page.",
			"id" => "archive_page_subtitle",
			"std" => "This would be the blog category page",
			"type" => "text",
			"translate_name" => "Archive Page Subtitle",
			"class" => ""
		);

		$mefe_options[] = array(
			"name" => "Use full width image",
			"description" => "Choose Use full width image option if you want the images to be full widht rather then the default layout",
			"id" => "sb_archive_use_full_image",
			"std" => "no",
			"type" => "select",
			"options" => array(
				'yes' => 'Use full width image',
				'no' => 'Use default layout'
			)
		);

		$mefe_options[] = array(
			"name" => "Archive Sidebar Position",
			"description" => "Select the position of the sidebar on archive pages.",
			"id" => "archive_sidebar_position",
			"std" => "right_sidebar",
			"type" => "select",
			"options" => array(
				'left_sidebar' => "Left Sidebar",
				'right_sidebar' => "Right sidebar",
				"no_sidebar" => "No sidebar"
			) ,
			"class" => ""
		);
		$mefe_options[] = array(
			"name" => "Archive Default Sidebar",
			"description" => "Select the default sidebar that will be used on archive pages.",
			"id" => "archive_sidebar",
			"std" => "",
			"type" => "select",
			"options" => $sidebar_option,
			"class" => ""
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start Single Blog options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'single_blog_option'
		);

		$mefe_options[] = array(
			"name" => "Use full width image",
			"description" => "Choose Use full width image option if you want the images to be full widht rather then the default layout",
			"id" => "sb_use_full_image",
			"std" => "no",
			"type" => "select",
			"options" => array(
				'yes' => 'Use full width image',
				'no' => 'Use default layout'
			)
		);

		$mefe_options[] = array(
			"name" => "Default Sidebar Position",
			"description" => "Select the default position of the sidebars troughout the site.",
			"id" => "default_sidebar_position",
			"std" => "right_sidebar",
			"type" => "select",
			"options" => array(
				'left_sidebar' => "Left Sidebar",
				'right_sidebar' => "Right sidebar",
				"no_sidebar" => "No sidebar"
			) ,
			"class" => ""
		);
		$mefe_options[] = array(
			"name" => "Single Post Default Sidebar",
			"description" => "Select the default sidebar that will be used on single post pages. Please note you can select a different sidebar from the post edit page.",
			"id" => "single_sidebar",
			"std" => "defaultsidebar",
			"type" => "select",
			"options" => $sidebar_option,
			"class" => ""
		);
		$mefe_options[] = array(
			"name" => "Show Social Share Buttons ?",
			"description" => "Choose if you want to show the social share buttons bellow the post's content.",
			"id" => "show_social",
			"std" => "show",
			"type" => "select",
			"options" => array(
				'show' => 'Show social buttons',
				'hide' => 'Do not show social buttons'
			)
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*
		*			Start PAGE DEFAULT options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'page_default_options'
		);
		$mefe_options[] = array(
			"name" => "Page Sidebar Position",
			"description" => "Select the position of the sidebar on archive pages.",
			"id" => "page_sidebar_position",
			"std" => "no_sidebar",
			"type" => "select",
			"options" => array(
				'left_sidebar' => "Left Sidebar",
				'right_sidebar' => "Right sidebar",
				"no_sidebar" => "No sidebar"
			) ,
			"class" => ""
		);
		$mefe_options[] = array(
			"name" => "Page Default Sidebar",
			"description" => "Select the default sidebar that will be used on archive pages.",
			"id" => "page_sidebar",
			"std" => "",
			"type" => "select",
			"options" => $sidebar_option,
			"class" => ""
		);

		$mefe_options[] = array( 
			"name" => "Enable Page Comments",
			"description" => "Please select if you want to enable the page comments. Please note that you can ovveride this setting from each page.",
			"id" => "mefe_enable_page_comments",
			"std" => "no",
			"options" => array ( 'yes' => 'Yes' , 'no' => 'No'  ),
			"type" => "select"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start PORTFOLIO options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'portfolio_options'
		);

		$mefe_options[] = array(
			"name" => "Portfolio Archive style",
			"description" => "Select the desired style for the portfolio archive pages.",
			"id" => "portfolio_style",
			"std" => "portfolio_sortable",
			"type" => "select",
			"options" => array(
				'portfolio_category' => 'Portfolio Category',
				'portfolio_sortable' => 'Portfolio Sortable',
				'portfolio_carousel' => 'Portfolio Carousel Layout',
			) ,
			"class" => ""
		);

		$mefe_options[] = array(
			"name" => "Portfolio items to show",
			"description" => "Please enter the desired number of portfolio items that will be loaded.(-1 will display all posts. Default is -1).",
			"id" => "portfolio_per_page",
			"std" => "-1",
			"type" => "text",
		);

		$mefe_options[] = array(
			"name" => "Portfolio items per page",
			"description" => "Please enter the desired number of portfolio items that will be displayed on a page.",
			"id" => "portfolio_per_page_show",
			"std" => "4",
			"type" => "text",
		);



		$mefe_options[] = array( 
			"name" => "Number of columns",
			"description" => "Please enter how many portfolio items you want to load on a page if you choose to use the portfolio category style.",
			"id" => "ports_num_columns",
			"std" => "4",
			"options" => array ( '1' => '1' , '2' => '2' , '3' => '3' , '4' => '4' , ),
			"type" => "select"
		);

		$mefe_options[] = array( 
			"name" => "Link Portfolio Media",
			"description" => "Select Yes if you want your portfolio images to be linked to the portfolio item as opposed to open the image in lightbox. ( only works with portfolio sortable )",
			"id" => "mefe_link_portfolio",
			"std" => "no",
			"options" => array ( 'yes' => 'Yes' , 'no' => 'No'  ),
			"type" => "select"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);


		/*
		*			Start DOCUMENTATION options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'documentation_options'
		);

		$mefe_options[] = array( 
						"name" => "Header Style",
						"description" => "Select the header style you want to use for this page.Please note that header styles can be created from the theme's admin page.",
						"id" => "mefe_doc_header_style",
						"std" => "",
						"type" => "select",
						"options" => $header_option,
						"class" => ""
					);



		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start LAYOUT options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'layout_options'
		);

		$mefe_options[] = array( 
			"name" => "Responsive options",
			"description" => "Please choose if you want to enable or not the responsive styles of the theme.",
			"id" => "mefe_responsive",
			"std" => "1",
			"options" => array ( 'yes' => 'Enable Responsive Style' , 'no' => 'Disable Responsive Style'  ),
			"type" => "select"
		);

		// BOXED LAYOUT
		$mefe_options[] = array(
			"name" => "Use Boxed Layout",
			"description" => "Choose yes if you want to use the boxed layour instead of the full width.",
			"id" => "mefe_boxed_layout",
			"std" => "no",
			"type" => "mefe_radio",
			"options" => array ( 'no' => 'No' , 'yes' => 'Yes'  ),
			"class" => "mefe_hide"
		);
		

		// BACKGROUND IMAGE
		$mefe_options[] = array(
			"name" => "Background Image",
			"description" => "Please choose your desired image to be used as a background",
			"id" => "boxed_style_image",
			"std" => '',
			"options" => array( "repeat" => true , "position" => true , "attachment" => true ),
			"type" => "background",
			"class" => "mefe_boxed_layout-yes"
		);
		
		// BACKGROUND COLOR
		$mefe_options[] = array(
			"name" => "Background Color",
			"description" => "Please choose your desired background color",
			"id" => "boxed_style_color",
			"std" => '#fff',
			"type" => "color",
			"class" => "mefe_boxed_layout-yes"
		);
		
		// BOXED LAYOUT FOR HOMEPAGE
		$mefe_options[] = array(
			"name" => "Homepage Boxed Layout",
			"description" => "Here you can choose a specific layout setting for the homepage that will overrite the seting from above.",
			"id" => "mefe_home_boxed_layout",
			"std" => "def",
			"type" => "mefe_radio",
			"options" => array ( 'def'=>'Default','no' => 'No' , 'yes' => 'Yes'  ),
			"class" => "mefe_hide"
		);
		
		$mefe_options[] = array( 
			"name" => "Content size",
			"description" => "Please choose the desired default size for the content.",
			"id" => "mefe_width",
			"std" => "1170",
			"options" => array ( '1170' => '1170px' , '960' => '960px'  ),
			"type" => "select"
		);

		// START SLIDER AFTER HEADER
		$mefe_options[] = array(
			"name" => "Start Slider/header area after header ?",
			"description" => "If set to yes, the slider/subheader area will start bellow the header.",
			"id" => "mefe_slider_header",
			"std" => "no",
			"type" => "mefe_radio",
			"options" => array ( 'no' => 'No' , 'yes' => 'Yes'  ),
			"class" => "mefe_hide"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

		/*
		*			Start COLOR options
		------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'color_options'
		);

		$mefe_options[] = array( 
			"name" => "Main Color",
			"description" => "Please choose a main color for your site.",
			"id" => "mefe_main_color",
			"std" => "#cd2122",
			"type" => "color"
		);
		

		$mefe_options[] = array( 
			"name" => "Top Nav default Color",
			"description" => "Please choose a color for the top nav links in header.",
			"id" => "mefe_top_nav_color",
			"std" => "",
			"type" => "color"
		);

		$mefe_options[] = array( 
			"name" => "Top Nav Hover Color",
			"description" => "Please choose a color for the top nav links in header when hovering over them.",
			"id" => "mefe_top_nav_h_color",
			"std" => "",
			"type" => "color"
		);

		$mefe_options[] = array( 
			"name" => "Content background Color",
			"description" => "Please choose a default color for the site's body.",
			"id" => "mefe_body_def_color",
			"std" => "",
			"type" => "color"
		);

		// BACKGROUND IMAGE
		$mefe_options[] = array(
			"name" => "Content Background Image",
			"description" => "Please choose your desired image to be used as as body background",
			"id" => "body_back_image",
			"std" => '',
			"options" => array( "repeat" => true , "position" => true , "attachment" => true ),
			"type" => "background"
		);

		$mefe_options[] = array( 
			"name" => "Grey area background Color",
			"description" => "Please choose a background color for the grey area.",
			"id" => "mefe_gr_area_def_color",
			"std" => "",
			"type" => "color"
		);

		// BACKGROUND IMAGE
		$mefe_options[] = array(
			"name" => "Grey Area Background Image",
			"description" => "Please choose your desired image to be used as as grey area background",
			"id" => "gr_arr_back_image",
			"std" => '',
			"options" => array( "repeat" => true , "position" => true , "attachment" => true ),
			"type" => "background"
		);

		$mefe_options[] = array( 
			"name" => "Color Style",
			"description" => "Please choose the desired default size for the content.",
			"id" => "mefe_main_style",
			"std" => "1170",
			"options" => array ( 'light' => 'Light Style ( default )' , 'dark' => 'Dark Style'  ),
			"type" => "select"
		);



		$mefe_options[] = array(
			"type" => 'option_page_end'
		);


		/*--------------------------------------------------------------------------------------------------
		Unlimited headers
		--------------------------------------------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'uh_headers'
		);
		$mefe_options[] = array(
			"name" => "Header Styles Generator",
			"description" => "Here you can create unlimited header styles to be used on different pages.",
			"id" => "header_generator",
			"std" => "",
			"type" => "group",
			"add_text" => "Header Style",
			"remove_text" => "Header Style",
			"use_name" => "uh_style_name",
			"group_sortable" => false,
			"subelements" => array(
				array(
					"name" => "Header Style Name",
					"description" => "The name of this header style.Please note that all names must be unique.",
					"id" => "uh_style_name",
					"std" => '',
					"type" => "text",
					"mod" => 'disabled'
				) ,
				array(
					"name" => "Background image",
					"description" => "Select a background image for your header.",
					"id" => "uh_background_image",
					"std" => "",
					"type" => "media",
					"class" => ''
				) ,
				array(
					"name" => "Header Background Color",
					"description" => "Here you can choose a default color for your header.If you do not select a background image, this color will be used as background.",
					"id" => "uh_header_color",
					"std" => '#AAAAAA',
					"type" => "color"
				) ,
				array(
					"name" => "Add gradient over color ?",
					"description" => "Select yes if you want add a gradien over the selected color",
					"id" => "uh_grad_bg",
					"std" => "1",
					"type" => "select",
					"options" => array(
						"1" => "Yes",
						"0" => "No"
					) ,
					"class" => ""
				) ,
				array(
					"name" => "Animate Background ?",
					"description" => "Select yes if you want to make your background animated",
					"id" => "uh_anim_bg",
					"std" => "0",
					"type" => "select",
					"options" => array(
						"1" => "Yes",
						"0" => "No"
					) ,
					"class" => ""
				) ,
				array(
					"name" => "Add Glare effect ?",
					"description" => "Select yes if you want to add a glare effect over the background",
					"id" => "uh_glare",
					"std" => "0",
					"type" => "select",
					"options" => array(
						"1" => "Yes",
						"0" => "No"
					) ,
					"class" => ""
				) ,
				array(
					"name" => "Bottom style ?",
					"description" => "Select the header bottom style you want to use",
					"id" => "uh_bottom_style",
					"std" => "0",
					"type" => "select",
					"options" => array(
						"none" => "None",
						"shadow" => "Shadow Up",
						"shadow_ud" => "Shadow Up and down",
						"mask1" => "Bottom mask 1",
						"mask2" => "Bottom mask 2"
					) ,
					"class" => ""
				)
			) ,
			"class" => ""
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*--------------------------------------------------------------------------------------------------
		Sidebar Generator
		--------------------------------------------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'sidebar_options'
		);
		$mefe_options[] = array(
			"name" => "Sidebar Generator",
			"description" => "Here you can create unlimited sidebars to be used on different pages.",
			"id" => "sidebar_generator",
			"std" => "",
			"type" => "group",
			"add_text" => "Sidebar",
			"remove_text" => "Sidebar",
			"use_name" => "sidebar_name",
			"subelements" => array(
				array(
					"name" => "Sidebar name",
					"description" => "Enter your desired name for this sidebar. Please note that this name must be unique and if multiple sidebars are registered with the same name , only the first sidebar will be shown",
					"id" => "sidebar_name",
					"std" => "",
					"type" => "text"
				)
			) ,
			"class" => ""
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*--------------------------------------------------------------------------------------------------
		Coming Soon Options
		--------------------------------------------------------------------------------------------------*/
		$mail_lists = array();
		if (!empty($data['mailchimp_api']))
		{
			if ( !class_exists( 'MCAPI' ) ) {
				include_once (TEMPLATEPATH . '/widgets/mailchimp/MCAPI.class.php');
			}
			
			$api_key = $data['mailchimp_api'];
			$mcapi = new MCAPI($api_key);
			$lists = $mcapi->lists();
			if ( !empty($lists['data']) ){
				foreach($lists['data'] as $key => $value)
				{
					$mail_lists[$value['id']] = $value['name'];
				}
			}
		}

		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'cs_options'
		);

		// ENABLE COMING SOON PAGE

		$mefe_options[] = array(
			"name" => "Enable Coming Soon?",
			"description" => "If enabled, the visitators will be displayed the coming soon page. Please note that all logged in users will still be able to see your site.",
			"id" => "cs_enable",
			"std" => "no",
			"type" => "mefe_radio",
			"options" => array(
				'yes' => 'Enable',
				'no' => 'Disable'
			) ,
			"class" => "mefe_hide"
		);

		// ENABLE COMING SOON PAGE

		$mefe_options[] = array(
			"name" => "Description",
			"description" => "Enter a description that will appear above the countdown clock.",
			"id" => "cs_desc",
			"std" => "We are currently working on a new website and won't take long. Please don't forget to check out our tweets and to subscribe to be notified!",
			"type" => "textarea",
			"translate_name" => "Coming Soon Page Description",
			"class" => "cs_enable-yes"
		);

		// ENABLE COMING SOON PAGE

		$mefe_options[] = array(
			"name" => "Launch date",
			"description" => "Please select the date when your site will be available.",
			"id" => "cs_date",
			"std" => "",
			"type" => "date_picker",
			"class" => "cs_enable-yes"
		);

		// MAILCHIMP LIST ID

		$mefe_options[] = array(
			"name" => "Mailchimp List ID",
			"description" => "Please select the mailchimp list ID you want to use. Please note that in order for the theme to display your list id's ,you will need to enter your Mailchimp API id in the General options > Mailchimp API option",
			"id" => "cs_lsit_id",
			"std" => "",
			"type" => "select",
			"options" => $mail_lists,
			"class" => "cs_enable-yes"
		);
		$mefe_options[] = array(
			"name" => "Social Icons",
			"description" => "Here you can configure what social icons to appear on the right side of the MailChimp form.",
			"id" => "cs_social_icons",
			"std" => "",
			"type" => "group",
			"add_text" => "Social Icon",
			"use_name" => "cs_social_title",
			"remove_text" => "Social Icon",
			"subelements" => array(
				array(
					"name" => "Icon title",
					"description" => "Here you can enter a title for this social icon.Please note that this is just for your information as this text will not be visible on the site.",
					"id" => "cs_social_title",
					"std" => "",
					"type" => "text"
				) ,
				array(
					"name" => "Social icon link",
					"description" => "Please enter your desired link for the social icon. If this field is left blank, the icon will not be linked.",
					"id" => "cs_social_link",
					"std" => "",
					"type" => "link",
					"options" => array(
						'_blank' => "New window",
						'_self' => "Same window"
					)
				) ,
				array(
					"name" => "Social icon",
					"description" => "Select your desired social icon.",
					"id" => "cs_social_icon",
					"std" => "",
					"options" => $all_icon_sets,
					"type" => "mefe_icon_font"
				)
			) ,
			"class" => "cs_enable-yes"
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		/*--------------------------------------------------------------------------------------------------
		Get all dynamic headers
		--------------------------------------------------------------------------------------------------*/
		$header_option = array();
		$header_option['mefe_def_header_style'] = 'Default style';
		if (isset($data['header_generator']) && is_array($data['header_generator']))
		{

			// $sidebars = $data['sidebar_generator'];

			foreach($data['header_generator'] as $header)
			{
				if (isset($header['uh_style_name']) && !empty($header['uh_style_name']))
				{
					$header_name = strtolower(str_replace(' ', '_', $header['uh_style_name']));
					$header_option[$header_name] = $header['uh_style_name'];
				}
			}
		}

		/*--------------------------------------------------------------------------------------------------
		404 PAGE OPTIONS
		--------------------------------------------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => '404_options'
		);
		$mefe_options[] = array(
			"name" => "Header Style",
			"description" => "Select the background style you want to use.Please note that the styles can be created from the \"Unlimited Headers\" options in the theme admin's page.",
			"id" => "404_header_style",
			"std" => "",
			"type" => "select",
			"options" => $header_option,
			"class" => ""
		);
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		
		
		/*--------------------------------------------------------------------------------------------------
		ADVANCED OPTIONS
		--------------------------------------------------------------------------------------------------*/
		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'advanced_options'
		);
		
		$mefe_options[] = array(
			"name" => "Enable Menu Caching ?",
			"description" => "By selecting yes, the menus added by mefe theme will be chached. This will grately improve the page loading speed when you have a big menu structure. Please note that this option may not work properly with multiple plugins and server configurations.",
			"id" => "cache_menu",
			"std" => "no",
			"type" => "select",
			"options" => array(
				"yes" => "Yes",
				"no" => "No"
			) ,
			"class" => ""
		);

		$mefe_options[] = array(
			"name" => "Custom CSS",
			"description" => "Here you can add your own custom css.",
			"id" => "mefe_custom_css",
			"std" => "",
			"type" => "textarea",
		);
		
		$mefe_options[] = array(
			"name" => "Install Dummy Data",
			"description" => "Press this button if you want your blog filled with demo data as seen on the demo site. Please note that the images will not be imported.",
			"id" => "install_dummy",
			"type" => "one_click_install",
		);

		$mefe_options[] = array(
			"name" => "Backup/Restore options",
			"description" => "Using this feature you can backup or restore your theme options.",
			"id" => "backup_restore",
			"type" => "mefe_backup_restore",
		);
		
		$mefe_options[] = array(
			"type" => 'option_page_end'
		);
		


/*--------------------------------------------------------------------------------------------------
	Facebook Options
--------------------------------------------------------------------------------------------------*/

		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'facebook_options'
		);

		$mefe_options[] = array(
			"name" => "Add Facebook OpenGraph Tags?",
			"description" => "Choose yes if you want to enable the facebook OpenGraph for your site.",
			"id" => "face_og",
			"std" => "1",
			"type" => "mefe_radio",
			"options" => array(
				"1" => "Show",
				"0" => "Hide"
			) 
		);

		$mefe_options[] = array(
			"name" => "Facebook Application ID",
			"description" => "Please enter your facebook application ID. The share buttons will not work correctly if you don't fill this in.",
			"id" => "face_AP_ID",
			"std" => "",
			"type" => "text"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

/*--------------------------------------------------------------------------------------------------
	reCaptcha Options
--------------------------------------------------------------------------------------------------*/

		$mefe_options[] = array(
			"type" => 'option_page_start',
			"id" => 'recaptcha_options'
		);

		$mefe_options[] = array(
			"name" => "Add Facebook OpenGraph Tags?",
			"description" => "Choose yes if you want to enable the facebook OpenGraph for your site.",
			"id" => "rec_theme",
			"std" => "red",
			"type" => "select",
			"options" => array(
				"red" => "Red",
				"white" => "White",
				"blackglass" => "Blackglass",
				"clean" => "Clean"
			) 
		);

		$mefe_options[] = array(
			"name" => "reCaptcha Public Key",
			"description" => "Please enter the Public key got from http://www.google.com/recaptcha.",
			"id" => "rec_pub_key",
			"std" => "",
			"type" => "text"
		);

		$mefe_options[] = array(
			"name" => "reCaptcha Private Key",
			"description" => "Please enter the Private key got from http://www.google.com/recaptcha",
			"id" => "rec_priv_key",
			"std" => "",
			"type" => "text"
		);

		$mefe_options[] = array(
			"type" => 'option_page_end'
		);

?>