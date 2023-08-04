<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Client_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Edit extends Abstract_Event
{
	const HOOK_NAME = 'profile_update';
	const EVENT_NAME = 'customer_update';

    public function execute(string $user_id)
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        try {
	        $customer = new \WC_Customer($user_id);

	        $client_params = \GuzzleHttp\json_encode([Client_Service::prepare_client_params($customer)]);
            $this->process_client_update($client_params, $customer->get_id());

        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }
}
