<?php
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
		'name'=>'Home Sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="heading"><h2>',
        'after_title' => '</h2></div>',
    ));
    register_sidebar(array(
		'name'=>'single Sidebar',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<div class="heading"><h2>',
        'after_title' => '</h2></div>',
    ));
} 

function blogtxt_date_classes($t, &$c, $p = '') {
	$t = $t + (get_option('gmt_offset') * 3600);
	$c[] = $p . 'y' . gmdate('Y', $t);
	$c[] = $p . 'm' . gmdate('m', $t);
	$c[] = $p . 'd' . gmdate('d', $t);
	$c[] = $p . 'h' . gmdate('h', $t);
}
function theme_init(){
	load_theme_textdomain('js-o4w', get_template_directory() . '/languages');
}

function js_o4w_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   	<?php $countComments = 1; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
      	<span class="comments_posted_top"></span>
     <div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
	<p class="message_head"><cite><?php comment_author_link();?></cite>

	<span class="timestamp"><?php comment_date('y/m/d H:i') ?></span>

	</p>
			

<div class="message_body">
			<div class="avatarbg">
			<?php echo get_avatar( get_comment_author_email(), '36' ); ?>
			</div>
			<?php echo comment_text();?>
			<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</div>

			<?php if ($comment->comment_approved == '0') : ?>
			(Your comment is awaiting moderation.)
			<?php endif; ?>
</div>


     </div></div>
<?php
        }
?>
<?php
add_action ('init', 'theme_init');
?>