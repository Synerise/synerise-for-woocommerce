<?php

namespace Synerise\IntegrationCore\Factory;

use Synerise\DataManagement\Api\TrackerControllerApi;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Factory\Api\ConfigurationFactoryInterface;
use Synerise\IntegrationCore\Factory\Api\ClientFactoryInterface;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;

class TrackerApiFactory
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
     * @return TrackerControllerApi
     * @throws ApiConfigurationException
     */
    public function create(): TrackerControllerApi
    {

		$configuration = $this->configurationFactory->create();
		$configuration->setHost($this->configProvider->getHost().'/business-profile-service');
        return new TrackerControllerApi(
            $this->clientFactory->create(),
	        $configuration
        );
    }
}
