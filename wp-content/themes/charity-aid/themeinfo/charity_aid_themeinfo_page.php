<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( !class_exists( 'Charity_Aid_Welcome' ) ) {

	class Charity_Aid_Welcome {
		public $charity_aid_theme_fields;

		public function __construct( $charity_aid_fields = array() ) {
			$this->charity_aid_theme_fields = $charity_aid_fields;
			add_action ('admin_init' , array( $this, 'admin_scripts' ) );
			add_action('admin_menu', array( $this, 'charity_aid_themeinfo_page_menu' ));
		}

		public function admin_scripts() {
			global $pagenow;
			$charity_aid_file_dir = get_template_directory_uri() . '/themeinfo/assets/';

			if ( $pagenow === 'themes.php' && isset($_GET['page']) && $_GET['page'] === 'charity-aid-themeinfo-page' ) {

				wp_enqueue_style (
					'charity-aid-themeinfo-page-style',
					$charity_aid_file_dir . 'charity_aid_themeinfo_page.css',
					array(), '1.0.0'
				);

				wp_enqueue_script (
					'charity-aid-themeinfo-page-functions',
					$charity_aid_file_dir . 'charity_aid_themeinfo_page.js',
					array('jquery'),
					'1.0.0',
					true
				);
			}
		}

        public function charity_aid_theme_info($charity_aid_id, $charity_aid_screenshot = false) {
            $charity_aid_themedata = wp_get_theme();
            return ($charity_aid_screenshot === true) ? esc_url($charity_aid_themedata->get_screenshot()) : esc_html($charity_aid_themedata->get($charity_aid_id));
        }

        public function charity_aid_themeinfo_page_menu() {
            add_theme_page(
                /* translators: 1: Theme Name. */
                sprintf(esc_html__('%1$s Info', 'charity-aid'), $this->charity_aid_theme_info('Name')),
                sprintf(esc_html__('%1$s Info', 'charity-aid'), $this->charity_aid_theme_info('Name')),
                'edit_theme_options',
                'charity-aid-themeinfo-page',
                array( $this, 'charity_aid_themeinfo_page' )
            );
		}

        public function charity_aid_themeinfo_page() {
            // Define tabs with proper escaping and prefixes
            $charity_aid_tabs = array(
                'charity_aid_home'      => esc_html__('Home', 'charity-aid'),
                'charity_aid_free_pro'  => esc_html__('Free VS Pro', 'charity-aid'),
                'charity_aid_faqs'      => esc_html__('FAQs', 'charity-aid'),
                'charity_aid_support'   => esc_html__('Free Theme Supports', 'charity-aid'),
                'charity_aid_review'    => esc_html__('Please Rate Us', 'charity-aid'),
                'charity_aid_free_demo_content'    => esc_html__('Click Here For Free Demo Content', 'charity-aid'),
            );
            ?>
            <div class="wrap about-wrap access-wrap">
        
                <div class="abt-promo-wrap clearfix">
                    <div class="abt-theme-wrap">
                        <h1>
                            <?php
                                printf(
                                    /* translators: 1: Theme Name. */
                                    esc_html__('%1$s - Version %2$s', 'charity-aid'),
                                    esc_html($this->charity_aid_theme_info('Name')),
                                    esc_html($this->charity_aid_theme_info('Version'))
                                );
                            ?>
                        </h1>
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
        
                <div class="test">
                    <div class="nav-tab-wrapper clearfix">
                        <?php
                        $tabHTML = '';
        
                        foreach ($charity_aid_tabs as $charity_aid_id => $charity_aid_label) :
        
                            $charity_aid_target = '';
                            $charity_aid_nav_class = 'nav-tab';
                            $charity_aid_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'charity_aid_home';
        
                            if ($charity_aid_id === $charity_aid_section) {
                                $charity_aid_nav_class .= ' nav-tab-active';
                            }
        
                            if ($charity_aid_id === 'charity_aid_free_pro') {
                                $charity_aid_nav_class .= ' upgrade-button';
                            }

                            if ($charity_aid_id === 'charity_aid_review') {
                                $charity_aid_nav_class .= ' review-button';
                            }

                            if ($charity_aid_id === 'charity_aid_free_demo_content') {
                                $charity_aid_nav_class .= ' demo-content-button';
                            }
        
                            switch ($charity_aid_id) {
        
                                case 'charity_aid_support':
                                    $charity_aid_target = 'target="_blank"';
                                    $charity_aid_url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->charity_aid_theme_info('TextDomain')));
                                break;
        
                                case 'charity_aid_review':
                                    $charity_aid_target = 'target="_blank"';
                                    $charity_aid_url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->charity_aid_theme_info('TextDomain')) . '/reviews/#new-post');
                                break;

                                case 'charity_aid_free_demo_content':
                                $charity_aid_target = 'target="_blank"';
                                $charity_aid_url = esc_url(admin_url('themes.php?page=charityaid-freedemocontent'));
                                break;
                                
                                
                                case 'charity_aid_home':
                                    $charity_aid_url = esc_url(admin_url('themes.php?page=charity-aid-themeinfo-page'));
                                break;
        
                                default:
                                    $charity_aid_url = esc_url(admin_url('themes.php?page=charity-aid-themeinfo-page&section=' . esc_attr($charity_aid_id)));
                                break;
        
                            }
        
                            $tabHTML .= '<a ';
                            $tabHTML .= $charity_aid_target;
                            $tabHTML .= ' href="' . esc_url($charity_aid_url) . '"';
                            $tabHTML .= ' class="' . esc_attr($charity_aid_nav_class) . '"';
                            $tabHTML .= '>';

                            if ($charity_aid_id === 'charity_aid_free_demo_content') {
                                $tabHTML .= '<span>' . esc_html($charity_aid_label) . '</span>';
                            } else {
                                $tabHTML .= esc_html($charity_aid_label);
                            }

                            if ($charity_aid_id === 'charity_aid_review') {
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                            }

                            $tabHTML .= '</a>';
        
                        endforeach;
        
                        echo $tabHTML;
                        ?>
        
                        <div class="get-pro">
                            <h3><?php echo esc_html__('Charity Aid Pro', 'charity-aid'); ?></h3>
                            <p><?php echo esc_html__('Get all of the features that are infinite!!!', 'charity-aid'); ?></p>
                            <a class="theme-pixel-button-btn primary-btn" target="_blank" href="<?php echo esc_url(CHARITY_AID_BUY_NOW); ?>"><?php echo esc_html__('Upgrade To Pro', 'charity-aid'); ?></a>
                        </div>
                    </div>

                    <div class="second-div">
                        <div class="themeinfo-section-wrapper">
                            <div class="themeinfo-section charity_aid_home clearfix">
                                <?php
                                $charity_aid_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'charity_aid_home';
                                switch ($charity_aid_section) {
            
                                    case 'charity_aid_free_pro':
                                        $this->charity_aid_free_pro();
                                    break;
            
                                    case 'charity_aid_faqs':
                                        $this->charity_aid_faqs();
                                    break;
            
                                    case 'charity_aid_home':
                                    default:
                                        $this->charity_aid_home();
                                    break;
            
                                }
                                ?>
                            </div>
                        </div>
            
                        <div class="theme-steps-list">

                            <div class="theme-steps highlight">
                                <h3><?php echo esc_html__('Buy Charity Aid Pro', 'charity-aid'); ?></h3>
                                <p><?php echo esc_html__('To get limitless features and improvements, buy the Charity Aid Theme Pro edition.', 'charity-aid'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(CHARITY_AID_BUY_NOW); ?>"><?php echo esc_html__('Buy Pro Theme', 'charity-aid'); ?></a>
                            </div>

                            <div class="theme-steps">
                                <h3><?php echo esc_html__('Documentation', 'charity-aid'); ?></h3>
                                <p><?php echo esc_html__('Do you need additional information? You may find detailed instructions on how to use the Charity Aid Theme in our extensive documentation.', 'charity-aid'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(CHARITY_AID_FREE_DOC); ?>"><?php echo esc_html__('Go to Free Docs', 'charity-aid'); ?></a>
                            </div>
            
                            <div class="theme-steps">
                                <h3><?php echo esc_html__('Preview Pro Theme', 'charity-aid'); ?></h3>
                                <p><?php echo esc_html__('Explore our Pro Themes full potential! To see the stunning designs and high-end functionality, click the Live Demo button.', 'charity-aid'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(CHARITY_AID_LIVE_DEMO); ?>"><?php echo esc_html__('View Live Demo', 'charity-aid'); ?></a>
                            </div>
            
                            <div class="theme-steps highlight">
                                <h3><?php echo esc_html__('Get the Bundle', 'charity-aid'); ?></h3>
                                <p><?php echo esc_html__('Introducing the WP Theme Bundle by Theme Pixel, a comprehensive collection of over 50 professionally designed WordPress themes tailored for various niches and businesses.', 'charity-aid'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(CHARITY_AID_BUNDLE); ?>"><?php echo esc_html__('Get Bundle', 'charity-aid'); ?></a>
                            </div>
            
                        </div>
                    </div>
                </div>
        
            </div>
            <?php
        }

        public function charity_aid_home() {
            ?>
            <div class="theme-info-top-wrap clearfix">
                <h3><?php esc_html_e( 'HOME', 'charity-aid' ); ?></h3>
                <div class="theme-details">
                    <div class="theme-screenshot">
                        <img src="<?php echo esc_url( $this->charity_aid_theme_info( 'Screenshot', true ) ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'charity-aid' ); ?>" />
                    </div>
                    <div class="about-text"><?php echo esc_html( $this->charity_aid_theme_info( 'Description' ) ); ?></div>
                    <div class="clearfix"></div>
                </div>
                <div class="theme-pixel-settings">
                    <h2><?php esc_html_e( 'Quick Customizer Settings', 'charity-aid' ); ?></h2>
                    <div class="theme-pixel-button">
                        <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="theme-pixel-btn" target="_blank">
                            <?php esc_html_e( 'Go To Customizer', 'charity-aid' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span>
                        </a>
                    </div>
                </div>
                <div class="theme-pixel-card customizer three-col">
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-admin-site-alt3"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Site Identity', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=site_identity' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-color-picker"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Color Settings', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=colors' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-screenoptions"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Layout Settings', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=layout_settings' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-format-image"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'General Settings', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=banner_option' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-align-full-width"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Frontpage Settings', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=general_settings' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-admin-page"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Footer Settings', 'charity-aid' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=footer_option' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'charity-aid' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }        

		public function charity_aid_free_pro() {
            ?>
            <h3><?php esc_html_e( 'FREE VS PRO', 'charity-aid' ); ?></h3>
            <div class="freeandpro">
                <table class="card table free-pro" cellspacing="0" cellpadding="0">
                    <tbody class="table-body">
                        <tr class="table-head">
                            <th class="large"><?php echo esc_html__( 'Features', 'charity-aid' ); ?></th>
                            <th class="indicator"><?php echo esc_html__( 'Free theme', 'charity-aid' ); ?></th>
                            <th class="indicator"><?php echo esc_html__( 'Pro Theme', 'charity-aid' ); ?></th>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Responsive Design', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Site Logo upload', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Footer Copyright text', 'charity-aid' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'Remove the copyright text from the Footer.', 'charity-aid' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Easy Customization', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Lightweight & Fast Loading', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Global Color', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Regular Bug Fixes', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>
                        
                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Premium Support', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Theme Sections', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="abc"><?php echo esc_html__( '2 Sections', 'charity-aid' ); ?></span></td>
                            <td class="indicator"><span class="abc"><?php echo esc_html__( '15+ Sections', 'charity-aid' ); ?></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Custom colors', 'charity-aid' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'Choose a color for links, buttons, icons and so on.', 'charity-aid' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Google fonts', 'charity-aid' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'You can choose and use over 600 different fonts, for the logo, the menu and the titles.', 'charity-aid' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Compatible with Popular Plugins', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Translation & WPML Ready', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'SEO Optimized', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Premium Support', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Extensive Customization', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Custom Post Types', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'High-Level Compatibility with Modern Browsers', 'charity-aid' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
        }

        public function charity_aid_faqs() {
            ?>
            <h3><?php esc_html_e( 'FAQs', 'charity-aid' ); ?></h3>
            <div class="faq-container">
                <div class="accordion" id="CharityAidFaqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseOne" aria-expanded="true" aria-controls="CharityAidCollapseOne">
                                <?php echo esc_html__('What is the difference between Free and Pro?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseOne" class="accordion-collapse collapse show" aria-labelledby="CharityAidHeadingOne" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('The themes are well-made in both their free and premium versions. But there are a lot more features in the Pro edition.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('You may quickly alter the appearance and feel of your website with the Pro version. You can alter your websites color and typeface with a few clicks. With more customization choices, the premium version gives you greater control over the theme. In addition, the theme offers more layout options and sections than the free version.', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseTwo" aria-expanded="false" aria-controls="CharityAidCollapseTwo">
                                <?php echo esc_html__('What are the advantages of upgrading to the Premium version?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseTwo" class="accordion-collapse collapse" aria-labelledby="CharityAidHeadingTwo" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('In addition to the additional features and regular upgrades, the Premium version comes with premium support. Compared to the free assistance, you will receive a much faster response if you encounter any theme problems.', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseThree" aria-expanded="false" aria-controls="CharityAidCollapseThree">
                                <?php echo esc_html__('Upgrading to the Pro version- will I lose my changes?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseThree" class="accordion-collapse collapse" aria-labelledby="CharityAidHeadingThree" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('Your posts, pages, media, categories, and other data will all be preserved when you upgrade to the Pro theme.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('You will need to configure the extra features via the customizer, though, because the Pro edition has more features and options. It just takes a few minutes to complete this easy process.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('There is a lot of flexibility in the Pro version to accommodate future updates. As a result, it differs slightly from the free theme yet is incredibly versatile and user-friendly.', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseFour" aria-expanded="false" aria-controls="CharityAidCollapseFour">
                                <?php echo esc_html__('How do I change the copyright text?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseFour" class="accordion-collapse collapse" aria-labelledby="CharityAidHeadingFour" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('You can change the copyright text going to Appearance > Customize > Footer Option > And here you can find (Edit Footer Copyright Text)', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseFour" aria-expanded="false" aria-controls="CharityAidCollapseFour">
                                <?php echo esc_html__('Why is my theme not working well?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseFour" class="accordion-collapse collapse" aria-labelledby="CharityAidHeadingFour" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('It could be a plugin conflict if your customizer is not loading correctly or if you are experiencing problems with the theme.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Deactivate every plugin first, with the exception of those the theme suggests, to resolve the problem. After that, use "Ctrl+Shift+R" on Windows to force a new page load. Once the problems have been resolved, begin turning on each plugin individually, then refresh and verify your website each time. This will assist you in identifying the problematic plugin.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please get in touch with us if this was not helpful.', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="CharityAidHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#CharityAidCollapseFour" aria-expanded="false" aria-controls="CharityAidCollapseFour">
                                <?php echo esc_html__('How can I solve my issues quickly and get faster support?', 'charity-aid'); ?>
                            </button>
                        </h2>
                        <div id="CharityAidCollapseFour" class="accordion-collapse collapse" aria-labelledby="CharityAidHeadingFour" data-bs-parent="#CharityAidFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('Please make sure you have updated the theme to the most recent version before sending us a support ticket for any problems. The theme update may have resolved the issue.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please try to include as much information as you can in your support ticket submission so that we can address your issue more quickly. We advise you to email us one or more screenshots that clearly illustrate the problems and include the URL of your website.', 'charity-aid'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please be patient with us as we may have a delayed response time during the weekend.', 'charity-aid'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        
	}

}
new Charity_Aid_Welcome();
?>