<?php
/**
* loads every component associated with the customizer. 
*
* @since Charity Aid 1.0.0
*/

function charity_aid_modify_default_settings( $wp_customize ){

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}
add_action( 'customize_register', 'charity_aid_modify_default_settings' );