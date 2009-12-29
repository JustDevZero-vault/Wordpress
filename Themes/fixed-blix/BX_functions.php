<?php
    global $options;
    foreach ($options as $value) {
        if (get_settings( $value['id'] ) === FALSE) {
            global $$value['id'];
            $$value['id'] = $value['std'];
        } else {
            global $$value['id'];
            $$value['id'] = get_settings( $value['id'] );
        }
    }
?>

<?php
/**
 * Function BX_archive
 * ------------------------------------------------------
 * This function is based on WP's built-in get_archives()
 * It outputs the following:
 *
 * <h3><a href="link">Month Year</a></h3>
 * <ul class="postspermonth">
 *     <li><a href="link">Post title</a> (Comment count)</li>
 *     [..]
 * </ul>
 */

function BX_archive()
{
    global $month, $wpdb;
    $now        = current_time('mysql');
    $arcresults = $wpdb->get_results('SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM ' . $wpdb->posts . ' WHERE post_date <\'' . $now . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC");

    if ($arcresults) {
        foreach ($arcresults as $arcresult) {
            $url  = get_month_link($arcresult->year, $arcresult->month);
            $text = sprintf('%s %d', $month[zeroise($arcresult->month,2)], $arcresult->year);
            echo get_archives_link($url, $text, '','<h3>','</h3>');

            $thismonth   = zeroise($arcresult->month,2);
            $thisyear = $arcresult->year;

            $arcresults2 = $wpdb->get_results('SELECT ID, post_date, post_title, comment_status FROM ' . $wpdb->posts . " WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC");

            if ($arcresults2) {
                echo '<ul class="postspermonth">', "\n";
                foreach ($arcresults2 as $arcresult2) {
                    if ($arcresult2->post_date != '0000-00-00 00:00:00') {
                        $url       = get_permalink($arcresult2->ID);
                        $arc_title = $arcresult2->post_title;

                        if ($arc_title) $text = strip_tags($arc_title);
                        else $text = $arcresult2->ID;

                        echo '<li>', get_archives_link($url, $text, '');
                        $comments = mysql_query('SELECT * FROM ' . $wpdb->comments . ' WHERE comment_post_ID=' . $arcresult2->ID);
                        $comments_count = get_comments_number($arcresult2->ID);
                        if ($arcresult2->comment_status == 'open' OR $comments_count > 0) echo '&nbsp;('.$comments_count.')';
                        echo '</li>', "\n";
                    }
                }
                echo '</ul>', "\n";
            }
        }
    }
}


/**
 * Function BX_excluded_pages()
 * ------------------------------------------------
 * Returns the Blix default pages that are excluded
 * from the navigation in the sidebar
 */

function BX_excluded_pages()
{
    $page_paths = array('archives', 'about', 'about_short', 'contact');
    foreach ($page_paths as $page_path) {
        $page = get_page_by_path($page_path);
        if ($page) $exclude .= $page->ID . ',';
    }
    return rtrim($exclude, ',');
}


/**
 * Function BX_shift_down_headlines
 * ------------------------------------------------------
 * Shifts down the headings by one level (<h5> --> </h6>)
 * Used for posts in the archive
 */

function BX_shift_down_headlines($text)
{
    $text = apply_filters('the_content', $text);
    $text = preg_replace('/h5>/','h6>',$text);
    $text = preg_replace('/h4>/','h5>',$text);
    $text = preg_replace('/h3>/','h4>',$text);
    echo $text;
}


/**
 * Function BX_remove_p
 * ---------------------------------------------------
 * Removes the opening <p> and closing </p> from $text
 * Used for the short about text on the front page
 */

function BX_remove_p($text)
{
    $text = apply_filters('the_content', $text);
    $text = preg_replace("/^[\t|\n]?<p>(.*)/","\\1",$text); // opening <p>
    $text = preg_replace("/(.*)<\/p>[\t|\n]$/","\\1",$text); // closing </p>
    return $text;
}

?>
