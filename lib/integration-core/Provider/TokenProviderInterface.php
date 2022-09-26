<?php

namespace Synerise\IntegrationCore\Provider;

use Synerise\IntegrationCore\Exception\ApiConfigurationException;

interface TokenProviderInterface
{
    /**
     * Get access token by api key from config.
     *
     * @return string
     * @throws ApiConfigurationException
     */
    public function getAccessToken();
}
