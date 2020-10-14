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
class Deviceheight extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'deviceheight';

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
		<div class="widget-wrapper type-deviceheight" data-field="{{ data.fieldID }}">
			<div class="widget-left">
				<label for="{{ data.fieldID }}">{{{ data.title }}}</label>
			</div>
			<div class="widget-right">
				<div class="device-height-list">
					<#
						_.each(data.options, function(label, key){
						#>
						<div class="device-item" data-device="{{key}}">
							<label>{{ label }}</label>
							<div class="wrapper">
								<input class="jeg-number-range device-input"
							        type="range"
						            data-id="{{ data.fieldID }}"
						            name="{{ data.fieldName }}[{{ key }}]"
						            min="{{ data.options[key].min }}"
						            max="{{ data.options[key].max }}"
						            step="{{ data.options[key].step }}"
						            value="{{ data.value[key] }}"
						            data-reset_value="{{ data.default[key] }}"/>
								<div class="jeg_range_value">
									<span class="value">{{{ data.value[key] }}}</span>
								</div>
								<div class="jeg-slider-reset">
									<span class="dashicons dashicons-image-rotate"></span>
								</div>
							</div>
						</div>
						<#
						});
					#>
				</div>
				<i>{{{ data.description }}}</i>
			</div>
		</div>
		<?php
	}
}
