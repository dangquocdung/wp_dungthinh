<div class="apus-search-form">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		
	  	<div class="input-group">
	  		<input type="text" placeholder="<?php esc_html_e( 'Search', 'studylms' ); ?>" name="s" class="apus-search form-control"/>
			<span class="input-group-btn">
		     	<button type="submit" class="button-search btn"><i class="mn-icon-52"></i></button>
		    </span>
	  	</div>
		<?php if ( defined('EDR_PT_COURSE') && EDR_PT_COURSE ): ?>
			<input type="hidden" name="post_type" value="<?php echo trim(EDR_PT_COURSE); ?>" class="post_type" />
		<?php endif; ?>
	</form>
</div>