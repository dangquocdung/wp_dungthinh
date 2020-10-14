<?php
if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );


/* Hide notices to avoid AJAX errors
 * Sometimes the Class throws a notice about 'hook_suffix' being undefined,
 * which breaks every AJAX call.
 */
/**
 * !ATTENTION 
 * __method : AA repository methods (those without __ belongs to WP_List_Table)
 */
class AArpr_List_Table_Ajax extends WP_List_Table 
{
	public $plugin_alias = '';

	public $data = array();

	public $wpdb = null;
	public $config = array();
	public $_args = array();
	public $_pagination_args = array();
	
	public $the_plugin = array();

	public $filter_fields = array();
	public $query_parts = array(); // custom sql query parts
	public $query_ = ''; // custom sql query final


	// ATTENTION: __method : AA repository methods (those without prefix __ belongs to WP_List_Table)
	/**
	 * REQUIRED. Set up a constructor that references the parent constructor. We 
	 * use the parent reference to set some default configs.
	 */
	public function __construct( $the_plugin=null, $params=array(), $plugin_alias='' ) 
	{
		global $status, $page, $wpdb;
		
		$this->plugin_alias = !empty($plugin_alias) ? $plugin_alias : AArpr()->alias;

		if ( isset($the_plugin) && is_object($the_plugin) ) {
			$this->the_plugin = $the_plugin;
		}

		$config = array();
		if ( isset($params['config']) && !empty($params['config']) && is_array($params['config']) ) {
        	$config = array_merge( $config, $params['config'] );			
		}
    
		// This is used only if making any database queries
		$this->wpdb = $wpdb;

        // Store some default options
        if ( !isset($config['ajaxid']) || empty($config['ajaxid']) ) die('Invalid list-table init!');

		// defaults are considered for wp_posts table
		$this->config = array(
			// mandatory
			// ajaxid: string, uniq list ID. Use for SESSION filtering / sorting actions
			'id' 								=> isset($config['id']) && !empty($config['id']) ? $config['id'] : 'AArpr_List_Table',
			'ajaxid'							=> isset($config['ajaxid']) && !empty($config['ajaxid']) ? $config['ajaxid'] : 'AArpr_List_Table',
			'singular'						=> isset($config['singular']) && !empty($config['singular']) ? $config['singular'] : 'aaitem',

			// optional
			'table'							=> isset($config['table']) && !empty($config['table']) ? $config['table'] : $this->wpdb->posts, // store database name
			'orderby'         				=> isset($config['orderby']) && !empty($config['orderby']) ? $config['orderby'] : 'ID', // orderby field
			'order'          					=> isset($config['order']) && !empty($config['order']) ? $config['order'] : 'DESC', // order directions: ASC | DESC
			'items_per_page' 			=> isset($config['items_per_page']) && !empty($config['items_per_page']) ? (int) $config['items_per_page'] : 10, // number. How many items per page
			//'search_box' 				=> isset($config['search_box'], $config['search_box']['title']) ? $config['search_box'] : $search_box_def,
			//'filter_fields' 				=> isset($config['filter_fields']) && !empty($config['filter_fields']) ? $config['filter_fields'] : array(),
			'requestFrom'				=> 'init', // values: init | ajax
		);
		// extra configuration
		$this->__set_config_extra(array());
    
		// Set parent defaults
		parent::__construct(
			$params['screen']
		);

		$this->_args['singular'] = $this->config['singular'];
		$this->_pagination_args['order'] = $this->config['order'];
		$this->_pagination_args['orderby'] = $this->config['orderby'];

		// main query defaults
		$this->__build_query_parts();

		//if ( isset($_SESSION['AArpr_ListTable']) ) unset($_SESSION['AArpr_ListTable']); // debug
		//var_dump('<pre>',$_SESSION['AArpr_ListTable'],'</pre>');  
	}

	public function get_bulk_actions()
	{
		return $actions = array(
			'delete'			=> 'Delete',
			'publish'			=> 'Publish',
			'unpublish'		=> 'Unpublish'
		);
	}

	public function process_bulk_action()
	{
		// Detect when a bulk action is being triggered...
		//if( 'delete'=== $this->current_action() ) {
		//	$keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : array();
		//	if( count($keyword) > 0 ) {
		//		foreach ($keyword as $keyword_id) {
		//			WZC_keywords()->keywords_remove($keyword_id);  
		//		}
		//	}
		//}		
	}

	public function prepare_items() 
	{
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array( $columns, $hidden, $sortable );

		$this->process_bulk_action();

		// build custom query
		$qres = $this->__execute_query();
		extract( $qres );

		// REQUIRED for pagination
		$current_page = $this->get_pagenum();
    
		// register our pagination options & calculations.
		$this->set_pagination_args(
			array(
				// WE have to calculate the total number of items
				'total_items'	=> $total_items,
				// WE have to determine how many items to show on a page
				'per_page'	=> $this->__query_field('items_per_page'),
				// WE have to calculate the total number of pages
				'total_pages'	=> ceil( $total_items / $this->__query_field('items_per_page') ),
				// Set ordering values if needed (useful for AJAX)
				'orderby'	=> $orderby,
				'order'		=> $order
			)
		);
	}

	public function __execute_query() {
		$ret = array();

		//$sql = $this->wpdb->prepare("SELECT * FROM " . ( $this->config['table'] ) . " ORDER BY $orderby $order LIMIT %d OFFSET %d", $this->__query_field('items_per_page'), $offset);
		//$total_items = $this->wpdb->get_var( "SELECT COUNT(id) FROM " . $this->config['table'] );
		//var_dump('<pre>',$sql,'</pre>');

		//---------------
		// Query Start

		$main_alias = $this->query_parts['main_alias'];

		//$myQuery = "SELECT a.* FROM " . $this->config['table'] . " as a WHERE 2=2 ";
		$myQuery = "SELECT SQL_CALC_FOUND_ROWS "
			. $this->query_parts['what']
			. " FROM " . $this->query_parts['from']
			. " WHERE 2=2 " . ($this->query_parts['where'] . " ");
		$myQuery_list = '';
		
		// :: search input
		$search_where = $this->__search_posts_where();
		$myQuery .= $search_where;
		
		// :: dropdown filter fields
		$filter_where = '';
		if ( $this->__has_filters() ) {
			$filter_fields = isset($this->config["filter_fields"]) && !empty($this->config["filter_fields"])
				? $this->config["filter_fields"] : array();
			foreach ($filter_fields as $field => $vals) {
				if ( $this->__is_filter_exclude_query( $vals ) ) continue 1;
   
				$this->filter_fields["$field"] = array();
				$field_val = $this->__query_field($field);
				
				$allow_empty = ! isset($vals['allow_empty']) || ! $vals['allow_empty'] ? false : true;
				if ( ! $allow_empty ) {
					$field_val = empty($field_val) || trim($field_val) == "" ? '' : $field_val;
				}

				if ( $field_val != '' ) {
					$filter_where .= " AND $main_alias.$field = '" . esc_sql($field_val) . "' ";
					
					if ( isset($vals['extra_filter']) && !empty($vals['extra_filter']) ) {
						foreach ($vals['extra_filter'] as $extra_field => $extra_vals) {
							$filter_where .= " AND $main_alias.$extra_field = '" . esc_sql($extra_vals) . "' ";
						}
					}
				}
			}
		}
		$myQuery .= $filter_where;
		
		//$myQuery .= " AND 1=1 ";
		
		// :: group by
		$__groupbyClause = '';
		if ( !empty($this->query_parts['groupby']) ) {
			$__groupbyClause = " GROUP BY " . $this->query_parts['groupby'];
		}
		$myQuery .= $__groupbyClause;
		
		// :: having
		$__havingClause = '';
		if ( !empty($this->query_parts['having']) ) {
			$__havingClause = " HAVING " . $this->query_parts['having'];
		}
		$myQuery .= $__havingClause;

		// :: limit query
	    $paged = $this->__query_field('paged') !== false ? max(0, intval($this->__query_field('paged') - 1)) : 0;
		$offset = $paged * $this->__query_field('items_per_page');

		$items_per_page = $this->__query_field('items_per_page');

		//$__limitClause = '1=1';
		//if ( $items_per_page > 0 ) {
		//	$__limitClause = "1=1 LIMIT " . $items_per_page . " OFFSET " . $offset;
		//}
		//$myQuery_list = str_replace("1=1", $__limitClause, $myQuery);
		$__limitClause = '';
		if ( $items_per_page > 0 ) {
			$__limitClause = " LIMIT " . $items_per_page . " OFFSET " . $offset;
		}

		// :: order by
	    $orderby = (in_array($this->__query_field('orderby'), array_keys($this->get_sortable_columns()))) ? $this->__query_field('orderby') : $this->__query_field('orderby', $this->config);
		$order = (in_array($this->__query_field('order'), array('asc', 'desc'))) ? $this->__query_field('order') : $this->__query_field('order', $this->config);

		//if( !empty($orderby) ) {
		//	if ( $items_per_page > 0 ) {
		//		$myQuery_list = str_replace('1=1 LIMIT', "1=1 ORDER BY $main_alias.$orderby $order LIMIT", $myQuery_list);
		//	}
		//	else {
		//		$myQuery_list = str_replace('1=1', "1=1 ORDER BY $main_alias.$orderby $order", $myQuery_list);
		//	}
		//}
		$__orderbyClause = '';
		if( !empty($orderby) ) {
			$__orderbyClause = " ORDER BY $main_alias.$orderby $order";
		}
		
		$myQuery_list = $myQuery . $__orderbyClause . $__limitClause;

		// :: query ;
		$myQuery_list .= ";";
		$myQuery .= ";";
		
		// :: dropdown filter fields
		//		when option <display> = links
		if ( $this->__has_filters() ) {
			foreach ($filter_fields as $field => $vals) {
				if ( $this->__is_filter_exclude_query( $vals ) ) continue 1;

				$display = isset($vals['display']) && ('links' == $vals['display']) ? 'links' : 'default';
   
				if ( 'links' == $display ) {
					$sql_ff = $myQuery;

					$field_val = $this->__query_field($field);
					$sql_ff = str_replace(" AND $main_alias.$field = '" . esc_sql($field_val) . "' ", "", $sql_ff);
					
					if ( isset($vals['extra_filter']) && !empty($vals['extra_filter']) ) {
						foreach ($vals['extra_filter'] as $extra_field => $extra_vals) {
							$sql_ff .= " AND $main_alias.$extra_field = '" . esc_sql($extra_vals) . "' ";
						}
					}
  
					// already have a GROUP BY clause
					if ( !empty($this->query_parts['groupby']) ) {
   
						$options = isset($vals['options']) ? $vals['options'] : array();
						foreach ($options as $opt_key => $opt_text) {
							$sql_ff__ = $sql_ff;
							$sql_ff__ = str_replace("2=2", "2=2 AND $main_alias.$field = '" . esc_sql($opt_key) . "'", $sql_ff__);
							$sql_ff__ = str_replace(";", " LIMIT 1 OFFSET 0;", $sql_ff__);
							//var_dump('<pre>',$sql_ff__,'</pre>');  
							$this->wpdb->get_results( $sql_ff__, ARRAY_A );
							$__nb = $this->wpdb->get_var( "SELECT FOUND_ROWS();" );
							$this->filter_fields["$field"]['count']["$opt_key"] = (object) array('__nb' => $__nb);
						}
					}
					else {
						$sql_ff = str_replace('SQL_CALC_FOUND_ROWS', '', $sql_ff);
		               	$sql_ff = str_replace("$main_alias.*", "$main_alias.$field, count($main_alias.id) as __nb", $sql_ff);
						$sql_ff = str_replace(";", " GROUP BY $main_alias.$field ORDER BY $main_alias.$field ASC", $sql_ff);
						//var_dump('<pre>',$sql_ff,'</pre>');
						$this->filter_fields["$field"]['count'] = $this->wpdb->get_results( $sql_ff, OBJECT_K );
					}
				}
			}
		}
		//var_dump('<pre>', $this->filter_fields, '</pre>'); die('debug...'); 

		// Query End
		//---------------
		
		//var_dump('<pre>',$myQuery_list,'</pre>');
	    $this->items = $this->wpdb->get_results( $myQuery_list, ARRAY_A );
		//$total_items = $this->wpdb->get_var( str_replace("$main_alias.*", "count($main_alias.id) as nb", $myQuery) );
		$total_items = $this->wpdb->get_var( "SELECT FOUND_ROWS();" );

		$this->query_ = $myQuery_list;
		$ret = array(
			'sql'					=> $this->query_,
			'total_items'		=> $total_items,
			'orderby'			=> $orderby,
			'order'				=> $order,
		);
		return $ret;
	}

	public function __build_query_parts( $query_parts=array() ) {
		$def = array(
			'main_alias'				=> 'a',
			'what'						=> 'a.*',
			'from'						=> $this->config['table'] . " as a",
			'where'						=> '',
			'groupby'					=> '',
			'having'						=> '',
		);
		
		foreach ($def as $key => $val) {
			$this->query_parts["$key"] = $val;
			if ( isset($query_parts["$key"]) && !empty($query_parts["$key"]) ) {
				$this->query_parts["$key"] = $query_parts["$key"];
			}
		}
		return $this->query_parts;
	}


	/**
	 * Display the table
	 * Adds a Nonce field and calls parent's display method
	 *
	 * @since 3.1.0
	 * @access public
	 */
	public function display() {
		wp_nonce_field( 'ajax-custom-list-nonce', '_ajax_custom_list_nonce' );
		
		echo '<input type="hidden" id="ajaxid" name="ajaxid" value="' . $this->config['ajaxid'] . '" />';
		echo '<input type="hidden" id="order" name="order" value="' . $this->_pagination_args['order'] . '" />';
		echo '<input type="hidden" id="orderby" name="orderby" value="' . $this->_pagination_args['orderby'] . '" />';
		
		//parent::display();

		$singular = $this->_args['singular'];

		$this->display_tablenav( 'top' );
		$this->screen->render_screen_reader_content( 'heading_list' );
		?>
		<table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
			<thead>
			<tr>
				<?php $this->print_column_headers(); ?>
			</tr>
			</thead>
		
			<tbody id="the-list"<?php
				if ( $singular ) {
					echo " data-wp-lists='list:$singular'";
				} ?>>
				<?php $this->display_rows_or_placeholder(); ?>
			</tbody>
		
			<tfoot>
			<tr>
				<?php $this->print_column_headers( false ); ?>
			</tr>
			</tfoot>
		
		</table>
		<?php
		$this->display_tablenav( 'bottom' );
	}

	/**
	 * Generate the table navigation above or below the table
	 *
	 * @since 3.1.0
	 * @access protected
	 * @param string $which
	 */
	protected function display_tablenav( $which ) {
		$__print_filters = array();
		if ( 'top' === $which ) {
			wp_nonce_field( 'bulk-' . $this->_args['plural'] );
			$__print_filters = $this->__print_filters( 'top' );
		}
		?>
		<div class="tablenav <?php echo esc_attr( $which ); ?>">

			<?php $this->__print_box_which( $which, $__print_filters ); ?>
			<?php //$this->extra_tablenav( $which ); ?>
			
		</div><!-- end tablenav -->
		<?php
	}

	/**
	 * Extra controls to be displayed between bulk actions and pagination
	 *
	 * @since 3.1.0
	 * @access protected
	 *
	 * @param string $which
	 */
	protected function extra_tablenav( $which ) {
	}


	/**
	 * Handle an incoming ajax request (called from admin-ajax.php)
	 *
	 * @since 3.1.0
	 * @access public
	 */
	public function ajax_response( $retType='die' ) 
	{
		check_ajax_referer( 'ajax-custom-list-nonce', '_ajax_custom_list_nonce' );
		$response = array();
		
		$request = array(
			'sub_action' 	=> isset($_REQUEST['sub_action']) ? $_REQUEST['sub_action'] : '',
			'ajax_id' 		=> isset($_REQUEST['ajax_id']) ? $_REQUEST['ajax_id'] : '',
			'params' 		=> isset($_REQUEST['params']) ? $_REQUEST['params'] : array(),
		);
		$request = array_merge_recursive($request, $request['params']);

		if ( isset($request['id']) ) {
			$request['id'] = array_filter( explode(',', $request['id']) );
		}
		extract( $request );

		//if( 'paged' == $sub_action ){
		if ( 0 ) { // NOT USED!
			if ( isset($params['paged']) ) {
				$new_paged = isset($params['paged']) ? $params['paged'] : 1;
				$new_paged = $new_paged < 1 ? 1 : $new_paged;
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['paged'] = $params['paged'];
			}
			if ( isset($params['order']) ) {
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['order'] = $params['order'];
			}
			if ( isset($params['orderby']) ) {
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['orderby'] = $params['orderby'];
			}
		}

		if ( 'items_per_page' == $sub_action ) {
			$new_items_per_page = isset($params['items_per_page']) ? $params['items_per_page'] : $this->config['items_per_page'];

			if ( $new_items_per_page == 'all' ) {
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['items_per_page'] = '-1';
			}
			else if ( (int)$new_items_per_page == 0 ) {
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['items_per_page'] = $this->config['items_per_page'];
			}
			else{
				$_SESSION['AArpr_ListTable'][$ajax_id]['params']['items_per_page'] = $new_items_per_page;
			}

			// reset the paged as well
			$_SESSION['AArpr_ListTable'][$ajax_id]['params']['paged'] = 1;
		}
  
		if( 'general_field' == $sub_action ){
			$filter_name = isset($params['filter_name']) ? $params['filter_name'] : '';
			$filter_val = isset($params['filter_val']) ? $params['filter_val'] : '';
			if( $filter_val == "all" ){
				$filter_val = "";
			}

			$_SESSION['AArpr_ListTable'][$ajax_id]['params']["$filter_name"] = $filter_val;

			// reset the paged as well
			$_SESSION['AArpr_ListTable'][$ajax_id]['params']['paged'] = 1;
		}

		if( 'search' == $request['sub_action'] ){
			$search_text = isset($params['search_text']) ? $params['search_text'] : '';
				
			$_SESSION['AArpr_ListTable'][$ajax_id]['params']['search_text'] = $search_text;

			// reset the paged as well
			$_SESSION['AArpr_ListTable'][$ajax_id]['params']['paged'] = 1;
		}

		// validation		
		if ( in_array($sub_action, array('delete', 'publish', 'unpublish')) && empty($id) ) {
			$response = $this->__list_table();
			$response = array_merge($response, array(
				'status'		=> 'invalid',
				'msg'		=> 'invalid request!',
			));

			//return
			if ( $retType == 'return' ) { return $response; }
			else { die( json_encode( $response ) ); }
		}

		if ( 'publish' == $sub_action || 'unpublish' == $sub_action ) {
			$response = $this->__publish( $request );
		}
		
		if ( 'delete' == $sub_action ) {
			$response = $this->__delete( $request );
			
			// reset the paged as well
			$_SESSION['AArpr_ListTable'][$ajax_id]['params']['paged'] = 1;
		}		

		// refresh table after any operation
		$response = array_merge($response, $this->__list_table());

		//return
		if ( $retType == 'return' ) { return $response; }
		else { die( json_encode( $response ) ); }
	}


	/* list table of items */
	public function __list_table() {
		$this->prepare_items();

		extract( $this->_args );
		extract( $this->_pagination_args, EXTR_SKIP );

		ob_start();
		if ( $this->__query_field('no_placeholder') != false )
			$this->display_rows();
		else
			$this->display_rows_or_placeholder();
		$rows = ob_get_clean();

		ob_start();
		$this->print_column_headers();
		$headers = ob_get_clean();

		ob_start();
		$this->pagination('top');
		$pagination_top = ob_get_clean();

		ob_start();
		$this->pagination('bottom');
		$pagination_bottom = ob_get_clean();
		
		ob_start();
		echo $this->__box_items_per_page();
		$box_items_per_page = ob_get_clean();
		
		ob_start();
		$__print_filters = $this->__print_filters( 'top' );
		$this->__print_box_which( 'top', $__print_filters );
		$print_filters = ob_get_clean();
		
		ob_start();
		$this->__print_box_which( 'bottom', $__print_filters );
		$print_filters_bottom = ob_get_clean();

		// return response
		$response = array(
			'status'	=> 'valid',
			//'msg'	=> 'default operation',
			'sql'		=> $this->query_,
			'rows' 	=> $rows
		);
		$response['pagination']['top'] = $pagination_top;
		$response['pagination']['bottom'] = $pagination_bottom;
		$response['column_headers'] = $headers;
		
		$response['box_items_per_page'] = $box_items_per_page;
		$response['print_filters'] = $print_filters;
		$response['print_filters_bottom'] = $print_filters_bottom;

		if ( isset( $total_items ) )
			$response['total_items_i18n'] = sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) );

		if ( isset( $total_pages ) ) {
			$response['total_pages'] = $total_pages;
			$response['total_pages_i18n'] = number_format_i18n( $total_pages );
		}
		return $response;
	}

	/* single & bulk delete items */
	public function __delete( $req ) {
		extract($req);

		$ret = array(
			'status'        => 'invalid',
			'msg_title'		=> __('Delete row', 'AArpr'),
			'msg'          => '',
		);

		do_action( 'AArpr_listable_delete_before', array('action' => 'delete', 'id' => $id, 'force' => true) );

		$status = 'invalid'; $status_msg = '';
		if (!empty($id)) {
			$table = $this->config['table'];
			$id_ = implode(',', array_map('AArpr_prepareForInList', $id));

			// delete record
			if ( 1 < count($id) ) {
				$query = "DELETE FROM " . $table . " where 1=1 and id in (" . ($id_) . ");";
			}
			else {
				$query = "DELETE FROM " . $table . " where 1=1 and id = " . ($id_) . ";";
			}
			$__stat = $this->wpdb->query($query);
				
			if ($__stat!== false) {
				$status = 'valid';
				if ( isset($is_bulk) && $is_bulk )
					$status_msg = __('bulk rows deleted successfully.', 'AArpr');
				else
					$status_msg = __('row deleted successfully.', 'AArpr');
				
				do_action( 'AArpr_listable_delete_success', array('action' => 'delete', 'id' => $id, 'force' => true) );
			}
			else {
				$status_msg = 'error: ' . __FILE__ . ":" . __LINE__;
				do_action( 'AArpr_listable_delete_failure', array('action' => 'delete', 'id' => $id, 'force' => true) );
			}
		}
		else {
			$status_msg = 'error: ' . __FILE__ . ":" . __LINE__;
			do_action( 'AArpr_listable_delete_failure', array('action' => 'delete', 'id' => $id, 'force' => true) );
		}
		
		do_action( 'AArpr_listable_delete_after', array('action' => 'delete', 'id' => $id, 'force' => true) );

		$ret = array_merge($ret, array(
			'status' 		=> $status,
			'msg'		=> $status_msg
		));
		return $ret;
	}

	/* single & bulk publish/unpublish items */
	public function __publish( $req ) {
		extract($req);

		$ret = array(
			'status'        => 'invalid',
			'msg_title'		=> __('Publish row', 'AArpr'),
			'msg'          => '',
		);
		
		do_action( 'AArpr_listable_'.$sub_action.'_before', array('action' => $sub_action, 'id' => $id, 'force' => true) );

		$status = 'invalid'; $status_msg = '';
		if (!empty($id)) {
			$table = $this->config['table'];
			$id_ = implode(',', array_map('AArpr_prepareForInList', $id));

			// update record
			if ( 1 < count($id) ) {
				$query = "UPDATE " . $table . " SET publish = %s where 1=1 and id in (" . ($id_) . ");";
			}
			else {
				$query = "UPDATE " . $table . " SET publish = %s where 1=1 and id = " . ($id_) . ";";
			}
			$query = $this->wpdb->prepare( $query, 'publish' == $sub_action ? 'Y' : 'N' );
			$__stat = $this->wpdb->query($query);
				
			if ($__stat!== false) {
				$status = 'valid';
				if ( isset($is_bulk) && $is_bulk )
					$status_msg = sprintf( __('bulk rows %s successfully.', 'AArpr'), ('publish' == $sub_action ? __('published', 'AArpr') : __('unpublished', 'AArpr')) );
				else
					$status_msg = sprintf( __('row %s successfully.', 'AArpr'), ('publish' == $sub_action ? __('published', 'AArpr') : __('unpublished', 'AArpr')) );
				
				do_action( 'AArpr_listable_'.$sub_action.'_success', array('action' => $sub_action, 'id' => $id, 'force' => true) );
			}
			else {
				$status_msg = 'error: ' . __FILE__ . ":" . __LINE__;
				do_action( 'AArpr_listable_'.$sub_action.'_failure', array('action' => $sub_action, 'id' => $id, 'force' => true) );
			}
		}
		else {
			$status_msg = 'error: ' . __FILE__ . ":" . __LINE__;
			do_action( 'AArpr_listable_'.$sub_action.'_failure', array('action' => $sub_action, 'id' => $id, 'force' => true) );
		}

		do_action( 'AArpr_listable_'.$sub_action.'_after', array('action' => $sub_action, 'id' => $id, 'force' => true) );

		$ret = array_merge($ret, array(
			'status' 		=> $status,
			'msg'		=> $status_msg
		));
		return $ret;
	}


	/**
	 * Utils
	 */
	public function __set_config_extra( $config=array() ) {
		// defaults are considered for wp_posts table
		$search_box_def = array(
			'status' => false,
			'title' 	=> __('Search', 'AArpr'),
			'fields'	=> array('post_title', 'post_content'),
		);
		
		if ( isset($config['search_box'], $config['search_box']['title']) ) {
			unset($this->config['search_box']);
		}
		$this->config = array_replace_recursive($this->config, array(
			'search_box' 				=> isset($config['search_box'], $config['search_box']['title']) ? $config['search_box'] : $search_box_def,
			'filter_fields' 					=> isset($config['filter_fields']) && !empty($config['filter_fields']) ? $config['filter_fields'] : array(),
		));
	}

	public function __box_items_per_page( $no_placeholder=false ) {
		$items_per_page = $this->__query_field('items_per_page');

		$html = array();
		if ( !$no_placeholder ) {
			$html[] = 		'<div class="AArpr-box-show-per-pages">';
		}
		$html[] = 			'<select name="AArpr-post-per-page" id="AArpr-post-per-page" class="AArpr-post-per-page">';
		$html[] = 				'<option value="" disabled="disabled">' . __('per page', 'AArpr') . '</option>';

		$_range = array_merge( array(), range(1, 4, 1), range(5, 50, 5), range(100, 500, 100), range(1000, 5000, 1000) );
		foreach( $_range as $nr => $val ){
			$html[] = 			'<option val="' . ( $val ) . '" ' . ( $items_per_page == $val ? 'selected' : '' ). '>' . ( $val ) . '</option>';
		}

		$html[] = 				'<option value="all" ' . ( $items_per_page == -1 ? 'selected' : '' ). '>';
		$html[] =				__('Show All', 'AArpr');
		$html[] = 				'</option>';
		$html[] =			'</select>';
		//$html[] = 			'<label for="AArpr-post-per-page" style="width:62px">' . __('per page', 'AArpr') . '</label>';
		if ( !$no_placeholder ) {
			$html[] = 		'</div>';
		}
		return implode(PHP_EOL, $html);
	}

	public function __search_posts_where( $where='' ) {
		$main_alias = $this->query_parts['main_alias'];

		if( $this->__has_search_box() ) {
			$search_box = isset($this->config['search_box']) ? $this->config['search_box'] : false;

			$search_text = $this->__query_field('search_text');
			$search_text = empty($search_text) ? '' : trim($search_text);
			$esc_search_text = esc_sql($search_text);

			if ( isset( $search_text ) && $search_text!='' ) {
				//if ( $search_text!='' && $this->the_plugin->utf8->strlen($search_text)<200 )
				if ( $search_text!='' && strlen($search_text)<200 ) {
					$search_fields = $this->config["search_box"]['fields'];
					$__where = array();
					foreach( $search_fields as $v) {
						$__where[] = "$main_alias.$v regexp '" . $esc_search_text . "'";
					}
					$__where = implode(' OR ', $__where);
					if (count($search_fields) > 1 ) {
						$where .= " AND ( $__where ) ";
					}
					else {
						$where .= " AND $__where ";
					}
				}
			}
		}
		return $where;
	}
	
	public function __print_filters( $which, $no_placeholder=false ) {
		{
			$ret = array(
				'select'			=> array(),
				'links'			=> array(),
				'search'			=> array(),
			);

			$nb_cols = 0;
			$html = array();

			// dropdown filter fields
			$filter_fields = isset($this->config["filter_fields"]) && !empty($this->config["filter_fields"])
				? $this->config["filter_fields"] : array();

			if ( !empty($filter_fields) && is_array($filter_fields) ) {
				//$html[] = '<div class="AArpr-list-table-left-col">';
			}
			foreach ($filter_fields as $field => $vals) {

				$html = array();
				$include_all = isset($vals['include_all']) ? $vals['include_all'] : false;

				//if ( $this->__is_filter_exclude_query( $vals ) ) continue 1;

				if ( $this->__is_filter_dropdown( $vals ) ) {
					$dropdown = $vals['dropdown'];
					$dropdown = preg_replace( 
        				'^' . preg_quote( '<select ' ) . '^imu',
        				'<select data-filter_field="'.$field.'" ',
        				$dropdown
    				);
					$dropdown = preg_replace( 
        				'^' . preg_quote( 'selected="selected"' ) . '^imu',
        				'', 
        				$dropdown 
    				);
					$newval = $this->__query_field($field);
					$dropdown = preg_replace( 
        				'^' . preg_quote( 'value="' . $newval . '"' ) . '^imu',
        				'selected="selected" value="' . $newval . '"', 
        				$dropdown 
    				);
					if ( isset($vals['title']) ) {
						$dropdown = preg_replace( 
	        				'^' . preg_quote( '<option' ) . '^imu',
	        				'<option value="" disabled="disabled">' . $vals['title'] . '</option><option',
	        				$dropdown,
	        				1
	    				);
					}
					$html[] = $dropdown;
					$ret['select'][] = implode(PHP_EOL, $html);
					continue 1;
				}

				$field_val = $this->__query_field($field);

				$allow_empty = ! isset($vals['allow_empty']) || ! $vals['allow_empty'] ? false : true;
				if ( ! $allow_empty ) {
					$field_val = empty($field_val) || trim($field_val) == "" ? '' : $field_val;
				}

				// drowdown options list
				$options = isset($vals['options']) ? $vals['options'] : array();
				if ( isset($vals['options_from_db']) && $vals['options_from_db'] ) {
					$_options = $this->__get_filter_from_db( $field, $vals['options_from_db'] );
					$options = array_merge($options, $_options);
				}

				if ( $include_all ) { // && count($options) > 1
					//$options = array_merge(array(), array(
					//	'all' 		=> __('Show All', 'AArpr'),
					//), $options);
					$options = array() + array( 'all' 		=> __('Show All', 'AArpr'), ) + $options;
				}
				$display = isset($vals['display']) && ('links' == $vals['display']) ? 'links' : 'default';
				if ( 'links' == $display ) {

					$_options = array();

					$html[] = 	'<ul class="subsubsub AArpr-filter-general_field" data-filter_field="'.$field.'">';

					$totals = 0;
					foreach ($options as $opt_key => $opt_text) {
						$_options["$opt_key"] = array('text' => $opt_text, 'nb' => 0);

						if ( 'all' == $opt_key ) continue 1;

						if ( isset($this->filter_fields["$field"], $this->filter_fields["$field"]["count"], $this->filter_fields["$field"]["count"]["$opt_key"]) ) {
							$_options["$opt_key"]['nb'] = (int) $this->filter_fields["$field"]["count"]["$opt_key"]->__nb;
						}
						$totals += $_options["$opt_key"]['nb'];
					}
					$_options["all"]['nb'] = (int) $totals;

					$cc = 0;
					foreach ($_options as $opt_key => $opt_vals) {
						$cc++;

						if ( ('all' == $opt_key) && !$include_all ) continue 1;

						$html[] = 	'<li class="ocs_post_status">';
						$html[] = 		'<a href="#'.$field.'=' . ( $opt_key ) . '" class="' . ( ( (string) $opt_key === (string) $field_val ) || ( 'all' == $opt_key && '' == trim($field_val) ) ? 'current' : '' ) . '" data-filter_val="' . ( $opt_key ) . '">';
						$html[] = 			AArpr_escape($opt_vals['text']) . ' <span class="count">(' . ( $opt_vals['nb'] ) . ')</span>';
						$html[] = 		'</a>' . ( count($_options) > ($cc) ? ' |' : '');
						$html[] = 	'</li>';
					}

					$html[] = 	'</ul>';
					$ret['links'][] = implode(PHP_EOL, $html);
				}
				else {

					// dropdown html
					$html[] = 		'<select name="AArpr-filter-'.$field.'" class="AArpr-filter-general_field" data-filter_field="'.$field.'">';
					if ( isset($vals['title']) ) {
						$html[] =		'<option value="" disabled="disabled">';
						$html[] =			$vals['title'];
						$html[] = 		'</option>';
					}
					//if ( $include_all && count($options) > 1 ) {
					//	$html[] = 		'<option value="all" >';
					//	$html[] =			__('Show All', 'AArpr');
					//	$html[] = 		'</option>';
					//}
					foreach ( $options as $opt_key => $opt_text ){
						$html[] = 		'<option ' . ( (string) $opt_key === (string) $field_val ? 'selected' : '' ) . ' value="' . ( AArpr_escape($opt_key) ) . '">';
						$html[] = 			AArpr_escape($opt_text);
						$html[] = 		'</option>';
					}
					$html[] = 		'</select>';
					$ret['select'][] = implode(PHP_EOL, $html);

				}
			} // end foreach

			if ( !empty($filter_fields) && is_array($filter_fields) ) {
				//$html[] = '</div>';
				$nb_cols++;
			}
			// end dropdown filter fields

			$html = array();
			// search box
			if( $this->__has_search_box() ) {
				$search_box = isset($this->config['search_box']) ? $this->config['search_box'] : false;

				$search_text = $this->__query_field('search_text');
				$search_text = empty($search_text) ? '' : trim($search_text);

				$search_title = isset($search_box['title'])
					? $search_box['title'] : __('Search', 'AArpr');

				$search_fields = isset($search_box['fields']) ? implode(',', $search_box['fields']) : '';

				//$html[] = 	'<div class="AArpr-list-table-right-col ">';
				$html[] = 		'<div class="AArpr-list-table-search-box">';
				$html[] = 			'<input type="search" name="AArpr-search-text" id="AArpr-search-text" value="'.($search_text).'" class="'.($search_text!='' ? 'search-highlight' : '').'" />';
				$html[] = 			'<input type="button" name="AArpr-search-btn" id="AArpr-search-btn" class="button" value="' . $search_title . '" />';
				$html[] = 		'</div>';
				//$html[] = 	'</div>';

				$ret['search'][] = implode(PHP_EOL, $html);

				$nb_cols++;
			}
			// end search box
			
			if ( $nb_cols ) {
				$html_ = implode(PHP_EOL, $html);
				$html = array();

				if ( !$no_placeholder ) {
				$html[] = '
					<div class="tablenav ' . esc_attr( $which ) . ' AArpr-list-table-wrapper">
				';
				}
				
				$html[] = $html_;
	
				if ( !$no_placeholder ) {
				$html[] = '
					<br class="clear" />
					</div>
				';
				}
			}

			//return implode(PHP_EOL, $html);
			foreach ($ret as $key => $val) {
				$ret["$key"] = implode(PHP_EOL, $val);
			}
			return $ret;
		}
	}
	
	public function __print_box_which( $which, $filters=array() ) {
		$__print_filters = $filters;
		
		if ( 'top' == $which ) {
		?>

			<div class="AArpr-list-table-wrapper">

				<div class="AArpr-list-table-left-col">
					<div>
						<?php echo $__print_filters['links'];?>
					</div>
					<div>
						<?php if ( $this->has_items() ): ?>
							<div class="alignleft actions bulkactions">
								<?php $this->bulk_actions( $which ); ?>
							</div>
						<?php endif; ?>

						<?php echo $__print_filters['select'];?>
					</div>
				</div><!-- end AArpr-list-table-left-col -->

				<div class="AArpr-list-table-right-col">
					<div>
						<?php echo $__print_filters['search'];?>
					</div>

					<?php
						if ( $this->has_items() ) {
							echo $this->__box_items_per_page();
						}
					?>
					<?php
						$this->pagination( $which );
					?>
				</div><!-- end AArpr-list-table-right-col -->

			</div><!-- end AArpr-list-table-wrapper -->

		<?php
		}
		else if ( 'bottom' == $which ) {
		?>
		
			<?php if ( $this->has_items() ): ?>
			<div class="alignleft actions bulkactions">
				<?php $this->bulk_actions( $which ); ?>
			</div>
			<?php endif; ?>
				
			<?php
				if ( $this->has_items() ) {
					echo $this->__box_items_per_page();
				}
			?>
				
			<?php
			$this->pagination( $which );
			?>

			<br class="clear" />

		<?php
		}
	}

	public function __has_search_box() {
		$search_box = isset($this->config['search_box'], $this->config['search_box']['title'])
			? $this->config['search_box'] : false;
    
		if( !empty($search_box) && ( !isset($search_box['status']) || $search_box['status'] ) ) {
			return true;
		}
		return false;
	}
	
	public function __has_filters() {
		$filter_fields = isset($this->config["filter_fields"]) && !empty($this->config["filter_fields"])
			? $this->config["filter_fields"] : array();

		if ( !empty($filter_fields) && is_array($filter_fields) ) {
			$count = array_keys($filter_fields);
			foreach ($filter_fields as $key => $filter_field) {
				//if ( preg_match('/^__/', $key) ) {
				if ( isset($filter_field['exclude_query']) && $filter_field['exclude_query'] ) {
					$count = array_diff($count, array($key));
				}
			}
			return !empty($count) ? true : false;
		}
		return false;
	}
	
	public function __is_filter_exclude_query( $filter_field ) {
		if ( isset($filter_field['exclude_query']) && $filter_field['exclude_query'] ) {
			return true;
		}
		return false;
	}

	public function __is_filter_dropdown( $filter_field ) {
		if ( isset($filter_field['dropdown']) && $filter_field['dropdown'] ) {
			return true;
		}
		return false;
	}
 
	public function __query_field( $field, $req=array() ) {
		if ( !empty($req) && is_array($req) ) {
			if ( isset($req["$field"]) ) return $req["$field"];
			return false;
		}
  
		$what = array(
			'request'	=> isset($_REQUEST) && !empty($_REQUEST) && is_array($_REQUEST) ? $_REQUEST : array(),
			'sess' 		=> isset($_SESSION['AArpr_ListTable'], $_SESSION['AArpr_ListTable'][$this->config['ajaxid']], $_SESSION['AArpr_ListTable'][$this->config['ajaxid']]['params']) 
				? $_SESSION['AArpr_ListTable'][$this->config['ajaxid']]['params'] : array(),
			'config'		=> $this->config,
		);
		foreach ( $what as $w) {
			if ( !empty($w) && is_array($w) ) {
				if ( isset($w["$field"]) ) return $w["$field"];
				//return false;
			}
		}
		return false;
	}
	
	public function __get_filter_from_db( $field='', $helper_arr=array() ) {
		if (empty($field)) return array();

		$table = $this->config['table'];
		$sql = "SELECT a.$field as __field FROM " . $table . " as a WHERE 1=1 GROUP BY a.$field ORDER BY a.$field ASC;";
	    $res = $this->wpdb->get_results( $sql, ARRAY_A);

		$rows = array();
	    foreach ($res as $key => $vals){
	    	$id = $vals['__field'];
			$rows["$id"] = ucfirst( $id );
			
			if (!empty($helper_arr) && is_array($helper_arr) && isset($helper_arr["$id"])) {
				$rows["$id"] = $helper_arr["$id"];
			}
		}
		return $rows;
	}
}