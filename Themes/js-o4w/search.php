<?php get_header(); ?>
<div id="content">
<div id="left_column">
<div id="tab-content-post">
   <p class="archiveh">
	<?php _e('Search results for ', 'js-o4w'); ?><?php printf( __('keyword(s): &#8216;%1$s&#8217;', 'js-o4w'), wp_specialchars($s, 1) ); ?>
	</p>
 <ul class="applyalt">
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 <li class="post">
 <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 <p>
<span class="index-meta"><?php _e('Date: ', 'js-o4w'); ?><?php the_time('Y.m.d') ?> | <?php _e('Category: ', 'js-o4w'); ?><?php the_category(', ') ?> | <?php _e('Response: ', 'js-o4w'); ?><?php comments_number('0','1','%'); ?></span>
</p>
<?php the_content(__('Read the rest of this entry &raquo;', 'js-o4w')); ?>

</li> <!-- end #post -->

 <?php endwhile; else: ?>
  <p class="nopost"><strong>There has been a glitch in the Matrix.</strong><br />
  There is nothing to see here.</p>
  <p class="nopost">Please try somewhere else.</p>
 <?php endif; ?>
</ul>
				<div class="nav-left">
					<span class="nav-previous"><?php next_posts_link(__('Older posts', 'js-o4w')) ?></span>
					<span class="nav-next"><?php previous_posts_link(__('Newer posts', 'js-o4w')) ?></span>
				</div>
</div>

</div> <!--left column ends-->
<?php get_sidebar(); ?>
</div> <!--content ends-->
</div> <!--wrapper ends-->
<?php get_footer(); ?>