<?php
/**
 * Template Name: Default Home Page
 */

get_header();
?>

<main id="primary">

    <?php if (get_theme_mod('charity_aid_banner_section_on_off_setting', false)) { ?>
        <section id="main-banner-wrap">
            <div id="banner-area">
                <div class="owl-carousel owl-theme">
                    <?php
                        $charity_aid_banner = get_theme_mod( 'charity_aid_slider');
                        for ( $i = 1; $i <= $charity_aid_banner; $i++ ){ ?>
                        <div class="item">
                            <div class="main-banner-inner-box">
                                <?php
                                $charity_aid_banner_image = get_theme_mod( 'charity_aid_banner_image'.$i, '' );
                                if ( ! empty( $charity_aid_banner_image ) ) { ?>
                                    <img src="<?php echo esc_url( $charity_aid_banner_image ); ?>">
                                <?php } ?>
                                <img class="overlay" src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/slide-overlay.png' ?> ">
                            </div>
                            <div class="main-banner-content-box">                            
                                <?php
                                    $charity_aid_banner_heading = get_theme_mod( 'charity_aid_banner_heading'.$i, '' );
                                    if ( ! empty( $charity_aid_banner_heading ) ) { ?>
                                    <h3 id="myHeading" class="myHeading"><?php echo esc_html( $charity_aid_banner_heading ); ?></h3>
                                <?php } ?>
                                <?php
                                    $charity_aid_banner_heading_text = get_theme_mod( 'charity_aid_banner_heading_text'.$i, '' );
                                    if ( ! empty( $charity_aid_banner_heading_text ) ) { ?>
                                    <h4><?php echo esc_html( $charity_aid_banner_heading_text ); ?></h4>
                                <?php } ?>
                                <?php
                                    $charity_aid_banner_content = get_theme_mod( 'charity_aid_banner_content'.$i, '' );
                                    if ( ! empty( $charity_aid_banner_content ) ) { ?>
                                    <p><?php echo esc_html( $charity_aid_banner_content ); ?></p>
                                <?php } ?>
                                <?php
                                    $charity_aid_banner_btn = get_theme_mod( 'charity_aid_banner_btn'.$i, '' );
                                    $charity_aid_banner_button_link = get_theme_mod( 'charity_aid_banner_button_link'.$i, '' );
                                    if ( ! empty( $charity_aid_banner_btn ) ) { ?>
                                    <a href="<?php echo esc_url( $charity_aid_banner_button_link ); ?>"><?php echo esc_html( $charity_aid_banner_btn ); ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <div class="experience-box">
                <?php
                    $charity_aid_experience_box_number = get_theme_mod( 'charity_aid_experience_box_number', '' );
                    if ( ! empty( $charity_aid_experience_box_number ) ) { ?>
                    <h3 class="mb-0"><?php echo esc_html( $charity_aid_experience_box_number ); ?></h3>
                <?php } ?>
                <?php
                    $charity_aid_experience_box_text = get_theme_mod( 'charity_aid_experience_box_text', '' );
                    if ( ! empty( $charity_aid_experience_box_text ) ) { ?>
                    <p class="mb-0"><?php echo esc_html( $charity_aid_experience_box_text ); ?></p>
                <?php } ?>
            </div>
        </section>
    <?php } ?>

    <?php if (get_theme_mod('charity_aid_services_section_on_off_setting', false)) { ?>
        <section class="services py-5">
            <div class="container">
                <?php
                    $charity_aid_services_short_title = get_theme_mod( 'charity_aid_services_short_title', '' );
                    if ( ! empty( $charity_aid_services_short_title ) ) { ?>
                    <div class="main-heading mb-3">
                        <h4 class="mb-0"><?php echo esc_html( $charity_aid_services_short_title ); ?></h4>
                    </div>
                <?php } ?>
                <?php
                    $charity_aid_services_title = get_theme_mod( 'charity_aid_services_title', '' );
                    if ( ! empty( $charity_aid_services_title ) ) { ?>
                    <div class="main-heading mb-4">
                        <h3 class="mb-0"><?php echo esc_html( $charity_aid_services_title ); ?></h3>
                    </div>
                <?php } ?>
                <div class="row">
                    <?php
                        $charity_aid_services = get_theme_mod( 'charity_aid_services_count');
                        for ( $i = 1; $i <= $charity_aid_services; $i++ ){ ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="services-box mb-4">
                                <div class="inner-content-box">                                
                                    <?php
                                        $charity_aid_services_heading = get_theme_mod( 'charity_aid_services_heading'.$i, '' );
                                        if ( ! empty( $charity_aid_services_heading ) ) { ?>
                                        <h3 class="mb-0"><?php echo esc_html( $charity_aid_services_heading ); ?></h3>
                                    <?php } ?>
                                    <?php
                                        $charity_aid_services_text = get_theme_mod( 'charity_aid_services_text'.$i, '' );
                                        if ( ! empty( $charity_aid_services_text ) ) { ?>
                                        <p class="mb-0"><?php echo esc_html( $charity_aid_services_text ); ?></p>
                                    <?php } ?>
                                    <?php
                                        $charity_aid_service_btn = get_theme_mod( 'charity_aid_service_btn'.$i, '' );
                                        $charity_aid_service_button_link = get_theme_mod( 'charity_aid_service_button_link'.$i, '' );
                                        if ( ! empty( $charity_aid_service_btn ) ) { ?>
                                        <a href="<?php echo esc_url( $charity_aid_service_button_link ); ?>"><?php echo esc_html( $charity_aid_service_btn ); ?></a>
                                    <?php } ?>
                                </div>
                                <div class="services-image-box">
                                    <?php
                                        $charity_aid_services_image = get_theme_mod( 'charity_aid_services_image'.$i, '' );
                                        if ( ! empty( $charity_aid_services_image ) ) { ?>
                                            <img src="<?php echo esc_url( $charity_aid_services_image ); ?>">
                                    <?php } ?>
                                    <div class="service-icon">
                                        <?php
                                            $charity_aid_services_icon = get_theme_mod( 'charity_aid_services_icon'.$i, '' );
                                            if ( ! empty( $charity_aid_services_icon ) ) { ?>
                                            <i class="<?php echo esc_attr( $charity_aid_services_icon ); ?>"></i>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </section>
    <?php } ?>

</main>

<?php
get_footer();