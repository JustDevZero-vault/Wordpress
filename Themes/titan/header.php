<?php global $titan; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php if ( is_front_page() ) : ?>
		<title><?php bloginfo( 'name'); ?></title>
	<?php elseif ( is_404() ) : ?>
		<title><?php _e( 'Page Not Found |', 'titan' ); ?> | <?php bloginfo( 'name'); ?></title>
	<?php elseif ( is_search() ) : ?>
		<title><?php printf(__ ("Search results for '%s'", "titan"), attribute_escape(get_search_query())); ?> | <?php bloginfo( 'name'); ?></title>
	<?php else : ?>
		<title><?php wp_title($sep = ''); ?> | <?php bloginfo( 'name');?></title>
	<?php endif; ?>
	
	<!-- Basical relation data-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<!-- Basic Meta Data -->
	<meta charset="<?php bloginfo( 'charset'); ?>" />

	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory'); ?>/images/favicon.ico" />

	<!--Stylesheets-->
	<link href="<?php bloginfo( 'stylesheet_url'); ?>" type="text/css" media="screen" rel="stylesheet" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo( 'template_url'); ?>/stylesheets/ie.css" />
	<![endif]-->

	<!--Scripts-->
	<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 7]>
		<script type="text/javascript">
			alert("Estas usando una versión anterior a IE6.\n Por favor, actualiza a una versión reciente.\n También puedes instalar un navegador en Geekly Planet, recomentamos, Mozilla Firefox el cual lo puedes opterner en http://www.mozilla-europe.org/es/firefox/");
		</script>
	<![endif]-->
	<!--[if lte IE 7]>
		<script type="text/javascript">
			sfHover=function(){var sfEls=document.getElementById("nav").getElementsByTagName("LI");for(var i=0;i<sfEls.length;i++){sfEls[i].onmouseover=function(){this.className+=" sfhover";}
			sfEls[i].onmouseout=function(){this.className=this.className.replace(new RegExp(" sfhover\\b"),"");}}}
			if (window.attachEvent)window.attachEvent("onload",sfHover);
		</script>
	<![endif]-->

	<!--WordPress-->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name'); ?> RSS Feed" href="<?php bloginfo( 'rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url'); ?>" />

	<!--WP Hook-->
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="skip-content"><a href="#content">Skip to content</a></div>
	<div id="header" class="clear">
		<div id="follow">
			<div class="wrapper clear">
				<dl>
					<dt><?php _e( 'Follow:', 'titan' ); ?></dt>
					<dd><a class="rss" href="<?php bloginfo( 'rss2_url'); ?>"><?php _e( 'RSS', 'titan' ); ?></a></dd>
					<?php if ($titan->emailToggle() == 'true' ): else : ?>
					 <dd><a class="email" href="<?php if ($titan->feedEmail() !== '' )echo $titan->feedEmail(); else echo "#"; ?>"><?php _e( 'Email', 'titan' ); ?></a></dd>
					<?php endif; ?>
					<?php if ($titan->twitterToggle() == 'true' ): else : ?>
					 <dd><a class="twitter" href="<?php if ($titan->twitter() !== '' )echo $titan->twitter(); else echo "#"; ?>"><?php _e( 'Twitter', 'titan' ); ?></a></dd>
					<?php endif; ?>
				</dl>
			</div><!--end wrapper-->
		</div><!--end follow-->
		<div class="wrapper">
			<?php if (is_home()) echo( '<h1 id="title">'); else echo( '<div id="title">');?><a href="<?php bloginfo( 'url'); ?>"><?php bloginfo( 'name'); ?></a><?php if (is_home()) echo( '</h1>'); else echo( '</div>');?>
			<div id="description">
				<?php bloginfo( 'description'); ?>
			</div><!--end description-->
		<div id="footer-search" class="footer-column">
			<?php if (is_file(STYLESHEETPATH . '/searchform.php')) include (STYLESHEETPATH . '/searchform.php'); else include(TEMPLATEPATH . '/searchform.php'); ?>
		</div>
			<div id="navigation">
				<ul id="nav">
					<li class="page_item <?php if (is_front_page()) echo( 'current_page_item');?>"><a href="<?php bloginfo( 'url'); ?>"><?php _e( 'Home', 'titan' ); ?></a></li>
					<?php if ($titan->hidePages() !== 'true' ): ?>
						<?php wp_list_pages( 'title_li=' ); ?>
					<?php endif; ?>
					<?php if ($titan->hideCategories() != 'true' ): ?>
						<?php wp_list_categories( 'title_li=' ); ?>
					<?php endif; ?>
				</ul>
			</div><!--end navigation-->
		</div><!--end wrapper-->
	</div><!--end header-->
<div class="content-background">
	<div class="wrapper">
		<div class="notice"></div>
		<div id="content">
