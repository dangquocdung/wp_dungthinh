<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" class="searchform" >
	<div class="eunice-searcform">
		<input type="text" name="s" id="s" placeholder="<?php esc_html_e('Search...','eunice'); ?>" />
		<input type="submit" id="searchsubmit" value="" />
		<i class="fa fa-search"></i>
	</div>
</form>