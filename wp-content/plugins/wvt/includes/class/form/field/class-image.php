<?php
/**
 * Customizer Control: Image.
 *
 * Creates a text
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package jeg-framework
 */

namespace WVT\Form\Field;

/**
 * Image control
 */
class Image extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'image';

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
		<div class="widget-wrapper image-control type-image" data-field="{{ data.fieldID }}">
			<div class="widget-left">
				<label for="{{ data.fieldID }}">{{{ data.title }}}</label>
			</div>
			<div class="widget-right">
				<div class="image-content">
					<# if (typeof data.value === 'object' && data.value !== null)
				        data.value = data.value.src

					  var emptyClass = data.value === '' ? '' : 'hide' #>
					<div class="image-empty {{ emptyClass }}">
						<button type="button" class="select-media-button"><?php esc_html_e('Select Image', 'wvt'); ?></button>
						<div class="button-action">
							<button type="button" class="add-media-button media-button"><?php esc_html_e('Add Image', 'wvt'); ?></button>
						</div>
					</div>
					<# var filledClass = data.value === '' ? 'hide' : '' #>
					<div class="image-filled {{ filledClass }}">
						<div class="image-holder">
							<img src="{{ data.value }}">
						</div>
						<div class="button-action">
							<button type="button" class="remove-media-button media-button"><?php esc_html_e('Remove', 'wvt'); ?></button>
							<button type="button" class="change-media-button media-button"><?php esc_html_e('Change Image', 'wvt'); ?></button>
						</div>
					</div>
				</div>
				<i>{{{ data.description }}}</i>
			</div>
		</div>
		<?php
	}
}
