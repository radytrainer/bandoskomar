<?php
require get_template_directory() . '/inc/free-demo-content/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function charity_aid_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'Classic Widgets', 'charity-aid' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$charity_aid_config = array();
	tgmpa( $plugins, $charity_aid_config );
}
add_action( 'tgmpa_register', 'charity_aid_register_recommended_plugins_set' );
