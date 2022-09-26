<?php

namespace Synerise\IntegrationCore\Factory\Api;

use Synerise\DataManagement\Configuration;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;

interface ClientConfigurationFactoryInterface
{
    /**
     * @param array $config
     * @return Configuration
     * @throws ApiConfigurationException
     */
    public function create($config = []): Configuration;
}
