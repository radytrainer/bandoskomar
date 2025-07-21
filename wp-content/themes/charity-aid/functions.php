<?php
/**
 * Charity Aid functions and definitions
 *
 * @package Charity Aid
 */

if ( ! function_exists( 'charity_aid_setup' ) ) :
	function charity_aid_setup() {
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );

		load_theme_textdomain( 'charity-aid', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Post thumbnail support should be enabled for pages and posts.
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'charity-aid' ),
			'menu-2' => esc_html__( 'Footer', 'charity-aid' ),
		) );

		/*
		 * To produce valid HTML5, change the default core markup for the comments, search form, and search form.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 270,
			'height'      => 80,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add custom image size.
		add_image_size( 'charity-aid-1920-550', 1920, 550, true );
		add_image_size( 'charity-aid-1370-550', 1370, 550, true );
		add_image_size( 'charity-aid-590-310', 590, 310, true );
		add_image_size( 'charity-aid-420-380', 420, 380, true );
		add_image_size( 'charity-aid-420-300', 420, 300, true );
		add_image_size( 'charity-aid-420-200', 420, 200, true );
		add_image_size( 'charity-aid-290-150', 290, 150, true );
		add_image_size( 'charity-aid-80-60', 80, 60, true );
		
		add_editor_style( array( '/assets/css/editor-style.min.css') );

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'custom-background', apply_filters( 'charity_aid_custom_background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
        
        add_theme_support( 'responsive-embeds' );

		add_theme_support('custom-header', array(
			'default-image'      => '',
			'width'              => 1920,
			'height'             => 200,
			'flex-height'        => true,
			'flex-width'         => true,
			'uploads'            => true,
		));

		define('CHARITY_AID_BUY_NOW',__('https://www.themepixels.net/products/charity-wordpress-theme/','charity-aid'));
		define('CHARITY_AID_LIVE_DEMO',__('https://themepixels.net/demo-site/charity-aid/','charity-aid'));
		define('CHARITY_AID_FREE_DOC',__('https://www.themepixels.net/docs/charity-aid-free/','charity-aid'));
		define('CHARITY_AID_BUNDLE',__('https://www.themepixels.net/products/wp-theme-bundle/','charity-aid'));
		define('CHARITY_AID_THEME_SUPPORT',__('https://wordpress.org/support/theme/charity-aid','charity-aid'));

		/**
		* FREE DEMO CONTENT.
		*/
		require get_template_directory() . '/inc/free-demo-content/charity_aid_config_file.php';

	}
endif;
add_action( 'after_setup_theme', 'charity_aid_setup' );

/**
 * Enqueue scripts and styles.
 */
function charity_aid_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	if ( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/bootstrap/css/rtl/bootstrap.min.css' );

		wp_enqueue_style( 'charity-aid-rtl-style', get_template_directory_uri() . '/rtl.css' );
	}

	wp_enqueue_style( 'charity-aid-style', get_stylesheet_uri() );
	
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css' );
	
	wp_enqueue_style( 'owl.carousel.css', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'charity-aid-blocks', get_template_directory_uri() . '/assets/css/blocks.min.css' );
	wp_enqueue_style( 'poppins-google-font', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );

	$scripts = array(
		array(
			'id'     => 'bootstrap',
			'url'    => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => true
		),
		array(
			'id'     => 'owl.carousel.js',
			'url'    => get_template_directory_uri() . '/assets/js/owl.carousel.js',
			'footer' => true
		),
		array(
			'id'     => 'charity-aid-custom',
			'url'    => get_template_directory_uri() . '/assets/js/custom.js',
			'footer' => true
		)
	);

	charity_aid_add_scripts( $scripts );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'charity_aid_scripts' );

/**
* Add script
* 
* @since Charity Aid 1.0.0
*/
function charity_aid_add_scripts( $scripts ){
	foreach ( $scripts as $key => $value ) {
		wp_enqueue_script( $value['id'] , $value['url'] , array( 'jquery', 'jquery-masonry' ), 0.8, $value['footer'] );
	}
}

/**
 * Sanitizes Image Upload.
 *
 * @param string $input potentially dangerous data.
 */
function charity_aid_sanitize_image( $input ) {
	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
		return esc_url( $input );
	}
	return '';
}

/**
* Enqueue editor styles for Gutenberg
* 
* @since Charity Aid 1.0.0
*/
function charity_aid_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'charity-aid-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.min.css' ) );
}
add_action( 'enqueue_block_editor_assets', 'charity_aid_block_editor_styles' );

// Sanitization function to ensure it's an integer within the range
function charity_aid_sanitize_number( $input ) {
    $input = absint( $input ); // Convert to a non-negative integer
    return ( $input >= 1 && $input <= 6 ) ? $input : 1; // Return input if within range, or default to 1
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Dynamic CSS.
 */
require get_template_directory() . '/inc/customizer/loader.php';

/**
* GET START.
*/
require get_template_directory() . '/themeinfo/charity_aid_themeinfo_page.php';

/**
 * Typography Fonts
 */
require get_template_directory() . '/inc/typography-settings/typography-fonts.php';


// NOTICE FUNCTION
function charity_aid_activation_notice() {
    if (get_option('charity_aid_notice_dismissed')) {
        return;
    }

    if (isset($_GET['page']) && $_GET['page'] === 'charity-aid-themeinfo-page') {
        return;
    }
    ?>
    <div class="updated notice notice-theme-info-class is-dismissible" data-notice="theme_info">
        <div class="charity-aid-theme-info-notice clearfix">
            <div class="charity-aid-theme-notice-content">
                <h2 class="charity-aid-notice-h2">
                    <?php
                    printf(
                        /* translators: 1: Theme name */
                        esc_html__('Hello! Thank you for choosing our %1$s!', 'charity-aid'), '<strong>' . esc_html(wp_get_theme()->get('Name')) . '</strong>'
                    );
                    ?>
                </h2>
                <a class="charity-aid-btn-theme-info button button-primary" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=charity-aid-themeinfo-page')); ?>" id="charity-aid-themeinfo-button"> <?php esc_html_e('Charity Aid Theme Information', 'charity-aid') ?></a>
				<a class="charity-aid-btn-theme-info button button-primary" target="_blank" href="<?php echo esc_url(admin_url('themes.php?page=charityaid-freedemocontent')); ?>" id="charity-aid-freedemocontent-button"> <?php esc_html_e('Free Demo Content', 'charity-aid') ?></a>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_notices', 'charity_aid_activation_notice');

add_action('wp_ajax_charity_aid_dismiss_notice', 'charity_aid_dismiss_notice');

function charity_aid_notice_status() {
    delete_option('charity_aid_notice_dismissed');
}
add_action('after_switch_theme', 'charity_aid_notice_status');

function charity_aid_dismiss_notice() {
    update_option('charity_aid_notice_dismissed', true);
    wp_send_json_success();
}

function charity_aid_admin_enqueue_scripts(){
	wp_enqueue_style('charity-aid-admin-style', esc_url( get_template_directory_uri() ) . '/assets/css/charity-aid-notice.css');
	wp_enqueue_script('charity-aid-dismiss-notice-script', get_stylesheet_directory_uri() . '/assets/js/charity-aid-notice.js', array('jquery'), null, true);
}
add_action( 'admin_enqueue_scripts', 'charity_aid_admin_enqueue_scripts' );


function charity_aid_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'charity_aid_remove_customize_register', 11 );