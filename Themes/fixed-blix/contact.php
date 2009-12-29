<?php
/*
Template Name: contact
*/
?>

<?php get_header(); ?>

            <div id="content" class="column">
                <div class="pageentry">

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php
        //validate email adress
        function is_valid_email($email)
        {
            return (eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $email));
        }

        //clean up text
        function clean($text)
        {
            return stripslashes($text);
        }

        //encode special chars (in name and subject)
        function encodeMailHeader ($string, $charset = 'UTF-8')
        {
            return sprintf ('=?%s?B?%s?=', strtoupper ($charset),base64_encode ($string));
        }

        $bx_name    = (!empty($_POST['bx_name']))    ? $_POST['bx_name']    : '';
        $bx_email   = (!empty($_POST['bx_email']))   ? $_POST['bx_email']   : '';
        $bx_url     = (!empty($_POST['bx_url']))     ? $_POST['bx_url']     : '';
        $bx_subject = (!empty($_POST['bx_subject'])) ? $_POST['bx_subject'] : '';
        $bx_message = (!empty($_POST['bx_message'])) ? $_POST['bx_message'] : '';

        $bx_subject = clean($bx_subject);
        $bx_message = clean($bx_message);
        $error_msg = '';
        $send = 0;

        if (!empty($_POST['submit'])) {
            $send = 1;
            if (empty($bx_name) || empty($bx_email) || empty($bx_subject) || empty($bx_message)) {
                $error_msg.= '<p><strong>Please fill in all required fields.</strong></p>' . "\n";
                $send = 0;
            }
            if (!is_valid_email($bx_email)) {
                $error_msg.= '<p><strong>Your email adress failed to validate.</strong></p>'."\n";
                $send = 0;
            }
        }

        if (!$send) { ?>

                    <h2><?php the_title(); ?></h2>
                    <?php
                        the_content();
                        echo $error_msg;
                    ?>

                    <form method="post" action="<?php echo 'http://', $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']; ?>" id="contactform">
                        <fieldset>
                            <p><label for="bx_name"><?php _e('Name'); ?></label> <input type="text" name="bx_name" id="bx_name" value="<?php echo $bx_name; ?>" tabindex="1" /></p>
                            <p><label for="bx_email"><?php _e('E-mail'); ?></label> <input type="text" name="bx_email" id="bx_email" value="<?php echo $bx_email; ?>" tabindex="2" /></p>
                            <p><label for="bx_url"><?php _e('URL'); ?></label> <input type="text" name="bx_url" id="bx_url" value="<?php echo $bx_url; ?>" tabindex="3" /> <em><?php _e('Optional'); ?></em></p>
                            <p><label for="bx_subject"><?php _e('Subject'); ?></label> <input type="text" name="bx_subject" id="bx_subject" value='<?php echo $bx_subject; ?>' tabindex="4" /></p>
                            <p><label for="bx_message"><?php _e('Comment'); ?></label> <textarea name="bx_message" id="bx_message" cols="45" rows="10" tabindex="5"><?php echo $bx_message; ?></textarea></p>
                            <p><input type="submit" name="submit" id="submit" value="<?php _e('Submit'); ?>" class="button" tabindex="6" /></p>
                        </fieldset>
                    </form>

        <?php
        } else {

            $displayName_array	= explode(' ',$bx_name);
            $displayName = htmlentities(utf8_decode($displayName_array[0]));

            $header  = "MIME-Version: 1.0\n";
            $header .= "Content-Type: text/plain; charset=\"utf-8\"\n";
            $header .= 'From:' . encodeMailHeader($bx_name) . '<' . $bx_email . ">\n";
            $email_subject	= '[' . get_settings('blogname') . '] ' . encodeMailHeader($bx_subject);
            $email_text		= 'From......: ' . $bx_name . "\n" .
                                  'Email.....: ' . $bx_email . "\n" .
                                  'Url.......: ' . $bx_url . "\n\n" .
                                  '..........................................................' . "\n" .
                                  'Subject...: ' . $bx_subject . "\n" .
                                  '..........................................................' . "\n\n" .
                                  $bx_message;

            if (@mail(get_settings('admin_email'), $email_subject, $email_text, $header)) {
                echo '<h2>Hey ', $displayName, ',</h2><p>thanks for your message! I\'ll get back to you as soon as possible.</p>';
            }
        }
        ?>

    <?php endwhile; ?>

<?php endif; ?>

                </div>
            </div>

<?php if ($blix_sidebar) get_sidebar(); ?>

<?php get_footer(); ?>
