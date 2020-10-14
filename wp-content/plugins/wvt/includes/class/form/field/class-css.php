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
class Css extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'css';

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
		<div class="widget-wrapper type-css" data-field="{{ data.fieldID }}">
			<div class="widget-left">
				<label for="{{ data.fieldID }}">{{{ data.title }}}</label>
			</div>
			<div class="widget-right">
				<textarea class="widefat" name="{{ data.fieldName }}" id="{{ data.fieldID }}">{{{ data.value }}}</textarea>
				<i>{{{ data.description }}}</i>
			</div>
		</div>
		<?php
	}
}
