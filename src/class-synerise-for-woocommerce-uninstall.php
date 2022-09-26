<?php

namespace Synerise\Integration;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Synerise\Integration
 */
class Synerise_For_Woocommerce_Uninstall {

	/**
	 * Plugin uninstall function.
	 *
	 * Fires when plugin uninstall start.
	 *
	 * @since    1.0.0
	 */
	public static function uninstall() {
		delete_option('synerise_for_woocommerce');
	}
}
