</div>


<div id="c_footer">

<div id="recent_top"></div>
<div id="recent_ctr">
<div class="left_footer">
<h2>Recent Entries</h2>

<ul>
<?php get_archives('postbypost', 10); ?>
</ul>

</div>

<div class="mid_footer">
<h2>Recent Comments</h2>

<ul>
<?php if(function_exists("get_recent_comments")) : ?>
<?php get_recent_comments(); ?>
<?php else : ?>
<?php mw_recent_comments(10, false, 50, 35, 35, 'all', '<li><a href="%permalink%" title="%title%"><b>%author_name%</b></a> in %title%</li>','d.m.y, H:i'); ?>
<?php endif; ?>
</ul>

</div>


<div class="right_footer">
<ul><li><h2>Random Selection of Posts</h2>
    <ul>
 <?php
 $rand_posts = get_posts('numberposts=7&orderby=rand');
 foreach( $rand_posts as $post ) :
 ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
 <?php endforeach; ?>
    </ul>
 </li></ul> 
</div>

</div>
<div id="recent_bottom"></div>
</div>

<div id="footer_bg">
<div id="footer_panel">
<div id="footer_panel_text">
&copy; 2008 <a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a> is proudly powered by <a href="http://wordpress.org">WordPress</a> <br/> Theme designed by <a href="http://roam2rome.com">Roam2Rome</a>
<br/> Theme modified by <a href="http://geeklyplanet.net">Mephiston | Geekly Planet</a> | <a href="http://validator.w3.org/check/referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer&profile=css3&warning=no">CSS3.0</a>
</div>
</div>
</div>

<div id="close_footer"></div>

</div>

<?php wp_footer(); ?>

</div>

</div>

</body>
</html>
