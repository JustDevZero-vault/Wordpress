<!DOCTYPE html>
<html>
<head>
<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="top-block">
	<div id="site-title">
	<a href="<?php bloginfo('url'); ?>">
	<?php bloginfo('name'); ?>	
	</a>
	</div>
	<div id="site-slogan">
	<?php bloginfo('description'); ?>
	</div>
	<div id="search-box">
		<form method="get" action="<?php bloginfo('url'); ?>">
		<input type="text" name="s" id="search-input"/><input type="submit" value="" id="search-button"/>
		</form>		
	</div>
</div>
<div id="top-divider">
</div>
<div id="top-nav-container">
	<div id="top-nav-background">
		<ul>
		<li class="page_item"><a href="<?php bloginfo('url'); ?>">Home</a></li>
		<?php wp_list_pages('depth=1&title_li='); ?>
		</ul>	
	</div>
	<div id="date-background">
	<?php echo date("d");?>
	-
	<?print to_roman(date("m"))?>
	-
	<?php echo date("Y");?>
	</div>	
</div>
<div id="main-area">