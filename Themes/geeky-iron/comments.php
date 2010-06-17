<?php

// Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p> 
	<?php
		return;
	}
	$oddcomment = 'comment-1';
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h2 id="comments"><?php comments_number(__('No Comments'), __('1 Comment'), __('%'));?> <?php printf(__('Comment on %s'), the_title('&#8220;', '&#8221;', false)); ?></h2>
	<br/>
	
	<?php foreach ($comments as $comment) : ?>
		<div class="<?=$oddcomment;?>" id="comment-<?php comment_ID() ?>">
			<cite><?php echo get_avatar( $comment, 30,  $default = '' ); ?>
			<b><?php comment_author_link() ?></b></cite> Dijo:
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
		<?php _e('Comments are closed.')?>
	<?php endif; ?>
<?php endif; ?>
<p><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?>
<?php if ( pings_open() ) : ?>
	<a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a>
<?php endif; ?>
</p>
<?php if ('open' == $post->comment_status) : ?>
<br />
<h2><?php comment_form_title( __('Leave a Reply'), __('Leave a Reply for %s') ); ?></h2>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
<?php else : ?>
<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>
<p><?php printf(__('Logged in as %s.'), $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>
<?php else : ?>
<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author) ?>" size="22" tabindex="1" />
<label for="author"><?php _e('Name'); ?> <?php if ($req) _e('(required)'); ?></label></p>
<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
<label for="email"><?php _e('Mail (will not be published)');?> <?php if ($req) _e('(required)'); ?></label></p>
<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
<label for="url"><?php _e('Website'); ?></label></p>
<?php endif; ?>
<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
<p>
<input name="submit" type="submit" id="comment-submit" value="<?php _e('Submit Comment'); ?>" />
<?php comment_id_fields(); ?> 
</p>
<?php do_action('comment_form', $post->ID); ?>
</form>
<?php endif; // If registration required and not logged in ?>
<?php endif; // if you delete this the sky will fall on your head ?>