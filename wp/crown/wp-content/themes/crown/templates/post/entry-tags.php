<?php if (has_tag()): ?>
	<div class="post-tags">
        <label><?php esc_html_e( 'TAGS:', 'crown' ) ?></label>
		<?php the_tags("",","); ?>
	</div>
<?php endif; ?>