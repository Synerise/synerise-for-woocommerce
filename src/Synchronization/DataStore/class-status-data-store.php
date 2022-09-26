<?php

namespace Synerise\Integration\Synchronization\DataStore;

use Synerise\Integration\Synchronization\Status_Data;

class Status_Data_Store  {

	const SNRS_SYNC_STATUS_TABLE = 'snrs_sync_status';

	/**
	 * Get the table name for sync statuses.
	 *
	 * @return string
	 */
	public static function get_table_name() {
		return self::SNRS_SYNC_STATUS_TABLE;
	}

	/**
	 * Create sync status.
	 *
	 * @param Status_Data $status sync status object.
	 */
	public function create( Status_Data &$status ) {
		global $wpdb;

		$data = array(
            'model'           => $status->get_model( 'edit' ),
            'start_id'        => $status->get_start_id( 'edit' ),
            'stop_id'         => $status->get_stop_id( 'edit' ),
            'state'           => $status->get_state( 'edit' )
		);

		$format = array(
			'%s',
			'%s',
			'%s',
			'%s',
		);

		$result = $wpdb->insert(
			$wpdb->prefix . self::get_table_name(),
			apply_filters( 'snrs_sync_status_insert_data', $data ),
			apply_filters( 'snrs_sync_status_insert_format', $format, $data )
		);

		do_action( 'snrs_sync_status_insert', $data );

		if ( $result ) {
			$status->set_id( $wpdb->insert_id );
			$status->apply_changes();
		} else {
			wp_die( esc_html__( 'Unable to insert sync status entry in database.', 'synerise-for-woocommerce' ) );
		}
	}

	/**
	 * Method to read a sync status from the database.
	 *
	 * @param Status_Data $status sync status object.
	 * @throws \Exception Exception when read is not possible.
	 */
	public function read( &$status ) {
		global $wpdb;

		$status->set_defaults();

		// Ensure we have an id to pull from the DB.
		if ( ! $status->get_id() ) {
			throw new \Exception( __( 'Invalid sync status: no ID.', 'woocommerce' ) );
		}

		$table = $wpdb->prefix . self::get_table_name();

		// Query the DB for the sync status.
		$raw_synerise_sync = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id = %d", $status->get_id() ) ); // WPCS: unprepared SQL ok.

		if ( ! $raw_synerise_sync ) {
			throw new \Exception( __( 'Invalid sync status: not found.', 'woocommerce' ) );
		}

		$status->set_props(
			array(
                'model'           => $raw_synerise_sync->model,
                'start_id'        => $raw_synerise_sync->start_id,
                'stop_id'         => $raw_synerise_sync->stop_id,
                'state'           => $raw_synerise_sync->state
			)
		);

		$status->set_object_read( true );
	}

	/**
	 * Method to update sync status in the database.
	 *
	 * @param Status_Data $status sync status object.
	 */
	public function update( &$status ) {
		global $wpdb;

		$data = array(
            'model'           => $status->get_model( 'edit' ),
            'start_id'        => $status->get_start_id( 'edit' ),
            'stop_id'         => $status->get_stop_id( 'edit' ),
            'state'           => $status->get_state( 'edit' )
		);

		$format = array(
			'%s',
			'%s',
			'%s',
			'%s',
		);

		$wpdb->update(
			$wpdb->prefix . self::get_table_name(),
			$data,
			array(
				'id' => $status->get_id(),
			),
			$format
		);
		$status->apply_changes();
	}

	/**
	 * Get sync status object.
	 *
	 * @param mixed $data From the DB.
	 *
	 * @return Status_Data
	 */
	private function get_sync_status( $data ): Status_Data {
		return new Status_Data( $data );
	}

	/**
	 * Get array of sync status ids by specified args.
	 *
	 * @param array $args Arguments to define sync statuses to retrieve.
	 * @return array
	 */
	public function get_sync_statuses(array $args = array() ): array
    {
		global $wpdb;

		$args = wp_parse_args(
			$args,
			array(
                'model'           => '',
                'start_id'        => '',
                'stop_id'         => '',
                'state'           => '',
				'order_by'         => 'id',
				'order'           => 'ASC',
				'limit'           => -1,
				'page'            => 1,
				'return'          => 'objects',
			)
		);

		$query   = array();
		$table   = $wpdb->prefix . self::get_table_name();
		$query[] = "SELECT * FROM {$table} WHERE 1=1";

		if ( $args['model'] ) {
			$query[] = $wpdb->prepare( 'AND model = %d', $args['model'] );
		}

		if ( !empty($args['start_id']) ) {
			$query[] = $wpdb->prepare( 'AND start_id = %d', $args['start_id'] );
		}

		if ( !empty($args['stop_id']) ) {
			$query[] = $wpdb->prepare( 'AND stop_id = %s', $args['stop_id'] );
		}

        $query[] = $wpdb->prepare( 'AND state = %s', $args['state'] );


		$allowed_orders = array( 'id', 'model', 'state' );
		$order_by        = in_array( $args['order_by'], $allowed_orders, true ) ? $args['order_by'] : 'id';
		$order          = 'DESC' === strtoupper( $args['order'] ) ? 'DESC' : 'ASC';
		$order_by_sql    = sanitize_sql_orderby( "{$order_by} {$order}" );
		$query[]        = "ORDER BY {$order_by_sql}";

		if ( 0 < $args['limit'] ) {
			$query[] = $wpdb->prepare( 'LIMIT %d, %d', absint( $args['limit'] ) * absint( $args['page'] - 1 ), absint( $args['limit'] ) );
		}

		$raw_sync_statuses = $wpdb->get_results( implode( ' ', $query ) );

		switch ( $args['return'] ) {
			case 'ids':
				return wp_list_pluck( $raw_sync_statuses, 'id' );
			default:
				return array_map( array( $this, 'get_sync_status' ), $raw_sync_statuses );
		}
	}

    /**
     * Get sync status by specified args.
     *
     * @param array $args Arguments to define sync status to retrieve.
     * @return \Synerise\Integration\Synchronization\Status_Data|int
     */
    public function get_sync_status_by_model(array $args = array() ) {
        global $wpdb;

        $args = wp_parse_args(
            $args,
            array(
                'model'           => '',
                'return'          => 'objects',
            )
        );

        $query   = array();
        $table   = $wpdb->prefix . self::get_table_name();
        $query[] = "SELECT * FROM {$table} WHERE 1=1";

        if ( $args['model'] ) {
            $query[] = $wpdb->prepare( 'AND model = %s', $args['model'] );
        }

        $raw_sync_status = $wpdb->get_row( implode( ' ', $query ) );

        switch ( $args['return'] ) {
            case 'id':
                return $raw_sync_status->id;
            default:
                return $this->get_sync_status($raw_sync_status);
        }
    }
}
