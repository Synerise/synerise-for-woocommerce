<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\User_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Logout
{
	const HOOK_NAME = 'clear_auth_cookie';
	const EVENT_NAME = 'logout';

    /**
     * @var Tracking
     */
    private $tracking_manager;
    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger,
	    Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
    }

    public function send_event()
    {
		$user = wp_get_current_user();
	    $user_id = $user->ID;

	    if($user_id === 0){
		    return;
	    }

        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        if (User_Service::is_user_admin($user_id)) {
            return;
        }

        try {
            $event_client_logged_out_body = \GuzzleHttp\json_encode(
                [
                    'time' => Client_Action::get_time(new \DateTime()),
                    'label' => Client_Action::get_label(self::EVENT_NAME),
                    'client' => [
                        'uuid' => $this->tracking_manager->getClientUuid(),
                        'custom_id' => $user_id
                    ]
                ]
            );

            list($body, $status_code, $headers) = $this->data_management_api_factory->create()->clientLoggedOutWithHttpInfo('4.4', $event_client_logged_out_body);

			return $status_code;
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
