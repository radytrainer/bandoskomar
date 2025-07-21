<?php
/**
 * The layout of the search results page template
 *
 * @package Charity Aid
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div class="wrap-detail-page">
			<?php
				charity_aid_page_title_display();
			?>
			<div class="search-post-wrap">
				<div class="row">
					<div class="col-lg-8">
						<div id="primary" class="content-area">
							<?php if ( have_posts() ) : ?>
								<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/content', 'search' );

								endwhile; ?>
									<?php
										the_posts_pagination( array(
											'next_text' => '<span>'.esc_html__( 'Next', 'charity-aid' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'charity-aid' ) . '</span>',
											'prev_text' => '<span>'.esc_html__( 'Prev', 'charity-aid' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'charity-aid' ) . '</span>',
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'charity-aid' ) . ' </span>',
										) );
									?>
								<?php
							else :
								get_template_part( 'template-parts/content', 'none' );

							endif;
							?>
						</div>
					</div>
					<div class="col-lg-4">
						<div id="secondary" class="sidebar left-sidebar">
							<?php get_sidebar('sidebar-1'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();