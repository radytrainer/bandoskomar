<?php
/**
 * The primary widget space in the sidebar
 *
 * @package Charity Aid
 */
?>

<?php
if ( is_active_sidebar( 'sidebar-1' )) { ?>
	<div id="secondary" class="sidebar left-sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
<?php } else { ?>
	<div id="search-2" class="widget widget_search">
		<div class="widget-title-wrap"><h2 class="widget-title"><?php esc_html_e('Search Here', 'charity-aid'); ?></h2></div>
		<?php get_search_form(); ?>
	</div>

	<div id="recent-posts-2" class="widget widget_recent_entries">
		<div class="widget-title-wrap"><h2 class="widget-title"><?php esc_html_e('Recent Posts', 'charity-aid'); ?></h2></div>
		<ul>
			<?php
				$charity_aid_recent_posts = wp_get_recent_posts(array(
					'numberposts' => 5,
					'post_status' => 'publish',
				));
	
				foreach ($charity_aid_recent_posts as $charity_aid_post) :
					?>
					<li>
						<a href="<?php echo get_permalink($charity_aid_post['ID']); ?>">
							<?php echo esc_html($charity_aid_post['post_title']); ?>
						</a>
					</li>
				<?php endforeach; 
			?>
		</ul>
	</div>

	<div id="recent-comments-2" class="widget widget_recent_comments">
		<div class="widget-title-wrap"><h2 class="widget-title"><?php esc_html_e('Recent Comments', 'charity-aid'); ?></h2></div>
		<ul>
			<?php
				$charity_aid_comments = get_comments(array(
					'number' => 5,
					'status' => 'approve',
				));

				foreach ($charity_aid_comments as $charity_aid_comment) {
					$post_title = get_the_title($charity_aid_comment->comment_post_ID);
					
					echo '<li class="recentcomments"><span class="comment-author-link"><a href="' . esc_url(get_comment_author_url($charity_aid_comment->comment_ID)) . '" class="url" rel="ugc external nofollow">' . esc_html($charity_aid_comment->comment_author) . '</a></span> on <a href="' . esc_url(get_comment_link($charity_aid_comment->comment_ID)) . '">' . esc_html($post_title) . '</a></li>';
				}
			?>
		</ul>
	</div>

	<div id="archives-3" class="widget widget_archive">
		<div class="widget-title-wrap"><h2 class="widget-title"><?php esc_html_e('Archives', 'charity-aid'); ?></h2></div>
		<ul>
			<?php
				wp_get_archives(array(
					'type' => 'monthly',
					'format' => 'html',
					'show_post_count' => true,
				));
			?>
		</ul>
	</div>

	<div id="categories-3" class="widget widget_categories">
		<div class="widget-title-wrap"><h2 class="widget-title"><?php esc_html_e('Categories', 'charity-aid'); ?></h2></div>
		<ul>
			<?php
				wp_list_categories(array(
					'title_li' => '',
					'show_count' => true,
				));
			?>
		</ul>
	</div>
<?php } ?>