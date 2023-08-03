<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Cart_Status extends Abstract_Event
{
    const EVENT_NAME = 'cart_status_change';
    const HOOK_NAME = 'woocommerce_update_cart_action_cart_updated';

    public function execute()
    {
        if (!$this->is_event_enabled() || defined ( 'SYNERISE_CART_STATUS_SENT' )){
            return;
        }

        try {
            $this->process_event($this->prepare_event());

            define('SYNERISE_CART_STATUS_SENT', true);

        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event(): string
    {
        $cart = WC()->cart;
        $cart_status_params = Cart_Service::prepare_cart_status_params($cart);

        return \GuzzleHttp\json_encode(
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
    }
}
