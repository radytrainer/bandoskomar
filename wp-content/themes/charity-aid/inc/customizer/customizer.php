<?php
/**
 * Charity Aid Theme Customizer
 *
 * @package Charity Aid
 */

// Customize Controls.
require get_template_directory() . '/inc/custom-settings-control/customize-controls.php';

// Sanitization For Customize Controls.
require get_template_directory() . '/inc/custom-settings-control/sanitization.php';

/**
 * Provide postMessage support for the Theme Customizer's site title and description.
 */
function charity_aid_customize_register( $wp_customize ) {

	// General Settings Panel.
    $wp_customize->add_panel( 'charity_aid_general_settings_panel',
        array(
            'title'      => esc_html__( 'General Settings', 'charity-aid' ),
            'priority'   => 2,
            'capability' => 'edit_theme_options',
        )
    );

    // Header Settings Panel.
    $wp_customize->add_panel( 'charity_aid_header_settings_panel',
        array(
            'title'      => esc_html__( 'Header Settings', 'charity-aid' ),
            'priority'   => 2,
            'capability' => 'edit_theme_options',
        )
    );

    // Frontpage Sections Settings Panel.
    $wp_customize->add_panel( 'charity_aid_frontpage_sections_settings_panel',
        array(
            'title'      => esc_html__( 'Frontpage Sections Settings', 'charity-aid' ),
            'priority'   => 3,
            'capability' => 'edit_theme_options',
        )
    );

    // Footer Settings Panel.
    $wp_customize->add_panel( 'charity_aid_footer_settings_panel',
        array(
            'title'      => esc_html__( 'Footer Settings', 'charity-aid' ),
            'priority'   => 3,
            'capability' => 'edit_theme_options',
        )
    );

	// Site Identity

	$wp_customize->add_setting(
		'charity_aid_site_logo',
		array(
			'default'           => false,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_site_logo',
			array(
				'label'    => esc_html__( 'ON / OFF Site Logo', 'charity-aid' ),
				'section'  => 'title_tagline',
				'settings' => 'charity_aid_site_logo',
			)
		)
	);

	$wp_customize->add_setting(
		'charity_aid_site_title_text',
		array(
			'default'           => true,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_site_title_text',
			array(
				'label'    => esc_html__( 'ON / OFF Site Title', 'charity-aid' ),
				'section'  => 'title_tagline',
				'settings' => 'charity_aid_site_title_text',
			)
		)
	);

	$wp_customize->add_setting(
		'charity_aid_site_tagline_text',
		array(
			'default'           => false,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_site_tagline_text',
			array(
				'label'    => esc_html__( 'ON / OFF Site Tagline', 'charity-aid' ),
				'section'  => 'title_tagline',
				'settings' => 'charity_aid_site_tagline_text',
			)
		)
	);

	// Header Option

	$wp_customize->add_section(
		'charity_aid_header_section',
		array(
			'panel'      => 'charity_aid_header_settings_panel',
			'title'    => esc_html__( 'Header Options', 'charity-aid' ),
		)
	);

    $wp_customize->add_setting(
		'charity_aid_topbar_section_on_off_setting',
		array(
			'default'           => true,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new Charity_Aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_topbar_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Topbar Section', 'charity-aid' ),
				'section'  => 'charity_aid_header_section',
				'settings' => 'charity_aid_topbar_section_on_off_setting',
			)
		)
	);

	$wp_customize->add_setting(
        'charity_aid_phone_number',
        array(
            'default'           => '(+00)123 56 789 00',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

	$wp_customize->add_control(
        'charity_aid_phone_number',
        array(
            'label'           => sprintf( esc_html__( 'Add Phone Number', 'charity-aid' ), ),
            'section'         => 'charity_aid_header_section',
            'settings'        => 'charity_aid_phone_number' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'charity_aid_email_address',
        array(
            'default'           => 'charity12@axample.com',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'charity_aid_email_address',
        array(
            'label'           => sprintf( esc_html__( 'Add Email Address', 'charity-aid' ), ),
            'section'         => 'charity_aid_header_section',
            'settings'        => 'charity_aid_email_address' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'charity_aid_address',
        array(
            'default'           => '11/234 Main Street Kingstown Downtown',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

	$wp_customize->add_control(
        'charity_aid_address',
        array(
            'label'           => sprintf( esc_html__( 'Add Address', 'charity-aid' ), ),
            'section'         => 'charity_aid_header_section',
            'settings'        => 'charity_aid_address' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'charity_aid_timing',
        array(
            'default'           => 'Hours: Mon-Fri:9.00am-7.00pm',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'charity_aid_timing',
        array(
            'label'           => sprintf( esc_html__( 'Add Timing', 'charity-aid' ), ),
            'section'         => 'charity_aid_header_section',
            'settings'        => 'charity_aid_timing' ,
            'type'            => 'text',
        )
    );

	// Social Option

	$wp_customize->add_section(
		'charity_aid_social_section',
		array(
			'panel'      => 'charity_aid_header_settings_panel',
			'title'    => esc_html__( 'Social Options', 'charity-aid' ),
		)
	);

    $wp_customize->add_setting(
        'charity_aid_facebook_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'charity_aid_facebook_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Facebook Link', 'charity-aid' ), ),
            'section'         => 'charity_aid_social_section',
            'settings'        => 'charity_aid_facebook_url' ,
            'type'            => 'url',
        )
    );

	$wp_customize->add_setting(
        'charity_aid_twitter_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'charity_aid_twitter_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Twitter Link', 'charity-aid' ), ),
            'section'         => 'charity_aid_social_section',
            'settings'        => 'charity_aid_twitter_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'charity_aid_instagram_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'charity_aid_instagram_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Instagram Link', 'charity-aid' ), ),
            'section'         => 'charity_aid_social_section',
            'settings'        => 'charity_aid_instagram_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'charity_aid_youtube_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'charity_aid_youtube_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Youtube Link', 'charity-aid' ), ),
            'section'         => 'charity_aid_social_section',
            'settings'        => 'charity_aid_youtube_url' ,
            'type'            => 'url',
        )
    );

	$wp_customize->add_setting(
        'charity_aid_whatsapp_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'charity_aid_whatsapp_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Whatsapp Link', 'charity-aid' ), ),
            'section'         => 'charity_aid_social_section',
            'settings'        => 'charity_aid_whatsapp_url' ,
            'type'            => 'url',
        )
    );
	
	// Banner Option

	$wp_customize->add_section(
		'charity_aid_banner_section',
		array(
			'panel'      => 'charity_aid_frontpage_sections_settings_panel',
			'title'    => esc_html__( 'Banner Options', 'charity-aid' ),
		)
	);

    $wp_customize->add_setting(
		'charity_aid_banner_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_banner_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Banner Section', 'charity-aid' ),
				'section'  => 'charity_aid_banner_section',
				'settings' => 'charity_aid_banner_section_on_off_setting',
			)
		)
	);

	$wp_customize->add_setting(
	    'charity_aid_slider',
	    array(
	        'default'           => '',
	        'sanitize_callback' => 'charity_aid_sanitize_number',
	    )
	);

	$wp_customize->add_control(
	    'charity_aid_slider',
	    array(
	        'label'       => esc_html__( 'No of banner', 'charity-aid' ),
	        'section'     => 'charity_aid_banner_section',
	        'settings'    => 'charity_aid_slider',
	        'type'        => 'number',
	        'input_attrs' => array(
	            'min' => 1,
	            'max' => 3,
	        ),
	    )
	);

	$charity_aid_banner = get_theme_mod( 'charity_aid_slider');
	for ( $i = 1; $i <= $charity_aid_banner; $i++ ){
		$wp_customize->add_setting(
			'charity_aid_banner_heading'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'charity_aid_banner_heading'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Heading 0', 'charity-aid' ).$i, ),
				'section'         => 'charity_aid_banner_section',
				'settings'        => 'charity_aid_banner_heading'.$i,
				'type'            => 'text',
			)
		);

		$wp_customize->add_setting(
			'charity_aid_banner_heading_text'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'charity_aid_banner_heading_text'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Heading Text 0', 'charity-aid' ).$i, ),
				'section'         => 'charity_aid_banner_section',
				'settings'        => 'charity_aid_banner_heading_text'.$i,
				'type'            => 'text',
			)
		);

		$wp_customize->add_setting(
			'charity_aid_banner_content'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'charity_aid_banner_content'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Content 0', 'charity-aid' ).$i, ),
				'section'         => 'charity_aid_banner_section',
				'settings'        => 'charity_aid_banner_content'.$i,
				'type'            => 'text',
			)
		);

        $wp_customize->add_setting(
            'charity_aid_banner_btn'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'charity_aid_banner_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Banner Button 0', 'charity-aid' ).$i, ),
                'section'         => 'charity_aid_banner_section',
                'settings'        => 'charity_aid_banner_btn'.$i,
                'type'            => 'text',
            )
        );

		$wp_customize->add_setting(
			'charity_aid_banner_button_link'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'charity_aid_banner_button_link'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Button Link 0', 'charity-aid' ).$i, ),
				'section'         => 'charity_aid_banner_section',
				'settings'        => 'charity_aid_banner_button_link'.$i,
				'type'            => 'url',
			)
		);
		
		$wp_customize->add_setting(
			'charity_aid_banner_image'.$i,
			array(
	        	'default'           => '',
	        	'sanitize_callback' => 'charity_aid_sanitize_image',

	    	)
	    );
	    
	    $wp_customize->add_control(
	     	new WP_Customize_Image_Control(
	    		$wp_customize, 'charity_aid_banner_image'.$i, 
	    		array(
	    			'label'           => sprintf( esc_html__( 'Banner Image 0', 'charity-aid' ).$i, ),
			        'settings'  => 'charity_aid_banner_image'.$i,
			        'section'   => 'charity_aid_banner_section'
	    		) 
	    	)
	    );
	}

	$wp_customize->add_setting(
		'charity_aid_experience_box_number',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'charity_aid_experience_box_number',
		array(
			'label'           => sprintf( esc_html__( 'Year Of Experience', 'charity-aid' ), ),
			'section'         => 'charity_aid_banner_section',
			'settings'        => 'charity_aid_experience_box_number',
			'type'            => 'text',
		)
	);

	$wp_customize->add_setting(
		'charity_aid_experience_box_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'charity_aid_experience_box_text',
		array(
			'label'           => sprintf( esc_html__( 'Year Of Experience Text', 'charity-aid' ), ),
			'description'     => sprintf( esc_html__( 'Add Max-5 Words Min-3 Words', 'charity-aid' ), ),
			'section'         => 'charity_aid_banner_section',
			'settings'        => 'charity_aid_experience_box_text',
			'type'            => 'text',
		)
	);

    // Popular Causes Option

	$wp_customize->add_section(
		'charity_aid_services_section',
		array(
			'panel'      => 'charity_aid_frontpage_sections_settings_panel',
			'title'    => esc_html__( 'Popular Causes Options', 'charity-aid' ),
		)
	);

    $wp_customize->add_setting(
		'charity_aid_services_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_services_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Popular Causes Section', 'charity-aid' ),
				'section'  => 'charity_aid_services_section',
				'settings' => 'charity_aid_services_section_on_off_setting',
			)
		)
	);

    $wp_customize->add_setting(
        'charity_aid_services_short_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'charity_aid_services_short_title',
        array(
            'label'           => sprintf( esc_html__( 'Services Short Content', 'charity-aid' ), ),
            'section'         => 'charity_aid_services_section',
            'settings'        => 'charity_aid_services_short_title' ,
            'type'            => 'text',
        )
    );

	$wp_customize->add_setting(
        'charity_aid_services_title',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

	$wp_customize->add_control(
        'charity_aid_services_title',
        array(
            'label'           => sprintf( esc_html__( 'Services Heading', 'charity-aid' ), ),
            'section'         => 'charity_aid_services_section',
            'settings'        => 'charity_aid_services_title' ,
            'type'            => 'text',
        )
    );    

    $wp_customize->add_setting(
	    'charity_aid_services_count',
	    array(
	        'default'           => '',
	        'sanitize_callback' => 'charity_aid_sanitize_number',
	    )
	);

	$wp_customize->add_control(
	    'charity_aid_services_count',
	    array(
	        'label'       => esc_html__( 'No of Services', 'charity-aid' ),
	        'section'     => 'charity_aid_services_section',
	        'settings'    => 'charity_aid_services_count',
	        'type'        => 'number',
	        'input_attrs' => array(
	            'min' => 1,
	            'max' => 8,
	        ),
	    )
	);

	$charity_aid_services = get_theme_mod( 'charity_aid_services_count');
	for ( $i = 1; $i <= $charity_aid_services; $i++ ){

		$wp_customize->add_setting(
			'charity_aid_services_image'.$i,
			array(
	        	'default'           => '',
	        	'sanitize_callback' => 'charity_aid_sanitize_image',

	    	)
	    );
	    
	    $wp_customize->add_control(
	     	new WP_Customize_Image_Control(
	    		$wp_customize, 'charity_aid_services_image'.$i, 
	    		array(
	    			'label'           => sprintf( esc_html__( 'Service Image 0', 'charity-aid' ).$i, ),
			        'settings'  => 'charity_aid_services_image'.$i,
			        'section'   => 'charity_aid_services_section'
	    		) 
	    	)
	    );

        $wp_customize->add_setting(
            'charity_aid_services_icon'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'charity_aid_services_icon'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Service Icon 0', 'charity-aid' ).$i, ),
                'section'         => 'charity_aid_services_section',
                'settings'        => 'charity_aid_services_icon'.$i,
                'type'            => 'text',
            )
        );

		$wp_customize->add_setting(
			'charity_aid_services_heading'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'charity_aid_services_heading'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Service Heading 0', 'charity-aid' ).$i, ),
				'section'         => 'charity_aid_services_section',
				'settings'        => 'charity_aid_services_heading'.$i,
				'type'            => 'text',
			)
		);

		$wp_customize->add_setting(
            'charity_aid_services_text'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'charity_aid_services_text'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Service Text 0', 'charity-aid' ).$i, ),
                'section'         => 'charity_aid_services_section',
                'settings'        => 'charity_aid_services_text'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'charity_aid_service_btn'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'charity_aid_service_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Service Button Text 0', 'charity-aid' ).$i, ),
                'section'         => 'charity_aid_services_section',
                'settings'        => 'charity_aid_service_btn'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'charity_aid_service_button_link'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'charity_aid_service_button_link'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Service Button Link 0', 'charity-aid' ).$i, ),
                'section'         => 'charity_aid_services_section',
                'settings'        => 'charity_aid_service_button_link'.$i,
                'type'            => 'text',
            )
        );
	}

	// Global Color Options

	$wp_customize->add_section(
		'charity_aid_global_color_section',
		array(
			'panel'      => 'charity_aid_general_settings_panel',
			'title'    => esc_html__( 'Global Color Options', 'charity-aid' ),
		)
	);

	$wp_customize->add_setting(
		'charity_aid_global_color',
		array(
			'default'           => '#FF5817',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'charity_aid_global_color',
			array(
				'label'    => __( 'Global Color One', 'charity-aid' ),
				'section'  => 'charity_aid_global_color_section',
			)
		)
	);

	$wp_customize->add_setting(
		'charity_aid_global_colortwo',
		array(
			'default'           => '#04C0A8',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'charity_aid_global_colortwo',
			array(
				'label'    => __( 'Global Color Two', 'charity-aid' ),
				'section'  => 'charity_aid_global_color_section',
			)
		)
	);

	// Global Font Family Options

	$wp_customize->add_section(
		'charity_aid_global_font_section',
		array(
			'panel'      => 'charity_aid_general_settings_panel',
			'title'    => esc_html__( 'Global Font Family Options', 'charity-aid' ),
		)
	);

	$wp_customize->add_setting(
		'charity_aid_global_font_setting',
		array(
			'default'           => '',
			'sanitize_callback' => 'charity_aid_sanitize_google_fonts',
		)
	);
	
	$wp_customize->add_control(
		'charity_aid_global_font_setting',
		array(
			'label'    => esc_html__( 'Global Font Family', 'charity-aid' ),
			'section'  => 'charity_aid_global_font_section',
			'settings' => 'charity_aid_global_font_setting',
			'type'     => 'select',
			'choices'  => charity_aid_get_all_google_font_families(),
		)
	);	

    // Footer Option

	$wp_customize->add_section(
        'charity_aid_footer_widgets_section',
        array(
            'panel'      => 'charity_aid_footer_settings_panel',
            'title'    => esc_html__( 'Footer Widgets Options', 'charity-aid' ),
        )
    );

	$wp_customize->add_setting(
		'charity_aid_footer_widgets_section_on_off_setting',
		array(
			'default'           => true,
			'sanitize_callback' => 'charity_aid_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new charity_aid_On_Off_Custom_Control(
			$wp_customize,
			'charity_aid_footer_widgets_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Footer Widgets', 'charity-aid' ),
				'section'  => 'charity_aid_footer_widgets_section',
				'settings' => 'charity_aid_footer_widgets_section_on_off_setting',
			)
		)
	);

	$wp_customize->add_section(
        'charity_aid_copyright_section',
        array(
            'panel'      => 'charity_aid_footer_settings_panel',
            'title'    => esc_html__( 'Copyright Options', 'charity-aid' ),
        )
    );

    $wp_customize->add_setting(
        'charity_aid_footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'charity_aid_footer_text',
        array(
            'label'           => sprintf( esc_html__( 'Edit Copyright Text', 'charity-aid' ), ),
            'section'         => 'charity_aid_copyright_section',
            'settings'        => 'charity_aid_footer_text' ,
            'type'            => 'text',
        )
    );


}
add_action( 'customize_register', 'charity_aid_customize_register' );

/**
 * Create the site title for the partial selective refresh.
 *
 * @return void
 */
function charity_aid_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Create the website's slogan for the partial selective refresh.
 *
 * @return void
 */
function charity_aid_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Charity_Aid_Customize_Buttons {
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function Charity_Aid_get_instance() {

		static $charity_aid_instance = null;

		if ( is_null( $charity_aid_instance ) ) {
			$charity_aid_instance = new self;
			$charity_aid_instance->Charity_Aid_setup_actions();
		}

		return $charity_aid_instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function Charity_Aid_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $charity_aid_manager
	 * @return void
	*/
	public function sections( $charity_aid_manager ) {
		load_template( trailingslashit( get_template_directory() ) . '/inc/charity-aid-section-pro.php' );

		$charity_aid_manager->register_section_type( 'Charity_Aid_Customize_Section_Pro' );

		$charity_aid_manager->add_section( new Charity_Aid_Customize_Section_Pro( $charity_aid_manager,'charity_aid_buy_now', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Buy Charity Aid Pro', 'charity-aid' ),
			'pro_text' => esc_html__( 'Buy Pro Theme', 'charity-aid' ),
			'pro_url'    => esc_url( CHARITY_AID_BUY_NOW ),
		) )	);

		$charity_aid_manager->add_section( new Charity_Aid_Customize_Section_Pro( $charity_aid_manager, 'charity_aid_live_demo', array(
		    'priority'   => 1,
		    'title'      => esc_html__( 'Preview Pro Theme', 'charity-aid' ),
		    'pro_text'   => esc_html__( 'View Live Demo', 'charity-aid' ),
		    'pro_url'    => esc_url( CHARITY_AID_LIVE_DEMO ),
		) ) );	
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'charity-aid-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'charity-aid-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}
Charity_Aid_Customize_Buttons::Charity_Aid_get_instance();