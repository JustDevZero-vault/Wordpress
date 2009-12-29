<?php
    global $blix_navigation_location;
?>
            <hr class="low" />

            <div id="subcontent" class="column">
<?php
     /**
       * Pages navigation. Disabled by default because all new pages are added
       * to the main navigation.
       * If enabled: Blix default pages are excluded by default.
       */
    if ($blix_navigation_location == 'Sidebar') {
?>
            <h2><em><?php _e('Pages'); ?></em></h2>
            <ul class="pages">
                <?php wp_list_pages('title_li=&sort_column=menu_order&exclude=' . BX_excluded_pages()); ?>
            </ul>
<?php
    }
       /**/
?>

<?php if (is_home()) {
    /**
     * If a page called "about_short" has been set up its content will be put here.
     * In case that a page called "about" has been set up, too, it'll be linked to via 'More'.
     */

    $about_short = get_page_by_path('about_short');
    $about = get_page_by_path('about');

    if ($about->post_status == 'publish') $more_url = '<a href="'.get_bloginfo('url').'/'.get_page_uri($about->ID).'" class="more">'.__('More...').'</a>';
    if ($about_short->post_status == 'publish') {
        $about_title = $about_short->post_title;
        $about_text = BX_remove_p($about_short->post_content);
    }
    if ($about_text != '') {
        echo '<h2><em>', $about_title, "</em></h2>\n";
        echo '<p>', $about_text;
        if ($more_url != '') echo ' ', $more_url;
        echo "</p>\n";
    }
} ?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

    <?php if (is_home()) { ?>

        <h2><em><?php _e('Categories'); ?></em></h2>
        <ul class="categories">
            <?php wp_list_categories('title_li=&hide_empty=0'); ?> 
        </ul>

        <h2><em><?php _e('Links'); ?></em></h2>
        <ul class="links">
            <?php get_links('-1', '<li>', '</li>', '', 0, 'name', 0, 0, -1, 0); ?>
        </ul>

        <h2><em><?php _e('RSS'); ?></em></h2>
        <ul class="feeds">
            <li><a href="<?php bloginfo_rss('rss2_url'); ?>"><?php _e('Posts'); ?> (<?php _e('RSS'); ?>)</a></li>
            <li><a href="<?php bloginfo_rss('comments_rss2_url'); ?>"><?php _e('Comments'); ?> (<?php _e('RSS'); ?>)</a></li>
        </ul>

    <?php } ?>


    <?php if (is_single()) { ?>

        <h2><em><?php _e('Calendar'); ?></em></h2>
        <?php get_calendar() ?>

        <h2><em><?php _e('Recent Posts'); ?></em></h2>
        <ul class="posts">
            <?php wp_get_archives('type=postbypost&limit=10'); ?>
        </ul>

    <?php } ?>


    <?php if (is_page() || is_archive() || is_search()) { ?>

                <h2><em><?php _e('Calendar'); ?></em></h2>
                <?php get_calendar() ?>

        <?php if (!is_page('archives')) { ?>

                <h2><em><?php _e('Archives'); ?></em></h2>
                <ul class="months">
                    <?php get_archives('monthly','','','<li>','</li>',''); ?>
                </ul>

        <?php } ?>

                <h2><em><?php _e('Categories'); ?></em></h2>
                <ul class="categories">
                    <?php wp_list_categories('title_li=&hide_empty=0'); ?> 
                </ul>

    <?php } ?>

<?php endif; ?>

            </div>
