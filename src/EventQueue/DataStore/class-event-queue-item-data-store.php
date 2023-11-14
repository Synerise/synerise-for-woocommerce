<?php

namespace Synerise\Integration\Event_Queue;


use Exception;

class Item_Data_Store
{

    const SNRS_EVENT_QUEUE_ITEM_TABLE = 'snrs_event_queue_item';

    /**
     * Create event queue item record.
     *
     * @param Item_Data $item event queue item.
     */
    public function create(Item_Data &$item)
    {
        global $wpdb;

        $data = array(
            'id' => $item->get_id('edit'),
            'event_name' => $item->get_event_name('edit'),
            'payload' => $item->get_payload('edit'),
            'entity_id' => $item->get_entity_id('edit')
        );

        $format = array(
            '%s',
            '%s',
            '%s',
            '%s',
        );

        $result = $wpdb->insert(
            $wpdb->prefix . self::get_table_name(),
            apply_filters('snrs_event_queue_item_insert_data', $data),
            apply_filters('snrs_event_queue_item_insert_format', $format, $data)
        );

        do_action('snrs_event_queue_item_insert', $data);

        if ($result) {
            $item->set_id($wpdb->insert_id);
            $item->apply_changes();
        } else {
            wp_die(esc_html__('Unable to insert event queue item entry in database.', 'synerise-for-woocommerce'));
        }
    }

    /**
     * Get the table name for event queue items.
     *
     * @return string
     */
    public static function get_table_name()
    {
        return self::SNRS_EVENT_QUEUE_ITEM_TABLE;
    }

    /**
     * @param Item_Data[] $items
     * @return void
     */
    public function createMultiple(array $items)
    {
        global $wpdb;

        if (empty($items)) {
            return;
        }

        $values = $place_holders = array();

        foreach ($items as $item) {
            array_push(
                $values,
                $item->get_event_name('edit'),
                $item->get_payload('edit'),
                $item->get_entity_id('edit')
            );
            $place_holders[] = "(%s, %s, %s)";
        }

        $query = "INSERT INTO " . $wpdb->prefix . self::get_table_name() . " (`event_name`, `payload`, `entity_id`) VALUES ";
        $query .= implode(', ', $place_holders);
        $query .= ' ON DUPLICATE KEY UPDATE `payload`=VALUES(`payload`)';

        $sql = $wpdb->prepare("$query ", $values);

        $wpdb->query($sql);
    }

    /**
     * Method to read a event queue item from the database.
     *
     * @param Item_Data $item object.
     *
     * @throws Exception Exception when read is not possible.
     */
    public function read(&$item)
    {
        global $wpdb;

        if (!$item->get_id()) {
            throw new Exception(__('Invalid event queue item: no ID.', 'woocommerce'));
        }

        $table = $wpdb->prefix . self::get_table_name();

        $raw_synerise_event_queue_item = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id = %d", $item->get_id()));

        if (!$raw_synerise_event_queue_item) {
            throw new Exception(__('Invalid event queue item: not found.', 'woocommerce'));
        }

        $item->set_props(
            array(
                'id' => $raw_synerise_event_queue_item->id,
                'event_name' => $raw_synerise_event_queue_item->event_name,
                'payload' => $raw_synerise_event_queue_item->payload,
                'entity_id' => $raw_synerise_event_queue_item->entity_id
            )
        );

        $item->set_object_read(true);
    }

    /**
     * Method to update event queue item in the database.
     *
     * @param Item_Data $item event queue item object.
     */
    public function update(&$item)
    {
        global $wpdb;

        $item->apply_changes();

        $data = array(
            'id' => $item->get_id('edit'),
            'event_name' => $item->get_event_name('edit'),
            'payload' => $item->get_payload('edit'),
            'entity_id' => $item->get_entity_id('edit'),
            'retry_count' => $item->get_retry_count('edit'),
            'retry_at' => $item->get_retry_at('edit')
        );

        $format = array(
            '%d',
            '%s',
            '%s',
            '%d',
            '%d',
            '%s',
        );

        $wpdb->update(
            $wpdb->prefix . self::get_table_name(),
            $data,
            array(
                'id' => $item->get_id(),
            ),
            $format
        );
    }

    /**
     * Get array of event queue item ids by specified args.
     *
     * @param array $args Arguments to define event queue items to retrieve.
     * @return array
     */
    public function get_event_queue_items(array $args = array()): array
    {
        global $wpdb;

        $args = wp_parse_args(
            $args,
            array(
                'event_name' => '',
                'entity_id' => '',
                'id' => '',
                'order_by' => 'id',
                'order' => 'ASC',
                'limit' => -1,
                'page' => 1,
                'return' => 'objects'
            )
        );

        $query = array();
        $table = $wpdb->prefix . self::get_table_name();
        $query[] = "SELECT * FROM {$table} WHERE 1=1";

        if ($args['event_name']) {
            $query[] = $wpdb->prepare('AND event_name = %d', $args['event_name']);
        }

        if (!empty($args['entity_id'])) {
            $query[] = $wpdb->prepare('AND entity_id = %d', $args['entity_id']);
        }

        if (!empty($args['id'])) {
            $query[] = $wpdb->prepare('AND id = %d', $args['id']);
        }

        if (!empty($args['retry_interval'])) {
            $query[] = $wpdb->prepare('AND retry_at IS NULL OR retry_at <= NOW() - INTERVAL %d MINUTE', $args['retry_interval']);
        }

        $allowed_orders = array('id', 'event_name', 'entity_id');
        $order_by = in_array($args['order_by'], $allowed_orders, true) ? $args['order_by'] : 'id';
        $order = 'DESC' === strtoupper($args['order']) ? 'DESC' : 'ASC';
        $order_by_sql = sanitize_sql_orderby("{$order_by} {$order}");
        $query[] = "ORDER BY {$order_by_sql}";

        if (0 < $args['limit']) {
            $query[] = $wpdb->prepare('LIMIT %d, %d', absint($args['limit']) * absint($args['page'] - 1), absint($args['limit']));
        }

        $raw_event_queue_items = $wpdb->get_results(implode(' ', $query));

        switch ($args['return']) {
            case 'ids':
                return wp_list_pluck($raw_event_queue_items, 'id');
            default:
                return array_map(array($this, 'get_event_queue_item'), $raw_event_queue_items);
        }
    }

    public function delete_by(array $args)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::get_table_name();
        $result = $wpdb->delete($table_name, $args);

        if ($result === false) {
            wp_die(esc_html__('Unable to delete event queue items from database.', 'synerise-for-woocommerce'));
        }
    }

    public function delete_multiple(array $queue_items)
    {
        global $wpdb;

        $ids = implode(',', $queue_items);
        $sql = "DELETE FROM " . $wpdb->prefix . self::get_table_name() . " WHERE ID IN($ids)";
        $result = $wpdb->query($sql);

        if (!$result) {
            wp_die(esc_html__('Unable to delete sync queue items from database.', 'synerise-for-woocommerce'));
        }

    }

    /**
     * Get event queue item object.
     *
     * @param array $data From the DB.
     *
     * @return Item_Data
     */
    private function get_event_queue_item($data): Item_Data
    {
        return new Item_Data($data);
    }
}
