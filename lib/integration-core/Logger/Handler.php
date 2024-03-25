<?php

namespace Synerise\IntegrationCore\Logger;

use GuzzleHttp\Psr7\Message;
use GuzzleHttp\TransferStats;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class Handler implements \GuzzleLogMiddleware\Handler\HandlerInterface
{
    public function log(
        LoggerInterface $logger,
        RequestInterface $request,
        ?ResponseInterface $response = null,
        ?Throwable $exception = null,
        ?TransferStats $stats = null,
        array $options = []
    ): void
    {
        $this->logRequest($logger, $request);
        $this->logResponse($logger, $response);
    }

    private function logRequest(LoggerInterface $logger, RequestInterface $request): void
    {
        $message = Message::toString($request);
        $message = preg_replace('/(Authorization\: )(Basic |Bearer )(.*)/', '$1$2{TOKEN}', $message);
        $logger->debug('Guzzle HTTP request ' . $message);
    }

    private function logResponse(LoggerInterface $logger, ResponseInterface $response): void
    {
        $message = Message::toString($response);
        $logger->debug('Guzzle HTTP responde '. $message);
    }
}
