<?php

namespace Synerise\Integration\Event;

use DateTime;
use Exception;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Client_Service;
use WC_Customer;


if (!defined('ABSPATH')) {
    exit;
}

class Event_Client_Register extends Abstract_Event
{
    const HOOK_NAME = 'user_register';
    const EVENT_NAME = 'register';

    public function execute(int $user_id)
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        $customer = new WC_Customer($user_id);

        if ($customer->get_role() == 'administrator') {
            return null;
        }

        try {
            $this->process_event($this->prepare_event($customer));
        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event($customer)
    {
        $client_params = \GuzzleHttp\json_encode([Client_Service::prepare_client_params($customer)]);

        $this->process_client_update($client_params, $customer->get_id());

        return \GuzzleHttp\json_encode([
            'time' => Client_Action::get_time(new DateTime()),
            'label' => Client_Action::get_label(self::EVENT_NAME),
            'client' => [
                'custom_id' => $customer->get_id(),
                'uuid' => $this->tracking_manager->manageClientUuid($customer->get_email()),
                'email' => $customer->get_email()
            ]
        ]);
    }
}
