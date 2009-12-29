<?php get_header(); ?>

            <div id="content" class="column archive">

<?php if (have_posts()) : ?>

                <?php /* If this is a category archive */ if (is_category()) { ?>
                <h2><?php _e('Filed under:'); echo ' ', single_cat_title(); ?></h2>

                <?php /* If this is a tag archive */ } elseif (function_exists('is_tag') && is_tag()) { ?>
                <h2><?php _e('Tag'); echo ': ', single_tag_title(); ?></h2>

                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h2><?php _e('Archives'); ?> &ndash; <?php the_time(__('F j, Y')); ?></h2>

                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h2><?php _e('Archives'); ?> &ndash; <?php the_time('F, Y'); ?></h2>

                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h2><?php _e('Archives'); ?> &ndash <?php the_time('Y'); ?></h2>

                <?php /* If this is a search */ } elseif (is_search()) { ?>
                <h2><?php _e('Search Results'); ?></h2>

                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h2><?php _e('Archives'); ?> &ndash; <?php _e('Author'); ?></h2>

                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2><?php _e('Archives'); ?></h2>

                <?php } ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php $custom_fields = get_post_custom(); ?>

        <?php if (isset($custom_fields['BX_post_type']) && $custom_fields['BX_post_type'][0] == 'mini') { ?>

                <hr class="low" />
                <div class="minientry">
                    <p>
                        <?php echo BX_remove_p(get_the_content()); ?>
                        <div class="info">
                            <?php comments_popup_link('(0)', '(1)', '(%)', 'commentlink', ''); ?>
                            <a href="<?php the_permalink(); ?>" class="permalink" title="Permalink"><?php the_time('M j, \'y') ?><!--, <?php the_time('h:ia') ?>--></a>
                            <!--<em class="author"><?php the_author() ?></em>-->
                            <?php edit_post_link('Edit','<span class="editlink">','</span>'); ?>
                        </div>
                    </p>
                </div>
                <hr class="low" />

        <?php } else { ?>

                <div class="entry">
                    <h3><a href="<?php the_permalink() ?>" title="Permalink"><?php the_title(); ?></a></h3>
                    <?php ($post->post_excerpt != '') ? the_excerpt() : BX_shift_down_headlines(get_the_content()); ?>
                    <?php wp_link_pages('before=<p class="page-links">&after=</p>'); ?>
                    <p class="info">
                        <?php if ($post->post_excerpt != '') { ?><a href="<?php the_permalink() ?>" class="more"><?php _e('Continue'); ?></a><?php } ?>
                        <?php comments_popup_link(__('Leave a Comment'), __('1 Comment'), __('% Comments'), 'commentlink', ''); ?>
                        <em class="date"><?php the_time(__('F j, Y')) ?><!-- at <?php the_time('h:ia')  ?>--></em>
                        <!--<em class="author"><?php the_author(); ?></em>-->
                        <?php edit_post_link('Edit','<span class="editlink">','</span>'); ?>
                    </p>
                </div>

    <?php } ?>

    <?php endwhile; ?>

                <p>
                    <span class="next"><?php previous_posts_link(__('Next page')) ?></span>
                    <span class="previous"><?php next_posts_link(__('Previous page')) ?></span>
                </p>

<?php else : ?>

                <h2><?php _e('Page not found'); ?></h2>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

            </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
