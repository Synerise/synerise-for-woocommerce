<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\DataManagement\ApiException;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Client_Service;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;
use Synerise\IntegrationCore\Tracking;
use Synerise\IntegrationCore\Uuid;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Client_Edit
{
	const HOOK_NAME = 'profile_update';
	const EVENT_NAME = 'customer_update';

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
        ClientManagementApiFactory $client_management_api_factory
    ) {
        $this->logger = $logger;
        $this->client_management_api_factory = $client_management_api_factory;
    }

    public function send_event(string $user_id)
    {
        try {
	        $customer = new \WC_Customer($user_id);

	        $client_params = \GuzzleHttp\json_encode([Client_Service::prepare_client_params($customer)]);

	        list($body, $statusCode, $headers) =
		        $this->client_management_api_factory->create()
			         ->batchAddOrUpdateClientsWithHttpInfo($client_params,'application/json', '4.4');

	        if ($statusCode != 202) {
		        throw new ApiException(
			        sprintf('Invalid Status [%d]', $statusCode),
			        $statusCode,
			        $headers,
			        $body
		        );
	        }
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
