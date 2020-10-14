<?php
/**
 * The header for our theme
 *
 * @since 1.0
 * @version 1.0
 */

?>
<?php if  (!crown_has_request_pagination_ajax()): ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	do_action('crown_before_page_wrapper');
	$site_wrapper_classes = apply_filters('crown_site_wrapper_classes', array('site-wrapper'));
	?>
	<!-- Open Wrapper -->
	<div id="site-wrapper" class="<?php echo esc_attr(join(' ', $site_wrapper_classes))?>">
		<?php
		/**
		 * @hooked crown_template_header - 10
		 */
		do_action('crown_before_page_wrapper_content');
		?>
        <?php endif; ?>
        <?php $wrapper_content_classes = apply_filters('crown_wrapper_content_classes',  array('wrapper-content', 'clearfix')); ?>

		<div id="wrapper_content" class="<?php echo esc_attr(join(' ', $wrapper_content_classes))?>">
			<?php
			/**
			 * @hooked  crown_template_wrapper_start - 10
			 */
			do_action('crown_main_wrapper_content_start');
			?>