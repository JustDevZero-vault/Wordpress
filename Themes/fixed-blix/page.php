<?php get_header(); ?>

            <div id="content" class="column">
                <div class="pageentry">

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

                    <h2><?php the_title(); ?></h2>

                    <?php the_content(); ?>

    <?php endwhile; ?>

<?php endif; ?>

                </div>
            </div>

<?php if ($blix_sidebar) get_sidebar(); ?>

<?php get_footer(); ?>
