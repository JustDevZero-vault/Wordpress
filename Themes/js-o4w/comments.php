<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Please do not load this page directly. Thanks!');
	}
  if (!empty($post->post_password)) {
  	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
  		?>
  		<p class="alert">This post is password protected. Enter the password to view comments.</p>
  		<?php
  		return;
  	}
  }

  $countComments = 0; $countPings = 0;
  if ($post->comment_count > 0) {
  	$comments_list = array();
  	$pings_list = array();
  	foreach ($comments as $comment) {
  		if ('comment' == get_comment_type()) $comments_list[++$countComments] = $comment;
  		else $pings_list[++$countPings] = $comment;
  	}
  }

?>

<!-- You can start editing here. -->
<div id="commentblock">

<?php if ( have_comments() ) : ?>

<h3 id="comments"><span id="comment-num"><?php comments_number('0', '1', '%' );?></span> <?php _e('Responses to', 'js-o4w'); ?> &#8220;<?php the_title(); ?>&#8221;</h3>


	<ol class="commentlist" id="commentlist">
	<?php wp_list_comments('type=comment&callback=js_o4w_comment'); ?>
	</ol>
	

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comments are closed.', 'js-o4w'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply for %s') ); ?></h3>

<div id="cancel-comment-reply"> 
	<?php cancel_comment_reply_link() ?>
</div> 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'js-o4w'), get_option('siteurl') . '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<div class="form_line"><?php _e('Logged in as', 'js-o4w'); ?> <?php echo $user_identity; ?>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout', 'js-o4w'); ?> &raquo;</a></div>

<?php else : ?>
  		<div id="comment-personaldetails">
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small><?php _e('Name', 'js-o4w'); ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small><?php _e('E-Mail (will not be published)', 'js-o4w'); ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small><?php _e('Website', 'js-o4w'); ?></small></label></p>
</div>
<?php endif; ?>

<!--<p><small><?php printf(__('<strong>XHTML:</strong> You can use these tags: <code>%s</code>', 'js-o3-lite'), allowed_tags()); ?></small></p>-->
    <?php do_action('comment_form', $post->ID); ?>
	<?php include(TEMPLATEPATH . '/smiley.php'); ?>
<div id="re-use"><textarea name="comment" id="comment" cols="55%" rows="6" tabindex="4"></textarea></div>
<p><input class="formbutton" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit', 'js-o4w'); ?>" />
<?php comment_id_fields(); ?> 
</p>
<div class="clear"></div>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>

  <?php /* Check for pings */ if ($countPings > 0) { ?>
     <p class="pinglisth">The trackbacks and pingpacks:</p>
  <ul id="pinglist">
  	<?php	foreach ($pings_list as $comment) {
  		if ('pingback' == get_comment_type()) $pingtype = 'Pingback';
  		else $pingtype = 'Trackback';
  		?>
      <li id="comment-<?php echo $comment->comment_ID ?>">
      	<?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('y/m/d H:i', $comment->comment_date); ?>
      </li>
    <?php } ?>
  </ul>
    <?php } ?>
</div>