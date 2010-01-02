<?php get_header(); ?>

<div id="content">
<div id="left_column">
<div id="tab-content-post">

 <?php if (have_posts()) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

   <p class="archiveh">
   		<?php
		// If this is a category archive
		if (is_category()) {
			printf( __('Archive for the &#8216;%1$s&#8217; Category', 'js-o4w'), single_cat_title('', false) );
		// If this is a tag archive
		} elseif (is_tag()) {
			printf( __('Posts Tagged &#8216;%1$s&#8217;', 'js-o4w'), single_tag_title('', false) );
		// If this is a daily archive
		} elseif (is_day()) {
			printf( __('Archive for %1$s', 'js-o4w'), get_the_time(__('F jS, Y', 'js-o4w')) );
		// If this is a monthly archive
		} elseif (is_month()) {
			printf( __('Archive for %1$s', 'js-o4w'), get_the_time(__('F, Y', 'js-o4w')) );
		// If this is a yearly archive
		} elseif (is_year()) {
			printf( __('Archive for %1$s', 'js-o4w'), get_the_time(__('Y', 'js-o4w')) );
		// If this is an author archive
		} elseif (is_author()) {
			_e('Author Archive', 'js-o4w');
		// If this is a paged archive
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			_e('Blog Archives', 'js-o4w');
		}
		?>
   </p>



 <ul class="applyalt">
 <?php while (have_posts()) : the_post(); ?>

 <li class="post">
 <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 <p>
<span class="index-meta"><?php _e('Date: ', 'js-o4w'); ?><?php the_time('Y.m.d') ?> | <?php _e('Category: ', 'js-o4w'); ?><?php the_category(', ') ?> | <?php _e('Response: ', 'js-o4w'); ?><?php comments_number('0','1','%'); ?></span>
</p>
<?php the_content(__('Read the rest of this entry &raquo;', 'js-o4w')); ?>
</li> <!-- end #post -->

 <?php endwhile; else: ?>
  <p><strong>There has been a glitch in the Matrix.</strong><br />
  There is nothing to see here.</p>
  <p>Please try somewhere else.</p>
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