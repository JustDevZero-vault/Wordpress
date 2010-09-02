<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Geekly_Power
 * @since Geekly Power 1.0
 */
?>

        <div id="primary" class="widget-area" role="complementary">
            <ul class="xoxo">

<?php
    /* When we call the dynamic_sidebar() function, it'll spit out
     * the widgets for that widget area. If it instead returns false,
     * then the sidebar simply doesn't exist, so we'll hard-code in
     * some default sidebar stuff just in case.
     */
    if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
    
            <li id="search-id" class="widget-container widget_search">
                <?php get_search_form(); ?>
            </li>
            <!-- tab navigation (items must be in reverse order because of the tab-design) -->
            <div class="tabbed-content"> <!-- tabbed content -->
            
                <ul class="box-tabs">
                    <li class="popular"><a href="#popular-posts"></a></li>
                    <li class="recentcomm"><a href="#recent-comments"></a></li>
                    <li class="tags"><a href="#popular-tags"></a></li>
                </ul>
            <!--- /tab-nav-->
            
            <!-- tab sections -->
              <div class="sections">
              
                    <div id="popular-posts">
                        <ul class="the-most-popular">
                            <?php $result = $wpdb->get_results("SELECT comment_count,ID,post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , 5"); //cambia este numero a la cantidad de posts que quieras que se muestren
                                foreach ($result as $post) {
                                    setup_postdata($post);
                                    $postid = $post->ID;
                                    $title = $post->post_title;
                                    $commentcount = $post->comment_count;
                                    if ($commentcount != 0) { ?>
                                        <li><a href="<?php echo get_permalink($postid); ?>" title="<?php echo $title; ?>">
                                    <?php echo $title; ?></a> {<?php echo $commentcount; ?>}</li>
                                <?php };?>
                            <?php }; ?>
                        </ul>
                    </div>
                
                    <div id="recent-comments">
                        <?geeklypower_recent_comments();?>
                    </div>
                    
                    <?php if ( function_exists('wp_tag_cloud') ) : ?>
                        <div id="popular-tags"> <!--BEGIN POPULAR TAGS -->
                            <!--<h3 class="widget-title"><?php echo __( 'Tags:'); ?></h3>-->
                            <ul class="the-tags">
                                <?php wp_tag_cloud('smallest=10&largest=15&number=30'); ?>
                            </ul>
                        </div> <!--END POPULAR TAGS -->
                        
                    <?php endif; ?>
                </div> 
                    <div id="lastest-tweets"> <!--BEGIN TWITTER TAB -->
                        <h3 class="widget-title">
                            <a rel="nofollow" href="https://twitter.com/geeklyplanet">
                            <?php _e('Siguenos en Twitter', 'geeklypower');?>
                            </a>
                        </h3>
                        <ul id="twitter_update_list"></ul>
                        <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
                        <script type="text/javascript" src="http://twitter.com/statuses/user_timeline/geeklyplanet.json?callback=twitterCallback2&count=3" ?></script>
                    </div> <!--END TWITTER TAB -->
                    
                
            </div>
        <?php endif; // end primary widget area ?>
            </ul>
        </div><!-- #primary .widget-area -->

<?php
    // A second sidebar for widgets, just because.
    if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

        <div id="secondary" class="widget-area" role="complementary">
            <ul class="xoxo">
                <?php dynamic_sidebar( 'secondary-widget-area' ); ?>
            </ul>
        </div><!-- #secondary .widget-area -->

<?php endif; ?>
