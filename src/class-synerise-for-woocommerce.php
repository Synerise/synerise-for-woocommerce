<?php

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    Synerise\Integration
 */

namespace Synerise\Integration;

use Synerise\Integration\Admin\Synerise_For_Woocommerce_Admin;
use Synerise\Integration\Admin\Synerise_For_Woocommerce_API;
use Synerise\Integration\Service\Open_Graph_Service;
use Synerise\Integration\Service\Opt_In_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synchronization\Synchronization;
use Synerise\IntegrationCore\CookieManager;
use Synerise\IntegrationCore\Factory\Api\CatalogsConfigurationFactory;
use Synerise\IntegrationCore\Factory\Api\ClientConfigurationFactory;
use Synerise\IntegrationCore\Factory\Api\ClientFactory;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementCatalogsApiFactory;
use Synerise\IntegrationCore\Factory\TrackerApiFactory;
use Synerise\IntegrationCore\Provider\AuthApiTokenProvider;
use Synerise\IntegrationCore\Tracking;
use Synerise\IntegrationCore\Updater\Client;
use Synerise\Integration\Synchronization\DataStore\History_Data_Store;
use Synerise\Integration\Synchronization\DataStore\Status_Data_Store;
use Synerise\Integration\Synchronization\DataStore\Queue_Data_Store;

if(!class_exists('Synerise_For_Woocommerce')){
	final class Synerise_For_Woocommerce {

		/**
		 * @var Config_Provider
		 */
		private static $config_provider;

		/**
		 * @var Tracking
		 */
		private static $tracking_manager;

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      Synerise_For_Woocommerce_Loader $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * The unique identifier of this plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string $plugin_name The string used to uniquely identify this plugin.
		 */
		protected $plugin_name = 'synerise-for-woocommerce';

		/**
		 * The current version of the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      string $version The current version of the plugin.
		 */
		protected $version;

		/**
		 * When set to true, the settings have been
		 * changed and the runtime cached must be flushed
		 *
		 * @var Synerise_For_Woocommerce
		 * @since 1.0.0
		 */
		protected static $dirty_settings = array();

		/**
		 * @var Logger_Service
		 */
		protected static $logger_service;

		/**
		 * Define the core functionality of the plugin.
		 *
		 * Set the plugin name and the plugin version that can be used throughout the plugin.
		 * Load the dependencies, define the locale, and set the hooks for the admin area and
		 * the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			if ( defined( 'SYNERISE_FOR_WOOCOMMERCE_VERSION' ) ) {
				$this->version = SYNERISE_FOR_WOOCOMMERCE_VERSION;
			} else {
				$this->version = '1.0.0';
			}

			self::$logger_service   = new Logger_Service();
			self::$config_provider  = new Config_Provider();
			self::$tracking_manager = new Tracking(
				new CookieManager(),
				self::$config_provider,
				new Client( self::get_client_management_api_factory() ),
                self::$logger_service
			);

			$this->load_dependencies();
			$this->set_locale();
			$this->define_rest_api_hooks();
			$this->define_admin_hooks();

			if(self::is_plugin_configured() && self::is_woocommerce_enabled()){
                $this->include_frontend_scripts();
				$this->define_synchronization_hooks();
				$this->define_events();

				add_action('init', function(){
					Synchronization::create_cron_jobs();
				});

                $this->define_opt_in_hooks();

				add_filter( 'woocommerce_data_stores', [$this, 'register_data_stores'] );
			}
		}

		public function register_data_stores( $data_stores ) {
			return array_merge(
				$data_stores,
				[
					'synerise-sync-status' => Status_Data_Store::class,
					'synerise-sync-queue' => Queue_Data_Store::class,
					'synerise-sync-history' => History_Data_Store::class
				]
			);
		}

		public static function get_logger(): Logger_Service {
			return self::$logger_service;
		}

		/**
		 * Create an instance of the loader which will be used to register the hooks
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function load_dependencies() {
			$this->loader = new Synerise_For_Woocommerce_Loader();
		}

		/**
		 * Define the locale for this plugin for internationalization.
		 *
		 * Uses the Synerise_For_Woocommerce_i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function set_locale() {
			$plugin_i18n = new Synerise_For_Woocommerce_i18n();

			$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

		}


        private function define_opt_in_hooks() {
            $opt_in_mode = self::get_setting('opt_in');
            if($opt_in_mode !== Opt_In_Service::OPT_IN_MODE_MAP && Opt_In_Service::is_opt_in_enabled()){
                $opt_in_service = new Opt_In_Service();

                if(in_array($opt_in_mode, [Opt_In_Service::OPT_IN_MODE_ADD_TO_CHECKOUT, Opt_In_Service::OPT_IN_MODE_ADD_TO_REGISTER_AND_CHECKOUT], true)){
                    $this->loader->add_filter( 'woocommerce_checkout_fields', $opt_in_service, 'add_checkout_fields', 9998 );
                    $this->loader->add_action( 'woocommerce_checkout_update_order_meta', $opt_in_service, 'update_order_meta', 9998 );
                }

                if(in_array($opt_in_mode, [Opt_In_Service::OPT_IN_MODE_ADD_TO_REGISTER, Opt_In_Service::OPT_IN_MODE_ADD_TO_REGISTER_AND_CHECKOUT], true)){
                    $this->loader->add_action( 'edit_user_profile', $opt_in_service, 'add_user_profile_fields', 9998 );
                    $this->loader->add_action( 'show_user_profile', $opt_in_service, 'add_user_profile_fields', 9998 );
                    $this->loader->add_action( 'woocommerce_edit_account_form', $opt_in_service, 'add_user_profile_fields', 9998 );
                    $this->loader->add_action( 'register_form', $opt_in_service, 'add_user_profile_fields', 9998 );
                    $this->loader->add_action( 'woocommerce_register_form', $opt_in_service, 'add_user_profile_fields', 9998);

                    $this->loader->add_action( 'woocommerce_save_account_details', $opt_in_service, 'update_user_meta', 9998 );
                    $this->loader->add_action( 'edit_user_profile_update', $opt_in_service, 'update_user_meta', 9998 );
                    $this->loader->add_action( 'personal_options_update', $opt_in_service, 'update_user_meta', 9998 );
                    $this->loader->add_action( 'user_register', $opt_in_service, 'update_user_meta', 9998 );
                }
            }
        }

		/**
		 * Register all of the hooks related to the admin area functionality
		 * of the plugin.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function define_admin_hooks() {
			$plugin_admin = new Synerise_For_Woocommerce_Admin( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'load-toplevel_page_synerise', $plugin_admin, 'admin_page_load' );
			$this->loader->add_action( 'load-synerise_page_synerise/settings', $plugin_admin, 'admin_page_load' );
			$this->loader->add_action( 'load-admin_page_synerise/wizard', $plugin_admin, 'admin_page_load' );
			$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_admin_menu' );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
			$this->loader->add_action( 'activated_plugin', new Synerise_For_Woocommerce_Activator(), 'redirect_after_activation');
		}

		private function define_rest_api_hooks() {
			$plugin_rest_api = new Synerise_For_Woocommerce_API( $this->get_plugin_name(), $this->get_version() );
			$this->loader->add_action( 'rest_api_init', $plugin_rest_api, 'rest_api_init' );
		}

		private function define_events() {
			$plugin_events = new Synerise_For_Woocommerce_Events( $this->loader );
			$plugin_events->register_events();
		}

		private function define_synchronization_hooks(){
			$synchronization = new Synchronization();
			$this->loader->add_action(Synchronization::ACTION_SYNC_BY_ID, $synchronization, 'sync_by_id');
			$this->loader->add_action(Synchronization::ACTION_SYNC_BY_QUEUE, $synchronization, 'sync_by_queue');
			//$this->loader->add_action('init', $synchronization, 'create_cron_jobs');
		}


		private function include_frontend_scripts() {
			if (Open_Graph_Service::is_open_graph_enabled()) {
				add_action('wp_head', [Open_Graph_Service::class, 'print_tags']);
			}

			if (Tracking_Service::is_tracking_enabled()) {
                add_action('woocommerce_before_add_to_cart_quantity', [Tracking_Service::class, 'add_variation_change_script']);
				add_action('wp_footer', [Tracking_Service::class, 'print_script']);
			}
		}

		/**
		 * Run the loader to execute all of the hooks with WordPress.
		 *
		 * @since    1.0.0
		 */
		public function run() {
			$this->loader->run();
		}

		/**
		 * The name of the plugin used to uniquely identify it within the context of
		 * WordPress and to define internationalization functionality.
		 *
		 * @return    string    The name of the plugin.
		 * @since     1.0.0
		 */
		public function get_plugin_name(): string {
			return $this->plugin_name;
		}

		/**
		 * The reference to the class that orchestrates the hooks with the plugin.
		 *
		 * @return    Synerise_For_Woocommerce_Loader    Orchestrates the hooks of the plugin.
		 * @since     1.0.0
		 */
		public function get_loader(): Synerise_For_Woocommerce_Loader {
			return $this->loader;
		}

		/**
		 * Retrieve the version number of the plugin.
		 *
		 * @return    string    The version number of the plugin.
		 * @since     1.0.0
		 */
		public function get_version(): string {
			return $this->version;
		}

		/**
		 * Return APP Settings
		 *
		 * @param boolean $force Controls whether to force getting a fresh value instead of one from the runtime cache.
		 * @param string $option Controls which option to read/write to.
		 *
		 * @return array
		 * @since 1.0.0
		 *
		 */
		public static function get_settings( bool $force = false, string $option = SYNERISE_FOR_WOOCOMMERCE_OPTION_NAME ) {
			static $settings;

			if ( $force || is_null( $settings ) || ! isset( $settings[ $option ] ) || ( isset( self::$dirty_settings[ $option ] ) && self::$dirty_settings[ $option ] ) ) {
				$settings[ $option ] = get_option( $option );
			}

			return is_array($settings[ $option ]) ? $settings[ $option ] : [];
		}

		/**
		 * Return APP Setting based on its key
		 *
		 * @param string $key The key of specific option to retrieve.
		 * @param boolean $force Controls whether to force getting a fresh value instead of one from the runtime cache.
		 *
		 * @return mixed
		 * @since 1.0.0
		 *
		 */
		public static function get_setting( string $key, bool $force = false ) {
			$settings = self::get_settings( $force );

			return empty( $settings[ $key ] ) ? false : $settings[ $key ];
		}

		/**
		 * Save APP Setting
		 *
		 * @param string $key The key of specific option to retrieve.
		 * @param mixed $data The data to save for this option key.
		 *
		 * @return boolean
		 * @since 1.0.0
		 *
		 */
		public static function save_setting( string $key, $data ): bool {
			$settings = [];

			$settings[ $key ] = $data;

			return self::save_settings( $settings );
		}

		public static function remove_setting(string $key): bool {
			$settings = self::get_settings( true );
			unset( $settings[ $key ] );

			return update_option( SYNERISE_FOR_WOOCOMMERCE_OPTION_NAME, $settings );
		}

		/**
		 * Save APP Settings
		 *
		 * @param array $settings The array of settings to save.
		 * @param string $option Controls which option to read/write to.
		 *
		 * @return boolean
		 * @since 1.0.0
		 *
		 */
		public static function save_settings( array $settings, string $option = SYNERISE_FOR_WOOCOMMERCE_OPTION_NAME ): bool {
			self::$dirty_settings[ $option ] = true;

			$settings_array = self::get_settings( true );

			$updated_settings = array_replace($settings_array, $settings);

			$result = update_option( $option, $updated_settings );

			if(isset($settings['page_tracking_cookie_domain']) && !empty($settings['page_tracking_cookie_domain'])){
				Tracking_Service::add_tracking_code($settings['page_tracking_cookie_domain']);
			}

			return $result;
		}

		public static function get_tracking_manager(): Tracking {
			return self::$tracking_manager;
		}

		public static function get_client_management_api_factory(): ClientManagementApiFactory {
			return new ClientManagementApiFactory(
				new ClientFactory( self::$config_provider, self::get_logger() ),
				new ClientConfigurationFactory( new AuthApiTokenProvider( self::$config_provider ), self::$config_provider )
			);
		}

		public static function get_data_management_catalogs_api_factory(): DataManagementCatalogsApiFactory {
			return new DataManagementCatalogsApiFactory(
                new ClientFactory( self::$config_provider, self::get_logger() ),
				new CatalogsConfigurationFactory( new AuthApiTokenProvider( self::$config_provider ), self::$config_provider ),
				self::$config_provider
			);
		}

		public static function get_data_management_api_factory(): DataManagementApiFactory {
			return new DataManagementApiFactory(
                new ClientFactory( self::$config_provider, self::get_logger() ),
				new CatalogsConfigurationFactory( new AuthApiTokenProvider( self::$config_provider ), self::$config_provider )
			);
		}

		public static function get_tracker_api_factory($config_provider = null): TrackerApiFactory {
            $config_provider = $config_provider ?: self::$config_provider;
			return new TrackerApiFactory(
                new ClientFactory( $config_provider, self::get_logger() ),
				new CatalogsConfigurationFactory( new AuthApiTokenProvider( $config_provider ), $config_provider ),
				$config_provider
			);
		}

		public static function is_plugin_configured(): bool {
			$is_api_key_set = ! empty( self::get_setting( 'synerise_api_key' ) );
			$is_host_set = ! empty( self::get_setting( 'synerise_api_host_url' ) );

			return $is_api_key_set && $is_host_set;
		}

		public static function is_woocommerce_enabled(): bool {
			return in_array( 'woocommerce/woocommerce.php', (array) get_option( 'active_plugins', array() ) ) ||
			       is_plugin_active_for_network( 'woocommerce/woocommerce.php' );
		}
	}
}