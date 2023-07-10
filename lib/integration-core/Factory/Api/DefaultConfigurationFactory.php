<?php

namespace Synerise\IntegrationCore\Factory\Api;

use Synerise\DataManagement\Configuration;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;
use Synerise\IntegrationCore\Provider\TokenProviderInterface;

class DefaultConfigurationFactory implements ConfigurationFactoryInterface
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
        if (isset($config['is_authorized']) && $config['is_authorized']) {
            $configuration->setAccessToken(null);
        } else {
            $configuration->setAccessToken($this->tokenProvider->getAccessToken());
        }
		$configuration->setHost($this->configProvider->getHost().'/v4');
        return $configuration;
    }
}
