<?php

namespace Synerise\IntegrationCore\Provider;

use Synerise\DataManagement\Api\AuthorizationApi;
use Synerise\DataManagement\ApiException;
use Synerise\DataManagement\Configuration;
use Synerise\IntegrationCore\Exception\ApiConfigurationException;

class AuthApiTokenProvider implements TokenProviderInterface
{
    /**
     * @var ConfigProviderInterface
     */
    protected $configProvider;

    /**
     * @var string
     */
    protected $token;

    public function __construct(
        ConfigProviderInterface $configProvider
    ) {
        $this->configProvider = $configProvider;
    }

    /**
     * Get access token by api key from config.
     *
     * @return string
     * @throws ApiConfigurationException
     */
    public function getAccessToken()
    {
        if (!$this->token) {
            $configuration = new Configuration();
            $configuration->setHost($this->configProvider->getHost().'/uauth');
            $authApi = new AuthorizationApi(
                null,
                $configuration
            );

            $request = \GuzzleHttp\json_encode([
                'apiKey' => $this->configProvider->getApiKey()
            ]);

            try {
                $tokenResponse = $authApi->profileLoginWithHttpInfo($request);
                $this->token = $tokenResponse[0]->getToken();
            } catch (ApiException $apiException) {
                throw new ApiConfigurationException('Token request failed', 0, $apiException);
            }
        }

        return $this->token;
    }
}
