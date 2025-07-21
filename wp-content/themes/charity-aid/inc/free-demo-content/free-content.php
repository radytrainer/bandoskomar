<?php
/**
 * @package Free Demo Content
 * @since 1.0.0
 */

class CharityAidThemeWhizzie {

	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $charity_aid_theme_name = '';
	protected $charity_aid_theme_title = '';

	/** @var string Free Demo Content page slug and title. */
	protected $charity_aid_page_slug = '';
	protected $charity_aid_page_title = '';

	/** @var array Free Demo Content steps set by user. */
	protected $charity_aid_config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	*/
	protected $charity_aid_plugin_url = '';
	protected $charity_aid_plugin_path = '';
	public $charity_aid_parent_slug;
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	*/
	protected $charity_aid_tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	*/
	protected $charity_aid_tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	*/
	protected $charity_aid_tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	/**
	 * Constructor
	 *
	 * @param $charity_aid_config	Our config parameters
	*/
	public function __construct( $charity_aid_config ) {
		$this->set_vars( $charity_aid_config );
		$this->init();

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $charity_aid_config	Our config parameters
	*/
	public function set_vars( $charity_aid_config ) {

		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $charity_aid_config['charity_aid_page_slug'] ) ) {
			$this->charity_aid_page_slug = esc_attr( $charity_aid_config['charity_aid_page_slug'] );
		}
		if( isset( $charity_aid_config['charity_aid_page_title'] ) ) {
			$this->charity_aid_page_title = esc_attr( $charity_aid_config['charity_aid_page_title'] );
		}
		if( isset( $charity_aid_config['steps'] ) ) {
			$this->charity_aid_config_steps = $charity_aid_config['steps'];
		}

		$this->charity_aid_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->charity_aid_plugin_path );
		$this->charity_aid_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->charity_aid_theme_title = $current_theme->get( 'Name' );
		$this->charity_aid_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->charity_aid_page_slug = apply_filters( $this->charity_aid_theme_name . '_theme_setup_wizard_charity_aid_page_slug', $this->charity_aid_theme_name . '-freedemocontent' );
		$this->charity_aid_parent_slug = apply_filters( $this->charity_aid_theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	*/
	public function init() {

		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'charity-aid-free-demo-content-style', get_template_directory_uri() . '/inc/free-demo-content/css-and-js/free-demo-content-style.css');
		wp_register_script( 'charity-aid-free-demo-content-script', get_template_directory_uri() . '/inc/free-demo-content/css-and-js/free-demo-content-script.js', array( 'jquery' ), time() );
		wp_localize_script(
			'charity-aid-free-demo-content-script',
			'charity_aid_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'charity-aid' )
			)
		);
		wp_enqueue_script( 'charity-aid-free-demo-content-script' );
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	*/
	public function get_tgmpa_instance() {
		$this->charity_aid_tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $charity_aid_tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	*/
	public function set_tgmpa_url() {
		$this->charity_aid_tgmpa_menu_slug = ( property_exists( $this->charity_aid_tgmpa_instance, 'menu' ) ) ? $this->charity_aid_tgmpa_instance->menu : $this->charity_aid_tgmpa_menu_slug;
		$this->charity_aid_tgmpa_menu_slug = apply_filters( $this->charity_aid_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->charity_aid_tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->charity_aid_tgmpa_instance, 'charity_aid_parent_slug' ) && $this->charity_aid_tgmpa_instance->charity_aid_parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->charity_aid_tgmpa_url = apply_filters( $this->charity_aid_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->charity_aid_tgmpa_menu_slug );
	}


	/**  Make a modal screen for the wizard **/
	public function menu_page() {
		add_theme_page( esc_html( $this->charity_aid_page_title ), esc_html( $this->charity_aid_page_title ), 'manage_options', $this->charity_aid_page_slug, array( $this, 'charity_aid_guide' ) );
	}

	/*** Make an interface for the wizard ***/
	public function Charity_Aid_Demo_Content_Page() {

		tgmpa_load_bulk_installer();

		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$charity_aid_url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$charity_aid_method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$charity_aid_fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $charity_aid_url ), $charity_aid_method, false, false, $charity_aid_fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $charity_aid_url ), $charity_aid_method, true, false, $charity_aid_fields );
			return true;
		}

		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php echo '<div class="whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$charity_aid_steps = $this->get_steps();
				echo '<div class="abcd">';

					echo '<ul class="whizzie-nav wizard-icon-nav nav-tab-wrapper clearfix">';?>

					<?php
						$charity_aid_stepI=1;
						foreach( $charity_aid_steps as $charity_aid_step ) {
							$charity_aid_stepAct=($charity_aid_stepI ==1)? 1 : 0;
							if( isset( $charity_aid_step['icon_text'] ) && $charity_aid_step['icon_text'] ) {
								echo '<li class="commom-cls nav-step-' . esc_attr( $charity_aid_step['id'] ) . '" wizard-steps="step-'.esc_attr( $charity_aid_step['id'] ).'" data-enable="'.$charity_aid_stepAct.'">
								<a class="nav-tab upgrade-button">'.esc_attr( $charity_aid_step['icon_text'] ).'</a>
								</li>';
							}
						$charity_aid_stepI++;}

						echo '<div class="get-pro">';

							echo '<div class="theme-steps highlight">
									<h3>' . esc_html__('Charity Aid Pro', 'charity-aid') . '</h3>
									<p>' . esc_html__('Get all of the features that are infinite!!!', 'charity-aid') . '</p>
									<a target="_blank" class="button button-primary" href="' . esc_url(CHARITY_AID_BUY_NOW) . '">' . esc_html__('Upgrade To Pro', 'charity-aid') . '</a>
								</div>';

						echo '</div>';

					echo '</ul>';
			 	echo '</div>';

				echo '<div class="second-div">';
					echo '<ul class="whizzie-menu wizard-menu-page theme-details">';
					foreach( $charity_aid_steps as $charity_aid_step ) {
						$charity_aid_class = 'step step-' . esc_attr( $charity_aid_step['id'] );
						echo '<li data-step="' . esc_attr( $charity_aid_step['id'] ) . '" class="' . esc_attr( $charity_aid_class ) . '" >';

							$charity_aid_content = call_user_func( array( $this, $charity_aid_step['view'] ) );
							if( isset( $charity_aid_content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $charity_aid_content['summary'] )
								);
							}
							if( isset( $charity_aid_content['detail'] ) ) {
								// Add a link to see more detail
								printf( '<div class="wz-require-plugins">');
								printf(
									'<div class="detail">%s</div>',
									$charity_aid_content['detail'] // Need to escape this
								);
								printf('</div>');
							}
							printf('<div class="wizard-button-wrapper">');
								// The next button
								if( isset( $charity_aid_step['button_text'] ) && $charity_aid_step['button_text'] ) {
									printf(
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $charity_aid_step['callback'] ),
										esc_attr( $charity_aid_step['id'] ),
										esc_html( $charity_aid_step['button_text'] )
									);
								}

								if( isset( $charity_aid_step['button_text_one'] )) {
									printf(
										'<div class="button-wrap button-wrap-one">
											<a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><p class="demo-type-text">%s</p></a>
										</div>',
										esc_html( $charity_aid_step['button_text_one'] )
									);
								}
							printf('</div>');
						echo '</li>';
					}
					echo '</ul>';

					echo '<div class="theme-steps-list">';

						echo '<div class="theme-steps highlight">
								<h3>' . esc_html__('Buy Charity Aid Pro', 'charity-aid') . '</h3>
								<p>' . esc_html__('To get limitless features and improvements, buy the Charity Aid Theme Pro edition.', 'charity-aid') . '</p>
								<a target="_blank" class="button button-primary" href="' . esc_url(CHARITY_AID_BUY_NOW) . '">' . esc_html__('Buy Pro Theme', 'charity-aid') . '</a>
							</div>';

						echo '<div class="theme-steps highlight">
								<h3>' . esc_html__('Get the Bundle', 'charity-aid') . '</h3>
								<p>' . esc_html__('Introducing the WP Theme Bundle by Theme Pixel, a comprehensive collection of over 50 professionally designed WordPress themes tailored for various niches and businesses.', 'charity-aid') . '</p>
								<a target="_blank" class="button button-primary" href="' . esc_url(CHARITY_AID_BUNDLE) . '">' . esc_html__('Get Bundle', 'charity-aid') . '</a>
							</div>';

					echo '</div>';

				echo '</div>';
				?>
			<?php echo '</div>';?>
		</div>
	<?php }

	/**
	 * Set options for the steps
	 * @return Array
	*/
	public function get_steps() {
		$charity_aid_dev_steps = $this->charity_aid_config_steps;
		$charity_aid_steps = array(
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'charity-aid' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'charity-aid' ),
				'can_skip'		=> true,
				'icon_text'      => 'Plugins'
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Customizer', 'charity-aid' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text_one'	=> __( 'Import Demo Content', 'charity-aid' ),

				'can_skip'		=> true,
				'icon_text'      => 'Import Demo Content'
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'charity-aid' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> '',
				'icon_text'      => 'Done'
			)
		);

		// Iterate through each step and replace with dev config values
		if( $charity_aid_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $charity_aid_dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $charity_aid_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$charity_aid_steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $charity_aid_steps;
	}

	/*** Print the content for the intro step ***/
		public function get_step_importer() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this Charity Aid Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.','charity-aid'); ?>
			</p>
		</div>
	<?php }

	/**
	 * Get the content for the plugins step
	 * @return $charity_aid_content Array
	*/
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$charity_aid_content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Install Recommended Plugins:	','charity-aid') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$charity_aid_content['detail'] = '<span class="wizard-plugin-count">'.count($plugins['all']).'</span><ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$charity_aid_content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<div class="wizard-plugin-title">';

			$charity_aid_content['detail'] .= '<span class="wizard-plugin-status">Installation Required</span><i class="spinner"></i></div></li>';
		}
		$charity_aid_content['detail'] .= '</ul>';

		return $charity_aid_content;
	}

	/**    Print the content for the intro step     **/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme allows you to Import Demo Content content and add widgets. Install them using the button below. You can also update or deactivate them using the Customizer.','charity-aid'); ?>
			</p>
		</div>
	<?php }

	/***  Print the content for the final step  ***/
	public function get_step_done() { ?>

		<div class="setup-finish">
			<p>
				<?php echo esc_html('Your demo content has been imported successfully. Click the finish button for more information.'); ?>
			</p>
			<div class="finish-buttons">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=charity-aid-themeinfo-page' ) ); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Charity Aid Info','charity-aid') ?></a>
				<a href="<?php echo esc_url(admin_url('/customize.php')); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Customizer Settings','charity-aid') ?></a>
				<a href="" class="wz-btn-builder" target="_blank"><?php esc_html_e('Customize Your Demo','charity-aid'); ?></a>
				<a href="<?php echo esc_url(home_url()); ?>" class="wz-btn-visit-site" target="_blank"><?php esc_html_e('Visit Your Site','charity-aid'); ?></a>
			</div>
			<div class="finish-buttons">
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary"><?php esc_html_e('Finish','charity-aid'); ?></a>
			</div>
		</div>

	<?php }

	/***  Get the plugins registered with TGMPA  ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','charity-aid' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->charity_aid_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->charity_aid_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','charity-aid' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->charity_aid_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->charity_aid_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','charity-aid' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->charity_aid_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->charity_aid_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','charity-aid' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','charity-aid' ) ) );
		}
		exit;
	}


	//. - . - . - . - . - . - . - . - . - . - . - . - . MENUS . - . - . - . - . - . - . - . - . - . - . - . - .//
	
	public function Charity_Aid_Customizer_Header_Menu() {
		// ------- Create Primary Menu --------
		$charity_aid_themename = 'Charity Aid'; // Ensure the theme name is set
		$charity_aid_menuname = $charity_aid_themename . ' Primary Menu';
		$charity_aid_menulocation = 'menu-1';
		$charity_aid_menu_exists = wp_get_nav_menu_object($charity_aid_menuname);

		if (!$charity_aid_menu_exists) {
			$charity_aid_menu_id = wp_create_nav_menu($charity_aid_menuname);

			// Home
			wp_update_nav_menu_item($charity_aid_menu_id, 0, array(
				'menu-item-title' => __('Home', 'charity-aid'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$charity_aid_page_about = get_page_by_path('about');
			if($charity_aid_page_about){
				wp_update_nav_menu_item($charity_aid_menu_id, 0, array(
					'menu-item-title' => __('About', 'charity-aid'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($charity_aid_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Page
			$charity_aid_page_Page = get_page_by_path('Page');
			if($charity_aid_page_Page){
				wp_update_nav_menu_item($charity_aid_menu_id, 0, array(
					'menu-item-title' => __('Page', 'charity-aid'),
					'menu-item-classes' => 'Page',
					'menu-item-url' => get_permalink($charity_aid_page_Page),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$charity_aid_page_blog = get_page_by_path('blog');
			if($charity_aid_page_blog){
				wp_update_nav_menu_item($charity_aid_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'charity-aid'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($charity_aid_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// Contact Us
			$charity_aid_page_contact = get_page_by_path('contact');
			if($charity_aid_page_contact){
				wp_update_nav_menu_item($charity_aid_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'charity-aid'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($charity_aid_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			// Assign menu to location if not set
			if (!has_nav_menu($charity_aid_menulocation)) {
				$charity_aid_locations = get_theme_mod('nav_menu_locations');
				$charity_aid_locations[$charity_aid_menulocation] = $charity_aid_menu_id; // Use $charity_aid_menu_id here
				set_theme_mod('nav_menu_locations', $charity_aid_locations);
			}
		}
	}


	/**
	* Imports the Demo Content
	* @since 1.1.0
	*/
	public function setup_widgets() {

		//. - . - . - . - . - . - . - . - . - . - . - . - . MENU PAGES . - . - . - . - . - . - . - . - . - . - . - . - .//
		
			$charity_aid_home_id='';
			$charity_aid_home_content = '';

			$charity_aid_home_title = 'Home';
			$charity_aid_home = array(
					'post_type' => 'page',
					'post_title' => $charity_aid_home_title,
					'post_content'  => $charity_aid_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$charity_aid_home_id = wp_insert_post($charity_aid_home);

			//Set the home page template
			add_post_meta( $charity_aid_home_id, '_wp_page_template', 'default-home.php' );

			//Set the static front page
			$charity_aid_home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $charity_aid_home->ID );
			update_option( 'show_on_front', 'page' );


			// Create a posts page and assign the template
			$charity_aid_blog_title = 'Blog';
			$charity_aid_blog_check = get_page_by_path('blog');
			if (!$charity_aid_blog_check) {
				$charity_aid_blog = array(
					'post_type'    => 'page',
					'post_title'   => $charity_aid_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$charity_aid_blog_id = wp_insert_post($charity_aid_blog);

				// Set the posts page
				if (!is_wp_error($charity_aid_blog_id)) {
					update_option('page_for_posts', $charity_aid_blog_id);
				}
			}

			// Create a Contact Us page and assign the template
			$charity_aid_contact_title = 'Contact Us';
			$charity_aid_contact_check = get_page_by_path('contact');
			if (!$charity_aid_contact_check) {
				$charity_aid_contact = array(
					'post_type'    => 'page',
					'post_title'   => $charity_aid_contact_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'contact'
				);
				wp_insert_post($charity_aid_contact);
			}

			// Create a About page and assign the template
			$charity_aid_about_title = 'About';
			$charity_aid_about_check = get_page_by_path('about');
			if (!$charity_aid_about_check) {
				$charity_aid_about = array(
					'post_type'    => 'page',
					'post_title'   => $charity_aid_about_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($charity_aid_about);
			}

			// Create a Page page and assign the template
			$charity_aid_Page_title = 'Page';
			$charity_aid_Page_check = get_page_by_path('Page');
			if (!$charity_aid_Page_check) {
				$charity_aid_Page = array(
					'post_type'    => 'page',
					'post_title'   => $charity_aid_Page_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'Page'
				);
				wp_insert_post($charity_aid_Page);
			}

			
		//. - . - . - . - . - . - . - . - . - . - . - . - . FRONTPAGE CONTENT . - . - . - . - . - . - . - . - . - . - . - . - .//

			set_theme_mod('charity_aid_email_address','charity12@axample.com');
			set_theme_mod('charity_aid_phone_number','(+00)123 56 789 00');

			set_theme_mod('charity_aid_address','11/234 Main Street Kingstown Downtown');
			set_theme_mod('charity_aid_timing','Hours: Mon-Fri:9.00am-7.00pm');

			set_theme_mod('charity_aid_facebook_url','#');
			set_theme_mod('charity_aid_twitter_url','#');
			set_theme_mod('charity_aid_instagram_url','#');
			set_theme_mod('charity_aid_youtube_url','#');
			set_theme_mod('charity_aid_whatsapp_url','#');


			set_theme_mod('charity_aid_banner_section_on_off_setting',true);
			set_theme_mod('charity_aid_topbar_section_on_off_setting',true);
			set_theme_mod('charity_aid_services_section_on_off_setting',true);


			set_theme_mod('charity_aid_slider',3);
	
			$charity_aid_diff_headings = array(
				'We Help The Poor This Life\'s Services Now ',
				'Join Us in Making a Difference Today',
				'Together We Can Bring Hope and Change'
			);

			for($charity_aid_i=1;$charity_aid_i<=3;$charity_aid_i++){
				set_theme_mod('charity_aid_banner_heading'.$charity_aid_i, $charity_aid_diff_headings[$charity_aid_i - 1]);
				set_theme_mod( 'charity_aid_banner_heading_text'.$charity_aid_i, 'A great landing page to sell Charity' );
				set_theme_mod( 'charity_aid_banner_content'.$charity_aid_i, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.' );
				set_theme_mod( 'charity_aid_banner_btn'.$charity_aid_i, 'Donate Now $14.99' );
				set_theme_mod( 'charity_aid_banner_button_link'.$charity_aid_i, '#' );
				set_theme_mod( 'charity_aid_banner_image'.$charity_aid_i,get_template_directory_uri().'/assets/images/slider.png' );
			}

			set_theme_mod('charity_aid_experience_box_number','15+');
			set_theme_mod('charity_aid_experience_box_text','Year Of Experience In Charity');


			set_theme_mod('charity_aid_services_short_title','OUR CAUSES');
			set_theme_mod('charity_aid_services_title','Our Popular Causes');
			set_theme_mod('charity_aid_services_count','6');

			$charity_aid_services_heading = array(
				'We Encourage Education',
				'We Provide Medical Facility',
				'We Provide Water For Poor',
				'We Fight Hunger With Food Aid',
				'We Support Child Welfare',
				'We Protect the Environment'
			);
			
			$charity_aid_services_icon = array(
				'fas fa-book-reader',
				'fas fa-notes-medical',
				'fas fa-hand-holding-water',
				'fas fa-utensils',
				'fas fa-child',
				'fas fa-leaf'
			);

			for($charity_aid_i=1;$charity_aid_i<=6;$charity_aid_i++){
				set_theme_mod('charity_aid_services_icon'.$charity_aid_i, $charity_aid_services_icon[$charity_aid_i - 1]);
				set_theme_mod('charity_aid_services_heading'.$charity_aid_i, $charity_aid_services_heading[$charity_aid_i - 1]);
				set_theme_mod( 'charity_aid_services_text'.$charity_aid_i, 'Lorem Ipsum is simply dummy text of the printing & industry.' );
				set_theme_mod( 'charity_aid_service_btn'.$charity_aid_i, 'More Details' );
				set_theme_mod( 'charity_aid_service_button_link'.$charity_aid_i, '#' );
				set_theme_mod('charity_aid_services_image' . $charity_aid_i, get_template_directory_uri() . '/assets/images/causes' . $charity_aid_i . '.png');
			}


		$this->Charity_Aid_Customizer_Header_Menu();
	}

	//guidline for about theme
	public function charity_aid_guide() {
		$display_string = '';
		//custom function about theme customizer
		$return = add_query_arg( array()) ;
		$theme = wp_get_theme( 'charity-aid' );
		?>
		<div class="wrapper-info wrap about-wrap access-wrap">

			<div class="abt-promo-wrap clearfix">
				<div class="abt-theme-wrap">
				<h1><?php esc_html_e( 'Charity Aid', 'charity-aid' ); ?> <span class="version"><?php echo esc_html__( '- FREE DEMO CONTENT', 'charity-aid' ); ?></span></h1>
				<div class="doc-links">
						<h4><?php echo esc_html__('Visit Sites :-', 'charity-aid'); ?></h4>
						<a href="<?php echo esc_url(CHARITY_AID_BUY_NOW); ?>" target="_blank">
							<span class="dashicons dashicons-admin-site-alt3"></span>
							<span class="theme-pixel-tooltip"><?php echo esc_html__('View Website', 'charity-aid'); ?></span>
						</a>
						<a href="<?php echo esc_url(CHARITY_AID_LIVE_DEMO); ?>" target="_blank">
							<span class="dashicons dashicons-desktop"></span>
							<span class="theme-pixel-tooltip"><?php echo esc_html__('View Demo Site', 'charity-aid'); ?></span>
						</a>
						<a href="<?php echo esc_url(CHARITY_AID_THEME_SUPPORT); ?>" target="_blank">
							<span class="dashicons dashicons-megaphone"></span>
							<span class="theme-pixel-tooltip"><?php echo esc_html__('Contact Support', 'charity-aid'); ?></span>
						</a>
						<a href="<?php echo esc_url(CHARITY_AID_FREE_DOC); ?>" target="_blank">
							<span class="dashicons dashicons-pdf"></span>
							<span class="theme-pixel-tooltip"><?php echo esc_html__('Documentation', 'charity-aid'); ?></span>
						</a>
					</div>
				</div>
			</div>

			<div class="tab-sec theme-option-tab">
				<div id="demo_offer" class="tabcontent open">
					<?php $this->Charity_Aid_Demo_Content_Page(); ?>
				</div>
			</div>
		</div>
		
	<?php }
}