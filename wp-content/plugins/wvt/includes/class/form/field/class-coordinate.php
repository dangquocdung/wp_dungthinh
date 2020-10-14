<?php
/**
 * Customizer Control: text.
 *
 * Creates a text
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package jeg-framework
 */

namespace WVT\Form\Field;

/**
 * Slider control (range).
 */
class Coordinate extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'coordinate';

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
		<div class="widget-wrapper type-coordinate" data-field="{{ data.fieldID }}">
			<div class="widget-left">
				<label for="{{ data.fieldID }}">{{{ data.title }}}</label>
			</div>
			<div class="widget-right">
				<div class="coordinate-list">
					<#
						_.each(data.options, function(label, key){
						#>
						<div class="coordinate-item">
							<label>{{ label }}</label>
							<input readonly class="coordinate-input" data-coordinate="{{ key }}" name="{{ data.fieldName }}[{{ key }}]" value="{{ data.value[key] }}" data-reset_value="{{ data.default[key] }}" />
						</div>
						<#
						});
					#>
					<div class="coordinate-reset">
						<span class="dashicons dashicons-image-rotate"></span>
					</div>
				</div>
				<i>{{{ data.description }}}</i>
			</div>
		</div>
		<?php
	}
}
