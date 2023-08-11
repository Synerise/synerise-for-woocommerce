<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\Integration\Service\Product_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Removed_From_Cart extends Abstract_Event
{
    const HOOK_NAME = 'woocommerce_cart_item_removed';
	const EVENT_NAME = 'remove_from_cart';

    public function execute(string $cart_item_key)
    {
        if (!$this->is_event_enabled() || !$this->is_product_removed($cart_item_key)) {
            return;
        }

        try {
            $this->process_event($this->prepare_event($cart_item_key));
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    protected function is_product_removed($cart_item_key)
    {
        return !Product_Service::is_sku_item_key() || Cart_Service::cart_item_has_sku($cart_item_key, 'removed');
    }

    public function prepare_event($cart_item_key)
    {
        $instance = WC()->cart;
        $default_params = [
            'source' => Client_Action::get_source()
        ];

        $params = Cart_Service::prepare_remove_from_cart_product_data($instance, $cart_item_key);
        $params = array_merge($params, $default_params);

        return \GuzzleHttp\json_encode([
            'time' => Client_Action::get_time(new \DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'client' => [
                'uuid' => $this->tracking_manager->getClientUuid(),
            ],
            'params' => $params
        ]);

    }
}
