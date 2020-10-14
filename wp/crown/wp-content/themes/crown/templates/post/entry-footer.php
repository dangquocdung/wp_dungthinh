<?php if (!is_singular() || has_tag()): ?>
	<?php $entry_footer_class = is_singular() ? 'entry-footer entry-footer-single' : 'entry-footer'; ?>
	<div class="<?php echo esc_attr($entry_footer_class) ?>">
		<?php if (!is_singular()): ?>
			<p class="link-more">
				<a href="<?php echo esc_url(get_permalink( get_the_ID() ))?>">
					<?php esc_html_e('Continue reading','crown') ?>
				</a>
			</p>
			<?php if ((comments_open() || get_comments_number())): ?>
				<div class="meta-comment">
					<?php comments_popup_link(esc_html__('0 Comments','crown'), esc_html__('1 Comment','crown'), esc_html__('% Comments','crown')) ?>
				</div>
			<?php endif; ?>
		<?php else: ?>
			<?php crown_get_template('post/entry-tags') ?>
		<?php endif; ?>
	</div>
<?php endif; ?>