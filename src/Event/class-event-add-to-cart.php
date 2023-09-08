<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\IntegrationCore\Uuid;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Add_To_Cart extends Abstract_Event
{
    const HOOK_NAME = 'woocommerce_add_to_cart';
	const EVENT_NAME = 'add_to_cart';

    public function execute(string $cart_item_key, $quantity = 1)
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        if(Product_Service::is_sku_item_key() && !Cart_Service::cart_item_has_sku($cart_item_key)){
            return;
        }

        if (!$this->tracking_manager->getClientUuid()) {
            return;
        }

        try {
            $payload = $this->prepare_event($cart_item_key, $quantity);
            if($payload){
                $this->process_event($payload);
            }
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event($cart_item_key, $quantity = 1)
    {
        $defaultParams = [
            'source' => Client_Action::get_source()
        ];

        $uuid = $this->tracking_manager->getClientUuid();
        if (!$uuid) {
            $wp_user = wp_get_current_user();
            if(!$wp_user || $wp_user->ID === 0){
                return null;
            }

            $uuid = Uuid::generateUuidByEmail($wp_user->user_email);
        }

        $params = Cart_Service::prepare_add_to_cart_product_data($cart_item_key, $quantity);
        $params = array_merge($params, $defaultParams);

        return \GuzzleHttp\json_encode(array_filter([
            'time' => Client_Action::get_time(new \DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'client' => [
                'uuid' => $uuid,
            ],
            'params' => $params
        ]));
    }
}
