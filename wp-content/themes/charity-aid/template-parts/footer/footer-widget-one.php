<div class="col-sm-6 col-12 col-lg-3 footer-widget-item">
	<?php
	if ( is_active_sidebar( 'footer-sidebar-1' ) ) {
		dynamic_sidebar( 'footer-sidebar-1' );
	} else {
		the_widget( 'WP_Widget_Search', array(
			'title' => esc_html__( 'Search Here', 'charity-aid' ),
		));
	}
	?>
</div>

<div class="col-sm-6 col-12 col-lg-3 footer-widget-item">
	<?php
	if ( is_active_sidebar( 'footer-sidebar-2' ) ) {
		dynamic_sidebar( 'footer-sidebar-2' );
	} else {
		the_widget( 'WP_Widget_Recent_Posts', array(
			'title' => esc_html__( 'Latest Posts', 'charity-aid' ),
			'number' => 10,
		));
	}
	?>
</div>

<div class="col-sm-6 col-12 col-lg-3 footer-widget-item">
	<?php
	if ( is_active_sidebar( 'footer-sidebar-3' ) ) {
		dynamic_sidebar( 'footer-sidebar-3' );
	} else {
		$tags = get_tags();
		if ( ! empty( $tags ) ) {
			the_widget( 'WP_Widget_Tag_Cloud', array(
				'title' => esc_html__( 'Tag Cloud', 'charity-aid' ),
			));
		} else {
			// Fallback content if no tags exist
			echo '<div class="widget">';
			echo '<h2 class="widget-title">' . esc_html__( 'Tag Cloud', 'charity-aid' ) . '</h2>';
			echo '<p>' . esc_html__( 'Currently no tags are available to show.', 'charity-aid' ) . '</p>';
			echo '</div>';
		}
	}
	?>
</div>

<div class="col-sm-6 col-12 col-lg-3 footer-widget-item">
	<?php
	if ( is_active_sidebar( 'footer-sidebar-4' ) ) {
		dynamic_sidebar( 'footer-sidebar-4' );
	} else {
		echo '<div class="widget widget_calendar">';
		echo '<h2 class="widget-title">' . esc_html__( 'Calendar', 'charity-aid' ) . '</h2>';
		get_calendar();
		echo '</div>';
	}
	?>
</div>