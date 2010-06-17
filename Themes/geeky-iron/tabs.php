		<div class="nav-content">
			<div class="nav-header">
			<span class="subtitle"><?_e('Tags');?></span>
			</div>		
			<?php wp_tag_cloud(); ?>	
		</div>
		<div class="nav-content">
			<div class="nav-header">
			<span class="subtitle"><?_e('Categories');?></span>
			</div>		
			<ul>
			<?php wp_list_cats('sort_column=name&hierarchical=0'); ?>
			</ul>			
		</div>
		<div class="nav-footer">
		</div>
		<div class="nav-content">
			<div class="nav-header">
			<span class="subtitle"><?_e('Archives');?></span>
			</div>
			<br/>
			<select name="archive-dropdown" class="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'>
				<option value="%20"><?php echo attribute_escape(__('Select Month')); ?></option>
			<?php wp_get_archives('type=monthly&format=option&show_post_count=1'); ?>
			</select>
		</div>
		<div class="nav-footer">
		</div>	
		<div class="nav-content">
			<div class="nav-header">
			<span class="subtitle"><?_e('Links');?></span>
			</div>	
			<ul>
			<?php get_links(-1, '<li>', '</li>', 'between', FALSE, 'name', FALSE, FALSE, -1, FALSE); ?>
			</ul>
		</div>
		<div class="nav-footer">
		</div>