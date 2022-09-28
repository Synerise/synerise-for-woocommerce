<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Mapper\Client_Action;
use Synerise\Integration\Service\Client_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Service\User_Service;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Register
{
	const HOOK_NAME = 'user_register';
	const EVENT_NAME = 'register';

    /**
     * @var Tracking
     */
    private $tracking_manager;
    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;
	/**
	 * @var ClientManagementApiFactory
	 */
	private $client_management_api_factory;
    /**
     * @var LoggerInterface
     */
    private $logger;

	public function __construct(
        LoggerInterface $logger,
        Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory,
	    ClientManagementApiFactory $client_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
		$this->client_management_api_factory = $client_management_api_factory;
    }

    public function send_event(int $user_id)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        if (User_Service::is_user_admin($user_id)) {
            return;
        }

	    /**
	     * @var \WP_User|null $user_data
	     */
		$user_data = \WP_User::get_data_by('id', $user_id);

        try {
	        $customer = new \WC_Customer($user_id);
	        $client_params = \GuzzleHttp\json_encode(Client_Service::prepare_client_params($customer));

	        list($body, $status_code, $headers) = $this->client_management_api_factory->create()->createAClientInCrmWithHttpInfo($client_params, '4.4');

	        $event_client_registered = \GuzzleHttp\json_encode([
		        'time' => Client_Action::get_time(new \DateTime()),
		        'label' => Client_Action::get_label(self::EVENT_NAME),
		        'client' => [
			        'uuid' => $this->tracking_manager->manageClientUuid($customer->get_email()),
			        'email' => $customer->get_email()
		        ]
	        ]);

	        $this->data_management_api_factory->create()->clientRegisteredWithHttpInfo('4.4', $event_client_registered);

	        return $status_code;
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
