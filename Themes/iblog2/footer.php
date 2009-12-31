		<?php if(get_option('plallow') && get_option('pp_showfootnav')):?>
			<div class="bottomnav" style="">
				<ul class="piped">
						<li class="page_item "><a class="first" href="<?php echo get_settings('home'); ?>/" title="Home"><?php _e('Home');?></a></li>
					<?php 
						$frontpage_id = get_option('page_on_front');
						wp_list_pages('sort_column=menu_order&exclude='.$frontpage_id.'&depth=1&title_li=');?>
				</ul>
				<div style="clear:both"></div>
			</div>
		<?php endif;?>
		
		</div> <!-- end leftcol -->
		<?php get_sidebar(); ?>
		

		
		</div> <!-- /container -->
	</div> <!-- /wrapper -->
    <hr class="hidden" />
  </div><!--/page -->
<div style="display:none;">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/navgrad-active.gif" alt="preload" />
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/navgrad-down.gif" alt="preload" />
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/navgrad-hover.gif" alt="preload" />
</div>

<!-- Analytics Go Here -->
<?php if(get_option('pp_analytics')):?><?php echo get_option('pp_analytics');?><?php endif;?>
<!-- End Analytics -->
<?php wp_footer(); ?>
</body>
</html>