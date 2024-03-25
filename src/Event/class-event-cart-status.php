<?php

namespace Synerise\Integration\Event;

use DateTime;
use Exception;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Cart_Service;
use Synerise\IntegrationCore\Uuid;

if (!defined('ABSPATH')) {
    exit;
}

class Event_Cart_Status extends Abstract_Event
{
    const EVENT_NAME = 'cart_status_change';
    const HOOK_NAME = 'woocommerce_update_cart_action_cart_updated';

    public function execute()
    {
        if (!$this->is_event_enabled() || defined('SYNERISE_CART_STATUS_SENT')) {
            return;
        }

        try {
            $payload = $this->prepare_event();
            if ($payload) {
                $this->process_event($payload);
                define('SYNERISE_CART_STATUS_SENT', true);
            }

        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event($empty_cart = false)
    {
        $uuid = $this->tracking_manager->getClientUuid();
        if (!$uuid) {
            $wp_user = wp_get_current_user();
            if (!$wp_user || $wp_user->ID === 0) {
                return null;
            }
            $uuid = Uuid::generateUuidByEmail($wp_user->user_email);
        }


        if ($empty_cart) {
            $cart_status_params = [
                'products' => [],
                'totalAmount' => 0,
                'totalQty' => 0
            ];
        } else {
            $cart = WC()->cart;
            $cart_status_params = Cart_Service::prepare_cart_status_params($cart);
        }

        if ($this->should_include_snrs_params() && $snrs_params = $this->tracking_manager->getSnrsParamsFromCookie()) {
            $cart_status_params['snrs_params'] = $snrs_params;
        }

        return \GuzzleHttp\json_encode(
            [
                'time' => Client_Action::get_time(new DateTime()),
                'action' => 'cart.status',
                'label' => 'CartStatus',
                'client' => [
                    "uuid" => $uuid,
                ],
                'params' => $cart_status_params
            ]
        );
    }

    /**
     * @return void
     * @since 1.0.10
     */
    public function execute_empty_cart()
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        try {
            $payload = $this->prepare_event(true);
            $this->process_event($payload);
        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }

    }
}
