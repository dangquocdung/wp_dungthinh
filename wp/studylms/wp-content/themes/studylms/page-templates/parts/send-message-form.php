<?php
$user = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>
<form id="send-message-instructor" class="send-message-instructor-form" method="post">
	<h4 class="title"><?php esc_html_e('Send Message', 'studylms'); ?></h4>
	<div class="message-res"></div>
	<?php wp_nonce_field('ajax-send-message-instructor-nonce', 'instructor-security'); ?>
	<input id="instructor-email" type="hidden" name="instructor-email" value="<?php echo esc_attr($user->user_email); ?>">
	<div class="form-row form-row-wide">
		<input id="sender-name" type="text" name="name" value="" required aria-required="true" pattern="[a-zA-Z0-9 ]+" placeholder="<?php esc_html_e('Your Name ', 'studylms'); ?>" />
	</div>
	<div class="form-row form-row-wide">
		<input id="sender-email" type="email" name="email" value="" required aria-required="true" placeholder="<?php esc_html_e('Your Email ', 'studylms'); ?>" />
	</div>
	<div class="form-row form-row-wide">
		<input id="sender-subject" type="subject" name="subject" value="" required aria-required="true" pattern="[a-zA-Z0-9 ]+" placeholder="<?php esc_html_e('Subject', 'studylms'); ?>" />
	</div>
	<div class="form-row form-row-wide">
		<textarea id="sender-message" name="message" required aria-required="true" placeholder="<?php echo esc_html__('Your Message ', 'studylms'); ?>"></textarea>
	</div>
	<input class="btn btn-theme btn-sm radius-0 btn-send-message" type="submit" name="instructor-form-submitted" value="<?php esc_html_e('Send Now', 'studylms'); ?>">
</form>