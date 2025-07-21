<?php
/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'free-content.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );

/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$charity_aid_config['charity_aid_page_slug'] 	= 'charity-aid';
$charity_aid_config['charity_aid_page_title']	= 'Free Demo Content';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$charity_aid_config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro',
		'title'			=> __( 'Welcome to ', 'charity-aid' ) . $theme_title,
		'icon'			=> 'dashboard',
		'button_text'	=> __( 'System Status', 'charity-aid' ),
		'can_skip'		=> false,
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'charity-aid' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'charity-aid' ),
		'can_skip'		=> true,
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Free Demo Content', 'charity-aid' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text_one'	=> __( 'Click On The Image To Import Customizer Demo', 'charity-aid' ),
		'button_text_two'	=> __( 'Click On The Image To Import Gutenberg Block Demo', 'charity-aid' ),
		'can_skip'		=> true,
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'charity-aid' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'CharityAidThemeWhizzie' ) ) {
	$CharityAidThemeWhizzie = new CharityAidThemeWhizzie( $charity_aid_config );
}
