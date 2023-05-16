<?php

namespace Synerise\Integration\Synchronization\DataStore;

use Synerise\Integration\Synchronization\Queue;
use Synerise\Integration\Synchronization\Queue_Data;

defined( 'ABSPATH' ) || exit;

class Queue_Data_Store  {

	const SNRS_SYNC_QUEUE_TABLE = 'snrs_sync_queue';

	/**
	 * Get the table name for sync queue items.
	 *
	 * @return string
	 */
	public static function get_table_name() {
		return self::SNRS_SYNC_QUEUE_TABLE;
	}

	/**
	 * Create sync queue item.
	 *
	 * @param Queue_Data $queue sync queue object.
	 */
	public function create( Queue_Data &$queue ) {
		global $wpdb;

		$data = array(
            'model'           => $queue->get_model( 'edit' ),
            'entity_id'        => $queue->get_entity_id( 'edit' ),
		);

		$format = array(
			'%s',
			'%s'
		);

		$result = $wpdb->replace(
			$wpdb->prefix . self::get_table_name(),
			apply_filters( 'snrs_sync_queue_insert_data', $data ),
			apply_filters( 'snrs_sync_queue_insert_format', $format, $data )
		);
		do_action( 'snrs_sync_queue_insert', $data );

		if ( $result ) {
            $queue->set_id( $wpdb->insert_id );
            $queue->apply_changes();
		} else {
			wp_die( esc_html__( 'Unable to insert sync queue item entry in database.', 'synerise-for-woocommerce' ) );
		}
	}

    /**
     * @param Queue_Data[] $queue_items
     * @return void
     */
    public function create_multiple(array $queue_items)
    {
        global $wpdb;

        $values = $place_holders = array();

        foreach($queue_items as $queue_item) {
            array_push( $values, $queue_item->get_model( 'edit' ), $queue_item->get_entity_id( 'edit' ));
            $place_holders[] = "(%s, %s)";
        }


        $query  = "REPLACE INTO ".$wpdb->prefix.self::get_table_name()." (`model`, `entity_id`) VALUES ";
        $query .= implode( ', ', $place_holders );
        $sql = $wpdb->prepare( "$query ", $values );

        $result = $wpdb->query( $sql );

        if ( !$result ){
            wp_die( esc_html__( 'Unable to insert sync queue item entry in database.', 'synerise-for-woocommerce' ) );
        }
    }

	/**
	 * Method to read a sync queue item from the database.
	 *
	 * @param Queue_Data $queue sync queue item object.
	 * @throws \Exception Exception when read is not possible.
	 */
	public function read( &$queue ) {
		global $wpdb;

        $queue->set_defaults();

		// Ensure we have an id to pull from the DB.
		if ( ! $queue->get_id() ) {
			throw new \Exception( __( 'Invalid sync queue: no ID.', 'woocommerce' ) );
		}

		$table_name = $wpdb->prefix . self::get_table_name();

		// Query the DB for the sync queue item.
		$raw_synerise_sync = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table_name} WHERE id = %d", $queue->get_id() ) );

		if ( ! $raw_synerise_sync ) {
			throw new \Exception( __( 'Invalid sync queue item: not found.', 'woocommerce' ) );
		}

        $queue->set_props(
			array(
                'model'           => $raw_synerise_sync->model,
                'entity_id'        => $raw_synerise_sync->entity_id,
			)
		);

        $queue->set_object_read( true );
	}

	/**
	 * Method to update sync queue item in the database.
	 *
	 * @param Queue_Data $queue sync queue item object.
	 */
	public function update( &$queue ) {
		global $wpdb;

		$data = array(
            'model'           => $queue->get_model( 'edit' ),
            'entity_id'        => $queue->get_entity_id( 'edit' ),
		);

		$format = array(
			'%s',
			'%s',
		);

		$wpdb->update(
			$wpdb->prefix . self::get_table_name(),
			$data,
			array(
				'id' => $queue->get_id(),
			),
			$format
		);
        $queue->apply_changes();
	}

    public function delete_multiple(array $queue_items) {
        global $wpdb;

        $ids = implode( ',', $queue_items );
        $sql = "DELETE FROM ".$wpdb->prefix.self::get_table_name()." WHERE ID IN($ids)";
        $result = $wpdb->query($sql);

        if ( !$result ){
            wp_die( esc_html__( 'Unable to delete sync queue items from database.', 'synerise-for-woocommerce' ) );
        }

    }
	/**
	 * Get sync queue item object.
	 *
	 * @param  array $data From the DB.
	 * @return Queue_Data
     */
	private function get_queue_item( $data ) {
		return new Queue_Data( $data );
	}

	/**
	 * Get array of sync queue items ids by specified args.
	 *
	 * @param  array $args Arguments to define sync queue items to retrieve.
	 * @return array
	 */
	public function get_queue_items( $args = array() ) {
		global $wpdb;

		$args = wp_parse_args(
			$args,
			array(
                'model'           => '',
                'entity_id'       => '',
				'order_by'         => 'id',
				'order'           => 'ASC',
				'limit'           => -1,
				'page'            => 1,
				'return'          => 'objects',
			)
		);

		$query   = array();
		$table_name   = $wpdb->prefix . self::get_table_name();
		$query[] = "SELECT * FROM {$table_name} WHERE 1=1";

		if ( $args['model'] ) {
			$query[] = $wpdb->prepare( 'AND model = %d', $args['model'] );
		}

		if ( $args['entity_id'] ) {
			$query[] = $wpdb->prepare( 'AND entity_id = %d', $args['entity_id'] );
		}

		$allowed_orders = array( 'id', 'model' );
		$order_by        = in_array( $args['order_by'], $allowed_orders, true ) ? $args['order_by'] : 'id';
		$order          = 'DESC' === strtoupper( $args['order'] ) ? 'DESC' : 'ASC';
		$order_by_sql    = sanitize_sql_orderby( "{$order_by} {$order}" );
		$query[]        = "ORDER BY {$order_by_sql}";

		if ( 0 < $args['limit'] ) {
            $query[] = $wpdb->prepare( 'LIMIT %d', absint( $args['limit'] ) );
		}

		$raw_sync_queues = $wpdb->get_results( implode( ' ', $query ) );

		switch ( $args['return'] ) {
			case 'ids':
				return wp_list_pluck( $raw_sync_queues, 'id' );
			default:
				return array_map( array( $this, 'get_queue_item' ), $raw_sync_queues );
		}
	}

	public function get_single_queue_item_by_id_and_model($entity_id, $model){
		global $wpdb;

		$table_name   = $wpdb->prefix . self::get_table_name();
		$query = $wpdb->prepare("SELECT * FROM {$table_name} WHERE entity_id = %d AND model = %s", $entity_id, $model);

		$raw_sync_queue_item = $wpdb->get_row( $query );

		return $this->get_queue_item($raw_sync_queue_item);
	}
}
