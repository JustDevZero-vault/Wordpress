<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Post Topic <?php } ?> <?php wp_title(); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>"  />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>"  />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<meta name="Theme" content="Coffee Desk" />
<meta name="Author" content="Roam2Rome" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>

<?php wp_head(); ?>


</head>
<body>


<div id="c_wrapper">
<div id="c_container">
<div id="c_header"><div class="content_header">
<div class="rsscoffee"><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Add this blog to any reader'); ?>"><img alt="RSS" src="<?php bloginfo('stylesheet_directory'); ?>/images/rsscoffee.PNG" /></a></div>
<div class="header_logo"><span><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></span>
<p><?php bloginfo('description'); ?></p>
</div>
</div>


<div id="c_navigator">
<div class="navigator">
<ul>
<li><a href="<?php echo get_settings('home'); ?>">Home</a></li>
<?php wp_list_pages('title_li=&depth=1'); ?>
</ul>
</div>
</div>
