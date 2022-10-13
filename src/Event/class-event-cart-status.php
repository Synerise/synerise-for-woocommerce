<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\Integration\Service\Tracking_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Cart_Status
{
    const EVENT_NAME = 'cart_status_change';

    /**
     * @var Tracking
     */
    private $tracking_manager;
    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface   $logger,
	    Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
    }

    public function send_event()
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        if(defined ( 'SYNERISE_CART_STATUS_SENT' )){
            return;
        }

        try {
            $cart = WC()->cart;
            $cart_status_params = Cart_Service::prepare_cart_status_params($cart);

            $custom_event_request = \GuzzleHttp\json_encode(
                [
                    'time' => Client_Action::get_time(new \DateTime()),
                    'action' => 'cart.status',
                    'label' => 'CartStatus',
                    'client' => [
                        "uuid" => $this->tracking_manager->getClientUuid(),
                    ],
                    'params' => $cart_status_params
                ]
            );

            list($body, $status_code, $headers) = $this->data_management_api_factory->create()
                ->customEventWithHttpInfo('4.4', $custom_event_request);

            define('SYNERISE_CART_STATUS_SENT', true);

			return $status_code;
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
