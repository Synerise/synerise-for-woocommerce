<?php

namespace Synerise\IntegrationCore\Factory\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use Gmponos\GuzzleLogger\Middleware\LoggerMiddleware;

use Psr\Log\LoggerInterface;
use Synerise\IntegrationCore\Logger\Handler;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;

class ClientFactory implements ClientFactoryInterface
{
    /**
     * @var ConfigProviderInterface
     */
    private $configProvider;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @var bool
     */
    private $isBasicAuthAllowed;

    public function __construct(
        ConfigProviderInterface $configProvider,
        LoggerInterface $logger = null,
        $isBasicAuthAllowed = false
    ) {
        $this->configProvider = $configProvider;
        $this->logger = $logger;
        $this->isBasicAuthAllowed = $isBasicAuthAllowed;
    }

    public function create($options = []): ClientInterface
    {
        if ($this->configProvider->isRequestLoggingEnabled() && $this->logger) {
            if (!isset($options['handler'])) {
                $options['handler'] = HandlerStack::create();
            }

            $this->pushLogMiddlewareToHandlerStack($options['handler']);
        }

        if ($this->isBasicAuthAllowed && $this->configProvider->isBasicAuthEnabled()) {
            $basicToken = $this->configProvider->getBasicToken();
            if (!empty($basicToken)) {
                $options['headers'] = [
                    'Authorization'=> [ "Basic {$basicToken}" ]
                ];
            }
        }

        return new Client($options);
    }

    protected function pushLogMiddlewareToHandlerStack(HandlerStack $handlerStack)
    {
        $LogMiddleware = new LoggerMiddleware($this->logger, new Handler());
        $handlerStack->push($LogMiddleware, 'logger');
    }
}
