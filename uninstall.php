<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://synerise.com
 * @since      1.0.1
 *
 * @package    Synerise\Integration
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove options
delete_option('synerise-for-woocommerce');
delete_site_option('synerise-for-woocommerce');

global $wpdb;
$tables = array('snrs_sync_queue', 'snrs_sync_status', 'snrs_sync_history');
foreach ($tables as $table) {
    $table_name = $wpdb->prefix . $table;
    $wpdb->query("DROP TABLE IF EXISTS {$table_name}");
}