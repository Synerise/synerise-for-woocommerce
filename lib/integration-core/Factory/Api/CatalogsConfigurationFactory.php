<?php

namespace Synerise\IntegrationCore\Factory\Api;

use Synerise\DataManagement\Configuration;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;
use Synerise\IntegrationCore\Provider\TokenProviderInterface;

class CatalogsConfigurationFactory implements CatalogsConfigurationFactoryInterface
{
    /**
     * @var TokenProviderInterface
     */
    private $tokenProvider;

	/**
	 * @var ConfigProviderInterface
	 */
	private $configProvider;

	public function __construct(
		TokenProviderInterface $tokenProvider,
		ConfigProviderInterface $configProvider
	)
    {
        $this->tokenProvider = $tokenProvider;
        $this->configProvider = $configProvider;
	}

    /**
     * @param array $config
     * @return Configuration
     * @throws ApiConfigurationException
     */
    public function create($config = []): Configuration
    {
		$configuration = Configuration::getDefaultConfiguration();
		$configuration->setAccessToken($this->tokenProvider->getAccessToken());
		$configuration->setHost($this->configProvider->getHost().'/v4');
        return $configuration;
    }
}
