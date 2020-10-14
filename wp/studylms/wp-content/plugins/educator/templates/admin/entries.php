<?php
if ( ! defined( 'ABSPATH' ) ) exit();

$entries_table = new Edr_Admin_EntriesTable();
$entries_table->prepare_items();
?>

<div class="wrap">
	<h2>
		<?php _e( 'Educator Entries', 'educator' ); ?>
		<?php if ( current_user_can( 'manage_educator' ) ) : ?>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=edr_admin_entries&edr-action=edit-entry' ) ); ?>" class="add-new-h2"><?php _e( 'Add New', 'educator' ); ?></a>
		<?php endif; ?>
	</h2>

	<?php $entries_table->display_entry_filters(); ?>

	<form method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=edr_admin_entries' ) ); ?>">
		<?php $entries_table->display(); ?>
	</form>
</div>

<script>
	(function($) {
		$('table.entries').on('click', 'a.delete-entry', function(e) {
			if (!confirm('<?php _e( 'Are you sure you want to delete this item?', 'educator' ); ?>')) {
				e.preventDefault();
			}
		});
	})(jQuery);
</script>
