<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\ClientManagementApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ClientConfigurationFactoryInterface;

class ClientManagementApiFactory
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @var ClientConfigurationFactoryInterface
     */
    private $configurationFactory;

    public function __construct(
        ClientFactoryInterface $clientFactory,
        ClientConfigurationFactoryInterface $configurationFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->configurationFactory = $configurationFactory;
    }

    /**
     * @return ClientManagementApi
     * @throws ApiConfigurationException
     */
    public function create(): ClientManagementApi
    {
        return new ClientManagementApi(
            $this->clientFactory->create(),
            $this->configurationFactory->create()
        );
    }
}
