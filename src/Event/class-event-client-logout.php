<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\IntegrationCore\Uuid;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Logout extends Abstract_Event
{
	const HOOK_NAME = 'wp_logout';
	const EVENT_NAME = 'logout';

    public function execute(int $user_id)
    {
        if (!$this->is_event_enabled()) {
            return;
        }

        try {
            $payload = $this->prepare_event($user_id);
            if(!$payload){
                return;
            }
            $this->process_event($this->prepare_event($user_id));
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event($user_id)
    {
        $uuid = $this->tracking_manager->getClientUuid();
        if(!$uuid){
            $wp_user = \WP_User::get_data_by('id', $user_id);
            if(!$wp_user || $wp_user->ID === 0){
                return null;
            }

            $uuid = Uuid::generateUuidByEmail($wp_user->user_email);
        }

        return \GuzzleHttp\json_encode(
            [
                'time' => Client_Action::get_time(new \DateTime()),
                'label' => Client_Action::get_label(self::EVENT_NAME),
                'client' => [
                    'uuid' => $uuid
                ]
            ]
        );
    }
}
