<?php

/**
 * @link              https://synerise.com
 * @since             1.0.0
 * @package           Synerise\Integration
 *
 * @wordpress-plugin
 * Plugin Name:       Synerise For Woocommerce
 * Plugin URI:        https://github.com/Synerise/synerise-for-woocommerce
 * Description:       Grow your business on Synerise! Use this official plugin to allow shoppers to Pin products while browsing your store, track conversions, and advertise on synerise.
 * Version:           1.0.5
 * Requires at least: 4.7
 * Requires PHP:      7.0.0
 * Author:            Synerise
 * Author URI:        https://synerise.com/
 * Text Domain:       synerise-for-woocommerce
 * Domain Path:       /languages
 */

use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\Integration\Synerise_For_Woocommerce_Activator;
use Synerise\Integration\Synerise_For_Woocommerce_Deactivator;
use Synerise\Integration\Synerise_For_Woocommerce_Uninstall;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Autoload packages.
 */
$autoloader = plugin_dir_path( __FILE__ ) . 'vendor/autoload_packages.php';

if ( is_readable( $autoloader ) ) {
	require $autoloader;
} else {
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
		error_log(  // phpcs:ignore
			sprintf(
			/* translators: 1: composer command. 2: plugin directory */
				esc_html__( 'Your installation of the Synerise for WooCommerce plugin is incomplete. Please run %1$s within the %2$s directory.', 'synerise-for-woocommerce' ),
				'`composer install`',
				'`' . esc_html( str_replace( ABSPATH, '', __DIR__ ) ) . '`'
			)
		);
	}
	/**
	 * Outputs an admin notice if composer install has not been ran.
	 */
	add_action(
		'admin_notices',
		function() {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					printf(
					/* translators: 1: composer command. 2: plugin directory */
						esc_html__( 'Your installation of the Synerise for WooCommerce plugin is incomplete. Please run %1$s within the %2$s directory.', 'synerise-for-woocommerce' ),
						'<code>composer install</code>',
						'<code>' . esc_html( str_replace( ABSPATH, '', __DIR__ ) ) . '</code>'
					);
					?>
				</p>
			</div>
			<?php
		}
	);
	return;
}

/**
 * Currently plugin version.
 */
define( 'SYNERISE_FOR_WOOCOMMERCE_VERSION', '1.0.5' );
define( 'SYNERISE_FOR_WOOCOMMERCE_DB_VERSION', '1.0.5' );
define( 'SYNERISE_FOR_WOOCOMMERCE_PREFIX', 'synerise_for_woocommerce' );
define( 'SYNERISE_FOR_WOOCOMMERCE_OPTION_NAME', 'synerise-for-woocommerce');
define( 'SYNERISE_FOR_WOOCOMMERCE_BASEDIR', plugin_dir_path(__FILE__));
define( 'SYNERISE_FOR_WOOCOMMERCE_PUBLIC_URL', plugin_dir_url(__FILE__).'public');

require_once( plugin_dir_path( __FILE__ ) . '/lib/action-scheduler/action-scheduler.php' );

/**
 * The code that runs during plugin activation.
 * This action is documented in src/class-synerise-for-woocommerce-activator.php
 */
function activate_synerise_for_woocommerce() {
	Synerise_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in src/class-synerise-for-woocommerce-deactivator.php
 */
function deactivate_synerise_for_woocommerce() {
	Synerise_For_Woocommerce_Deactivator::deactivate();
}

function uninstall_synerise_for_woocommerce() {
    Synerise_For_Woocommerce_Uninstall::uninstall();
}

register_activation_hook( __FILE__, 'activate_synerise_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_synerise_for_woocommerce' );
register_uninstall_hook( __FILE__, 'uninstall_synerise_for_woocommerce' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_synerise_for_woocommerce() {
	$plugin = new Synerise_For_Woocommerce();
	$plugin->run();
}

run_synerise_for_woocommerce();
