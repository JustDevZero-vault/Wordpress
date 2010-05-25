<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>
			<h2>Sorry...</h2>
			This post is password protected. Enter the password to view comments.
			<?php
			return;
		}
	}
	/* This variable is for alternating comment background */
	$oddcomment = 'comment-1';
?>
<?php if ($comments) : ?>
	<h2><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h2>
	<br />
	<?php foreach ($comments as $comment) : ?>
		<div class="<?=$oddcomment;?>" id="comment-<?php comment_ID() ?>">
			<cite><?php echo get_avatar( $comment, 30,  $default = '' ); ?>
			<b><?php comment_author_link() ?></b></cite> Says:
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>
			<br />
			<span class="comment-meta-data"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></span>
			<?php comment_text() ?>
		</div>
  <?php /* Changes every other comment to a different class */ 
   if("comment-2" == $oddcomment) {$oddcomment="comment-1";}
   else { $oddcomment="comment-2"; }
  ?>
	<?php endforeach; /* end for each comment */ ?>
	<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		Comments are closed.
	<?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) : ?>
<br />
<h2>Leave a Reply</h2>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><b><?php echo $user_identity; ?></b></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout</a></p>
<?php else : ?>
<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author">Your Name <?php if ($req) echo "(required)"; ?></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email">Your E-Mail Address <?php if ($req) echo "(required)"; ?></label></p>
<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url">Your Website</label></p>
<?php endif; ?>
<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<p><textarea name="comment" id="comment" cols="55" rows="10" tabindex="4"></textarea></p>
<p>
<input type="submit" name="submit" id="comment-submit" value="Add Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<p><?php do_action('comment_form', $post->ID); ?></p>
</form>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>