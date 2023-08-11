<?php

namespace Synerise\Integration;

use Synerise\Integration\Synchronization\Status_Data;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Synerise\Integration
 */
class Synerise_For_Woocommerce_Activator {

    const SYNC_QUEUE_TABLE_NAME = 'snrs_sync_queue';
    const SYNC_STATUS_TABLE_NAME = 'snrs_sync_status';
    const SYNC_HISTORY_TABLE_NAME = 'snrs_sync_history';

    const defaults = [
        'synerise_api_key' => '',
        'synerise_api_host_url' => 'https://api.synerise.com',
        'synerise_api_guid' => '',
        'basic_auth_enabled' => false,
        'request_logging_enabled' => false,
        'event_tracking_enabled' => true,
        'event_tracking_events' => [
            ["value" => "register", "label" => "Customer registration"],
            ["value" => "login", "label" => "Customer login"],
            ["value" => "logout", "label" => "Customer logout"],
            ["value" => "customer_update", "label" => "Customer data saved"],
            ["value" => "add_to_cart", "label" => "Customer added product to cart"],
            ["value" => "remove_from_cart", "label" => "Customer removed product from cart"],
            ["value" => "cart_status_change", "label" => "Cart status"],
            ["value" => "order_placed", "label" => "Customer placed order"],
            ["value" => "order_update", "label" => "Order update"],
            ["value" => "product_update", "label" => "Product update"],
            ["value" => "product_update_in_bulk", "label" => "Product update in bulk"],
            ["value" => "product_update_with_quick_edit", "label" => "Product update by quick edit"],
            ["value" => "product_import", "label" => "Product import"],
            ["value" => "product_trash_untrash", "label" => "Product trashed/untrashed"],
            ["value" => "product_review", "label" => "Product review"]
        ],
        'event_tracking_queue_enabled' => false,
        'event_tracking_queue_cron_expression' => "* * * * *",
        'event_tracking_queue_page_size' => 100,
        'page_tracking_enabled' => true,
        'page_tracking_open_graph_enabled' => true,
        'page_tracking_custom_script_enabled' => false,
        'page_tracking_custom_script' => '',
        'data_catalog_name' => "Shop",
        'data_products_attributes' => [
            ["value" => "date_created", "label" => "Date created", "type" => "property"],
            ["value" => "short_description", "label" => "Short description", "type" => "property"],
            ["value" => "sale_price", "label" => "Sale price", "type" => "property"],
            ["value" => "regular_price", "label" => "Regular price", "type" => "property"],
            ["value" => "stock_status", "label" => "Stock status", "type" => "property"],
            ["value" => "featured", "label" => "Featured", "type" => "property"],
            ["value" => "image_id", "label" => "Image", "type" => "property"],
            ["value" => "category_ids", "label" => "Categories", "type" => "property"],
            ["value" => "tag_ids", "label" => "Tags", "type" => "property"],
            ["value" => "height", "label" => "Height", "type" => "property"],
            ["value" => "length", "label" => "Length", "type" => "property"],
            ["value" => "weight", "label" => "Weight", "type" => "property"],
            ["value" => "average_rating", "label" => "Average rating", "type" => "property"]
        ],
        'data_products_enabled' => true,
        'data_orders_enabled' => true,
        'data_customers_enabled' => true,
        'synchronization_customers_attributes' => [],
        'synchronization_data_synchronization_cron_expression' => "* * * * *",
        'synchronization_data_synchronization_enabled' => true,
        'synchronization_data_synchronization_page_size' => 100,
        'synchronization_updates_synchronization_cron_expression' => "* * * * *",
        'synchronization_updates_synchronization_enabled' => true,
        'synchronization_updates_synchronization_page_size' => 100,
        'opt_in' => 0,
        'opt_in_email_marketing_agreement_enabled' => false,
        'opt_in_sms_marketing_agreement_enabled' => false
    ];

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        self::table_exist_check();
        self::update_db_check();
        self::set_default_values();
    }

    /**
     * Check if the database is up to date.
     * @return void
     */
    public static function update_db_check() {
        $installed_ver = get_option( "synerise_for_woocommerce_db_version" );
        if ( $installed_ver != SYNERISE_FOR_WOOCOMMERCE_DB_VERSION ) {
            self::datatables_create_update();
            self::datatables_insert_data();
        }
    }

    public static function table_exist_check() {
        global $wpdb;

        $syncQueueTableName = $wpdb->prefix.self::SYNC_QUEUE_TABLE_NAME;
        $syncStatusTableName = $wpdb->prefix.self::SYNC_STATUS_TABLE_NAME;
        $syncHistoryTableName = $wpdb->prefix.self::SYNC_HISTORY_TABLE_NAME;

        $tables_exist = $wpdb->get_var("
            SELECT COUNT(*) 
            FROM information_schema.tables 
            WHERE table_schema = '{$wpdb->dbname}' 
            AND table_name IN ('{$syncQueueTableName}', '{$syncStatusTableName}', '{$syncHistoryTableName}')
        ");

        if($tables_exist !== 3) {
            update_option( "synerise_for_woocommerce_db_version", null );
        }

    }

    /**
     * Create or update datatables.
     *
     * @return void
     */
    public static function datatables_create_update() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $syncQueueTableName = $wpdb->prefix.'snrs_sync_queue';
        $syncStatusTableName = $wpdb->prefix.'snrs_sync_status';
        $syncHistoryTableName = $wpdb->prefix.'snrs_sync_history';
        $eventQueueTableName = $wpdb->prefix.'snrs_event_queue_item';

        $syncQueue = "CREATE TABLE `$syncQueueTableName` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
                      `model` varchar(10) NOT NULL COMMENT 'Data model',
                      `entity_id` int(10) unsigned NOT NULL COMMENT 'Entity ID',
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `SYNERISE_SYNC_QUEUE_MODEL_ENTITY_ID` (`model`,`entity_id`)
                    ) $charset_collate COMMENT='Synerise synchronization queue';";

        $syncStatus = "CREATE TABLE `$syncStatusTableName` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
                      `model` varchar(10) NOT NULL COMMENT 'Data model',
                      `start_id` int(10) unsigned DEFAULT NULL COMMENT 'Current ID',
                      `stop_id` int(10) unsigned DEFAULT NULL COMMENT 'Stop ID',
                      `state` smallint(5) unsigned NOT NULL COMMENT 'State',
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `SNRS_SYNC_STATUS_MODEL` (`model`),
                      KEY `SNRS_SYNC_STATUS_STATE` (`state`)
                    ) $charset_collate COMMENT='Synerise synchronization status';";

        $syncHistory = "CREATE TABLE `$syncHistoryTableName` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
                      `model` varchar(10) NOT NULL COMMENT 'Data model',
                      `entity_id` int(10) unsigned NOT NULL COMMENT 'Entity ID',
                      `synerise_updated_at` datetime DEFAULT NOW() COMMENT 'Last synchronization timestamp',
                      PRIMARY KEY (`id`),
                      UNIQUE KEY `SNRS_SYNC_HISTORY_MODEL_ENTITY` (`model`, `entity_id`)
                    ) $charset_collate COMMENT='Synerise synchronization history';";

        $eventQueue = "CREATE TABLE `$eventQueueTableName` (
                      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
                      `event_name` varchar(25) NOT NULL COMMENT 'Name of the event to be sent',
                      `payload` longtext DEFAULT NULL COMMENT 'Event Payload to be sent',
                      `entity_id` int(10) unsigned COMMENT 'Entity ID',
                      `retry_at` datetime COMMENT 'Time of last retry',
                      `retry_count` int(1) unsigned COMMENT 'Number of retries',
                      PRIMARY KEY (`id`)
                    ) $charset_collate COMMENT='Synerise event queue items';";

        try {
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( [$syncQueue, $syncStatus, $syncHistory, $eventQueue] );
        } catch (\Exception $e) {
            Synerise_For_Woocommerce::get_logger()->error(`SQL REQUEST ERROR ${$e->getMessage()}`);
        }

        update_option( "synerise_for_woocommerce_db_version", SYNERISE_FOR_WOOCOMMERCE_DB_VERSION );
    }

    /**
     * Insert data into datatables.
     *
     * @return void
     */
    public static function datatables_insert_data()
    {
        global $wpdb;
        $table_name = $wpdb->prefix.'snrs_sync_status';

        $statuses = ['customer', 'order', 'product'];

        foreach ($statuses as $status){
            $entity = [
                $status,
                Status_Data::STATE_IN_PROGRESS
            ];

            $sql = 'INSERT INTO '.$table_name.' (model, state) VALUES (\''.$entity[0].'\', \''.$entity[1].'\') ON DUPLICATE KEY UPDATE model = VALUES(model)';
            $query_status = $wpdb->query($sql);

            if($query_status === FALSE)
            {
                wp_die( esc_html__( 'Unable to insert default statuses', 'synerise-for-woocommerce' ) );
            }
        }
    }

    public static function set_default_values()
    {
        $synerise_options = get_option('synerise-for-woocommerce');

        if($synerise_options){
            foreach(self::defaults as $key => $value){
                if(array_key_exists($key, $synerise_options)){
                    continue;
                }

                Synerise_For_Woocommerce::save_setting($key, $value);
            }
        } else {
            foreach(self::defaults as $key => $value){
                Synerise_For_Woocommerce::save_setting($key, $value);
            }
        }
    }

    public static function redirect_after_activation($plugin) {
        $plugin_name = explode('/', $plugin)[1];
        if($plugin_name !== 'synerise-for-woocommerce.php'){
            return;
        }

        if(Synerise_For_Woocommerce::is_plugin_configured()){
            wp_redirect(admin_url('admin.php?page=synerise'));
        } else {
            wp_redirect(admin_url('admin.php?page=synerise/wizard'));
        }
        exit;
    }

}
