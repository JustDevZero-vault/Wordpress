<?php
//Set language folder and load textdomain
if (file_exists(STYLESHEETPATH . '/languages'))
	$language_folder = (STYLESHEETPATH . '/languages');
else
	$language_folder = (TEMPLATEPATH . '/languages');
load_theme_textdomain( 'titan', $language_folder);

//Add support for post thumbnails
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' );

//Redirect to theme options page on activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow ==	"themes.php" )
	wp_redirect( 'themes.php?page=titan-admin.php');

// Required functions
if (is_file(STYLESHEETPATH . '/functions/comments.php'))
	require_once(STYLESHEETPATH . '/functions/comments.php');
else
	require_once(TEMPLATEPATH . '/functions/comments.php');

if (is_file(STYLESHEETPATH . '/functions/titan-extend.php'))
	require_once(STYLESHEETPATH . '/functions/titan-extend.php');
else
	require_once(TEMPLATEPATH . '/functions/titan-extend.php');

// Sidebars
if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Sidebar', 'titan'),
				'id' => 'normal_sidebar',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
		));

if ( function_exists( 'register_sidebar_widget' ))
		register_sidebar(array(
				'name'=> __( 'Footer', 'vigilance'),
				'id' => 'footer_sidebar',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h2 class="widgettitle">',
				'after_title' => '</h2>',
		));
		
// Define your motherfuckin' meta robots tags
function my_mofo_meta_robo() {
	if (is_home())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"index, follow\" />\n"; // HOME PAGE
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // HOME PAGE
	elseif (is_single())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"index, follow\" />\n"; // SINGLE BLOG POSTS
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // SINGLE BLOG POSTS
	elseif (is_page())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"index, follow\" />\n"; // PAGES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // PAGES
	elseif (is_category())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"index, follow\" />\n"; // CATEGORY ARCHIVES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // CATEGORY ARCHIVES
	elseif (is_tag())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, follow\" />\n"; // TAG ARCHIVES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // TAG ARCHIVES
	elseif (is_author())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, follow\" />\n"; // AUTHOR ARCHIVES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // AUTHOR ARCHIVES
	elseif (is_date())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, follow\" />\n"; // DATE ARCHIVES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // DATE ARCHIVES
	elseif (is_search())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, follow\" />\n"; // SEARCH PAGES
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // SEARCH PAGES
	elseif (is_404())
/*
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, follow\" />\n"; // 404 ERROR PAGE
*/
		$mofo_robo = "<meta name=\"robots\" content=\"noindex, nofollow\" />\n"; // 404 ERROR PAGE

	echo $mofo_robo;
}

// Add your motherfuckin' meta robots tag to the <head> section
add_action('wp_head', 'my_mofo_meta_robo');

/*
register_nav_menus(
	array(
		'primary' => __( 'Primary Navigation', 'geeklypower' ),
		)
);
*/

	function wpbeginner_remove_version() {
		return '';
		}
	add_filter('the_generator', 'wpbeginner_remove_version');
	// Add support for editor syling
    function my_new_contactmethods( $contactmethods ) {
		// Add Twitter
		$contactmethods['twitter'] = 'Twitter';
		//add Facebook
		$contactmethods['facebook'] = 'Facebook';
		//add Linkedin
		$contactmethods['linkedin'] = 'Linkedin';
		//add Linkedin
		$contactmethods['github'] = 'Github';
 		//add Identi.ca
/*
		$contactmethods['identica'] = 'Identi.ca';
*/
		return $contactmethods;
    }
    add_filter('user_contactmethods','my_new_contactmethods',10,1);   

?>
