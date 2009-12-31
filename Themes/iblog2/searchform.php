<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
	<input type="text" value="<?php _e('Search', TDOMAIN);?>" name="s" id="s" onfocus="if (this.value == '<?php _e('Search', TDOMAIN);?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search', TDOMAIN);?>';}" />
	<input class="png_bg" type="submit" id="searchsubmit" value="<?php _e('Go', TDOMAIN);?>" />
</form>
