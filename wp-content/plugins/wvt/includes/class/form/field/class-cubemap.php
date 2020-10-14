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
class Cubemap extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'cubemap';

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
		<div class="widget-wrapper type-cubemap" data-field="{{ data.fieldID }}">
			<div class="widget-left">
				<label for="{{ data.fieldID }}">{{{ data.title }}}</label>
			</div>
			<div class="widget-right">
				<div class="cubemap-list">
					<ul>
					<#
						_.each(data.options, function(label, key){
							var imageClass = ( '' !== data.value[key] ) ? 'contain' : ''

							var image = data.value[key]

							if (typeof data.value[key] === 'object' && data.value[key] !== null)
				        		image = data.value[key].src
						#>
						<li data-position="{{ key }}" class="{{ imageClass }}">
							<div class="cubemap-img">
								<div class="cubemap-bg" style="background-image: url({{ image }});"></div>
								<div class="remove"></div>
							</div>
							<input type="hidden" class="image-input" name="{{ data.fieldName }}[{{ key }}]" value="{{ image }}" />
							<label>{{{ label }}}</label>
						</li>
						<#
						});
					#>
					</ul>
				</div>
				<i>{{{ data.description }}}</i>
			</div>
		</div>
		<?php
	}
}
