<div id="sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) { ?>
	        <?php include (TEMPLATEPATH . '/tabs.php'); ?>
	        <?}?>
</div>
