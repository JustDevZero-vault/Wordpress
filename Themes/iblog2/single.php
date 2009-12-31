<?php get_header(); ?>
  <div id="content">
  
  <div class="post-nav"> <span class="previous"><?php previous_post_link('%link') ?></span> <span class="next"><?php next_post_link('%link') ?></span></div>
  
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		  <div class="date"><span><?php the_time('M') ?></span> <?php the_time('d') ?></div>
		  <div class="title">
          <h2  class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
          <div class="postdata">
				<?php if(get_option('plallow') && get_option('pp_showauthor')):?><span class="author"><?php _e('By', TDOMAIN);?> <?php the_author() ?></span><?php endif;?>
				<span class="category"><?php the_category(', ') ?></span>
				<span class="right mini-add-comment"><a href="#respond"><?php _e('Add comments', TDOMAIN);?></a></span></div>
		  </div>
          <div class="entry fix">
			<?php if(function_exists('the_post_thumbnail') && has_post_thumbnail()): ?>
            		<div class="postthumb">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link To', TDOMAIN);?> <?php the_title_attribute();?>">
							<?php the_post_thumbnail('thumbnail');?>
						</a>
		            </div>
			<?php endif; ?>
            <?php the_content(__('Continue reading &raquo;', TDOMAIN)); ?>
			
			<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %'); ?>
			
			<?php edit_post_link(__('Edit', TDOMAIN), '', ''); ?>
          </div><!--/entry -->
		
		<?php comments_template(); ?>
		</div><!--/post -->
		
			<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.', TDOMAIN);?></p>

<?php endif; ?>
</div>
<?php get_footer(); ?>