                <div id="comments">

<?php // Do not delete these lines
    if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if (!empty($post->post_password)) { // if there's a password
        if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
?>
                    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?><p>
                </div>
<?php
            return;
        }
    }
    $commentalt = '';
    $commentcount = 1;
?>

<?php if ($comments) : ?>

                    <h2><?php comments_number(__('No Comments yet'), __('1 Comment'), __('% Comments')); if($post->comment_status == 'open') { ?> <a href="#commentform" class="more"><?php _e('Leave a Comment'); ?></a><?php } ?></h2>

                    <ul>

    <?php foreach ($comments as $comment) : ?>

                        <li id="comment-<?php comment_ID(); ?>" class="<?php comment_type('comment','trackback','pingback'); ?>">
                        <p class="header<?php echo $commentalt; ?>"><strong><?php echo $commentcount ?>.</strong>

	<?php if (function_exists('get_avatar')) { echo get_avatar($comment); } ?>

	<?php if ($comment->comment_type == 'comment') comment_author_link();
        else {
            strlen($comment->comment_author)?$author=substr($comment->comment_author,0,25)."&hellip":$author=substr($comment->comment_author,0,25);
            echo '<a href="', $comment->comment_author_url, '">', $author, '</a>';
        }
	?> &nbsp;|&nbsp; <?php printf(__('%1$s at %2$s'), get_comment_date(__('F j, Y')), get_comment_time()); ?></p>
	<?php if ($comment->comment_approved == '0') : ?><p><em><?php _e('Your comment is awaiting moderation.'); ?></em></p><?php endif; ?>
	<?php comment_text() ?>
	<?php edit_comment_link(__('Edit Comment'),'<span class="editlink">','</span>'); ?>
                        </li>

	<?php
            ($commentalt == ' alt')?$commentalt='':$commentalt=' alt';
            $commentcount++;
	?>

    <?php endforeach; ?>

                    </ul>

<?php endif; ?>

<?php if ($post->comment_status == 'open') : ?>

                    <h2 id="respond"><?php _e('Leave a Comment'); ?></h2>

    <?php if (get_option('comment_registration') && !$user_ID) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>

    <?php else : ?>

                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                        <fieldset>

	<?php if ($user_ID) : ?>

                            <p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>

        <?php else : ?>

                            <p><label for="author"><?php _e('Name'); ?></label> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /> <em><?php if ($req) _e('(required)'); ?></em></p>
                            <p><label for="email"><?php _e('E-mail'); ?></label> <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /> <em><?php if ($req) _e('(required)'); ?>, (<?php _e('Hidden'); ?>)</em></p>
                            <p><label for="url"><?php _e('URL'); ?></label> <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" /></p>

        <?php endif; ?>
                            <p><label for="comment"><?php _e('Comment'); ?></label> <textarea name="comment" id="comment" cols="45" rows="10" tabindex="4"></textarea></p>
                            <p><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
                            <input type="submit" name="submit" id="submit" value="<?php _e('Submit'); ?>" class="button" tabindex="5" /></p>

                        </fieldset>
        <?php do_action('comment_form', $post->ID); ?>
                    </form>

                    <p><strong>XHTML:</strong> <?php printf(__('You can use these tags: %s'), allowed_tags()); ?></p>

    <?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>

<?php if ($post-> comment_status == "open" && $post->ping_status == "open") { ?>
                    <p><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a> &nbsp;|&nbsp; <?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?></p>
<?php } elseif ($post-> comment_status == "open") {?>
                    <p><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?></p>
<?php } elseif ($post->ping_status == "open") {?>
                    <p><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a></p>
                    <p><a href="<?php trackback_url(display); ?>">Trackback this post</a></p>
<?php } ?>

                </div>
