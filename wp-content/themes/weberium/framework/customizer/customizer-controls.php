<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// HR control for the customizer
class Weberium_Customizer_Hr_Control extends WP_Customize_Control {
	public $type = 'hr';
	public function render_content() {
		echo '<hr />';
	}
}

// Heading control for the customizer
class Weberium_Customizer_Heading_Control extends WP_Customize_Control {
	public $type = 'weberium-heading';
	public function render_content() {
		echo '<span class="weberium-customizer-heading">' . esc_html( $this->label ) . '</span>';
	}
}

// Textarea control for the customizer
class Weberium_Customizer_Textarea_Control extends WP_Customize_Control {
	public $type = 'weberium_textarea';
	public $rows = '8';
	public function render_content() { ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) :
				echo '<span class="description customize-control-description">'. $this->description. '</span>'; ?>
			<?php endif; ?>
			<textarea rows="<?php echo intval( $this->rows ); ?>" <?php $this->link(); ?> style="width:100%;"><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	<?php }
}

// Multiple check customize control class.
class Weberium_Customize_Multicheck_Control extends WP_Customize_Control {
	public $description = '';
	public $subtitle = '';
	private static $firstLoad = true;
	// Since theme_mod cannot handle multichecks, we will do it with some JS
	public function render_content() {
		// the saved value is an array. convert it to csv
		if ( is_array( $this->value() ) ) {
			$savedValueCSV = implode( ',', $this->value() );
			$values = $this->value();
		} else {
			$savedValueCSV = $this->value();
			$values = explode( ',', $this->value() );
		}
		if ( self::$firstLoad ) {
			self::$firstLoad = false;
			?>
			<script>
			jQuery(document).ready( function($) {
				"use strict";
				$( 'input.tf-multicheck' ).change( function(event) {
					event.preventDefault();
					var csv = '';
					$( this ).parents( 'li:eq(0)' ).find( 'input[type=checkbox]' ).each( function() {
						if ($( this ).is( ':checked' )) {
							csv += $( this ).attr( 'value' ) + ',';
						}
					} );
					csv = csv.replace(/,+$/, "");
					$( this ).parents( 'li:eq(0)' ).find( 'input[type=hidden]' ).val(csv)
					// we need to trigger the field afterwards to enable the save button
					.trigger( 'change' );
					return true;
				} );
			} );
			</script>
			<?php
		} ?>
		<label class='tf-multicheck-container'>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
				<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
					<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
				<?php } ?>
			</span>
			<?php if ( '' != $this->subtitle ) :
				echo '<div class="customizer-subtitle">'. $this->subtitle .'</div>'; ?>
			<?php endif; ?>
			<?php
			foreach ( $this->choices as $value => $label ) {
				printf( '<label for="%s"><input class="tf-multicheck" id="%s" type="checkbox" value="%s" %s/> %s</label><br>',
					$this->id . $value,
					$this->id . $value,
					esc_attr( $value ),
					checked( in_array( $value, $values ), true, false ),
					$label
				);
			}
			?>
			<input type="hidden" value="<?php echo esc_attr( $savedValueCSV ); ?>" <?php $this->link(); ?> />
		</label>
		<?php
	}
}

// Sorter Control
class Weberium_Customize_Control_Sorter extends WP_Customize_Control {

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-sortable' );
	}

	public function render_content() { ?>
		<div class="weberium-sortable">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( '' != $this->description ) {
					echo '<span class="description customize-control-description">'. $this->description .'</span>'; ?>
				<?php } ?>
			</label>
			<?php
			// Get values and choices
			$choices = $this->choices;
			$values  = $this->value();
			// Turn values into array
			if ( ! is_array( $values ) ) {
				$values = explode( ',', $values );
			}
			echo '<ul id="'. $this->id .'_sortable">'; ?>
				<?php
				// Loop through values
				foreach ( $values as $val ) :
					// Get label
					$label = isset( $choices[$val] ) ? $choices[$val] : '';
					if ( $label ) : ?>
						<li data-value="<?php echo esc_attr( $val ); ?>" class="weberium-sortable-li">
							<?php echo esc_html( $label ); ?>
							<span class="weberium-hide-sortee fa fa-toggle-on"></span>
						</li>
					<?php
					// End if label check
					endif;
					// Remove item from choices array - so only disabled items are left
					unset( $choices[$val] );
				// End val loop
				endforeach;
				// Loop through disabled items (disabled items have been removed alredy from choices)
				foreach ( $choices as $val => $label ) { ?>
					<li data-value="<?php echo esc_attr( $val ); ?>" class="weberium-sortable-li weberium-hide">
						<?php echo esc_html( $label ); ?>
						<span class="weberium-hide-sortee fa fa-toggle-on fa-rotate-180"></span>
					</li>
				<?php } ?>
			</ul>
		</div><!-- .weberium-sortable -->
		<div class="clear:both"></div>
		<?php
		// Return values as comma seperated string for input
		if ( is_array( $values ) ) {
			$values = array_keys( $values );
			$values = implode( ',', $values );
		}
		echo '<input id="'. $this->id .'_input" type="hidden" name="'. $this->id .'" value="'. esc_attr( $values ) .'" '. $this->get_link() .' />'; ?>
		<script>
		jQuery(document).ready( function($) {
			"use strict";
			// Define variables
			var sortableUl = $( '#<?php echo esc_html( $this->id ); ?>_sortable' );

			// Create sortable
			sortableUl.sortable()
			sortableUl.disableSelection();

			// Update values on sortstop
			sortableUl.on( "sortstop", function( event, ui ) {
				weberiumUpdateSortableVal();
			} );

			// Toggle classes
			sortableUl.find( 'li' ).each( function() {
				$( this ).find( '.weberium-hide-sortee' ).on('click', function() {
					$( this ).toggleClass( 'fa-rotate-180' ).parents( 'li:eq(0)' ).toggleClass( 'weberium-hide' );
				} );
			})
			// Update Sortable when hidding/showing items
			$( '#<?php echo esc_html( $this->id ); ?>_sortable span.weberium-hide-sortee' ).on('click', function() {
				weberiumUpdateSortableVal();
			} );
			// Used to update the sortable input value
			function weberiumUpdateSortableVal() {
				var values = [];
				sortableUl.find( 'li' ).each( function() {
					if ( ! $( this ).hasClass( 'weberium-hide' ) ) {
						values.push( $( this ).attr( 'data-value' ) );
					}
				} );
				$( '#<?php echo esc_html( $this->id ); ?>_input' ).val(values).trigger( 'change' );
			}
		} );
		</script>
		<?php
	}
}

// Google Fonts Control
class Weberium_Fonts_Dropdown_Custom_Control extends WP_Customize_Control {
	public function render_content() {
	$this_val = $this->value(); ?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> style="width:100%;">
			<option value="" <?php if ( ! $this_val ) echo 'selected="selected"'; ?>><?php esc_html_e( 'Default', 'weberium' ); ?></option>
			<?php
			// Add custom fonts from child themes
			if ( function_exists( 'weberium_add_custom_fonts' ) ) {
				$fonts = weberium_add_custom_fonts();
				if ( $fonts && is_array( $fonts ) ) { ?>
					<optgroup label="<?php esc_html_e( 'Custom Fonts', 'weberium' ); ?>">
						<?php foreach ( $fonts as $font ) { ?>
							<option value="<?php echo esc_html( $font ); ?>" <?php if ( $font == $this_val ) echo 'selected="selected"'; ?>><?php echo esc_html( $font ); ?></option>
						<?php } ?>
					</optgroup>
				<?php }
			} ?>
			<?php
			// Get Standard font options
			$std_fonts = '';
			if ( $std_fonts = weberium_standard_fonts() ) { ?>
				<optgroup label="<?php esc_html_e( 'Standard Fonts', 'weberium' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $std_fonts as $font ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>
			<?php
			// Google font options
			$google_fonts = '';
			if ( $google_fonts = weberium_google_fonts_array() ) { ?>
				<optgroup label="<?php esc_html_e( 'Google Fonts', 'weberium' ); ?>">
					<?php
					// Loop through font options and add to select
					foreach ( $google_fonts as $font ) { ?>
						<option value="<?php echo esc_html( $font ); ?>" <?php selected( $font, $this_val ); ?>><?php echo esc_html( $font ); ?></option>
					<?php } ?>
				</optgroup>
			<?php } ?>
		</select>
	</label>
	<?php }
}