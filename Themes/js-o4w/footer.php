    <div id="footer">
    	<div id="footer_content" class="encadre">
			<div class="bl"></div>
			<div class="br"></div>
        	<ul>
			<li class="no_bg"><a class="top" href="#"><?php _e('Back to top', 'js-o4w'); ?></a></li>
				<?php wp_list_pages('sort_column=post_title&title_li=&depth=1&')?>
			</ul>
            <p> &copy; <?php _e('Copyright', 'js-o4w'); ?> <?php bloginfo('name');?> <?php echo date('Y');?> | <?php _e('Powered by', 'js-o4w'); ?> <a href="http://wordpress.org">WordPress</a><br/>
			<?php _e('Theme ', 'js-o4w'); ?><?php _e(' designed by ', 'js-o4w'); ?><a href="http://www.saywp.com/">Jinwen</a><?php _e(', valid', 'js-o4w'); ?> <a href="http://jigsaw.w3.org/css-validator/check/referer&profile=css3">CSS 3.0</a> <?php _e('&amp;', 'js-o4w'); ?> <a href="http://validator.w3.org/check?uri=referer">HTML 5.0</a></p>

    	</div> <!--footer content ends-->
    </div> <!--footer ends-->
<?php wp_footer(); ?>

</body></html>