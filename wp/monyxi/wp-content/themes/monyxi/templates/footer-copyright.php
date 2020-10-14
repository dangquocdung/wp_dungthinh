<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage MONYXI
 * @since MONYXI 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap<?php
				if (!monyxi_is_inherit(monyxi_get_theme_option('copyright_scheme')))
					echo ' scheme_' . esc_attr(monyxi_get_theme_option('copyright_scheme'));
 				?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$monyxi_copyright = monyxi_get_theme_option('copyright');
				if (!empty($monyxi_copyright)) {
					// Replace {{Y}} or {Y} with the current year
					$monyxi_copyright = str_replace(array('{{Y}}', '{Y}'), date('Y'), $monyxi_copyright);
					// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
					$monyxi_copyright = monyxi_prepare_macros($monyxi_copyright);
					// Display copyright
					echo wp_kses(nl2br($monyxi_copyright), 'monyxi_kses_content');
				}
			?></div>
		</div>
	</div>
</div>
