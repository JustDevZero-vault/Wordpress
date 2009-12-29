<?php
/*
Template Name: archives
*/
?>

<?php get_header(); ?>

            <div id="content" class="column archive">
                <h2><?php _e('Archives'); ?></h2>
                <?php BX_archive(); ?>
            </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
