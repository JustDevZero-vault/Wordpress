            <div id="right_column">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>               
                <div class="heading">
                	<h2><?php _e('Most Popular', 'js-o4w'); ?></h2>
                </div> <!--heading ends-->
				<ul class="most-comments">
					<?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 10");
					foreach ($result as $post) {
					setup_postdata($post);
					$postid = $post->ID;
					$title = $post->post_title;
					$commentcount = $post->comment_count;
					if ($commentcount != 0) { ?>
						<li>
							<a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title ?>"><?php echo $title ?></a> (<?php echo $commentcount ?>)
						</li>
					<?php } } ?>
				</ul>
                
                <div class="heading">
                	<h2><?php _e('Recent Comments', 'js-o4w'); ?></h2>
                </div> <!--heading ends-->
				<ul>
					<?php
					  global $wpdb;
					  $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,30) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 10";
					  $comments = $wpdb->get_results($sql);
					  $output = $pre_HTML;
					  foreach ($comments as $comment) {
						$output .= "\n<li>". "<a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"on ".$comment->post_title . "\">".strip_tags($comment->comment_author)."</a>" .": " .strip_tags($comment->com_excerpt).'...'."</li>";
					  }
					  $output .= $post_HTML;
					  echo $output;
					?>
				</ul>
				
				
			<?php endif; ?>
            </div> <!--right column ends-->