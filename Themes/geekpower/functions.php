<?php
/**
 * GeeklyPower functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, geeklypower_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'geeklypower_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Geekly_Power
 * @since Geekly Power 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 640;

/** Tell WordPress to run geeklypower_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'geeklypower_setup' );

if ( ! function_exists( 'geeklypower_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override geeklypower_setup() in a child theme, add your own geeklypower_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Geekly Power 1.0
 */
function geeklypower_setup() {

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // This theme uses post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain( 'geeklypower', TEMPLATEPATH . '/languages' );

    $locale = get_locale();
    $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );

    // This theme uses wp_nav_menu() in one location.
    

        register_nav_menus(
        array(
            'primary' => __( 'Primary Navigation', 'geeklypower' ),
            'menu-ul-secondary' => __( 'Secondary Navigation', 'geeklypower' ),
            )
        );
        
function my_init_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery','http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
}
    add_action('init','my_init_method');
    
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('unitzNav', get_bloginfo('template_directory')."/js/navigation.js");
    wp_enqueue_script('jquery-ui', "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js");
 
    // This theme allows users to set a custom background
    add_custom_background();

    // Your changeable header business starts here
    define( 'HEADER_TEXTCOLOR', '' );
    // No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
    define( 'HEADER_IMAGE', '%s/images/headers/geeklylogo.jpg' );

    // The height and width of your custom header. You can hook into the theme's own filters to change these values.
    // Add a filter to geeklypower_header_image_width and geeklypower_header_image_height to change these values.
    define( 'HEADER_IMAGE_WIDTH', apply_filters( 'geeklypower_header_image_width', 417 ) );
    define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'geeklypower_header_image_height', 100 ) );

    // We'll be using post thumbnails for custom header images on posts and pages.
    // We want them to be 940 pixels wide by 198 pixels tall.
    // Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
    set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

    // Don't support text inside the header image.
    define( 'NO_HEADER_TEXT', true );

    // Add a way for the custom header to be styled in the admin panel that controls
    // custom headers. See geeklypower_admin_header_style(), below.
    add_custom_image_header( '', 'geeklypower_admin_header_style' );

    // ... and thus ends the changeable header business.

    // Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
    register_default_headers( array(
        'berries' => array(
            'url' => '%s/images/headers/berries.jpg',
            'thumbnail_url' => '%s/images/headers/berries-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Berries', 'geeklypower' )
        ),
        'cherryblossom' => array(
            'url' => '%s/images/headers/cherryblossoms.jpg',
            'thumbnail_url' => '%s/images/headers/cherryblossoms-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Cherry Blossoms', 'geeklypower' )
        ),
        'concave' => array(
            'url' => '%s/images/headers/concave.jpg',
            'thumbnail_url' => '%s/images/headers/concave-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Concave', 'geeklypower' )
        ),
        'fern' => array(
            'url' => '%s/images/headers/fern.jpg',
            'thumbnail_url' => '%s/images/headers/fern-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Fern', 'geeklypower' )
        ),
        'forestfloor' => array(
            'url' => '%s/images/headers/forestfloor.jpg',
            'thumbnail_url' => '%s/images/headers/forestfloor-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Forest Floor', 'geeklypower' )
        ),
        'inkwell' => array(
            'url' => '%s/images/headers/inkwell.jpg',
            'thumbnail_url' => '%s/images/headers/inkwell-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Inkwell', 'geeklypower' )
        ),
        'geeklylogo' => array(
            'url' => '%s/images/headers/geeklylogo.jpg',
            'thumbnail_url' => '%s/images/headers/geeklylogo-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'GeeklyLogo', 'geeklypower' )
        ),
        'path' => array(
            'url' => '%s/images/headers/path.jpg',
            'thumbnail_url' => '%s/images/headers/path-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Path', 'geeklypower' )
        ),
        'sunset' => array(
            'url' => '%s/images/headers/sunset.jpg',
            'thumbnail_url' => '%s/images/headers/sunset-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Sunset', 'geeklypower' )
        )
    ) );
}
endif;

if ( ! function_exists( 'geeklypower_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in geeklypower_setup().
 *
 * @since Geekly Power 1.0
 */
function geeklypower_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
    border-bottom: 1px solid #000;
    border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
    #headimg #name { }
    #headimg #desc { }
*/
</style>
<?php
}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Geekly Power 1.0
 */
function geeklypower_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'geeklypower_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Geekly Power 1.0
 * @return int
 */
function geeklypower_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'geeklypower_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Geekly Power 1.0
 * @return string "Continue Reading" link
 */
function geeklypower_continue_reading_link() {
    return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'geeklypower' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and geeklypower_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Geekly Power 1.0
 * @return string An ellipsis
 */
function geeklypower_auto_excerpt_more( $more ) {
    return ' &hellip;' . geeklypower_continue_reading_link();
}
add_filter( 'excerpt_more', 'geeklypower_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Geekly Power 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function geeklypower_custom_excerpt_more( $output ) {
    if ( has_excerpt() && ! is_attachment() ) {
        $output .= geeklypower_continue_reading_link();
    }
    return $output;
}
add_filter( 'get_the_excerpt', 'geeklypower_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Geekly Power's style.css.
 *
 * @since Geekly Power 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function geeklypower_remove_gallery_css( $css ) {
    return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'geeklypower_remove_gallery_css' );

if ( ! function_exists( 'geeklypower_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own geeklypower_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Geekly Power 1.0
 */
 
 function related_posts_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'limit' => '5',
        ), $atts));

    global $wpdb, $post, $table_prefix;

    if ($post->ID) {
        $retval = '<ul>';
        // Get tags
        $tags = wp_get_post_tags($post->ID);
        $tagsarray = array();
        foreach ($tags as $tag) {
            $tagsarray[] = $tag->term_id;
        }
        $tagslist = implode(',', $tagsarray);

        // Do the query
        $q = "SELECT p.*, count(tr.object_id) as count
        FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
        AND p.post_status = 'publish'
        AND p.post_date_gmt < NOW()
        GROUP BY tr.object_id
        ORDER BY count DESC, p.post_date_gmt DESC
        LIMIT $limit;";

        $related = $wpdb->get_results($q);
        if ( $related ) {
            foreach($related as $r) {
            $retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
            }
        } else {
            $retval .= '<li>No related posts found</li>';
        }
        $retval .= '</ul>';
        return $retval;
        }
        return;
}
add_shortcode('related_posts', 'related_posts_shortcode');

function geeklypower_recent_comments($attrs){
    global $wpdb;
    $sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,30) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 10";

    $comments = $wpdb->get_results($sql);
    $output = $pre_HTML;
    $output .= "\n<ul>";
    foreach ($comments as $comment) {
    $output .= "\n<li>".strip_tags($comment->comment_author) .":" . "<a href=\"" . get_permalink($comment->ID)."#comment-" . $comment->comment_ID . "\" title=\"on ".$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";
    }
    $output .= "\n</ul>";
    $output .= $post_HTML;
    echo $output;
}

function geeklypower_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case '' :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 40 ); ?>
            <?php printf( __( '%s <span class="says">says:</span>', 'geeklypower' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em><?php _e( 'Your comment is awaiting moderation.', 'geeklypower' ); ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
            <?php
                /* translators: 1: date, 2: time */
                printf( __( '%1$s at %2$s', 'geeklypower' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'geeklypower' ), ' ' );
            ?>
        </div><!-- .comment-meta .commentmetadata -->

        <div class="comment-body"><?php comment_text(); ?></div>

        <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
    </div><!-- #comment-##  -->

    <?php
            break;
        case 'pingback'  :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'geeklypower' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'geeklypower'), ' ' ); ?></p>
    <?php
            break;
    endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override geeklypower_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Geekly Power 1.0
 * @uses register_sidebar
 */
function geeklypower_widgets_init() {
    // Area 1, located at the top of the sidebar.
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'geeklypower' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
    register_sidebar( array(
        'name' => __( 'Secondary Widget Area', 'geeklypower' ),
        'id' => 'secondary-widget-area',
        'description' => __( 'The secondary widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 3, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'First Footer Widget Area', 'geeklypower' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 4, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Second Footer Widget Area', 'geeklypower' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 5, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Third Footer Widget Area', 'geeklypower' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );

    // Area 6, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Fourth Footer Widget Area', 'geeklypower' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'geeklypower' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
/** Register sidebars by running geeklypower_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'geeklypower_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Geekly Power 1.0
 */
function geeklypower_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'geeklypower_remove_recent_comments_style' );

if ( ! function_exists( 'geeklypower_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Geekly Power 1.0
 */
function geeklypower_posted_on() {
    printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'geeklypower' ),
        'meta-prep meta-prep-author',
        sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
            get_permalink(),
            esc_attr( get_the_time() ),
            get_the_date()
        ),
        sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
            get_author_posts_url( get_the_author_meta( 'ID' ) ),
            sprintf( esc_attr__( 'View all posts by %s', 'geeklypower' ), get_the_author() ),
            get_the_author()
        )
    );
}
endif;

if ( ! function_exists( 'geeklypower_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Geekly Power 1.0
 */
function geeklypower_posted_in() {
    // Retrieves tag list of current post, separated by commas.
    $tag_list = get_the_tag_list( '', ', ' );
    if ( $tag_list ) {
        $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'geeklypower' );
    } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
        $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'geeklypower' );
    } else {
        $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'geeklypower' );
    }
    // Prints the string, replacing the placeholders.
    printf(
        $posted_in,
        get_the_category_list( ', ' ),
        $tag_list,
        get_permalink(),
        the_title_attribute( 'echo=0' )
    );
}
endif;
