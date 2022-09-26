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

    public function __construct(
        ConfigProviderInterface $configProvider,
        LoggerInterface $logger = null
    ) {
        $this->configProvider = $configProvider;
        $this->logger = $logger;
    }

    public function create($options = []): ClientInterface
    {
        if ($this->configProvider->isRequestLoggingEnabled() && $this->logger) {
            if (!isset($options['handler'])) {
                $options['handler'] = HandlerStack::create();
            }

            $this->pushLogMiddlewareToHandlerStack($options['handler']);
        }

        return new Client($options);
    }

    protected function pushLogMiddlewareToHandlerStack(HandlerStack $handlerStack)
    {
        $LogMiddleware = new LoggerMiddleware($this->logger, new Handler());
        $handlerStack->push($LogMiddleware, 'logger');
    }
}
