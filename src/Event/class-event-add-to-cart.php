<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Add_To_Cart extends Abstract_Event
{
    const HOOK_NAME = 'woocommerce_add_to_cart';
	const EVENT_NAME = 'add_to_cart';

    public function execute(string $cart_item_key, $quantity = 1)
    {
        if (!$this->is_event_enabled() || !$this->is_product_added($cart_item_key)) {
            return;
        }

        try {
            $this->process_event($this->prepare_event($cart_item_key, $quantity));
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event($cart_item_key, $quantity = 1): string
    {
        $defaultParams = [
            'source' => Client_Action::get_source()
        ];

        $params = Cart_Service::prepare_add_to_cart_product_data($cart_item_key, $quantity);
        $params = array_merge($params, $defaultParams);

        return \GuzzleHttp\json_encode(array_filter([
            'time' => Client_Action::get_time(new \DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'client' => [
                'uuid' => $this->tracking_manager->getClientUuid(),
            ],
            'params' => $params
        ]));
    }

    protected function is_product_added($cart_item_key)
    {
        return !Product_Service::is_sku_item_key() || Cart_Service::cart_item_has_sku($cart_item_key);
    }
}
