<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Service\Opt_In_Service;
use Synerise\Integration\Service\Order_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Order_Placed
{
    const HOOK_NAME = 'woocommerce_checkout_order_processed';
	const EVENT_NAME = 'order_placed';

    /**
     * @var Tracking
     */
    private $tracking_manager;
    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;
	/**
	 * @var ClientManagementApiFactory
	 */
	private $client_management_api_factory;
    /**
     * @var LoggerInterface
     */
    private $logger;

	public function __construct(
        LoggerInterface $logger,
	    Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory,
	    ClientManagementApiFactory $client_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
		$this->client_management_api_factory = $client_management_api_factory;
    }

	/**
	 * @param int $order_id
	 * @return void
	 */
    public function send_event(int $order_id)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        try {
	        $order = wc_get_order($order_id);

	        $this->tracking_manager->manageClientUuid($order->get_billing_email());

	        $order_data = Order_Service::prepare_order_params($order);
	        if(empty($order_data['products'])){
		        return;
	        }

            $action_data = [
                'time' => Client_Action::get_time(new \DateTime()),
                'label' => Client_Action::get_label(self::EVENT_NAME),
                'client' => [
                    'uuid' => $this->tracking_manager->getClientUuid(),
                ],
                'source' => Client_Action::get_source()
            ];

            $event_transaction_body = \GuzzleHttp\json_encode(array_filter(array_merge($action_data, $order_data)));
            list($body, $status_code, $headers) = $this->data_management_api_factory->create()->createATransactionWithHttpInfo($event_transaction_body, '4.4');

	        if (!is_user_logged_in()) {
                $client_params = Client_Service::prepare_client_params_from_order($order);
		        $client_params_json = \GuzzleHttp\json_encode($client_params);
		        $this->client_management_api_factory->create()->createAClientInCrmWithHttpInfo($client_params_json, '4.4');
	        }

			return $status_code;
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
