<?php
/**
 * The page.php template portion that displays the page content
 *
 * @package Charity Aid
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'charity-aid' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php charity_aid_edit_link(); ?>
	
</article><!-- #post-<?php the_ID(); ?> -->
