<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\Integration\Service\Tracking_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Add_To_Cart
{
    const HOOK_NAME = 'woocommerce_add_to_cart';
	const EVENT_NAME = 'add_to_cart';

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

    public function send_event(string $cart_item_key, $quantity = 1)
    {

        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

		if(Product_Service::is_sku_item_key() && !Cart_Service::cart_item_has_sku($cart_item_key)){
			return;
		}

        try {
            $defaultParams = [
                'source' => Client_Action::get_source()
            ];

            $params = Cart_Service::prepare_add_to_cart_product_data($cart_item_key, $quantity);
            $params = array_merge($params, $defaultParams);

            $event_added_to_cart_body = \GuzzleHttp\json_encode(array_filter([
	            'time' => Client_Action::get_time(new \DateTime()),
	            'label' => Client_Action::get_label(self::EVENT_NAME),
	            'client' => [
		            'uuid' => $this->tracking_manager->getClientUuid(),
	            ],
	            'params' => $params
            ]));

            list($body, $status_code, $headers) = $this->data_management_api_factory->create()
                ->clientAddedProductToCartWithHttpInfo($event_added_to_cart_body, '4.4');

			return $status_code;
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
