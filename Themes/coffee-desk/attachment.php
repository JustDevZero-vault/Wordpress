<?php get_header(); ?>
<div id="c_content">
<div id="post_entry">


<?php
// This also populates the iconsize for the next line
$attachment_link = get_the_attachment_link($post->ID, true, array(450, 800));
// This lets us style narrow icons specially
$_post = &get_post($post->ID); $classname = ($_post->iconsize[0] <= 128 ? 'small' : '') . 'attachment';
?>

<?php if(have_posts()) : ?>

<?php while(have_posts()) : the_post(); ?>

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
<span class="category">Published in <?php the_category(', ') ?></span></div>
</div>

<div class="post_content" id="<?php echo $classname; ?>">
<?php echo $attachment_link; ?><br /><p>This is an image of <?php the_title(); ?></p>
</div>

</div>
<?php if ( function_exists('the_tags') ) { the_tags( '<p>Tags: ', ', ', '</p>'); } ?>
<div class="post_bottom"></div>
</div>
<div class="clear_content"></div>

<?php endwhile; ?>

<?php else: ?>

<h3>The Attachment Had Been Deleted...</h3>

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>