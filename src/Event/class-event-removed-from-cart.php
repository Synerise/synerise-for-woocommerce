<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Removed_From_Cart
{
    const HOOK_NAME = 'woocommerce_cart_item_removed';
	const EVENT_NAME = 'remove_from_cart';

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
        LoggerInterface $logger,
        Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
    }

    public function send_event(string $cart_item_key)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

	    if(!Cart_Service::cart_item_has_sku($cart_item_key, 'removed')){
		    return;
	    }

        try {
	        $instance = WC()->cart;
            $default_params = [
                'source' => Client_Action::get_source()
            ];

            $params = Cart_Service::prepare_remove_from_cart_product_data($instance, $cart_item_key);
            $params = array_merge($params, $default_params);

            $event_client_removed_from_cart_body = \GuzzleHttp\json_encode([
                'time' => Client_Action::get_time(new \DateTime()),
                'label' => Client_Action::get_label(self::EVENT_NAME),
                'client' => [
                    'uuid' => $this->tracking_manager->getClientUuid(),
                ],
                'params' => $params
            ]);

            list($body, $status_code, $headers) = $this->data_management_api_factory->create()->clientRemovedProductFromCartWithHttpInfo($event_client_removed_from_cart_body, '4.4');
			return $status_code;
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
