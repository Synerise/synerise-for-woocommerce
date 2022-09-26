<?php

namespace Synerise\Integration\Admin;

use Synerise\DataManagement\Api\AuthorizationApi;
use Synerise\DataManagement\Configuration;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Service\Opt_In_Service;
use Synerise\Integration\Service\Order_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Synchronization\DataStore\History_Data_Store;
use Synerise\Integration\Synchronization\Synchronization;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\Integration\Synerise_For_Woocommerce_Activator;

/**
 * The rest api functionality of the plugin.
 *
 * @link       https://synerise.com
 * @since      1.0.0
 *
 * @package    Synerise\Integration
 */

class Synerise_For_Woocommerce_API {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function rest_api_init() {
		//Register route
		register_rest_route( $this->plugin_name.'/v1' , '/settings/', [
			//Endpoint to get settings from
			[
				'methods' => ['GET'],
				'callback' => function($request){
					return rest_ensure_response(
						array_merge(
							array(
								'event_tracking_events_list' => Client_Action::ACTION_LABELS,
								'data_products_attributes_list' => Product_Service::get_product_attributes(),
                                'opt_in_mode_list' => Opt_In_Service::OPT_IN
							),
							Synerise_For_Woocommerce::get_settings()
						)
					);
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			],
			//Endpoint to update settings at
			[
				'methods' => ['POST'],
				'callback' => function($request){
					Synerise_For_Woocommerce::save_settings($request->get_json_params());
					return rest_ensure_response(Synerise_For_Woocommerce::get_settings());
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);

		register_rest_route( $this->plugin_name.'/v1' , '/settings/defaults', [
			[
				'methods' => ['GET'],
				'callback' => function($request){
					return rest_ensure_response(
						array_merge(
							array(
								'event_tracking_events_list' => Client_Action::ACTION_LABELS,
								'data_products_attributes_list' => Product_Service::get_product_attributes(),
                                'opt_in_mode_list' => Opt_In_Service::OPT_IN
							),
							Synerise_For_Woocommerce_Activator::defaults
						)
					);
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);

		register_rest_route( $this->plugin_name.'/v1' , '/synchronization/', [
			[
				'methods' => ['GET'],
				'callback' => function(){
					/**
					 * @var History_Data_Store $history_store
					 */
					$history_store = \WC_Data_Store::load( 'synerise-sync-history' );
					return rest_ensure_response(
						[
							'products' => [
								'synchronized' => (int) $history_store->get_sync_count('product'),
								'total' => (int) Product_Service::get_products_count()
							],
							'customers' => [
								'synchronized' => (int) $history_store->get_sync_count('customer'),
								'total' => (int) Client_Service::get_customers_count()
							],
							'orders' => [
								'synchronized' => (int) $history_store->get_sync_count('order'),
								'total' => (int) Order_Service::get_orders_count()
							]
						]
					);
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);

		register_rest_route( $this->plugin_name.'/v1' , '/synchronization/resend', [
			[
				'methods' => ['POST'],
				'callback' => function($request) {
					$params = $request->get_json_params();

					$wp_response = new \WP_REST_Response([
						'success' => true,
						'message' => 'Synchronization restarted',
						'code'    => 200
					], 200);

					switch ($params['model']) {
						case 'product':
							Synchronization::resend_items('product');
							break;
						case 'customer':
							Synchronization::resend_items('customer');
							break;
						case 'order':
							Synchronization::resend_items('order');
							break;
						default:
							$wp_response->set_status(400);
							$wp_response->set_data([
								'success' => false,
								'message' => 'Invalid model',
								'code'    => 400
							]);
							return rest_ensure_response($wp_response);
					}
					return rest_ensure_response($wp_response);
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);

		register_rest_route( $this->plugin_name.'/v1' , '/synchronization/send-additional', [
			[
				'methods' => ['POST'],
				'callback' => function($request) {
					$params = $request->get_json_params();

					$wp_response = new \WP_REST_Response([
						'success' => true,
	                    'message' => 'Additional data sent to synchronization',
	                    'code'    => 200
					], 200);

					switch ($params['model']) {
						case 'product':
							Synchronization::reset_sync_status('product');
							break;
						case 'customer':
							Synchronization::reset_sync_status('customer');
							break;
						case 'order':
							Synchronization::reset_sync_status('order');
							break;
						default:
							$wp_response->set_status(400);
							$wp_response->set_data([
								'success' => false,
								'message' => 'Invalid model',
								'code' => 400
							]);
							return rest_ensure_response($wp_response);
					}
					return rest_ensure_response($wp_response);
				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);

		register_rest_route( $this->plugin_name.'/v1' , '/validate-api-key', [
			[
				'methods' => ['POST'],
				'callback' => function($request){
					$params = $request->get_json_params();
					$configuration = new Configuration();
					$configuration->setHost($params['apiHost'].'/uauth');
					$authorization_api = new AuthorizationApi(null, $configuration);
					$request_body = \GuzzleHttp\json_encode([
						'apiKey' => $params['apiKey'],
					]);

					$wp_response = new \WP_REST_Response();

					try {
						list($response_body, $status_code, $headers) = $authorization_api->profileLoginWithHttpInfo($request_body);
						$wp_response->set_data([
							'success' => true,
							'message' => 'API key is valid',
							'code' => $status_code
						]);
						$wp_response->set_status($status_code);
						return rest_ensure_response($wp_response);
					} catch (\Exception $exception) {
						$message = 'Something went wrong with the API key validation. Please check your API key and host.';
						if($exception->getResponseBody()){
							$response = \GuzzleHttp\json_decode($exception->getResponseBody());
							$message = $response->error.': '.$response->message;
						}
						$wp_response->set_data([
							'success' => false,
							'message' => $message,
							'code' => $exception->getCode()
						]);
						$wp_response->set_status($exception->getCode());
						return rest_ensure_response($wp_response);
					}

				},
				'permission_callback' => function(){
					return current_user_can('manage_options');
				}
			]
		]);
	}
}