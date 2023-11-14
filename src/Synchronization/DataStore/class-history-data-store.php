<?php

namespace Synerise\Integration\Synchronization\DataStore;

use Exception;
use Synerise\Integration\Synchronization\History_Data;


class History_Data_Store
{

    const SNRS_SYNC_HISTORY_TABLE = 'snrs_sync_history';

    /**
     * Create sync history.
     *
     * @param History_Data $history sync history object.
     */
    public function create(History_Data &$history)
    {
        global $wpdb;

        $data = array(
            'model' => $history->get_model('edit'),
            'entity_id' => $history->get_entity_id('edit'),
        );

        $format = array(
            '%s',
            '%s',
        );

        $result = $wpdb->insert(
            $wpdb->prefix . self::get_table_name(),
            apply_filters('snrs_sync_history_insert_data', $data),
            apply_filters('snrs_sync_history_insert_format', $format, $data)
        );

        do_action('snrs_sync_history_insert', $data);

        if ($result) {
            $history->set_id($wpdb->insert_id);
            $history->apply_changes();
        } else {
            wp_die(esc_html__('Unable to insert sync history entry in database.', 'synerise-for-woocommerce'));
        }
    }

    /**
     * Get the table name for sync history.
     *
     * @return string
     */
    public static function get_table_name()
    {
        return self::SNRS_SYNC_HISTORY_TABLE;
    }

    /**
     * @param History_Data[] $historyItems
     * @return void
     */
    public function createMultiple(array $historyItems)
    {
        global $wpdb;

        if (empty($historyItems)) {
            return;
        }

        $values = $place_holders = array();

        foreach ($historyItems as $historyItem) {
            array_push($values, $historyItem->get_model('edit'), $historyItem->get_entity_id('edit'));
            $place_holders[] = "(%s, %s)";
        }

        $query = "INSERT INTO " . $wpdb->prefix . self::get_table_name() . " (`model`, `entity_id`) VALUES ";
        $query .= implode(', ', $place_holders);
        $query .= ' ON DUPLICATE KEY UPDATE `entity_id`=VALUES(`entity_id`)';
        $sql = $wpdb->prepare("$query ", $values);

        $wpdb->query($sql);
    }

    /**
     * Method to read a sync history from the database.
     *
     * @param History_Data $history object.
     *
     * @throws Exception Exception when read is not possible.
     */
    public function read(&$history)
    {
        global $wpdb;

        $history->set_defaults();

        if (!$history->get_id()) {
            throw new Exception(__('Invalid sync history: no ID.', 'woocommerce'));
        }

        $table = $wpdb->prefix . self::get_table_name();

        $raw_synerise_history = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$table} WHERE id = %d", $history->get_id()));

        if (!$raw_synerise_history) {
            throw new Exception(__('Invalid sync history: not found.', 'woocommerce'));
        }

        $history->set_props(
            array(
                'model' => $raw_synerise_history->model,
                'entity_id' => $raw_synerise_history->entity_id,
                'synerise_updated_at' => $raw_synerise_history->synerise_updated_at
            )
        );

        $history->set_object_read(true);
    }

    /**
     * Method to update sync history in the database.
     *
     * @param History_Data $history sync object.
     */
    public function update(&$history)
    {
        global $wpdb;

        $data = array(
            'model' => $history->get_model('edit'),
            'entity_id' => $history->get_entity_id('edit'),
            'synerise_updated_at' => $history->get_synerise_updated_at('edit')
        );

        $format = array(
            '%s',
            '%s',
            '%s',
        );

        $wpdb->update(
            $wpdb->prefix . self::get_table_name(),
            $data,
            array(
                'id' => $history->get_id(),
            ),
            $format
        );

        $history->apply_changes();
    }

    public function get_sync_count($model = null)
    {
        global $wpdb;

        $table = $wpdb->prefix . self::get_table_name();

        $query[] = "SELECT COUNT(ID) FROM {$table} WHERE 1=1";

        if ($model) {
            $query[] = $wpdb->prepare('AND model = %s', $model);
        }

        $result = $wpdb->get_var(implode(' ', $query));
        return $result;
    }

    /**
     * Get array of sync histories ids by specified args.
     *
     * @param array $args Arguments to define sync histories to retrieve.
     * @return array
     */
    public function get_sync_histories(array $args = array()): array
    {
        global $wpdb;

        $args = wp_parse_args(
            $args,
            array(
                'model' => '',
                'entity_id' => '',
                'synerise_updated_at' => '',
                'order_by' => 'id',
                'order' => 'ASC',
                'limit' => -1,
                'page' => 1,
                'return' => 'objects',
            )
        );

        $query = array();
        $table = $wpdb->prefix . self::get_table_name();
        $query[] = "SELECT * FROM {$table} WHERE 1=1";

        if ($args['model']) {
            $query[] = $wpdb->prepare('AND model = %d', $args['model']);
        }

        if (!empty($args['entity_id'])) {
            $query[] = $wpdb->prepare('AND entity_id = %d', $args['entity_id']);
        }

        if (!empty($args['synerise_updated_at'])) {
            $query[] = $wpdb->prepare('AND synerise_updated_at = %s', $args['synerise_updated_at']);
        }

        $allowed_orders = array('id', 'model', 'synerise_updated_at');
        $order_by = in_array($args['order_by'], $allowed_orders, true) ? $args['order_by'] : 'id';
        $order = 'DESC' === strtoupper($args['order']) ? 'DESC' : 'ASC';
        $order_by_sql = sanitize_sql_orderby("{$order_by} {$order}");
        $query[] = "ORDER BY {$order_by_sql}";

        if (0 < $args['limit']) {
            $query[] = $wpdb->prepare('LIMIT %d, %d', absint($args['limit']) * absint($args['page'] - 1), absint($args['limit']));
        }

        $raw_sync_histories = $wpdb->get_results(implode(' ', $query));

        switch ($args['return']) {
            case 'ids':
                return wp_list_pluck($raw_sync_histories, 'id');
            default:
                return array_map(array($this, 'get_sync_history'), $raw_sync_histories);
        }
    }

    public function delete_by(array $args)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . self::get_table_name();
        $result = $wpdb->delete($table_name, $args);

        if ($result === false) {
            wp_die(esc_html__('Unable to delete sync history items from database.', 'synerise-for-woocommerce'));
        }
    }

    /**
     * Get sync history object.
     *
     * @param array $data From the DB.
     *
     * @return History_Data
     */
    private function get_sync_history($data): History_Data
    {
        return new History_Data($data);
    }
}
