<?php

namespace Synerise\IntegrationCore\Updater;

use Synerise\DataManagement\ApiException;
use Synerise\DataManagement\Model\CompanyclientsBody;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\ClientManagementApiFactory;

class Client implements ClientInterface
{
    /**
     * @var ClientManagementApiFactory
     */
    protected $clientManagementApiFactory;

    public function __construct(
        ClientManagementApiFactory $clientManagementApiFactory
    ) {
        $this->clientManagementApiFactory = $clientManagementApiFactory;
    }

    /**
     * Send client update request to trigger merge.
     *
     * @param string $email
     * @param string $curUuid
     * @param string $prevUuid
     * @throws ApiException|ApiConfigurationException
     */
    public function mergeByEmail($email, $curUuid, $prevUuid)
    {
        $createAClientInCrmRequestsBody = \GuzzleHttp\json_encode([
            [
                'email' => $email,
                'uuid' => $curUuid
            ],
            [
                'email' => $email,
                'uuid' => $prevUuid
            ]
        ]);

        list($body, $statusCode, $headers) = $this->clientManagementApiFactory->create()
            ->batchAddOrUpdateClientsWithHttpInfo($createAClientInCrmRequestsBody, 'application/json', '4.4');

        if ($statusCode != 202) {
            throw new ApiException(sprintf(
                'Invalid Status [%d]',
                $statusCode
            ));
        }
    }
}
