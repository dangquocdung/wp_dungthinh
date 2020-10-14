<?php

class Edr_Entries {
	/**
	 * @var Edr_Entries
	 */
	protected static $instance = null;

	/**
	 * Get instance.
	 *
	 * @return Edr_Entries
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	protected function __construct() {
		$tables = edr_db_tables();
		$this->entries = $tables['entries'];
	}

	/**
	 * Get entry.
	 *
	 * @param array $args
	 * @return false|Edr_Entry
	 */
	public function get_entry( $args ) {
		global $wpdb;
		$sql = "SELECT * FROM $this->entries WHERE 1";

		if ( isset( $args['payment_id'] ) ) {
			$sql .= ' AND payment_id = ' . intval( $args['payment_id'] );
		}

		if ( isset( $args['course_id'] ) ) {
			$sql .= ' AND course_id = ' . intval( $args['course_id'] );
		}

		if ( isset( $args['user_id'] ) ) {
			$sql .= ' AND user_id = ' . intval( $args['user_id'] );
		}

		if ( isset( $args['entry_status'] ) ) {
			$sql .= $wpdb->prepare( ' AND entry_status = %s', $args['entry_status'] );
		}

		$row = $wpdb->get_row( $sql );

		if ( $row ) {
			return edr_get_entry( $row );
		}

		return false;
	}

	/**
	 * Get entries.
	 *
	 * @param array $args
	 * @param string $output_type
	 * @return array
	 */
	public function get_entries( $args, $output_type = OBJECT ) {
		global $wpdb;
		$sql = "SELECT * FROM $this->entries WHERE 1";

		// Entry ID.
		if ( isset( $args['entry_id'] ) ) {
			if ( is_array( $args['entry_id'] ) ) {
				$ids = implode( ',', array_map( 'intval', $args['entry_id'] ) );
				$sql .= " AND ID IN ($ids)";
			} else {
				$sql .= ' AND ID = ' . intval( $args['entry_id'] );
			}
		}

		// Course ID.
		if ( isset( $args['course_id'] ) ) {
			if ( is_array( $args['course_id'] ) ) {
				$ids = implode( ',', array_map( 'intval', $args['course_id'] ) );
				$sql .= " AND course_id IN ($ids)";
			} else {
				$sql .= ' AND course_id = ' . intval( $args['course_id'] );
			}
		}

		// User ID.
		if ( isset( $args['user_id'] ) ) {
			if ( is_array( $args['user_id'] ) ) {
				$ids = implode( ',', array_map( 'intval', $args['user_id'] ) );
				$sql .= " AND user_id IN ($ids)";
			} else {
				$sql .= ' AND user_id = ' . intval( $args['user_id'] );
			}
		}

		// Payment ID.
		if ( isset( $args['payment_id'] ) ) {
			$sql .= ' AND payment_id = ' . intval( $args['payment_id'] );
		}

		// Entry status.
		if ( isset( $args['entry_status'] ) ) {
			$sql .= $wpdb->prepare( ' AND entry_status = %s', $args['entry_status'] );
		}

		// Entry origin.
		if ( isset( $args['entry_origin'] ) ) {
			$sql .= $wpdb->prepare( ' AND entry_origin = %s', $args['entry_origin'] );
		}

		$pagination_sql = '';
		$has_pagination = isset( $args['page'] ) && isset( $args['per_page'] ) &&
			is_numeric( $args['page'] ) && is_numeric( $args['per_page'] );

		if ( $has_pagination ) {
			$num_rows = $wpdb->get_var( str_replace( 'SELECT *', 'SELECT count(1)', $sql ) );
			$pagination_sql .= ' LIMIT ' . ( ( $args['page'] - 1 ) * $args['per_page'] ) . ', ' . $args['per_page'];
		}

		$entries = $wpdb->get_results( $sql . ' ORDER BY entry_date DESC' . $pagination_sql, $output_type );

		if ( $entries ) {
			if ( OBJECT == $output_type ) {
				$entries = array_map( 'edr_get_entry', $entries );
			}
		}

		if ( $has_pagination ) {
			return array(
				'num_pages' => (int) ceil( $num_rows / $args['per_page'] ),
				'num_items' => (int) $num_rows,
				'rows'      => $entries,
			);
		}

		return $entries;
	}
}
