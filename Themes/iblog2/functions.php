<?php
add_option('plallow', true);
define('THEMENAME', 'iBlog2');

// THEME WP OPTIONS
	if (function_exists( 'add_theme_support' )) add_theme_support('post-thumbnails');


// LOCALIZATION
	define('TDOMAIN', 'iBlog');
	load_theme_textdomain(TDOMAIN);

if ( function_exists('register_sidebar') ){
    register_sidebar( array(
        'before_widget' => '<!--sidebox start --><div id="%1$s" class="dbx-box %2$s">',
        'after_widget' => '&nbsp;</div></div><!--sidebox end -->',
        'before_title' => '<h3 class="dbx-handle">',
        'after_title' => '&nbsp;</h3><div class="dbx-content">',
    ));
}
?><?php function widget_iblog_search() {
?><?php
}
if ( function_exists('register_sidebar_widget') )
    register_sidebar_widget(__('Search'), 'widget_iblog_search');
?><?php function widget_iblog_meta() { ?>
	<!--sidebox start -->
	<div id="meta" class="dbx-box">
	  <h3 class="dbx-handle"><?php _e('Meta', TDOMAIN);?></h3>
	  <div class="dbx-content">
	    <ul>
			<?php wp_register(); ?>
			<li class="login"><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
	        <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><?php _e('Entries (RSS)', TDOMAIN);?></a></li>
	        <li class="rss"><a href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comments (RSS)', TDOMAIN);?></a></li>
			<li class="wordpress"><a href="http://www.wordpress.org" title="<?php _e('Powered by WordPress', TDOMAIN);?>">WordPress</a></li>

	    </ul>
	  </div>
	</div>
	<!--sidebox end -->
<?php } if ( function_exists('register_sidebar_widget') ) register_sidebar_widget(__('Meta', TDOMAIN), 'widget_iblog_meta'); 
?><?php function widget_iblog_links() { ?>
	<!--sidebox start -->
	<div id="links" class="dbx-box">
	  <h3 class="dbx-handle"><?php _e('Links', TDOMAIN); ?></h3>
	  <div class="dbx-content">
	      <?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
	  </div>
	</div>
	<!--sidebox end -->
<?php } if ( function_exists('register_sidebar_widget') ) register_sidebar_widget(__('Links', TDOMAIN), 'widget_iblog_links');

if($_GET['activated']){
	$linkno = rand(1,3);
	if($linkno == 1){update_option('pllink', 'http://www.pagelines.com');	add_option('pltext', 'professional wordpress themes');
	}else{	update_option('pllink', 'http://www.pagelines.com');	add_option('pltext', 'professional website themes'); }
}

add_action('admin_menu', 'add_option_interface');
function add_option_interface() { add_theme_page(THEMENAME.' Options', THEMENAME.' Options', '8', 'optionpage', 'editoptions'); }

?><?php function editoptions() { ?>	
<form method="post" action="options.php">
  <div class='wrap'>
		<div id="" class="ui-tabs-panel" style="display: block;">
			<h2><?php echo THEMENAME;?> Options</h2>
			<table class="form-table">
				<tbody>
				 <?php wp_nonce_field('update-options'); ?>
					<?php if($_GET['updated']=='true'):?>
							<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">
								<p>	<strong>Options Saved.</strong></p>
							</div>
					<?php endif;?>
					<?php if(floatval(phpversion()) < 5.0):?>
						<div id="message" class="updated fade" style="background-color: rgb(255, 251, 204);">	
						<p><strong>You are using PHP version <?php echo phpversion(); ?>.</strong>  Version 5 or higher is recommended for this theme to perform as well as possible.</p>  <p>Please check with your host about upgrading to a newer version.</p> 
						</div>
					<?php endif;?>
				<p><a href="http://www.pagelines.com/themes/iblogpro" title="iBlogPro"><img alt="iBlogPro Pro Theme" src="<?php bloginfo('stylesheet_directory'); ?>/images/iblogpro.png" class="alignright"/></a>Welcome to <?php echo THEMENAME;?> Options. We hope your enjoying this free theme from <a href="http://www.pagelines.com">PageLines</a>.<br/> If you would like more CMS features, a pro options framework, a <strong>matching BBPress forum</strong> and additional support, please visit our site to learn about <a href="http://www.pagelines.com/themes/iblogpro">iBlogPro</a>.</p>
				<p>This section allows you to customize your header and favicon image.<br/> If you would like to use <strong>custom</strong> images you will need to have their direct URL addresses available.</p>
				
				<table class="form-table">
					<tbody>
				
						<tr valign="middle">
							<th scopt="row"><strong>Site Logo or Header</strong><br/><small>Input Full URL to your custom header or logo image (replaces text).</small></th>
							<td><input class="regular-text" type="text" name="custom-header" value="<?php echo get_option('custom-header'); ?>" />
								<span class="setting-description">Optional way to replace 'heading' and 'description' text for your website with an image.</span>
								<?php if(get_option('custom-header')):?>
									<p><img src="<?php echo get_option('custom-header');?>" style="width:200px; "/></p>
								<?php endif;?>
							</td>
						</tr>
						<tr valign="middle">
							<th scopt="row"><strong>Favicon Image</strong><br/><small>Input Full URL to Favicon</small></th>
							<td><input class="regular-text" type="text" name="favicon" value="<?php echo get_option('favicon'); ?>" />
								<span class="setting-description">Enter the full URL location of your custom 'favicon' which is visible in browser favorites and tabs.</span>
							</td>
						</tr>
					
						<tr valign="middle">
							<th scopt="row">
								<strong>Easy Analytics</strong><br/><small>Adds analytics script to your footer</small>
							</th>
							<td valign="middle">
								
								<p>
									<label for="">This is the easiest way to add an analytics script for a service like <a href="http://www.google.com/analytics">Google Analytics</a> to your footer. Simply add your script here and <?php echo THEMENAME;?> will load your analytics script dynamically.</label><br/>
									<textarea name="pp_analytics" cols="50" rows="5"><?php echo get_option('pp_analytics'); ?></textarea>
										<span class="setting-description"></span>
								</p>
							</td>
						</tr>
						<tr valign="middle">
							<th scopt="row">
								<strong>Layout Options</strong>
							</th>
							<td valign="middle">
								<div class="additional" style="<?php if(!get_option('plallow')):?>display:none;<?php endif;?>border-top: 1px solid #ccc; border-bottom: 1px solid #bbb; background: #eee;padding: 10px 2em; ">
									<p>
										<label for=""><strong>Welcome Message</strong> <small>(Placed above sidebar. Format with HTML)</small></label><br/>
										<textarea name="pp_welcomemessage" cols="50" rows="5"><?php echo get_option('pp_welcomemessage'); ?></textarea>
											<span class="setting-description"></span>
									</p>
									<p>
										<label><input class="admin_checkbox" type="checkbox" name="pp_showauthor" <?php if(get_option('pp_showauthor')): echo 'checked'; else: echo 'unchecked'; endif;?> /><strong> Show author on posts?</strong></label>
									</p>
									<p>
										<label><input class="admin_checkbox" type="checkbox" name="pagecomments" <?php if(get_option('pagecomments')):
										echo 'checked'; else: echo 'unchecked'; endif;?> /><strong> Allow comments on pages?</strong></label>
									</p>
									<p>
										<label><input class="admin_checkbox" type="checkbox" name="pp_showfootnav" <?php if(get_option('pp_showfootnav')): echo 'checked'; else: echo 'unchecked'; endif;?> /><strong> Show footer navigation?</strong></label>
									</p>
									<p>
										<label><input class="admin_checkbox" type="checkbox" name="pp_pagetitle" <?php if(get_option('pp_pagetitle')): echo 'checked'; else: echo 'unchecked'; endif;?> /><strong> Show page title on pages?</strong></label>
									</p>
									<p>
										<label><strong>Color of links (Hex Code): </strong></label><input id="bgcolor" size="7"  type="text" name="pp_linkcolor" value="<?php echo get_option('pp_linkcolor'); ?>" /><span class="setting-description"> <small><em>Example</em>: #000000 for black, default is #0088CC</small></span>
									</p>
									<p>
										<label><input class="admin_checkbox" type="checkbox" name="pp_nodrag" <?php if(get_option('pp_nodrag')): echo 'checked'; else: echo 'unchecked'; endif;?> /><strong> Disable drag and drop widgets in sidebar?</strong></label>
									</p>
									
								</div>
							</td>
						</tr>
						<tr valign="middle">
							<th scopt="row"><strong>Questions?</strong></th>
							<td>								
								<p>If you would like to become a <a href="http://www.pagelines.com/partners" target="_blank">partner</a>, have any questions about <a href="http://www.pagelines.com/themes" target="_blank">our products</a> or would like to learn more about what we are working on, visit us at <a href="http://www.pagelines.com" alt="pagelines">PageLines.com</a>.</p>
							</td>
							
						</tr>
						
					</tbody>
				</table>
		
			
			
			 <input type="hidden" name="action" value="update" />
			 <input type="hidden" name="page_options" value="favicon, custom-header,pagecomments,  pp_welcomemessage, pp_linkcolor, pp_showauthor, pp_showfootnav, pp_pagetitle, pp_analytics, pp_nodrag" />
			 <p><input class="button-primary" type="submit" name="Submit" value="Update Options" /></p>
		</div>	
  </div>
</form>
<?php } ?>
