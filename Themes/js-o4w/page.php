<?php get_header(); ?>
<div id="content">
<div id="left_column">
<div id="tab-content-post">
<div class="single-post">
 <ul>
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

 <li class="post">
 <h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
 <?php the_content(__('Read more'));?>	
  </li>
 </ul>
 </div>
 <?php comments_template(); ?>
<?php endwhile; else: ?>
  <p><strong>There has been a glitch in the Matrix.</strong><br />
  There is nothing to see here.</p>
  <p>Please try somewhere else.</p>
<?php endif; ?>
</div>

</div> <!--left column ends-->
<?php get_sidebar(); ?>
</div> <!--content ends-->
</div> <!--wrapper ends-->
<?php get_footer(); ?>