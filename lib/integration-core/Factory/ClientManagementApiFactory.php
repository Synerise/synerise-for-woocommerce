<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\ClientManagementApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ConfigurationFactoryInterface;

class ClientManagementApiFactory
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @var ConfigurationFactoryInterface
     */
    private $configurationFactory;

    public function __construct(
        ClientFactoryInterface $clientFactory,
        ConfigurationFactoryInterface $configurationFactory
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
