<?php
/**
 * Section of the template used to display posts
 *
 * @package Charity Aid
 */
?>

<?php
	$class = '';
	if(!has_post_thumbnail()){
		$class = 'no-thumbnail';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class . ' ' ) ?> >
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="featured-image">
			<a href="<?php the_permalink(); ?>">
				<?php charity_aid_image_size( 'charity-aid-1370-550' ) ?>
			</a>
		</figure>
	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php 
				charity_aid_entry_header();
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			?>
		</header>

		<div class="entry-meta">
			<?php charity_aid_post_meta(); ?>
		</div>
		
		<div class="entry-text">
			<?php
				$charity_aid_excerpt_limit = get_theme_mod('charity_aid_excerpt_limit', 50);
				echo "<p>" . wp_trim_words(get_the_excerpt(), $charity_aid_excerpt_limit) . "</p>";
			?>
		</div>

		<?php charity_aid_edit_link(); ?>

	</div>
	
</article>