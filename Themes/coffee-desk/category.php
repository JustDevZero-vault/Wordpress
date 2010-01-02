<?php get_header(); ?>
<div id="c_content">
<div id="post_entry">
<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
<div class="post_meta" id="post-<?php the_ID(); ?>">
<div class="post_top"></div>
<div class="post_index">
<div class="post_title">
<div class="calendar">
<p class="date"><?php the_time('j'); ?></p>
<p class="month"><?php the_time('M'); ?></p>
</div>
<div class="post_info">
<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<span class="author">Posted by <?php the_author_posts_link(); ?>&nbsp;<?php edit_post_link(__(' Edit'), '|', ''); ?></span>
<span class="category">Published in <b><?php the_category(', ') ?></b></span></div>
</div>

<div class="post_content">
<?php the_content("<br />" . "continue reading&nbsp;" . "&quot;" . the_title('', '', false) . "&quot;"); ?>
</div>
<?php if ( function_exists('the_tags') ) { the_tags( '<p>Tags: ', ', ', '</p>'); } ?>
<div class="post_comment_counter">
<div class="coms_count"><a href="<?php comments_link(); ?>"><?php comments_number('no comment','1 comment','% comments'); ?></a></div>
</div>

</div>
<div class="post_bottom"></div>
</div>
<div class="clear_content"></div>

<?php endwhile; ?>

<div class="post_nav"><?php if(function_exists('wp_pagenavi')): ?> <?php wp_pagenavi(); ?><?php else : ?><?php posts_nav_link(); ?>
<?php endif; ?></div>

<?php else: ?>

<h3>The Category Had Been Deleted...</h3>

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>