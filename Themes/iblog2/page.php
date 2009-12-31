<?php get_header(); ?>

	<?php if($post->post_parent || wp_list_pages("title_li=&child_of=".$post->ID."&echo=0")):?>
	<div id="subnav" class="fix">
		<ul>
			<?php
			if($post->post_parent) $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
			else 	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_column=menu_order");
			if ($children) { echo $children;} 
			?>
		</ul>
	</div><!-- /sub nav -->
	<?php endif;?>

  <div id="content">
    
  		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
		    <div class="post fix" id="post-<?php the_ID(); ?>">
		        <?php if(get_option('plallow') && get_option('pp_pagetitle')):?><h2 class="posttitle"><?php the_title(); ?></h2><?php endif; ?>
		
				<div class="entry">
				<?php the_content('<p>'.__('Continue reading', TDOMAIN).' &raquo;</p>'); ?>
				<?php link_pages('<p><strong>'.__('Pages', TDOMAIN).':</strong> ', '</p>', 'number'); ?>
				<?php edit_post_link(__('Edit', TDOMAIN), '<p>', '</p>'); ?>
				</div><!--/entry -->
				<?php if(get_option('pagecomments')):?>
					<?php comments_template(); ?>
				<?php endif; ?>
			</div><!--/post -->
	
		<?php endwhile; endif; ?>
   </div>
<?php get_footer(); ?>