<div class="dbx-group" id="sidebar">
	
		<div id="cred">
				<a class="plimage" href="<?php echo get_option('pllink'); ?>">Free WordPress Themes</a>
		</div>
	<?php if(get_option('plallow') && get_option('pp_welcomemessage')):?>
		<div class="welcome"> 
			<?php echo get_option('pp_welcomemessage'); ?>
		</div>
	<?php endif;?>
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

      <!--sidebox start -->
      <div id="categories" class="dbx-box">
        <h3 class="dbx-handle"><?php _e('Categories', TDOMAIN); ?></h3>
        <div class="dbx-content">
          <ul>
            <?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
          </ul>
        </div>
      </div>
      <!--sidebox end -->

	<!--sidebox start -->
	<div id="tags" class="dbx-box">
	  <h3 class="dbx-handle"><?php _e('Tag Cloud', TDOMAIN); ?></h3>
	  <div class="dbx-content">

		<?php wp_tag_cloud('smallest=8&largest=17&number=30'); ?>

	  </div>
	</div>
	<!--sidebox end -->


      <!--sidebox start -->
      <div id="archives" class="dbx-box">
        <h3 class="dbx-handle"><?php _e('Archives', TDOMAIN); ?></h3>
        <div class="dbx-content">
          <ul>
            <?php wp_get_archives('type=monthly'); ?>
          </ul>
        </div>
      </div>
      <!--sidebox end -->

      <!--sidebox start -->
      <div id="links" class="dbx-box">
        <h3 class="dbx-handle"><?php _e('Links', TDOMAIN); ?></h3>
        <div class="dbx-content">
          <ul>
            <?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
          </ul>
        </div>
      </div>
      <!--sidebox end -->

      <!--sidebox start -->
      <div id="meta" class="dbx-box">
        <h3 class="dbx-handle"><?php _e('Meta', TDOMAIN); ?></h3>
        <div class="dbx-content">
          <ul>
			<?php wp_register(); ?>
			<li class="login"><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
            
	        <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', TDOMAIN);?></a></li>
	        <li class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', TDOMAIN);?></a></li>
			<li class="wordpress"><a href="http://www.wordpress.org" title="<?php _e('Powered by WordPress', TDOMAIN);?>">WordPress</a></li>
			<li class="pagelines"><a href="http://www.pagelines.com" title="PageLines"><?php _e('iBlog2 WordPress Theme', TDOMAIN);?></a></li>
          </ul>
        </div>
      </div>
      <!--sidebox end -->

  <?php endif; ?>
	<div style="clear:both"></div>
</div><!--/sidebar -->
