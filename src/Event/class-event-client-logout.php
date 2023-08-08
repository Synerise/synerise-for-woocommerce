<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Logout extends Abstract_Event
{
	const HOOK_NAME = 'clear_auth_cookie';
	const EVENT_NAME = 'logout';

    public function execute()
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        if(!$this->tracking_manager->getClientUuid()){
            return;
        }

        try {
            $this->process_event($this->prepare_event());
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event()
    {
        return \GuzzleHttp\json_encode(
            [
                'time' => Client_Action::get_time(new \DateTime()),
                'label' => Client_Action::get_label(self::EVENT_NAME),
                'client' => [
                    'uuid' => $this->tracking_manager->getClientUuid()
                ]
            ]
        );
    }
}
