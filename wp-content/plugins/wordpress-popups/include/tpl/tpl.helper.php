<?php
/**
 * Amazon Helper module
 * http://www.aa-team.com
 * ======================
 *
 * @package		WooEnvato Contextual
 * @author		Andrei Dinca, AA-Team
 * @version		1.0
 */
!defined('ABSPATH') and exit;
if (class_exists('SMPNEW_Tpl_Helper') != true) {
    class SMPNEW_Tpl_Helper
    {
        const VERSION = '1.0';
		
		public $parent = array();

        public $config = array(
			"api_key" => ""
		);
		
        
        /**
         * The constructor
         */
        public function __construct( $parent=array() )
        {
        	$this->parent = $parent; // load parent

        	// create AJAX request
			add_action('wp_ajax_SMPNEW_tpl_ajax', array(
                $this,
                'ajax_requests'
            ));
        }
		
		private function print_error_response( $msg='' )
		{	
			die( json_encode( array(
				'status' 	=> 'invalid',
				'msg'		=> $msg
			) ) );  
		}
		
		
		/**
		 * Functions - for options file
		 */
		public function ajax_requests()
		{
			$action = isset($_REQUEST['sub_action']) ? $_REQUEST['sub_action'] : 'none';
			
			$allowed_action = array( 'check_amazon', );
			
			if( !in_array($action, $allowed_action) ){
				die(json_encode(array(
					'status' => 'valid',
					'html' => 'Invalid action!'
				)));
			}

			$html = array();

			if( 'check_amazon' == $action ){

				$smpnew = $this->parent;
				$config = $smpnew->settings();

				die(json_encode(array(
					'status' => 'valid',
					'html' => implode( "\n", $html )
				))); 
			}

			die(json_encode(array(
				'status' => 'valid',
				'html' => 'Invalid action!'
			)));
		}
	
		public function _box_templates( $istab = '' ) {
			$smpnew = $this->parent;
			$config = $smpnew->settings();
			$tplcfg = $smpnew->settings_tpl();
			
		    $html         = array();

			$template_default = isset($config['template_default']) ? $config['template_default'] : '';
			$template_default = isset($tplcfg['template_current']) ? $tplcfg['template_current'] : $template_default;

			ob_start();
		?>
		
			<script>
			(function($) {
				"use strict";

				// public
				var ajaxurl 					= '<?php echo admin_url('admin-ajax.php');?>';
				var maincontainer			= null;

				
			    // init function, autoload
			    (function init() {
			        // load the triggers
			        $(document).ready(function(){
			        	maincontainer = $(".SMPNEW_iw");

			            triggers();
			        });
			    })();
			    
			    // :: TRIGGERS
			    function triggers() {

					maincontainer.on('click', ".SMPNEW-box-templates a", function(e){
						e.preventDefault();

						build_template( $(this) );
					});

					var template_def 	= '<?php echo $template_default; ?>',
						  template_sel	= null;
					//console.log( template_def );

					if ( '' != template_def )
						template_sel = maincontainer.find('.SMPNEW-box-templates a#SMPNEW-idtemplate-thumb-' + template_def);
					else
						template_sel = maincontainer.find('.SMPNEW-box-templates a:first');

					build_template( template_sel ); // current selected
					
					fix_cache_force_refresh();
			    };
			    
			    function build_template( that ) {
					var id				= that.prop('id'),
						  template		= id.replace('SMPNEW-idtemplate-thumb-', '');

					// hidden
					maincontainer.find('#SMPNEW_Tpl_Settings-template_current').val( template );

					// selected thumb
					maincontainer.find('.SMPNEW-idtemplate-thumb').find('img').removeClass('selected');
					that.find('img').addClass('selected');

					// selected content
					maincontainer.find('.SMPNEW-idtemplate-content').hide();
					maincontainer.find('#SMPNEW-idtemplate-content-'+template).show();
			    };
			    
			    function fix_cache_force_refresh() {
			    	maincontainer.find('.SMPNEW-item-input-type-hidden input[type="hidden"]').val(1);
			    	//console.log( maincontainer.find('.SMPNEW-item-input-type-hidden input[type="hidden"]') ); 
			    };

		   	})(jQuery);
			</script>

			<style type="text/css">
				.SMPNEW-form .SMPNEW-form-row.SMPNEW-box-templates {
					background-color: #f2f2f2;
					color: #72777c;
				}
					.SMPNEW-form .SMPNEW-form-row.SMPNEW-box-templates .SMPNEW-idtemplate-thumb {
						display: inline-block;
						margin-right: 20px;
						margin-bottom: 20px;
					}
						.SMPNEW-form .SMPNEW-form-row.SMPNEW-box-templates .SMPNEW-idtemplate-thumb img {
							border: 2px solid #e2e2e2;
						}
						.SMPNEW-form .SMPNEW-form-row.SMPNEW-box-templates .SMPNEW-idtemplate-thumb img.selected {
							border: 2px solid #e8c2ff;
						}
					.SMPNEW-form .SMPNEW-idtemplate-content {
						display: none;
					}
			</style>

			<!-- templates list -->
		    <div class="SMPNEW-form-row SMPNEW-box-templates <?php echo ($istab!='' ? ' '.$istab : ''); ?>" id="SMPNEW-box-templates">
			<?php
				$templates = SMPNEW_get_templates_list(false, 'both');
				//var_dump('<pre>', $templates, '</pre>'); echo __FILE__ . ":" . __LINE__;die . PHP_EOL;    
				foreach ($templates as $tkey => $tval) {
					$thumb = SMPNEW_asset_url( 'images/templates/' . $tval['thumb'] );
					echo '<a href="#SMPNEW-box-templates" class="SMPNEW-idtemplate-thumb" id="SMPNEW-idtemplate-thumb-' . $tkey . '"><img src="' . $thumb . '" title="' . $tval['name'] . '" /></a>';
				}
			?>
		    </div>

			<!-- template options -->
			<?php
				$html[] = ob_get_clean();
				ob_start();

				$templates = SMPNEW_get_templates_list(false);
				$options = array();
				foreach ($templates as $tkey => $tval) {
					$options["$tkey"] = $this->_get_template_options( $tkey );
					//var_dump('<pre>', $tkey, $options, '</pre>');  
				}
				//echo __FILE__ . ":" . __LINE__;die . PHP_EOL;
				
				foreach ($templates as $tkey => $tval) {
					echo '<div class="SMPNEW-idtemplate-content" id="SMPNEW-idtemplate-content-' . $tkey . '">';
					echo 	SMPNEW_Settings_Build_Options( $options["$tkey"], 'SMPNEW_Tpl_Settings' );
					echo '</div>';  
				}
			?>
			
			<!-- here is hidden selection -->
			<input id="SMPNEW_Tpl_Settings-template_current" value="<?php echo $template_default; ?>" name="SMPNEW_Tpl_Settings[template_current]" style="display: none;" type="hidden">

		<?php
			$html[] = ob_get_clean();
			return implode("\n", $html);
		}

		public function _get_template_options( $template ) {
			//$filtered = array_map('trim', explode(',', $filtered));

			$options = SMPNEW_Load_Options( dirname( __FILE__ ), array( 'file' => 'options-tpl.php' ) );
			extract( $options );  

			$elements = isset($elements) ? $elements : array();

			$newel = array();
			foreach ($elements as $key => $val) {
				$filtered = isset($val['__template']) ? $val['__template'] : '';

				if ( $template == $filtered ) {
					$newel["$key"] = $val;
				}
			}
			//var_dump('<pre>',$template, $newel,'</pre>');

			if ( isset($elements) )
				$options['elements'] = $newel;
			return $options;
		}
	}
}
