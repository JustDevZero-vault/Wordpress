<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div class="nav-content">',
        'after_widget' => '</div><div class="nav-footer"></div>',
        'before_title' => '<div class="nav-header"><span class="subtitle">',
        'after_title' => '</span></div>',
    ));
?>
<?php
function wp_list_recent_posts( $iAmount = 5, $szCat = null, $szBefore = "<li>", $szAfter = "</li>" )
{
	( $szCat != null ) ? $szCat = "&cat=" . $szCat : $szCat ;
	$aRecentPosts = new WP_Query( "showposts=" . $iAmount . $szCat );
	while($aRecentPosts->have_posts()) : $aRecentPosts->the_post();
	$szReturn .= $szBefore . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . $szAfter;
	endwhile;
	echo $szReturn;
}

function shorten_text( $iChars = 250, $szTail = "...", $bPrint = true ) 
{ 
	global $post;
	$szText = strip_tags( trim( $post->post_content ) );
    $szText = substr( $szText, 0, $iChars );
    $szText = substr( $szText, 0, strrpos( $szText , ' ' ) ) . $szTail;
	apply_filters('the_excerpt', $szText);
    if ( $bPrint == true ) echo $szText; else return $szText;
}

function highlight_comment( $szAuthClass = "autor-comment", $iUserID = 1 )
{
	global $comment;
	$szAuthComment = ( $comment->user_id == $iUserID ) ? $szAuthClass : null;
	echo $szAuthComment;
}

function display_copyright( $iYear = null, $szSeparator = " - ", $szTail = '. All rights reserved.' ) 
{
	echo '<div id="copyright">' . display_years( $iYear, $szSeparator, false ) . ' &copy; ' . get_bloginfo('name') . $szTail . '</div>';   
}

function display_ccbysa( $iYear = null, $szSeparator = " - ", $szTail = '. All rights reserved.' ) 
{
	echo '<div id="copyright">' . display_years( $iYear, $szSeparator, false ) . '<img src="http://www.mati.unam.mx/images/stories/imagenes_articulos/art_80/atribucion.jpg" /> <img src="http://www.mati.unam.mx/images/stories/imagenes_articulos/art_80/compartirigual.gif"/>' . get_bloginfo('name') . $szTail . '</div>';   
}

function display_years( $iYear = null, $szSeparator = " - ", $bPrint = true )
{	
	$iCurrentYear = ( date( "Y" ) );	
	if ( is_int( $iYear ) ) 
	{	
		$iYear = ( $iCurrentYear > $iYear ) ? $iYear = $iYear . $szSeparator . $iCurrentYear : $iYear;	
	} else {
		$iYear = $iCurrentYear;
	}
	if ( $bPrint == true ) echo $iYear; else return $iYear;
}


function to_roman($num) {
if ($num <0 || $num >9999) {return -1;}
$r_ones = array(1=>"I", 2=>"II", 3=>"III", 4=>"IV", 5=>"V", 6=>"VI", 7=>"VII", 8=>"VIII",
9=>"IX");
$r_tens = array(1=>"X", 2=>"XX", 3=>"XXX", 4=>"XL", 5=>"L", 6=>"LX", 7=>"LXX",
8=>"LXXX", 9=>"XC");
$r_hund = array(1=>"C", 2=>"CC", 3=>"CCC", 4=>"CD", 5=>"D", 6=>"DC", 7=>"DCC",
8=>"DCCC", 9=>"CM");
$r_thou = array(1=>"M", 2=>"MM", 3=>"MMM", 4=>"MMMM", 5=>"MMMMM", 6=>"MMMMMM",
7=>"MMMMMMM", 8=>"MMMMMMMM", 9=>"MMMMMMMMM");
$ones = $num % 10;
$tens = ($num - $ones) % 100;
$hundreds = ($num - $tens - $ones) % 1000;
$thou = ($num - $hundreds - $tens - $ones) % 10000;
$tens = $tens / 10;
$hundreds = $hundreds / 100;
$thou = $thou / 1000;
if ($thou) {$rnum .= $r_thou[$thou];}
if ($hundreds) {$rnum .= $r_hund[$hundreds];}
if ($tens) {$rnum .= $r_tens[$tens];}
if ($ones) {$rnum .= $r_ones[$ones];}
return $rnum;
}

function insertAds($content) {
    $content = $content.'<hr /><a href="http://google.es">Have you googled today?</a><hr />';
    return $content;
}
//add_filter('the_excerpt_rss', 'insertAds'); uncomment this files for showing ads in the rss
//add_filter('the_content_rss', 'insertAds');


function myFilter($query) {
    if ($query->is_feed) {
        $query->set('cat','-5'); 
    }
return $query;
}

//add_filter('pre_get_posts','myFilter');//Uncoment this files for filtering cat, ID from the feed


function publish_later_on_feed($where) {
	global $wpdb;
	if ( is_feed() ) {
		// timestamp in WP-format
		$now = gmdate('Y-m-d H:i:s');
		// value for wait; + device
		$wait = '5'; // integer
		// http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
		$device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR
		// add SQL-sytax to default $where
		$where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
	} return $where;
}
add_filter('posts_where', 'publish_later_on_feed');
?>