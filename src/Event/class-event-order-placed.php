<?php

namespace Synerise\Integration\Event;

use DateTime;
use Exception;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Service\Order_Service;
use WC_Order;

if (!defined('ABSPATH')) {
    exit;
}

class Event_Order_Placed extends Abstract_Event
{
    const HOOK_NAME = 'woocommerce_checkout_order_processed';
    const EVENT_NAME = 'order_placed';

    /**
     * @param int $order_id
     * @return void
     */
    public function execute(int $order_id)
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        try {
            $order = wc_get_order($order_id);
            if (!$order->get_billing_email()) {
                return;
            }

            $this->process_event($this->prepare_event($order));

            if (!is_user_logged_in()) {
                $client_params_json = \GuzzleHttp\json_encode([Client_Service::prepare_client_params_from_order($order)]);
                $this->process_client_update($client_params_json, $order->get_customer_id());
            }

            $cartStatusEvent = new Event_Cart_Status($this->logger, $this->tracking_manager, $this->event_service);
            $cartStatusEvent->execute_empty_cart();
        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event(WC_Order $order)
    {
        $snrs_params = $this->should_include_snrs_params() ? $this->tracking_manager->getSnrsParamsFromCookie() : null;

        $order_data = Order_Service::prepare_order_params($order, $snrs_params);
        if (empty($order_data['products'])) {
            return null;
        }

        $action_data = [
            'time' => Client_Action::get_time(new DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'client' => [
                'uuid' => $this->tracking_manager->manageClientUuid($order->get_billing_email()),
                'email' => $order->get_billing_email()
            ],
            'source' => Client_Action::get_source()
        ];

        return \GuzzleHttp\json_encode(array_filter(array_merge($action_data, $order_data)));
    }
}
