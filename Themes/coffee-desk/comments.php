<?php // Do not delete these lines

if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

die ('Please do not load this page directly. Thanks!');

if (!empty($post->post_password)) { // if there's a password

if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

?>

<h3><?php _e("This post is password protected. Enter the password to view comments."); ?></h3>

<?php

return;

}

}

$commentalt = '_alt';

$commentcount = 1;

?>

<div id="comments_templates">

<div class="post_top"></div>

<div class="post_index">

<?php
$this_post = $post;
$category = get_the_category(); $category = $category[0]; $category = $category->cat_ID;
$posts = get_posts('numberposts=6&offset=0&orderby=post_date&order=DESC&category='.$category);
$count = 0;
foreach ( $posts as $post ) {
if ( $post->ID == $this_post->ID || $count == 5) {
unset($posts[$count]);
}else{
$count ++;
}
}
?>


<div class="relatedpost">
<?php if ( $posts ) : ?>
<h2>Related Articles</h2>
<ul>
<?php function getWords($text, $limit) {
$array = explode(" ", $text, $limit +1);
if(count($array) > $limit) {
unset($array[$limit]);
}
return implode(" ", $array); }
?>
<?php foreach ( $posts as $post ) : ?>
<?php $mycontent = strip_tags($post->post_content);
$excerpt = getWords($mycontent, 15);
$a_title = $excerpt . "..."; ?>
<li><a href="<?php the_permalink(); ?>" title="<?php echo $a_title ?>">
<?php if ( get_the_title() ) { the_title(); } else { echo "Untitle"; } ?></a>
(<?php the_time('F jS, Y') ?>)
</li>
<?php endforeach // $posts as $post ?>
</ul>
<?php endif // $posts ?>
<?php
$post = $this_post;
unset($this_post);
?>
</div>


<div class="clear_box"></div>
<h4><?php comments_number('No user', '1 user', '% users' );?> responded in this post</h4>
<div class="rssfeeds">Subscribe to this post <?php comments_rss_link('comment rss'); ?> or <a href="<?php trackback_url(display); ?>">trackback url</a></div>
<div class="clear_box"></div>


<?php if ($comments) : ?>

<?php foreach ($comments as $comment) : ?>

<?php
$email = $comment->comment_author_email;
$default = "http://roam2rome.com/wp-content/uploads/2008/07/avtar11.gif"; // link to your default avatar
$size = 52; // size in pixels squared
$rating = "PG"; // [G | PG | R | X]
$grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=
" . md5($email) . "&default=" . urlencode($default) . "&size=" . $size."&rating=".$rating;
?>

<div class="comment_user<?php echo $commentalt; ?>">
<div class="user_avatar"><img src="<?=$grav_url ?>" height="<?=$size ?>" width="<?=$size ?>" alt="User Gravatar" /></div>
<div class="user_infos">
<div class="com_author"><?php comment_author_link(); ?> said in <?php comment_date('F jS, Y') ?> at <?php comment_time() ?> <?php edit_comment_link('edit','',''); ?></div>
<div class="com_text"><?php comment_text() ?></div>
</div>
</div>
<div class="com_break"></div>

<?php

($commentalt == "_alt")?$commentalt="":$commentalt="_alt";

$commentcount++;

?>

<?php endforeach; /* end for each comment */ ?>

<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php if (get_option('comment_registration') && !$user_ID) : ?>


<?php else : ?>

<h6>Leave A Reply</h6>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

<?php if (!$user_ID) : ?>

<p><input name="author" type="text" value="<?php echo $comment_author; ?>"/>&nbsp;Username (Required)</p>
<p><input name="email" type="text" value="<?php echo $comment_author_email; ?>"/>&nbsp;Email Address (Remains Private)</p>
<p><input name="url" type="text" value="<?php echo $comment_author_url; ?>"/>&nbsp;Website (Optional)</p>

<?php endif; ?>

<p><textarea name="comment" cols="50%" rows="8"></textarea></p>
<p><input name="" type="image" value="Submit" src="<?php bloginfo('stylesheet_directory'); ?>/images/submit.PNG" alt="post my comment" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></p>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

</div>

<div class="post_bottom"></div>

</div>
