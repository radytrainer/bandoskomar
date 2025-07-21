<?php if (get_theme_mod('charity_aid_topbar_section_on_off_setting', true)) { ?>
	<div class="top-info-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="header-info">
						<?php
							$charity_aid_email_address = get_theme_mod( 'charity_aid_email_address', 'charity12@axample.com' );
							if ( ! empty( $charity_aid_email_address ) ) {
							?>
							<a href="mailto:<?php echo esc_attr( $charity_aid_email_address ); ?>"><i class="fas fa-envelope-open-text mr-2"></i> <?php echo esc_html( $charity_aid_email_address ); ?></a>
						<?php } ?>
						<?php
							$charity_aid_phone_number = get_theme_mod( 'charity_aid_phone_number', '(+00)123 56 789 00' );
							if ( ! empty( $charity_aid_phone_number ) ) {
							?>
							<p class="mb-0"><i class="fas fa-phone mr-2"></i> <?php echo esc_html( $charity_aid_phone_number ); ?> </p>
						<?php } ?>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="header-infoo">
						<?php
							$charity_aid_address = get_theme_mod( 'charity_aid_address', '11/234 Main Street Kingstown Downtown' );
							if ( ! empty( $charity_aid_address ) ) {
							?>
							<p class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i> <?php echo esc_html( $charity_aid_address ); ?></p>
						<?php } ?>
						<?php
							$charity_aid_timing = get_theme_mod( 'charity_aid_timing', 'Hours: Mon-Fri:9.00am-7.00pm' );
							if ( ! empty( $charity_aid_timing ) ) {
							?>
							<p class="mb-0"><i class="fas fa-clock mr-2"></i> <?php echo esc_html( $charity_aid_timing ); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>


<?php 
	$charity_aid_has_header_image = has_header_image();
	$charity_aid_header_image_url = $charity_aid_has_header_image ? esc_url(get_header_image()) : '';
	$charity_aid_header_style = '';
	if ($charity_aid_has_header_image) {
		$charity_aid_header_style = sprintf(
			'background-image: url(%s); background-position: center; background-attachment: fixed; background-size: cover;',
			$charity_aid_header_image_url
		);
	}
?>
<div class="upper-header-area" <?php if ($charity_aid_header_style) echo 'style="' . esc_attr($charity_aid_header_style) . '";'; ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4 align-self-center">
				<?php get_template_part( 'template-parts/site', 'branding' ); ?>
			</div>
			<div class="col-lg-7 col-md-4 align-self-center">
				<header id="masthead" class="site-header header-one">
					<div class="bottom-header header-image-wrap">
						<div class="toggle-menu menu text-center text-md-right">
							<button onclick="charity_aid_mobile_menu_open()" class="toggle p-2"><i class="fa-solid fa-bars"></i></button>
						</div>
						<div id="responsive" class="nav side_nav">
							<nav id="top_menu" class="nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu', 'charity-aid' ); ?>">
								<?php
								    wp_nav_menu( array( 
										'theme_location' => 'menu-1',
										'container_class' => 'navigation clearfix' ,
										'menu_class' => 'clearfix',
										'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 px-0">%3$s</ul>',
										'fallback_cb' => 'wp_page_menu',
								    ) ); 
								?>
								<a href="javascript:void(0)" class="closebtn menu" onclick="charity_aid_mobile_menu_close()"><i class="fa-solid fa-xmark"></i></a>
							</nav>
						</div>
					</div>
				</header>
			</div>
			<div class="col-lg-2 col-md-4 align-self-center">
				<div class="social-inner-box text-center text-md-right">
					<?php					    
					    $charity_aid_facebook_url = get_theme_mod( 'charity_aid_facebook_url', '#' );
					    $charity_aid_twitter_url = get_theme_mod( 'charity_aid_twitter_url', '#' );
					    $charity_aid_instagram_url = get_theme_mod( 'charity_aid_instagram_url', '#' );
					    $charity_aid_youtube_url = get_theme_mod( 'charity_aid_youtube_url', '#' );
					    $charity_aid_whatsapp_url = get_theme_mod( 'charity_aid_whatsapp_url', '#' );
					?>
				    <?php if ( ! empty( $charity_aid_facebook_url ) ) { ?>
				        <a href="<?php echo esc_url( $charity_aid_facebook_url ); ?>"><i class="fab fa-facebook-f mr-3"></i></a>
				    <?php } ?>

				    <?php if ( ! empty( $charity_aid_twitter_url ) ) { ?>
				        <a href="<?php echo esc_url( $charity_aid_twitter_url ); ?>"><i class="fab fa-twitter mr-3"></i></a>
				    <?php } ?>

				    <?php if ( ! empty( $charity_aid_instagram_url ) ) { ?>
				        <a href="<?php echo esc_url( $charity_aid_instagram_url ); ?>"><i class="fab fa-instagram mr-3"></i></a>
				    <?php } ?>

				    <?php if ( ! empty( $charity_aid_youtube_url ) ) { ?>
				        <a href="<?php echo esc_url( $charity_aid_youtube_url ); ?>"><i class="fab fa-youtube mr-3"></i></a>
				    <?php } ?>

				    <?php if ( ! empty( $charity_aid_whatsapp_url ) ) { ?>
				        <a href="<?php echo esc_url( $charity_aid_whatsapp_url ); ?>"><i class="fab fa-whatsapp"></i></a>
				    <?php } ?>
			    </div>
			</div>
		</div>
	</div>
</div>