<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\EventsApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\ConfigurationFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;

class DataManagementApiFactory
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
     * @return EventsApi
     * @throws ApiConfigurationException
     */
    public function create(): EventsApi
    {
        $client = $this->clientFactory->create();
        $config = $client->getConfig();
        $isAuthorised = isset($config['headers']['Authorization']);

        return new EventsApi(
            $client,
            $this->configurationFactory->create(['is_authorized' => $isAuthorised])
        );
    }
}
