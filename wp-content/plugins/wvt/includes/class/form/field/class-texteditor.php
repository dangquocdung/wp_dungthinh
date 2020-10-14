<?php
/**
 * Customizer Control: Text editor.
 *
 * Creates a text editor
 *
 * @author Jegstudio
 * @since 1.0.0
 * @package wvt-framework
 */

namespace WVT\Form\Field;

/**
 * Text editor
 */
class Texteditor extends Field_Abstract {

	/**
	 * Form Text Template
	 *
	 * @var string
	 */
	protected $type = 'texteditor';

	/**
	 * Render the control's JS template.
	 */
	public function render_template() {
		?>
        <script type="text/html" id="tmpl-wvt-field-<?php echo esc_attr( $this->type ); ?>">
			<?php $this->js_template(); ?>
        </script>
		<?php

		$this->get_wp_editor();
	}

	/**
	 * An Underscore (JS) template for this control's content
	 */
	public function js_template() {
		?>
        <# var id = data.parent.id + '_' + data.fieldID #>
        <div class="widget-wrapper type-texteditor" data-field="{{ id }}">
            <div class="widget-left">
                <label for="{{ id }}">{{{ data.title }}}</label>
            </div>
            <div class="widget-right">

                <div id="wp-{{ id }}-wrap" class="wp-core-ui wp-editor-wrap tmce-active">
                    <link rel='stylesheet' id='editor-buttons-css' href='<?php echo home_url(); ?>/wp-includes/css/editor.css?ver=<?php echo get_bloginfo('version', 'display'); ?>' type='text/css' media='all' />
                    <div id="wp-{{ id }}-editor-tools" class="wp-editor-tools hide-if-no-js">
                        <div id="wp-{{ id }}-media-buttons" class="wp-media-buttons">
                            <button type="button" id="insert-media-button" class="button insert-media add_media" data-editor="{{ id }}">
                                <span class="wp-media-buttons-icon"></span>
								<?php esc_html_e( 'Add Media', 'wvt' ) ?>
                            </button>
                        </div>
                        <div class="wp-editor-tabs">
                            <button type="button" id="{{ id }}-tmce" class="wp-switch-editor switch-tmce" data-wp-editor-id="{{ id }}"><?php esc_html_e( 'Visual', 'wvt' ) ?></button>
                            <button type="button" id="{{ id }}-html" class="wp-switch-editor switch-html" data-wp-editor-id="{{ id }}"><?php esc_html_e( 'Text', 'wvt' ) ?></button>
                        </div>
                    </div>
                    <div id="wp-{{ id }}-editor-container" class="wp-editor-container">
                        <div id="qt_{{ id }}_toolbar" class="quicktags-toolbar"></div><textarea class="wp-editor-area" rows="20" autocomplete="off" cols="40" name="{{ data.fieldName }}" id="{{ id }}">{{ data.value }}</textarea>
                    </div>
                </div>

                <i>{{{ data.description }}}</i>
            </div>
        </div>
		<?php
	}

	/**
	 * Print all required script for wp editor
	 */
	private function get_wp_editor() {
		echo '<div style="display:none;">';
		wp_editor(
			'',
			'wvt-wpeditor'
		);
		echo '</div>';
	}
}
