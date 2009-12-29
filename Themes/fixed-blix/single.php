<?php get_header(); ?>

            <div id="content" class="column">

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

	<?php /* This is the navigation for previous/next post. It's disabled by default. ?>
                <p id="entrynavigation">
                    <?php previous_post('<span class="previous">%</span>','','yes') ?>
                    <?php next_post('<span class="next">%</span>','','yes') ?>
                </p>
	<?php */ ?>

                <div class="entry single">
                    <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                    <p class="info">
                        <?php if ($post->comment_status == 'open') ?>
                        <em class="date"><?php the_time(__('F j, Y')) ?><!-- at <?php the_time('h:ia') ?>--></em>
                        <!--<em class="author"><?php the_author(); ?></em>-->
                        <?php edit_post_link('Edit','<span class="editlink">','</span>'); ?>
                    </p>
                    <?php the_content();?>
                    <?php wp_link_pages('before=<p class="page-links">&after=</p>'); ?>
                    <p id="filedunder"><?php _e('Filed under:'); ?> <?php the_category(','); ?></p>
                    <?php if (function_exists('the_tags')) ?><p id="tags"><?php the_tags(__('Tags: '), ', ', '') ?></p><?php ; ?>
               </div>

    <?php endwhile; ?>

<?php else : ?>

                <h2><?php _e('Page not found'); ?></h2>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

<?php comments_template(); ?>

            </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
