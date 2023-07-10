<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\CatalogsApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\ConfigurationFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;

class DataManagementCatalogsApiFactory
{
    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * @var ConfigurationFactoryInterface
     */
    private $configurationFactory;

	/**
	 * @var ConfigProviderInterface
	 */
	private $configProvider;

    public function __construct(
        ClientFactoryInterface        $clientFactory,
        ConfigurationFactoryInterface $configurationFactory,
        ConfigProviderInterface       $configProvider
    ) {
        $this->clientFactory = $clientFactory;
        $this->configurationFactory = $configurationFactory;
		$this->configProvider = $configProvider;
    }

    /**
     * @return CatalogsApi
     * @throws ApiConfigurationException
     */
    public function create(): CatalogsApi
    {
        $configuration = $this->configurationFactory->create();
        $configuration->setHost($this->configProvider->getHost().'/catalogs');

        return new CatalogsApi(
            $this->clientFactory->create(),
            $configuration
        );
    }
}
