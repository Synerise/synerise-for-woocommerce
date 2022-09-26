<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\EventsApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\CatalogsConfigurationFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;

class DataManagementApiFactory
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @var CatalogsConfigurationFactoryInterface
     */
    private $configurationFactory;

    public function __construct(
        ClientFactoryInterface $clientFactory,
        CatalogsConfigurationFactoryInterface $configurationFactory
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
        return new EventsApi(
            $this->clientFactory->create(),
            $this->configurationFactory->create()
        );
    }
}
