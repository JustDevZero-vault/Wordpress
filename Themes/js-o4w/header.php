<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
 <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
 <title><?php if (is_single() || is_page() || is_archive()) : ?><?php wp_title('',true); ?> | <?php bloginfo('name'); ?><?php else : ?><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?><?php endif; ?></title>
 <?php if(is_single()){?>
 <link rel="canonical" href="<?php echo get_permalink($post->ID);?>" />
 <?php } ?>

 <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
 <link title="RSS 2.0" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" rel="alternate" />
 <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
 <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
 <?php wp_head(); ?>	
</head>
<body>

<div id="wrapper" class="encadre">
	<div class="tl"></div>
	<div class="tr"></div>

    	<div id="header">
        </div> <!--header ends-->
		<div id="headerlogo">
		<a href="<?php echo get_settings('home') ?>/" id="logo" title="<?php bloginfo('name'); ?>" class="replace"><span><?php bloginfo('name'); ?></span></a>
		
		
        <form id="search_form" method="get" action="<?php bloginfo('home') ?>">
        	<p><input id="s" name="s" type="text" size="21" value="<?php _e('Type your word here...', 'js-o4w'); ?>" onfocus="if (this.value == '<?php _e('Type your word here...', 'js-o4w'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Type your word here...', 'js-o4w'); ?>';}" />
            	<input type="submit" id="submit-s" value="" /></p>
        </form> <!--form ends-->
</div>
        <div id="banner">
        </div> <!--banner ends-->
        
        <div id="navigation">
        	<ul>
				<?php if (is_home() ) : ?>
				<li class="home active"><a href="#"><?php _e('Home', 'js-o4w'); ?></a></li>
				<?php else : ?>
				<li class="home"><a href="<?php echo get_settings('home') ?>"><?php _e('Home', 'js-o4w'); ?></a></li>
				<?php endif; ?>
				<?php wp_list_pages('sort_column=post_title&title_li=&depth=1&')?>
        	</ul>
        </div> <!--navigation ends-->