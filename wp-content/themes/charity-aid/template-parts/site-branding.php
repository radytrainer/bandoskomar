<?php
/**
 * Section of the template that displays the site's identity.
 *
 * @since Charity Aid 1.0.0
 */

?>

<div class="site-branding text-center text-md-left">
	<?php
		if (get_theme_mod('charity_aid_site_logo', false)) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( charity_aid_get_custom_logo_url() ); ?>" id="headerLogo">
			</a>
			<?php
		}
	?>
	<?php
		if (get_theme_mod('charity_aid_site_title_text', true)) {
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		}
		$charity_aid_description = get_bloginfo( 'description', 'display' );
		if (get_theme_mod('charity_aid_site_tagline_text', false)) {
			if ( $charity_aid_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo esc_html($charity_aid_description); /* WPCS: xss ok. */ ?></p>
			<?php endif;
		}
	?>
</div>