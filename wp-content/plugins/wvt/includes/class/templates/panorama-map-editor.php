<?php
/**
 * Jeg Header Builder Frontend Editor
 *
 * @author Jegtheme
 * @since 1.0.0
 * @package jeg-header-element
 */

namespace WVT\template;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php echo __( 'Panorama Editor', 'jhb' ) . ' | ' . get_the_title(); ?></title>
	<?php wp_head(); ?>
	<script>
      var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
	</script>
</head>
<body class="wvt-single-panorama-editor wvt-single-panorama-map-editor">
<?php
	wp_footer();
	/** This action is documented in wp-admin/admin-footer.php */
	do_action( 'admin_print_footer_scripts' );
?>
</body>
</html>
