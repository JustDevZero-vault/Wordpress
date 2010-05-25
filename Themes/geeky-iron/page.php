<?php get_header(); ?>
<?php get_sidebar(); ?>	
	<div id="main-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post-wrap">
			<div class="post-title">
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
			</div>
			<?php the_content(__('(<span class="col-text"><u>More...</u></span>)')); ?>
			<?php edit_post_link('<span class="col-text"><u>Edit</u></span>'); ?>
		</div>	
		<?php endwhile; else: ?>
		<h2>Sorry...</h2>
		<?php _e('No posts matched your criteria.'); ?>
		<?php endif; ?>
		<div class="pagination">
		<?php next_posts_link('Next'); ?>
		</div>
		<div class="pagination">
		<?php previous_posts_link('Previous'); ?>
		</div>
	</div>
<?php get_footer(); ?>