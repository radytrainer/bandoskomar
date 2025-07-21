<?php
/**
 * Particular Typography function for this theme
 *
 * Some of this functionality may eventually be superseded by essential features.
 *
 * @package Charity Aid
 */

function charity_aid_get_all_google_fonts() {
    $charity_aid_webfonts_json = get_template_directory() . '/inc/typography-settings/google-webfonts.json';
    if ( ! file_exists( $charity_aid_webfonts_json ) ) {
        return array();
    }

    $charity_aid_fonts_json_data = file_get_contents( $charity_aid_webfonts_json );
    if ( false === $charity_aid_fonts_json_data ) {
        return array();
    }

    $charity_aid_all_fonts = json_decode( $charity_aid_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $charity_aid_google_fonts = array();
    foreach ( $charity_aid_all_fonts as $charity_aid_font ) {
        $charity_aid_google_fonts[ $charity_aid_font['family'] ] = array(
            'family'   => $charity_aid_font['family'],
            'variants' => $charity_aid_font['variants'],
        );
    }
    return $charity_aid_google_fonts;
}


function charity_aid_get_all_google_font_families() {
    $charity_aid_google_fonts  = charity_aid_get_all_google_fonts();
    $charity_aid_font_families = array(
        '' => esc_html__( 'Default (Theme Font Family)', 'charity-aid' ),
    );

    foreach ( $charity_aid_google_fonts as $charity_aid_font ) {
        $charity_aid_font_families[ $charity_aid_font['family'] ] = $charity_aid_font['family'];
    }

    return $charity_aid_font_families;
}


function charity_aid_get_fonts_url() {
    $charity_aid_fonts_url = '';
    $charity_aid_fonts     = array();

    $charity_aid_all_fonts = charity_aid_get_all_google_fonts();
    $charity_aid_selected_font = get_theme_mod( 'charity_aid_global_font_setting', '' );

    if ( ! empty( $charity_aid_selected_font ) && isset( $charity_aid_all_fonts[ $charity_aid_selected_font ] ) ) {
        $charity_aid_variants = $charity_aid_all_fonts[ $charity_aid_selected_font ]['variants'];
        $charity_aid_font_family[] = $charity_aid_selected_font . ':' . implode( ',', $charity_aid_variants );

        $charity_aid_query_args = array(
            'family' => urlencode( implode( '|', $charity_aid_font_family ) ),
        );

        $charity_aid_fonts_url = add_query_arg( $charity_aid_query_args, 'https://fonts.googleapis.com/css' );
    }

    return $charity_aid_fonts_url;
}

function charity_aid_sanitize_google_fonts( $charity_aid_input, $charity_aid_setting ) {
    $charity_aid_choices = $charity_aid_setting->manager->get_control( $charity_aid_setting->id )->choices;
    return ( array_key_exists( $charity_aid_input, $charity_aid_choices ) ? $charity_aid_input : $charity_aid_setting->default );
}

function charity_aid_dynamic_css() {
    $charity_aid_color       = get_theme_mod( 'charity_aid_global_color', '#FF5817' );
    $charity_aid_colortwo    = get_theme_mod( 'charity_aid_global_colortwo', '#04C0A8' );
    $charity_aid_font_family = get_theme_mod( 'charity_aid_global_font_setting', '' );

    // Enqueue Google Fonts if font is selected
    $charity_aid_fonts_url = charity_aid_get_fonts_url();
    if ( ! empty( $charity_aid_fonts_url ) ) {
        wp_enqueue_style( 'charity-aid-google-fonts', esc_url( $charity_aid_fonts_url ), array(), null );
    }

    // Build the CSS
    $charity_aid_custom_css  = ':root {';
    $charity_aid_custom_css .= '--global-color: ' . esc_attr( $charity_aid_color ) . ';';
    $charity_aid_custom_css .= '--global-colortwo: ' . esc_attr( $charity_aid_colortwo ) . ';';

    if ( ! empty( $charity_aid_font_family ) ) {
        $charity_aid_custom_css .= '--global-font-family: "' . esc_attr( $charity_aid_font_family ) . '", sans-serif !important;';
    }

    $charity_aid_custom_css .= '}';

    wp_add_inline_style( 'charity-aid-style', $charity_aid_custom_css );
}
add_action( 'wp_enqueue_scripts', 'charity_aid_dynamic_css', 99 );