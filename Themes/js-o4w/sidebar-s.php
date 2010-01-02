            <div id="right_column">

			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>               

                
                <div class="heading">
                	<h2><?php _e('Related Posts', 'js-o4w'); ?></h2>
                </div> <!--heading ends-->
				<ul>
						<?php
							$tags = wp_get_post_tags($post->ID);
							if ($tags) {
							  $first_tag = $tags[0]->term_id;
							  $args=array(
								'tag__in' => array($first_tag),
								'post__not_in' => array($post->ID),
								'showposts'=>10,
								'caller_get_posts'=>1
							   );
							  $my_query = new WP_Query($args);
							  if( $my_query->have_posts() ) {
								while ($my_query->have_posts()) : $my_query->the_post(); ?>
									<li>
										<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
											<?php the_title(); ?> <?php comments_number(' ','(1)','(%)'); ?>
										</a> 
									</li>
								  <?php
								endwhile;
							  }
							}
						?>
				</ul>
				<div class="heading">
                	<h2><?php _e('Recent Posts', 'js-o4w'); ?></h2>
                </div> <!--heading ends-->
				<ul><?php
$limit = get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('showposts=' . $limit=10 . '&paged=' . $paged);
$wp_query->is_archive = true; $wp_query->is_home = false;
?>
<?php while(have_posts()) : the_post(); if(!($first_post == $post->ID)) : ?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>&nbsp;<span class="me-count"><?php comments_number('&nbsp;','(1)','(%)'); ?></span></li>
<?php endif; endwhile; ?></ul>
				
				
			<?php endif; ?>
            </div> <!--right column ends-->