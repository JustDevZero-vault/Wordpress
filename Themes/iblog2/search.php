<?php get_header(); ?>

      <div id="content">

	<?php if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">
		  <div class="date"><span><?php the_time('M') ?></span><?php the_time('d') ?></div>
		  <div class="title">
          <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <div class="postdata"><span class="category"><?php the_category(', ') ?></span> <span class="comments"><?php comments_popup_link(__('No Comments &#187;', TDOMAIN), __('1 Comment &#187;', TDOMAIN), __('% Comments &#187;', TDOMAIN)); ?></span></div>
		  </div>
          <div class="entry">
				<?php if(function_exists('the_post_thumbnail') && has_post_thumbnail()): ?>
	            		<div class="postthumb">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link To', TDOMAIN);?> <?php the_title_attribute();?>">
								<?php the_post_thumbnail('thumbnail');?>
							</a>
			            </div>
				<?php endif; ?>
            <?php the_excerpt(); ?>
          </div><!--/entry -->
        </div><!--/post -->

		<?php endwhile; ?>
		
        <div class="page-nav fix">
			<span class="previous-entries"><?php next_posts_link(__('Previous Entries', TDOMAIN)) ?></span>
			<span class="next-entries"><?php previous_posts_link(__('Next Entries', TDOMAIN)) ?></span>
		</div><!-- /page nav -->

	<?php else : ?>
		<div class="post">
			<div class="billboard">
			<h2><?php _e('Nothing Found', TDOMAIN);?></h2>
			<p><?php _e('Please try another search.', TDOMAIN);?></p>
			</div>
		</div>

	<?php endif; ?>
</div>
<?php get_footer(); ?>