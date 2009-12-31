<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php if(is_front_page()) { echo bloginfo('name'); } else { wp_title(''); } ?></title>
<link rel="shortcut icon" href="<?php if (get_option('favicon')):?><?php echo get_option('favicon');?><?php else :?><?php bloginfo('stylesheet_directory'); ?>/favicon.ico<?php endif;?>" type="image/x-icon" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print" />

<?php if(!get_option('pp_nodrag')):?>
<!-- Sidebar docking boxes (dbx) by Brothercake - http://www.brothercake.com/ -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/dbx.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/dbx-key.js"></script>

<?php endif;?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/dbx.css" media="screen, projection" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
<![endif]-->

<!--[if IE 6]>
<script src="<?php bloginfo('stylesheet_directory'); ?>/belatedpng.js"></script>
<script>
  DD_belatedPNG.fix('.png_bg, img, #sidebar ul li, .plimage, .headerimage, .homeimage');
 </script>
<style>
	#header .blogtitle .sheen{display: none; height: 1px;}
</style>
<![endif]-->

<?php if(get_option('plallow') && get_option('pp_linkcolor')):?>
<style>
		a, h1.blogtitle a:hover, .postdata a:hover, h2.posttitle a:hover, tags a:hover,.commentlist cite a, .commentlist cite, #subnav li a:hover, #subnav .current_page_item a, .button:hover, input[type="submit"]:hover,#calendar caption{color: <?php echo get_option('pp_linkcolor'); ?>;}
</style>
<?php endif; ?>

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); wp_head(); ?>
</head>
<body>

<div id="page" class="fix">
	<div id="wrapper" class="fix">
	   <div id="header" class="fix">
			<?php if(get_option('custom-header')):?>
				<a href="<?php echo get_settings('home'); ?>"><img class="headerimage" src="<?php echo get_option('custom-header');?>" alt="<?php bloginfo('name'); ?>"/></a>
			<?php else:?>
		      		<h1 class="blogtitle"><a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></h1>
		      		<div class="description"><?php bloginfo('description'); ?></div>
			<?php endif; ?>
	   </div><!-- /header -->

	<div id="nav" class="fix">
		<ul class="fix">
			<li class="page_item "><a class="home" href="<?php echo get_settings('home'); ?>/" title="<?php _e('Home', TDOMAIN);?>"><img width="18" height="18" class="homeimage" src="<?php bloginfo('stylesheet_directory'); ?>/images/home-icon-trans.png" alt="home"/></a></li>
			<?php 
				$frontpage_id = get_option('page_on_front');
				wp_list_pages('sort_column=menu_order&exclude='.$frontpage_id.'&depth=1&title_li=');?>
		</ul>
		
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
		
	</div><!-- /nav -->

<div id="container" class="fix">
    <div id="left-col">
