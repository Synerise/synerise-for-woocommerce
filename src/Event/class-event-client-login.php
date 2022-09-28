<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Client_Service;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\User_Service;
use Synerise\Integration\Service\Tracking_Service;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Login
{
	const HOOK_NAME = 'wp_login';
	const EVENT_NAME = 'login';

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

	/**
	 * @throws \Exception
	 */
	public function send_event(string $username)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

		$wp_user = \WP_User::get_data_by('login', $username);

        if (User_Service::is_user_admin($wp_user->ID)) {
            return;
        }

        try {
	        $customer = new \WC_Customer($wp_user->ID);

            $this->tracking_manager->manageClientUuid($wp_user->user_email);

            $event_client_logged_in_body = \GuzzleHttp\json_encode(
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

	        list($body, $status_code, $headers) = $this->data_management_api_factory->create()->clientLoggedInWithHttpInfo('4.4', $event_client_logged_in_body);

			return $status_code;
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
