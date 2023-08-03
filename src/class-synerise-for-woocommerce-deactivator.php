<?php

namespace Synerise\Integration;

use Synerise\Integration\Event_Queue\Consumer;
use Synerise\Integration\Synchronization\Synchronization;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Synerise\Integration
 */
class Synerise_For_Woocommerce_Deactivator {

	/**
	 * @since    1.0.0
	 */
	public static function deactivate() {
		self::cancel_cron_jobs();
	}


	/**
	 * Unschedule all actions registered by this plugin.
	 * @return void
	 */
	private static function cancel_cron_jobs() {
		as_unschedule_all_actions( Synchronization::ACTION_SYNC_BY_ID, array(), SYNERISE_FOR_WOOCOMMERCE_PREFIX );
		as_unschedule_all_actions( Synchronization::ACTION_SYNC_BY_QUEUE, array(), SYNERISE_FOR_WOOCOMMERCE_PREFIX );
		as_unschedule_all_actions( Consumer::ACTION_PROCESS_EVENT_QUEUE, array(), SYNERISE_FOR_WOOCOMMERCE_PREFIX );
	}
}
