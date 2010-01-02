<div id="sidebars">

<div class="widget_sidebar">

<div class="key_search">
<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p class="aligncenter"><input name="s" type="text" class="s"  value="Search this blog" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><input type="image" class="searchButton" value="Search" src="<?php bloginfo('stylesheet_directory'); ?>/images/searchButton.jpg"/></p>
</form></div>

<?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar() ) : ?>

<div class="div_wrap_sidebar">
<div class="top_sidebar"></div>
<div class="sidebar_content">
<div class="wrap_calendar">
<?php get_calendar(1); ?>
</div></div>
<div class="bottom_sidebar"></div>
</div>

<div class="div_wrap_sidebar">
<div class="top_sidebar"></div>
<div class="sidebar_content">
<h2>Blogroll</h2>
<ul>
<?php get_links(-1, '<li>', '</li>', ' - '); ?>
</ul>
</div><div class="bottom_sidebar"></div>
</div>

<div class="div_wrap_sidebar">
<div class="top_sidebar"></div>
<div class="sidebar_content"><h2>Categories</h2>
<ul>
<?php wp_list_cats('sort_column=name&optioncount=1'); ?>
</ul>
</div><div class="bottom_sidebar"></div>
</div>

<div class="div_wrap_sidebar">
<div class="top_sidebar"></div>
<div class="sidebar_content"><h2>Archives</h2>
<ul>
<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
</ul>
</div><div class="bottom_sidebar"></div>
</div>

<?php endif; ?>

</div>

</div>
