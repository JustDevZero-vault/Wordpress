<?php
    /* Don't remove these lines. */
    add_filter('comment_text', 'popuplinks');
    foreach ($posts as $post) { start_wp();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require_once get_template_directory()."/BX_functions.php"; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php bloginfo('name'); wp_title(); ?></title>
        <meta http-equiv="Content-Type" content="<?php bloginfo('charset'); ?>" />
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    </head>

    <body id="commentspopup">
        <div id="container">
            <div id="content">
                <div id="comments">

<?php
    // this line is WordPress' motor, do not delete it.
    $comment_author = (isset($_COOKIE['comment_author_' . COOKIEHASH])) ? trim($_COOKIE['comment_author_'. COOKIEHASH]) : '';
    $comment_author_email = (isset($_COOKIE['comment_author_email_'. COOKIEHASH])) ? trim($_COOKIE['comment_author_email_'. COOKIEHASH]) : '';
    $comment_author_url = (isset($_COOKIE['comment_author_url_'. COOKIEHASH])) ? trim($_COOKIE['comment_author_url_'. COOKIEHASH]) : '';
    $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $id AND comment_approved = '1' ORDER BY comment_date");
    $commentstatus = $wpdb->get_row("SELECT comment_status, post_password FROM $wpdb->posts WHERE ID = $id");
    if (!empty($commentstatus->post_password) && $_COOKIE['wp-postpass_'. COOKIEHASH] != $commentstatus->post_password) {  // and it doesn't match the cookie
        echo(get_the_password_form());
    } else {
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

            <?php if ($comment->comment_type == "comment") comment_author_link();
            else {
                strlen($comment->comment_author)?$author=substr($comment->comment_author,0,25)."&hellip":$author=substr($comment->comment_author,0,25);
                echo '<a href="', $comment->comment_author_url, '">', $author, '</a>';
            }
            ?> &nbsp;|&nbsp; <?php comment_date(__('F j, Y')) ?> at <?php comment_time() ?></p>
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

<?php } ?>

<?php if ($post->comment_status == 'open') : ?>

                    <h2><?php _e('Leave a Comment'); ?></h2>

    <?php if (get_option('comment_registration') && !$user_ID) : ?>
                    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>

    <?php else : ?>

                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                        <fieldset>

        <?php if ($user_ID) : ?>

                            <p><?php printf(__('Logged in as %s.'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php         echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account') ?>"><?php _e('Log out &raquo;'); ?></a></p>

        <?php else : ?>

                            <p><label for="author"><?php _e('Name'); ?></label> <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" /> <em><?php if ($req) _e('(required)'); ?></em></p>
                            <p><label for="email"><?php _e('E-mail'); ?></label> <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" /> <em><?php if ($req) _e('(required)'); ?>, (hidden)</em></p>
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

    <?php if ($post-> comment_status == 'open' && $post->ping_status == 'open') { ?>
                    <p><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a> &nbsp;|&nbsp; <?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?></p>
    <?php } elseif ($post-> comment_status == 'open') {?>
                    <p><?php post_comments_feed_link(__('<abbr title="Really Simple Syndication">RSS</abbr> feed for comments on this post.')); ?></p>
    <?php } elseif ($post->ping_status == 'open') {?>
                    <p><a href="<?php trackback_url() ?>" rel="trackback"><?php _e('TrackBack <abbr title="Universal Resource Locator">URL</abbr>'); ?></a></p>
                    <p><a href="<?php trackback_url(display); ?>">Trackback this post</a></p>
    <?php } ?>

<?php } ?>

                </div>
            </div>
        </div>
    </body>
</html>
