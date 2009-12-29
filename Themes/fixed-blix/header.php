<?php
    require_once get_template_directory()."/BX_functions.php";

    if (!$blix_sidebar && is_page() && get_page_template() != get_template_directory() . '/archives.php') {
        $col_class = ' class="singlecol"';
    } else {
        $col_class = ' class="doublecol"';
    }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <title><?php bloginfo('name'); wp_title(); ?></title>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<?php if ($blix_layout == 'Fixed Width') { ?>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen, projection" />
<?php } else if ($blix_layout == 'Fluid Width') { ?>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style-fluid.css" type="text/css" media="screen, projection" />
<?php } ?>
        <!--[if IE 7]>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" type="text/css" media="screen, projection" />
        <![endif]-->
        <!--[if IE 6]>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css" media="screen, projection" />
        <![endif]-->
        <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
        <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
        <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php /*comments_popup_script(520, 550);*/ ?>
        <?php wp_head();?>
    </head>
    <body>
        <div id="container"<?php echo $col_class; ?>>
            <div id="header">
                <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                <h3><?php bloginfo('description'); ?></h3>
            </div>
            <div id="navigation">
                <ul>
                    <li<?php if (is_front_page()) echo ' class="selected"'; ?>><a href="<?php bloginfo('url'); ?>"><?php _e('Home'); ?></a></li>
<?php
    $param_parent = $blix_navigation_hide_subpages ? '&parent=0' : '';
    if ($blix_navigation_location == 'Sidebar') {
        $include_pages = array('about', 'archives', 'contact');
        $param_include = '&include=';
        foreach ($include_pages as $page) {
            $include_page = get_page_by_path($page);
            if ($include_page != NULL) {
                if ($include_page->ID != get_option('page_on_front')) {
                    $param_include .= $include_page->ID . ',';
                }
            }
        }
        $param_include = rtrim($param_include, ',');
    }
    if ($param_include != '&include=') {
        $pages = get_pages('sort_column=menu_order' . $param_parent . $param_include . '&exclude=' . get_option('page_on_front'));
        foreach ($pages as $page) {
            switch ($page->post_name) {
                case 'archives':
                    (is_page($page->ID) || is_archive() || is_search() || is_single())?$selected = ' class="selected"':$selected='';
                    echo '                    <li', $selected, '><a href="', get_page_link($page->ID), '">', __('Archives'), '</a></li>', "\n";
                    break;
                case 'about':
                    (is_page($page->ID))?$selected = ' class="selected"':$selected='';
                    echo '                    <li', $selected, '><a href="', get_page_link($page->ID),'">', __('About'), '</a></li>', "\n";
                    break;
                case 'contact':
                    (is_page($page->ID))?$selected = ' class="selected"':$selected='';
                    echo '                    <li', $selected, '><a href="', get_page_link($page->ID), '">', __('contact'), '</a></li>', "\n";
                    break;
                case 'about_short':
                    break;
                default:
                    (is_page($page->ID))?$selected = ' class="selected"':$selected='';
                    echo '                    <li', $selected, '><a href="', get_page_link($page->ID), '">', $page->post_title, '</a></li>', "\n";
            }
        }
    }
    $locale = get_locale();
    $search = !$locale || $locale == 'es_ES' ? 'Ve!' : 'Ve!';
?>
                </ul>
                <form action="<?php bloginfo('url'); ?>/" method="get">
                    <fieldset>
                        <input value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
                        <input type="submit" value="<?php _e($search);?>" id="searchbutton" />
                    </fieldset>
                </form>
                <div style="clear:both;"></div>
            </div>
