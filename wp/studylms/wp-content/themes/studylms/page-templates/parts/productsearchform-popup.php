<div class="apus-search-form">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		
	  	<div class="input-group">
	  		<input type="text" placeholder="<?php esc_html_e( 'Search', 'studylms' ); ?>" name="s" class="apus-search form-control"/>
			<button class="close-search-form" type="button">
                <i class="mn-icon-4"></i>
            </button>
	  	</div>
		<?php if ( defined('EDR_PT_COURSE') && EDR_PT_COURSE ): ?>
			<input type="hidden" name="post_type" value="<?php echo trim(EDR_PT_COURSE); ?>" class="post_type" />
		<?php endif; ?>
	</form>
</div>