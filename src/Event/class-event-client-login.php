<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Mapper\Client_Action;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Login extends Abstract_Event
{
	const HOOK_NAME = 'wp_login';
	const EVENT_NAME = 'login';

	/**
	 * @throws \Exception
	 */
	public function execute(string $username)
    {
        if (!$this->is_event_enabled()) {
            return null;
        }

        if ( current_user_can( 'manage_options' ) ) {
            return null;
        }

        try {
            $this->process_event($this->prepare_event($username));
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
        }
    }

    public function prepare_event(string $username): string
    {
        $wp_user = \WP_User::get_data_by('login', $username);

        $customer = new \WC_Customer($wp_user->ID);

        $this->tracking_manager->manageClientUuid($wp_user->user_email);

        return \GuzzleHttp\json_encode(
            [
                'time' => Client_Action::get_time(new \DateTime()),
                'label' => Client_Action::get_label(self::EVENT_NAME),
                'client' => [
                    'uuid' => $this->tracking_manager->getClientUuid(),
                    'email' => $wp_user->user_email,
                ],
                'params' => Client_Service::prepare_client_params($customer)
            ]
        );

    }
}
