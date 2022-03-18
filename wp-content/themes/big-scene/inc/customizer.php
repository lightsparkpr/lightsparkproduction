<?php
/**
 * Big Bob Theme Customizer
 *
 * @package Big_Bob
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function big_bob_customize_register( $wp_customize ) {
    //You have to update the widgets panel this way or it throws a warning;
    $bb_widgets_section = (object) $wp_customize->get_panel( 'widgets' );
    $bb_widgets_section->title = __( 'Sidebars and Footer (Widgets)', 'big-scene' );
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
    $wp_customize->get_control('header_textcolor')->description = __('This controls the color of the title (not the logo).', "big-scene");
    $wp_customize->get_control('header_textcolor')->priority = -1;
    $wp_customize->get_control('header_textcolor')->label = __('Title Color', 'big-scene');
    $wp_customize->get_section( 'header_image' )->title = __('Homepage Header Media', 'big-scene');
    $wp_customize->get_setting( 'header_image' )->transport = 'refresh';
    $wp_customize->get_section( 'header_image' )->description = __("The big-scene theme is designed to maximize the size of any header image 
        or header video while minimizing distortion regardless of the screen size or the header media's dimensions.  
        <u> You should feel free to utilize horizontally or vertically or squarely defined images or videos.</u>
        If you choose both an image and a video, the image will load first then the video will replace it.  Header media is only displayed 
        on your homepage.", "big-scene");
    $wp_customize->get_setting( 'header_video' )->transport = 'refresh';
    $wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
    $wp_customize->get_control( 'display_header_text' )->description = __('This only affects the logo if it is displayed below the navbar.  
    Turning this off usually looks best when <u>Center Navbar</u> has been switched on.', "big-scene");
    $wp_customize->get_control('display_header_text')->section = 'big_bob_navigation';
    $wp_customize->get_control( 'background_color' )->description = __('Black or a dark color works best when the theme is in the default
    setting.  White or a light color works best when the theme is in bright mode.', "big-scene");
    $wp_customize->get_control('background_color')->priority = '-3';
    $wp_customize->get_control( 'external_header_video' )->description = __("YouTube adds extra negative space to its videos,
    so your background color may include black in the header.  You should also be aware that some browsers do not support 
    YouTube's autoplay feature, so it is recommended that you set the <u>Set Header Media to Background</u> control in the
    <u>Header Media Options</u>section to OFF.", "big-scene");
    $wp_customize->get_control( 'external_header_video' )->label = __("Use a YouTube URL", "big-scene");

    $wp_customize->add_setting('big_bob_preloader', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_preloader', array(
    'label' => __('Preloader', 'big-scene'),
    'section' => 'title_tagline',
    'settings' => 'big_bob_preloader',
    'type' => 'radio',
    'choices' => array(
      'On' => __('On', 'big-scene'),
      'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __('This turns the prelaoder on and off.', 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_title_below_nav', array(
        'default'     => 'Small',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit_Big_Small',
    ));
  
    $wp_customize->add_control('big_bob_title_below_nav', array(
    'label' => __('Title Below Nav', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_title_below_nav',
    'type' => 'radio',
    'choices' => array(
      'Big' => __('Big', 'big-scene'),
      'Small' => __('Small', 'big-scene'),
      'Logo Below Nav' => __('Logo Below Nav', 'big-scene'),
      'Big Tagline Only' => __('Big Tagline Only', 'big-scene'),
      'Small Tagline Only' => __('Small Tagline Only', 'big-scene'),
      'Off' => __('Off', 'big-scene'),
	),
    'priority' => 50,
    'description' => __('This removes the title and tagline from the navbar, and
    sets the title and tagline below the navbar on the homepage.  You may want to turn on 
    <u>Center Navbar</u> in the <u>Navigation</u> section.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_title_below_nav', array(
        'render_callback' => 'big_bob_turn_on_big_description',
    ) );

    $wp_customize->add_setting('big_bob_foreground_color', array(
        'default'     => '#000000',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'big_bob_foreground_color', array(
        'label'        => __('Foreground Color', 'big-scene'),
        'section'    => 'colors',
		'settings'   => 'big_bob_foreground_color',
        'priority' => -5,
        'description'   => __('This will change the color behind the text.', 'big-scene'),
	)));

    $wp_customize->selective_refresh->add_partial( 'big_bob_foreground_color', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    $wp_customize->add_setting('big_bob_background_color', array(
        'default'     => '#0f0f0f',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'big_bob_background_color', array(
        'label'        => __('Background Color', 'big-scene'),
        'section'    => 'colors',
		'settings'   => 'big_bob_background_color',
        'priority' => -5,
        'description'   => __('This will change the color behind everything.', 'big-scene'),
	)));

    $wp_customize->selective_refresh->add_partial( 'big_bob_background_color', array(
        'render_callback' => 'big_bob_add_bright',
    ) );
    
    $wp_customize->add_setting('big_bob_text_color', array(
        'default'     => '#ffffff',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'big_bob_text_color', array(
        'label'        => __('Text and Border Color', 'big-scene'),
        'section'    => 'colors',
		'settings'   => 'big_bob_text_color',
        'priority' => -5,
        'description'   => __('This will change the color of the text (not links) and the borders
        surrounding the lower sections of the site.', 'big-scene'),
	)));

    $wp_customize->selective_refresh->add_partial( 'big_bob_text_color', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    $wp_customize->add_setting( 'big_bob_range_home_nav_ti', array(
        'default' => '7',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'bb_wpse_intval',
    ) );

    $wp_customize->add_control( 'big_bob_range_home_nav_ti', array(
        'type' => 'range',
        'section' => 'colors',
        'label' => __( 'Home Navbar and Title Opacity', 'big-scene' ),
        'description' => '',
        'priority' => 0,
        'input_attrs' => array(
                'min' => 0,
                'max' => 10,
                'step' => 1,
                ),
        'description'   => __('This is the opacity for foreground color at the top of the page
        for your homepage.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_range_home_nav_ti', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    $wp_customize->add_setting( 'big_bob_range_nav_ti', array(
        'default' => '7',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'bb_wpse_intval',
    ) );

    $wp_customize->add_control( 'big_bob_range_nav_ti', array(
        'type' => 'range',
        'priority' => 10,
        'section' => 'colors',
        'label' => __( 'Navbar and Title Opacity', 'big-scene' ),
        'description' => '',
        'priority' => 0,
        'input_attrs' => array(
                'min' => 0,
                'max' => 10,
                'step' => 1,
                ),
        'description'   => __('This is the opacity for foreground color at the top of the page
        for the rest of your pages.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_range_nav_ti', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    $wp_customize->add_setting( 'big_bob_range_sb', array(
        'default' => '10',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => 'refresh',
        'sanitize_callback' => 'bb_wpse_intval',
    ) );

    $wp_customize->add_control( 'big_bob_range_sb', array(
        'type' => 'range',
        'section' => 'colors',
        'label' => __( 'Body Opacity', 'big-scene' ),
        'description' => '',
        'priority' => 0,
        'input_attrs' => array(
                'min' => 0,
                'max' => 10,
                'step' => 1,
                ),
        'description'   => __('This is the opacity for foreground color for the body, sidebar, and footer.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_range_sb', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    function bb_wpse_intval( $value ) {
        return (int) $value;
    }

    $wp_customize->add_setting('big_bob_bright_mode', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_setting('big_bob_background_shadow', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
    
    $wp_customize->add_control('big_bob_background_shadow', array(
    'label' => 'Shadow Halo',
    'section' => 'colors',
    'settings' => 'big_bob_background_shadow',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This creates a shadow effect around the different sections of your site and changes the style of shadow effect
    behind the hamburger menu site title.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_background_shadow', array(
        'render_callback' => 'big_bob_add_shadow',
    ) );

    $wp_customize->add_setting('big_bob_borders', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
    
    $wp_customize->add_control('big_bob_borders', array(
    'label' => 'Borders',
    'section' => 'colors',
    'settings' => 'big_bob_borders',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This will add borders that are the same color as the text.
    The borders will be added around the body, sidebar, and footer.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_borders', array(
        'render_callback' => 'big_bob_add_bright',
    ) );

    $wp_customize->add_setting('big_bob_title_shadow', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
    
    $wp_customize->add_control('big_bob_title_shadow', array(
    'label' => 'Title Shadow',
    'section' => 'colors',
    'settings' => 'big_bob_title_shadow',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This will add or remove a shadow from behind the title if a title is displayed in the navbar.
    There is no shadow effect available if a logo is displayed.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_title_shadow', array(
        'render_callback' => 'big_bob_add_shadow',
    ) );
    
    $wp_customize->add_setting('big_bob_link_color', array(
        'default'     => '#a7ccbc',
		'transport'   => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'big_bob_link_color', array(
        'label'        => __('Link Color', 'big-scene'),
        'section'    => 'colors',
		'settings'   => 'big_bob_link_color',
        'priority' => -1,
        'description'   => __('This  will change the color of all the links.', 'big-scene'),
	)));

    $wp_customize->selective_refresh->add_partial( 'big_bob_link_color', array(
        'render_callback' => 'big_bob_customizer_css',
    ) );

    $wp_customize->add_setting('big_bob_link_hover_color', array(
        'default'     => '#66cdaa',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color_no_hash',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'big_bob_link_hover_color', array(
        'label'        => __('Link Hover Color', 'big-scene'),
        'section'    => 'colors',
		'settings'   => 'big_bob_link_hover_color',
        'priority' => -1,
        'description'   => __('This  will change the hover color of all the links.', 'big-scene'),
	)));

    $wp_customize->selective_refresh->add_partial( 'big_bob_link_hover_color', array(
        'render_callback' => 'big_bob_customizer_css',
    ) );

    $wp_customize->add_setting('big_bob_media_to_background', array(
        'default'     => 'Off',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_media_to_background', array(
    'label' => __('Set Header Media to Background', 'big-scene'),
    'section' => 'header_image',
    'settings' => 'big_bob_media_to_background',
    'type' => 'radio',
    'choices' => array(
      'On' => __('On', 'big-scene'),
      'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __('Turning this on will cause the header media to stay in place and the text to scroll over the top of the media.', 'big-scene'),
	));
	
	$wp_customize->selective_refresh->add_partial( 'big_bob_media_to_background', array(
        'render_callback' => 'big_bob_media_in_background',
    ) );

    $wp_customize->add_setting('big_bob_video_on_phone', array(
        'default'     => 'On',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_video_on_phone', array(
    'label' => __('Show Header Video On Mobile', 'big-scene'),
    'section' => 'header_image',
    'settings' => 'big_bob_video_on_phone',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __('Turns off the video for mobile devices with small screen sizes (a width of less than 1050 pixels).  
    The item loaded (image or video) is based on the width when the site loads.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_video_on_phone', array(
        'render_callback' => 'big_bob_video_for_phone',
    ) );

    $wp_customize->add_setting('big_bob_big_header_image', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_big_header_image', array(
    'label' => 'Big Header Image',
    'section' => 'header_image',
    'settings' => 'big_bob_big_header_image',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('Fills the header image across the entire screen.', 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_big_background_copy', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_big_background_copy', array(
    'label' => 'Big Background Image',
    'section' => 'big_bob_background_video',
    'settings' => 'big_bob_big_background_copy',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This transforms the background image so that it expands across the entire screen and is centered.  However, depending
    on the window size, some of the image may be cut off.', 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_background_copy_all', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_background_copy_all', array(
    'label' => 'Background Image All Pages',
    'section' => 'big_bob_background_video',
    'settings' => 'big_bob_background_copy_all',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This will turn on the background image for every page.', 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_image_over_video', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_image_over_video', array(
    'label' => 'Image Over Video',
    'section' => 'big_bob_background_video',
    'settings' => 'big_bob_image_over_video',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 0,
    'description' => __('This places the bacground image over the background video.', 'big-scene'),
    ));

    $wp_customize->selective_refresh->add_partial( 'big_bob_image_over_video', array(
        'render_callback' => 'big_bob_is_image_over_video',
    ) );

    $wp_customize->add_section('big_bob_navigation', array(
        'title'      => __('Navigation', 'big-scene'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('big_bob_sticky_sidebar', array(
        'default'     => 'On',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_sticky_sidebar', array(
    'label' => __('Sticky Sidebar', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_sticky_sidebar',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 110,
    'description' => __('If a sidebar is being used, and a reduced sidebar is shorter than the body,
    then turning this on will cause the sidebar to shrink in size if it is big 
    and become its own window with its own scrollbar, and it will stick into position when you scroll down the screen.
    This feature is not available on all browsers.', 'big-scene'),
    ));
    
    $wp_customize->selective_refresh->add_partial( 'big_bob_sticky_sidebar', array(
        'render_callback' => 'big_bob_sidebar_is_sticky',
    ) );
    
    $wp_customize->selective_refresh->add_partial( 'big_bob_sticky_navbar_on_mobile', array(
        'render_callback' => 'big_bob_phone_is_sticky',
    ) );
    
    $wp_customize->add_setting('big_bob_sticky_navbar_on_mobile', array(
        'default'     => 'Off',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_sticky_navbar_on_mobile', array(
    'label' => __('Sticky Title On Mobile', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_sticky_navbar_on_mobile',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 110,
    'description' => __('Turning this off will remove most of the navbar (except the menu button) when scrolling down mobile screens 
    (screens with a width less than 1065px).  If you do not have a title in the navbar, then only the menu button is 
    dsiplayed regarless of the status of this control.', 'big-scene'),
    ));

    $wp_customize->add_section('big_bob_body_style', array(
        'title'      => __('Layout', 'big-scene'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('big_bob_highlight_feature_image', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_highlight_feature_image', array(
    'label' => __('Highlight Featured Media', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_highlight_feature_image',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __("This will move the text down the width of the screen on single pages and posts
    so that feaured and background images and videos receive more exposure.", 'big-scene'),
    ));
    
    $wp_customize->selective_refresh->add_partial( 'big_bob_highlight_feature_image', array(
        'render_callback' => 'big_bob_turn_on_highlighted_featured_image',
    ) );

    $wp_customize->add_setting('big_bob_page_titles', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_page_titles', array(
    'label' => __('Page Titles', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_page_titles',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __("This controls whether page titles are displayed on pages (not posts).", 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_wide_when_centered', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_wide_when_centered', array(
    'label' => __('Pages Wide When Centered', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_wide_when_centered',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __("This will widen the width of the body to the full width of the screen on pages (not posts) when the 
    sidebar isn't present.", 'big-scene'),
    ));
    
    $wp_customize->selective_refresh->add_partial( 'big_bob_wide_when_centered', array(
        'render_callback' => 'big_bob_turn_on_wide_when_centered',
    ) );

    $wp_customize->add_setting('big_bob_excerpt_mode', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));
  
    $wp_customize->add_control('big_bob_excerpt_mode', array(
    'label' => __('Excerpt Mode', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_excerpt_mode',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 0,
    'description' => __("This will turrn off excerpt mode for the post and archive results pages, but it will leave it on
    for the search results page.", 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_blog_sidebar_only', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit_home',
    ));
  
    $wp_customize->add_control('big_bob_blog_sidebar_only', array(
    'label' => __('No Sidebar for Static Pages', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_blog_sidebar_only',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Home Only' => __('Home Only', 'big-scene'),
        'Except Home' => __('Except Home', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => -1,
    'description' => __("Turning this on will turn off the sidebar for any page that is created as a page (as opposed to a post),
    but it will keep your sidebar active for all other pages of your site (posts, search results, archives, etc.).  Note that if
    you choose <u>Home Only</u> or <u>Except Home</u>, your homepage must be defined as a static page in <u>Homepage Settings</u>.", 'big-scene'),
    ));

    $wp_customize->add_section('big_bob_background_video', array(
        'title' => __('Background Media', 'big-scene'),
        'priority'   => 90,
        'description'  => __('You can use this section to set mobile friendly background images and videos
        into different areas of your site, inlcluding area not covered by header media and featured media.', 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_background_image_media', array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'big_bob_background_image_media', array(
        'section' => 'big_bob_background_video',
        'settings' => 'big_bob_background_image_media',
        'label' => __('Load a Background Image to Your Query Pages.', 'big-scene'),
        'mime_type' => 'image',
        'priority' => -1,
        'description' => __('The background image has been designed to be mobile frindly.
        The default setting will add a background image to your query pages 
        like your posts page or your search results page.  It will also be loaded to 
        your 404 page.', 'big-scene'),
    )));

    $wp_customize->add_setting('big_bob_background_video_media', array(
        'type' => 'theme_mod',
        'sanitize_callback' => 'absint'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'big_bob_background_video_media', array(
        'section' => 'big_bob_background_video',
        'settings' => 'big_bob_background_video_media',
        'label' => __('Load a Background Video to Your Query Pages.', 'big-scene'),
        'mime_type' => 'video',
        'priority' => 0,
        'description' => __('The default setting will add a background video to your query pages 
        like your posts page or your search results page.  It will also be loaded to 
        your 404 page.', 'big-scene'),
    )));    

    $wp_customize->add_setting('big_bob_background_video_all', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_background_video_all', array(
        'label' => __('Background Video All', 'big-scene'),
        'section' => 'big_bob_background_video',
        'settings' => 'big_bob_background_video_all',
        'type' => 'radio',
        'choices' => array(
            'On' => __('On', 'big-scene'),
            'Off' => __('Off', 'big-scene'),
        ),
        'priority' => 1,
        'description' => __("Turning this on will set the background video to all of your pages.", 'big-scene'),
    ));

    $wp_customize->add_setting('big_bob_show_footer', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit_Att',
    ));
  
    $wp_customize->add_control('big_bob_show_footer', array(
    'label' => __('Show Footer', 'big-scene'),
    'section' => 'big_bob_body_style',
    'settings' => 'big_bob_show_footer',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Remove Attribution Only' => __('Remove Attribution Only', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
	),
    'priority' => 100,
    'description' => __("Turning this off will completely remove the footer and the back to top button.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_show_footer', array(
        'render_callback' => 'big_bob_show_footer_on',
    ) );

    // Add section.
	$wp_customize->add_section( 'big_bob_fonts' , array(
		'title'    => __('Typography','big-scene'),
		'priority' => 50,
        'description' => __("You can use this to update the default fonts using the fonts
        from the google fonts api (https://fonts.google.com/).  If you want to add a new font, 
        then you need to use the exact letter casing and spacing.  You should be able to achieve this 
        by copying and pasting the name of the font directly from the google fonts site.  
        Because the Google font library is so large, you will
        find that some fonts are more compatible than others.", 'big-scene'),
	) );
    // Add settings
	$wp_customize->add_setting( 'big_bob_fonts_main_title', array(
        'default'           => __( 'Bebas Neue', 'big-scene' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
   ) );
   $wp_customize->add_control( new WP_Customize_Control(
       $wp_customize,
       'big_bob_fonts_main_title',
           array(
               'label'    => __( 'Title', 'big-scene' ),
               'section'  => 'big_bob_fonts',
               'settings' => 'big_bob_fonts_main_title',
               'type'     => 'text',
               'description' => __("If this is left blank, then headings will used as the title font.", 'big-scene'),
           )
       )
   );
   $wp_customize->selective_refresh->add_partial( 'big_bob_fonts_main_title', array(
       'render_callback' => 'big_bob_change_fonts_main_title',
   ) );
	// Add settings
	$wp_customize->add_setting( 'big_bob_fonts_title', array(
		 'default'           => __( 'Bebas Neue', 'big-scene' ),
		 'sanitize_callback' => 'wp_filter_nohtml_kses',
	) );
    $wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'big_bob_fonts_title',
		    array(
		        'label'    => __( 'Headings', 'big-scene' ),
		        'section'  => 'big_bob_fonts',
		        'settings' => 'big_bob_fonts_title',
		        'type'     => 'text',
		    )
	    )
	);
    $wp_customize->selective_refresh->add_partial( 'big_bob_fonts_title', array(
        'render_callback' => 'big_bob_change_fonts_title',
    ) );
    // Add settings
	$wp_customize->add_setting( 'big_bob_fonts_paragraph', array(
        'default'           => __( '', 'big-scene' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
   ) );
   $wp_customize->add_control( new WP_Customize_Control(
       $wp_customize,
       'big_bob_fonts_paragraph',
           array(
               'label'    => __( 'Paragraph', 'big-scene' ),
               'section'  => 'big_bob_fonts',
               'settings' => 'big_bob_fonts_paragraph',
               'type'     => 'text',
           )
       )
   );
   $wp_customize->selective_refresh->add_partial( 'big_bob_fonts_paragraph', array(
       'render_callback' => 'big_bob_change_fonts_paragraph',
   ) );

    // Add settings
	$wp_customize->add_setting( 'big_bob_fonts_misc', array(
        'default'           => __( 'Bebas Neue', 'big-scene' ),
        'sanitize_callback' => 'wp_filter_nohtml_kses',
   ) );
   $wp_customize->add_control( new WP_Customize_Control(
       $wp_customize,
       'big_bob_fonts_misc',
           array(
               'label'    => __( 'Menus and Miscellaneous', 'big-scene' ),
               'section'  => 'big_bob_fonts',
               'settings' => 'big_bob_fonts_misc',
               'type'     => 'text',
           )
       )
   );
   $wp_customize->selective_refresh->add_partial( 'big_bob_fonts_misc', array(
       'render_callback' => 'big_bob_change_fonts_misc',
   ) );

   $wp_customize->add_setting('big_bob_center_nav', array(
    'default'     => 'On',
    'transport'   => 'refresh',
    'sanitize_callback' => 'big_bob_checkMediaFit',
    ));

    $wp_customize->add_control('big_bob_center_nav', array(
    'label' => __('Center Navbar', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_center_nav',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 90,
    'description' => __("This will center the contents of the navbar on wide screens and remove the tagline from the navbar 
    if it is being shown.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_center_nav', array(
        'render_callback' => 'big_bob_set_nav',
    ) );

    $wp_customize->add_setting('big_bob_menu_size', array(
        'default'     => 'Medium',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMenuSize',
        ));
    
    $wp_customize->add_control('big_bob_menu_size', array(
    'label' => __('Menu Size', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_menu_size',
    'type' => 'radio',
    'choices' => array(
        'Small' => __('Small', 'big-scene'),
        'Medium' => __('Medium', 'big-scene'),
        'Large' => __('Large', 'big-scene'),
    ),
    'priority' => 100,
    'description' => __("This will change the size of the menu items in your navbar.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_menu_size', array(
        'render_callback' => 'big_bob_set_nav',
    ) );
    $wp_customize->add_setting('big_bob_menu_spacing', array(
        'default'     => 'Large',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMenuSize',
        ));
    
    $wp_customize->add_control('big_bob_menu_spacing', array(
    'label' => __('Menu Spacing', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_menu_spacing',
    'type' => 'radio',
    'choices' => array(
        'Small' => __('Small', 'big-scene'),
        'Medium' => __('Medium', 'big-scene'),
        'Large' => __('Large', 'big-scene'),
    ),
    'priority' => 100,
    'description' => __("This will change the spacing between your menu items.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_menu_spacing', array(
        'render_callback' => 'big_bob_set_nav',
    ) );

    $wp_customize->add_setting('big_bob_underline_menu', array(
        'default'     => 'On',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
        ));
    
    $wp_customize->add_control('big_bob_underline_menu', array(
    'label' => __('Underline Current Page', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_underline_menu',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 90,
    'description' => __("This will underline the current page in the main navigation menu.
    It may be helpful to turn this off if you are creating a one page website.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_underline_menu', array(
        'render_callback' => 'big_bob_set_underline',
    ) );

    $wp_customize->add_setting('big_bob_center_nav_with_tagline', array(
        'default'     => 'Off',
        'transport'   => 'refresh',
        'sanitize_callback' => 'big_bob_checkMediaFit',
        ));
    
    $wp_customize->add_control('big_bob_center_nav_with_tagline', array(
    'label' => __('Add Tagline When Title is in Navbar', 'big-scene'),
    'section' => 'big_bob_navigation',
    'settings' => 'big_bob_center_nav_with_tagline',
    'type' => 'radio',
    'choices' => array(
        'On' => __('On', 'big-scene'),
        'Off' => __('Off', 'big-scene'),
    ),
    'priority' => 90,
    'description' => __("This will set the tagline in the under the title if the title is set into the 
    navbar.", 'big-scene'),
    ));
    $wp_customize->selective_refresh->add_partial( 'big_bob_center_nav_with_tagline', array(
        'render_callback' => 'big_bob_set_nav',
    ) );

    function big_bob_checkMenuSize($input) {
        $valid = array(
            'Small' => 'Small',
            'Medium' => 'Medium',
            'Large' => 'Large',
        );
    
        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

    function big_bob_checkMediaFit_Att($input) {
        $valid = array(
            'On' => 'On',
            'Remove Attribution Only' => 'Remove Attribution Only',
            'Off' => 'Off',
        );
    
        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

    function big_bob_checkMediaFit($input) {
        $valid = array(
            'On' => 'On',
            'Off' => 'Off',
        );
    
        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

    function big_bob_checkMediaFit_Big_Small($input) {
        $valid = array(
            'Big' => 'Big',
            'Small' => 'Small',
            'Logo Below Nav' => 'Logo Below Nav',
            'Big Tagline Only' => 'Big Tagline Only',
            'Small Tagline Only' => 'Small Tagline Only',
            'Off' => 'Off',
        );
    
        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }

    function big_bob_checkMediaFit_home($input) {
        $valid = array(
            'On' => 'On',
            'Home Only' => 'Home Only',
            'Except Home' => 'Except Home',
            'Off' => 'Off',
        );
    
        if (array_key_exists($input, $valid)) {
            return $input;
        } else {
            return '';
        }
    }
}
add_action( 'customize_register', 'big_bob_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function big_bob_customize_preview_js() {
	wp_enqueue_script( 'big-bob-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'big_bob_customize_preview_js' );

add_action('wp_head', 'big_bob_customizer_css');
function big_bob_customizer_css()
{
        ?>
         <style type="text/css">
                a, a:focus, a:active, a:visited { 
                 color: #<?php echo esc_attr(get_theme_mod('big_bob_link_color', '#66cdaa')); ?>; 
                }
                .nav-menu li a:hover, .site-title a:hover, .bb-site-title a:hover, a:hover {
                    color:  #<?php echo esc_attr(get_theme_mod('big_bob_link_hover_color', '#66cdaa')); ?> !important;
                }
            
         </style>
    <?php
}

add_action('wp_head', 'big_bob_underline_menu');
function big_bob_underline_menu() {
    if (get_theme_mod('big_bob_underline_menu', "On") == "Off") {
        ?>
         <style type="text/css">
                .nav-menu .current_page_item,
                .nav-menu .current-menu-item  {
                    text-decoration: none; 
                }
         </style>
    <?php
    }
}

//big_bob_set_nav
add_action('wp_head', 'big_bob_set_nav');
function big_bob_set_nav() {
    if (get_theme_mod('big_bob_center_nav', "On") == "On") {
         ?>
			<style type="text/css">
                @media screen and (min-width: 1065px) {
                    #site-navigation ul {
                        transition: 1200ms ease;
                        margin: 0px;
                        margin-bottom: 10px;
                    }
                    #site-navigation.scrolled ul {
                        transition: 1200ms ease;
                    }
                    .custom-logo-link,
                    .bb-site-title-top {
                        clear: both;
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                        text-align: center;
                        margin-bottom: 10px !important;
                        margin-top: 10px!important;
                        padding-right: 0px
                    }
                    .bb-site-title-top {
                        font-size: 45px !important;
                    }
                    .bb-site-description-top {
                        display: none;
                    }
                    .main-navigation ul{
                        justify-content: center;
                    }
                    .nav-menu, .custom-logo-link {
                        float: none;
                        padding: 0px !important;
                    }
                    <?php
                    if ((has_custom_logo() && (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) != 'Logo Below Nav')) || (display_header_text() && (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Off'))) {
                    ?>
                        @media screen and (min-width: 1065px) {
                            #site-navigation.scrolled {
                                top: -80px;
                            }
                        }
                    <?php
                    } else {
                        ?>
                            #site-navigation {
                                padding-top: 10px;
                            }
                        <?php
                    }
                    ?>
                }
            </style>
        <?php
        if ((get_theme_mod('big_bob_menu_size', "Medium") == "Medium") || (get_theme_mod('big_bob_menu_size', "Medium") == "Large")) {
            ?>
            <style type="text/css">
                @media screen and (min-width: 1065px) {
                    #site-navigation ul {
                        font-size: 23px;
                    }
                    #site-navigation.scrolled ul {
                        font-size: 18px;
                    }
                    .no-results .sideStick,
                    .search-results .sideStick,
                    .error404 .sideStick,
                    .search-no-results .sideStick{
                        top: 150px;
                    }
                }
            </style>
            <?php
            if (get_theme_mod('big_bob_menu_size', "Medium") == "Large") {
                ?>
                <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation ul {
                            font-size: 30px;
                        }
                    }
                </style>
            <?php
            }
            if ((get_theme_mod( 'big_bob_highlight_feature_image', 'On' ) == 'Off') && !is_front_page() && (is_page() || is_single()) ) {
                ?>
                <style type="text/css">
                @media screen and (min-width: 1065px) {
                    .page .sideStick,
                    .single .sideStick{
                        top: 150px;
                    }
                }
                </style>
                <?php
            }
            $big_bob_description = get_bloginfo( 'description', 'display' );
            if (!is_front_page() && !(!get_header_image() && !has_header_video() && !display_header_text() && !is_front_page() && !((get_theme_mod( 'big_bob_highlight_feature_image', 'On' ) == 'On') && !is_front_page() && (is_page() || is_single()) ) )){
                ?>
                <style type="text/css">
                @media screen and (min-width: 1065px) {
                    .bb-top-padding{
                        margin: 300px;
                    }
                }
                </style>
                <?php
                if (!display_header_text()) {
                    ?>
                    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        .bb-top-padding{
                            margin: 190px;
                        }
                    }
                    </style>
                    <?php
                }
            } else if (has_custom_logo() && !display_header_text() && !((get_theme_mod( 'big_bob_highlight_feature_image', 'On' ) == 'On') && !is_front_page() && (is_page() || is_single()) ) )  {
                ?>
                    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        .bb-top-padding {
                            margin: 190px;
                        }
                    }
                    </style>
                    <?php
            }
        }
        //Add the tagline back
        $big_bob_description = get_bloginfo( 'description', 'display' );
        if ((get_theme_mod( 'big_bob_center_nav_with_tagline', 'Off' ) == 'On') && !has_custom_logo() && $big_bob_description) {
            ?>
            <style type="text/css">
            @media screen and (min-width: 1065px) {
                .bb-site-title-top {
                    font-size: 30px !important;
                    margin-top: 0px !important;
                    margin-bottom: 5px !important;
                }
                .bb-site-description-top {
                    font-size: 15px !important;
                    display: block;
                    clear: both;
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    text-align: center;
                    padding-right: 0px;
                }
            }
            </style>
            <?php
            big_bob_change_fonts_title();
        }
    } else {//not centered
        ?>
        <style type="text/css">
            @media screen and (min-width: 1065px) {
                #site-navigation ul {
                    margin-bottom: 0px;
                    transition: 1200ms ease;
                }
                #site-navigation.scrolled ul {
                    transition: 1200ms ease;
                }
                #site-navigation.scrolled .custom-logo-link {
                    padding-top: 10px;
                    padding-bottom: 10px;
                    transition: 1200ms ease;
                }

                #site-navigation .custom-logo-link {
                    padding-top: 25px;
                    padding-bottom: 25px;
                    transition: 1200ms ease;
                }
            }
        </style>
        <?php
        if (get_theme_mod('big_bob_menu_size', "Medium") == "Small") {
            $big_bob_description = get_bloginfo( 'description', 'display' );
            if ($big_bob_description && !has_custom_logo()) {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                                margin-top: -15px !important;
                        }
                        #site-navigation.scrolled ul ul {
                                margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            } else {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                                margin-top: -12px !important;
                        }
                        #site-navigation.scrolled ul ul {
                                margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            }
        } else if (get_theme_mod('big_bob_menu_size', "Medium") == "Medium") {
            ?>
            <style type="text/css">
                @media screen and (min-width: 1065px) {
                    #site-navigation ul {
                        margin-top: -4px !important;
                        font-size: 23px;
                    }
                    #site-navigation.scrolled ul {
                        font-size: 18px;
                    }
                    #site-navigation.scrolled ul ul {
                         margin-top: 0px !important;
                    }
                }
            </style>
            <?php
            $big_bob_description = get_bloginfo( 'description', 'display' );
            if ($big_bob_description && !has_custom_logo()) {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                            margin-top: -18px !important;
                        }
                        #site-navigation.scrolled ul ul {
                                margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            } else {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                                margin-top: -15px !important;
                        }
                        #site-navigation.scrolled ul ul {
                                margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            }
        } else if (get_theme_mod('big_bob_menu_size', "Medium") == "Large") {
            ?>
            <style type="text/css">
                @media screen and (min-width: 1065px) {
                    #site-navigation ul {
                        margin-top: -7px !important;
                        font-size: 30px;
                    }
                    #site-navigation.scrolled ul {
                        font-size: 18px;
                    }
                    #site-navigation.scrolled ul ul {
                        margin-top: 0px !important;
                    }
                }
            </style>
            <?php
            $big_bob_description = get_bloginfo( 'description', 'display' );
            if ($big_bob_description && !has_custom_logo()) {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                            margin-top: -18px !important;
                        }
                        #site-navigation.scrolled ul ul {
                            margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            } else {
                ?>
			    <style type="text/css">
                    @media screen and (min-width: 1065px) {
                        #site-navigation.scrolled ul {
                                margin-top: -15px !important;
                        }
                        #site-navigation.scrolled ul ul {
                            margin-top: 0px !important;
                        }
                    }
                </style>
                <?php
            }
        }
    }
    if (get_theme_mod('big_bob_menu_spacing', "Large") == "Small") {
        if (get_theme_mod('big_bob_center_nav', "On") == "On") {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 5px;
                    margin-right: 5px;
                }
            </style>
            <?php
        } else {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 10px;
                }
            </style>
            <?php
        }
    } else if (get_theme_mod('big_bob_menu_spacing', "Large") == "Medium") {
        if (get_theme_mod('big_bob_center_nav', "On") == "On") {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 9px;
                    margin-right: 9px;
                }
            </style>
            <?php
        } else {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 18px;
                }
            </style>
            <?php
        }
    } else {
        if (get_theme_mod('big_bob_center_nav', "On") == "On") {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 18px;
                    margin-right: 18px;
                }
            </style>
            <?php
        } else {
            ?>
            <style type="text/css">
                .main-navigation li {
                    margin-left: 25px;
                }
            </style>
            <?php
        }
    }
}

add_action('wp_head', 'big_bob_show_footer_on');
function big_bob_show_footer_on() {
    if (get_theme_mod('big_bob_show_footer', "On") == "Off") {
         ?>
			<style type="text/css">
                .site-footer {
                    display: none;
                }
            </style>
        <?php
    } else if (get_theme_mod('big_bob_show_footer', "On") == "Remove Attribution Only") {
        ?>
           <style type="text/css">
               .site-info {
                    display: none;
                }
           </style>
       <?php
   }
}

add_action('wp_head', 'big_bob_is_image_over_video');
function big_bob_is_image_over_video() {
    if (get_theme_mod('big_bob_image_over_video', 'Off') == "Off") {?>
			<style type="text/css">
                #bb-back-image, #bb-back-image img {
                    z-index: -1000;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_change_fonts_title');
function big_bob_change_fonts_title() {
    if (get_theme_mod('big_bob_fonts_title', 'Bebas Neue') != "") {
        $big_bob_url = get_theme_mod('big_bob_fonts_title', 'Bebas Neue'); ?>
			<style type="text/css">
                h1, h2, h3, h4, h5, h6, .site-description, .bb-site-description-top {
                    font-family: "<?php echo esc_html($big_bob_url); ?>", RobotoCondensed-Bold, Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_change_fonts_main_title');
function big_bob_change_fonts_main_title() {
    if (get_theme_mod('big_bob_fonts_main_title', 'Bebas Neue') != "") {
        $big_bob_url = get_theme_mod('big_bob_fonts_main_title', 'Bebas Neue'); ?>
			<style type="text/css">
                .site-title, .bb-site-title-top, .site-description, .bb-site-description-top {
                    font-family: "<?php echo esc_html($big_bob_url); ?>", RobotoCondensed-Bold, Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif !important;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_change_fonts_paragraph');
function big_bob_change_fonts_paragraph() {
    if (get_theme_mod('big_bob_fonts_paragraph') != "") {
        $big_bob_url = get_theme_mod('big_bob_fonts_paragraph'); ?>
			<style type="text/css">
                p, pre {
                    font-family: "<?php echo esc_html($big_bob_url); ?>", Abel-Regular, 'Times New Roman', Times, serif;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_change_fonts_misc');
function big_bob_change_fonts_misc() {
    if (get_theme_mod('big_bob_fonts_misc', 'Bebas Neue') != "") {
        $big_bob_url = get_theme_mod('big_bob_fonts_misc', 'Bebas Neue'); ?>
			<style type="text/css">
                body,
                input,
                select,
                optgroup,
                textarea {
                    font-family: "<?php echo esc_html($big_bob_url); ?>", RobotoCondensed-Bold, Arial, Helvetica, sans-serif;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_add_bright');
function big_bob_add_bright() {
        $FC = get_theme_mod('big_bob_foreground_color', '#000000');
        $FC = str_replace("#", "", $FC);
        $ThirdPart = substr($FC, 4);
        $SecondPart = substr($FC, 2, 2);
        $FirstPart = substr($FC, 0, 2);
        $ThirdHex = hexdec($ThirdPart);
        $SecondHex = hexdec($SecondPart);
        $FirstHex = hexdec($FirstPart);
        $OC = get_theme_mod('big_bob_range_home_nav_ti', '7');
        $OC = $OC/10;
        $OCRest = get_theme_mod('big_bob_range_nav_ti', '7');
        $OCRest = $OCRest/10;
        $OCBody = get_theme_mod('big_bob_range_sb', '10');
        $OCBody = $OCBody/10;
        $BBTC = get_theme_mod('big_bob_text_color', '#ffffff');
        ?>
			<style type="text/css">
                body {
                    background: #<?php echo esc_attr(get_theme_mod('big_bob_background_color', '#0f0f0f'))?>;
                }
                .home .site-branding {
                    background:rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OC)?>);
                }
                .home .bb-scroll-down {
                    background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OC)?>);
                }
                .site-branding {
                    background:rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCRest)?>);
                }
                .bb-scroll-down {
                    background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCRest)?>);
                }
                .bb-back-to-top {
                    background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCBody)?>);
                }
                <?php
                if (get_theme_mod('big_bob_borders', 'On') == "On") {
                ?>
                    .bb-aligncenterstyle,
                    .bb-alignleftstyle,
                    .bb-alignrightstyle,
                    .bb-back-to-top,
                    .posts-navigation, .post-navigation, .pagination {
                        border: 5px solid #<?php echo esc_attr($BBTC)?>;
                    }
                <?php
                } else {
                    ?>
                    .bb-aligncenterstyle,
                    .bb-alignleftstyle,
                    .bb-alignrightstyle,
                    .bb-back-to-top,
                    .posts-navigation, .post-navigation, .pagination {
                        border: none;
                    }
                    <?php 
                }
                ?>
                #bb-site-description-top,
                .site-description {
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                .home #site-navigation {
                    background:rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OC)?>) !important;
                }
                #site-navigation {
                    background:rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCRest)?>) !important;
                }
                #site-navigation.scrolled {
                    transition: 1200ms ease;
                    background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCBody)?>) !important;
                }
                p, pre {
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                .main-navigation ul ul,
                figcaption,
                .bb-alignleftstyle,
                .bb-alignrightstyle,
                .bb-aligncenterstyle,
                .posts-navigation, .post-navigation, .pagination,
                .no-sidebar .no-results {
                    background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCBody)?>);
                }
                @media screen and (max-width: 1064px) {
                    #bb-popout {
                        color: #<?php echo esc_attr($BBTC)?>;
                        background: rgba(<?php echo esc_attr($FirstHex)?>, <?php echo esc_attr($SecondHex)?>, <?php echo esc_attr($ThirdHex)?>, <?php echo esc_attr($OCBody)?>);
                    }
                    .nav-menu li {
                        border-bottom: 1px solid #<?php echo esc_attr($BBTC)?>;
                    }
                }
                @media screen and (max-width: 750px) {
                    .bb-side-menu li {
		                border-bottom: 1px solid #<?php echo esc_attr($BBTC)?>;
                    }
                }
                body,h1, h2, h3, h4, h5, h6  {
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                #bb-preloader {
                    background: #<?php echo esc_attr($FC)?>;
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                #bb-preloader h1,
                #bb-preloader h2 {
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                #bb-preloader:before {
                    border: 6px solid #<?php echo esc_attr($FC)?>;
	                border-top: 6px solid #<?php echo esc_attr($BBTC)?>;
                }
                .widget_search .search-form .search-submit, .form-submit .submit, .widget_search .search-form #submit,
                .error-404 .search-submit,
                .no-results .search-submit,
                .wp-block-search .wp-block-search__button {
                    border: 1px solid #<?php echo esc_attr($BBTC)?>;
                    background-color: transparent;
                    color: #<?php echo esc_attr($BBTC)?>;
                }
                input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea {
                    border: 1px solid #<?php echo esc_attr($BBTC)?>;
                }
                a {
                    -webkit-text-decoration-color: #<?php echo esc_attr($BBTC)?> !important; /* Safari */  
                    text-decoration-color: #<?php echo esc_attr($BBTC)?> !important;
                }
			</style>
		<?php
}

add_action('wp_head', 'big_bob_add_shadow');
function big_bob_add_shadow() {
    if( get_theme_mod( 'big_bob_background_shadow', 'On' ) == 'On' ) {
		?>
			<style type="text/css">
                .bb-site-title-top {
                    text-shadow: 0rem 0.8rem 0.8rem rgba(0, 0, 0, 1);
                    transition: 1200ms ease;
                }
                .bb-alignleftstyle,
                .bb-alignrightstyle,
                .bb-aligncenterstyle,
                .posts-navigation, .post-navigation, .pagination,
                .site-branding,
                .bb-scroll-down,
                #bb-toggle,
                .bb-back-to-top,
                #site-navigation,
                #site-navigation.scrolled,
                .no-sidebar .no-results
                {
                    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.8);
                }
			</style>
		<?php
    } 
    if (get_theme_mod('big_bob_title_shadow', 'Off') == 'Off') {
		?>
			<style type="text/css">
                .bb-site-title-top {
                    text-shadow: none !important;
                }
			</style>
		<?php
    }
}

add_action('wp_head', 'big_bob_turn_on_highlighted_featured_image');
function big_bob_turn_on_highlighted_featured_image() {
    if( get_theme_mod( 'big_bob_highlight_feature_image', 'On' ) == 'On' ) {
        if (is_page() && !is_front_page()) {
            ?>
			<style type="text/css">
                .entry-header {
                    display: none;
                }
			</style>
		<?php
        } else if (is_single()) {
            ?>
			<style type="text/css">
                .entry-title {
                    display: none;
                }
			</style>
		<?php
        }
        if (!is_front_page() && is_page() || is_single()) {
            ?>
			<style type="text/css">
            .site-title {
                display: none;
            }
            .site-branding {
                position: absolute;
                right: 60vw;
                text-align: left;
                width: 30%;
                bottom:  25vh;
                margin-bottom: auto;
            }
            .bb-page-or-post-title {
                font-size: 35px;
                font-weight: bold;
                margin: 0px;
                padding: 0px;
            }

            @media screen and (min-width: 1250px) {
                .site-branding {
                    width: 28%;
                }
            }

            @media screen and (max-width: 1050px) {
                .site-branding {
                    width: 33%;
                    right: 50vw;
                }
            }

            @media screen and (max-width: 900px) {
                .site-branding {
                    width: 38%;
                }
            }

            @media screen and (max-width: 800px) {
                .bb-page-or-post-title {
                    font-size: 30px;
                }
            }

            @media screen and (max-width: 750px) {
                .site-branding {
                    right: 0vw;
                    text-align: center;
                    width: 92%;
                    bottom:  45vh;
                }
            }

            @media screen and (max-width: 600px) {
                .bb-page-or-post-title {
                    font-size: 25px;
                }
            }

            @media screen and (max-height: 450px) {
                .site-branding {
                    right: 0vw;
                    text-align: center;
                    width: 52%;
                }
            }
            </style>
		<?php
        }
    } 
}

add_action('wp_head', 'big_bob_turn_on_wide_when_centered');
function big_bob_turn_on_wide_when_centered() {
    if (get_theme_mod('big_bob_wide_when_centered', 'On') == 'On') {
        ?>
        <style type="text/css">
        /*begin wide*/
        .page .entry-content.bb-aligncenterstyle {
            width: 100%;
            border-radius: 0px;
        }
        @media screen and (min-width: 1064px) {
            .page .entry-content.bb-aligncenterstyle p,
            .page .entry-content.bb-aligncenterstyle pre,
            .page .entry-content.bb-aligncenterstyle ul,
            .page .entry-content.bb-aligncenterstyle ol,
            .page .entry-content.bb-aligncenterstyle dl,
            .page .entry-content.bb-aligncenterstyle cite,
            .page .entry-content.bb-aligncenterstyle address {
                width: 55%;
            }
            .page .entry-content.bb-aligncenterstyle code {
                width: auto;
            }
        }
        .page .bb-aligncenterstyle .blocks-gallery-grid {
            max-width: 100%;
            width: 100% !important;
        }
        .page .entry-header.bb-aligncenterstyle {
            width: 100%;
            border-radius: 0px;
        }
        .page .comments-area.bb-aligncenterstyle {
            width: 100%;
            border-radius: 0px;
        }
        .page .bb-wide-footer {
            width: 100%;
            max-width: 100%;
            border-radius: 0px;
            margin-bottom: -25px;
        }
        /*end wide*/
        </style>
        <?php
    }
}

add_action('wp_head', 'big_bob_turn_on_big_description');
function big_bob_turn_on_big_description() {
    if( (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Small Tagline Only' ) || (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Big Tagline Only' ))  {
		?>
			<style type="text/css">
                .site-title {
                    display: none;
                }
                .site-branding {
                    right: 70vw;
                    text-align: left;
                    width: 20%;
                }
                .site-description {
                    font-size: 45px;
                    font-weight: bold;
                }

                @media screen and (min-width: 1250px) {
                    .site-branding {
                        width: 18%;
                     }
                }

                @media screen and (max-width: 1050px) {
                    .site-branding {
                        width: 23%;
                        right: 60vw;
                     }
                }

                @media screen and (max-width: 900px) {
                    .site-branding {
                        width: 28%;
                     }
                }

                @media screen and (max-width: 750px) {
                    .site-branding {
                        right: 0vw;
                        text-align: center;
                        width: 52%;
                    }
                }
                
                @media screen and (max-width: 600px) {
                    .site-branding {
                        width: 85%;
                    }
                }

                @media screen and (max-width: 500px) {
                    .site-description {
                        font-size: 42px;
                    }
                }

                @media screen and (max-height: 450px) {
                    .site-branding {
                        right: 0vw;
                        text-align: center;
                        width: 85%;
                    }
                }
			</style>
		<?php
        if( get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Small Tagline Only' ) {
            ?>
			<style type="text/css">
                .site-description {
                    font-size: 35px;
                }
                @media screen and (max-width: 500px) {
                    .site-description {
                        font-size: 32px;
                    }
                }
                </style>
		<?php
         }
    } 
    if (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Big') {
        ?>
        <style type="text/css">
            .site-title {
                font-size: 75px;
            }
            @media screen and (max-width: 900px) {
                .site-title {
                    font-size: 60px;
                }
            }
            @media screen and (max-width: 750px) {
                .site-title {
                    font-size: 50px;
                    text-align: center;
                }
            }
            </style>
    <?php
     }
     if (get_theme_mod( 'big_bob_title_below_nav', 'Small' ) == 'Off') {
        ?>
        <style type="text/css">
        .home .site-branding {
            display: none;
        }
        .paged .site-branding {
            display: block;
        }
        </style>
    <?php
     }
    big_bob_turn_on_highlighted_featured_image();//overrides if necessary.
}

add_action('wp_head', 'big_bob_sidebar_is_sticky');
function big_bob_sidebar_is_sticky() {
    if( get_theme_mod( 'big_bob_sticky_sidebar', 'On' ) == 'Off' ) {
		?>
			<style type="text/css">
				.sideStick {
                    position: static;
                    top: auto;
                    right: auto;
                }
                @media screen and (min-width: 750px) {
                    #secondary, #bb-secondSide {
                        max-height: none;
                    }
                }
                @media screen and (min-height: 1000px) {
                    #secondary, #bb-secondSide {
                        max-height: none;
                    }
                }
			</style>
		<?php
    } else {
        ?>
			<style type="text/css">
				.sideStick {
                    position: sticky;
                    top: 130px;
                    right: 0;
                    overflow: auto;
                    overflow-x:  hidden;
                }
                @media screen and (max-width: 1300px) {
                    .site-footer {
                        max-width: 400px;
                    }
                }
                @media screen and (max-width: 1000px) {
                    .site-footer {
                        max-width: 300px;
                    }
                }
                @media screen and (max-width: 750px) {
                    .site-footer {
                        max-width: 95%;
                    }
                }
                @media screen and (min-width: 750px) {
                    #secondary, #bb-secondSide {
                        max-height: 60vh;
                        overflow: auto;
                        overflow-x: hidden;
                        scrollbar-width: thin;
                        scrollbar-color: #fff #000;
                    }
                }
                @media screen and (min-height: 1000px) {
                    #secondary, #bb-secondSide {
                        max-height: 75vh;
                    }
                }
			</style>
		<?php
    }
}

add_action('wp_head', 'big_bob_phone_is_sticky');
function big_bob_phone_is_sticky() {
    if( get_theme_mod( 'big_bob_sticky_navbar_on_mobile', 'Off' ) == 'Off' ) {
		?>
			<style type="text/css">
                @media screen and (max-width: 1064px) {
                    .bb-fixed-top {
                        position: absolute;
                    }
                }
			</style>
		<?php
    } else {
        ?>
			<style type="text/css">
                @media screen and (max-width: 1065px) {
                    .bb-fixed-top {
                        position: fixed;
                    }
                }
				@media screen and (max-width: 500px) {
                    .bb-fixed-top {
                        position: fixed;
                    }
                }
			</style>
		<?php
    }
}

add_action('wp_head', 'big_bob_media_in_background');
function big_bob_media_in_background() {
    if( get_theme_mod( 'big_bob_media_to_background', 'Off' ) == 'On' ) {
		?>
            <style type="text/css">
            
                .wp-custom-header video,
                .wp-custom-header img,
                .wp-custom-header iframe {
                    position: fixed;
                    z-index: -999;
                }
            
			</style>
		<?php
    } else {
        ?>
            <style type="text/css">

                .wp-custom-header,
				.wp-custom-header video,
                .wp-custom-header img,
                .wp-custom-header iframe {
                    position: relative;
                    z-index: auto;
                }
            
			</style>
		<?php
    }
}
add_action('wp_head', 'big_bob_video_for_phone');
function big_bob_video_for_phone() {
    if( get_theme_mod( 'big_bob_video_on_phone', 'On' ) == 'Off' ) {
		add_filter( 'header_video_settings', function( $args ) {

            $args['minWidth'] = 1050;
        
            return $args;
        
        } );
    } else {
        add_filter( 'header_video_settings', function( $args ) {

            $args['minWidth'] = 0;
        
            return $args;
        
        } );
    }
}

