<?php

namespace Synerise\IntegrationCore\Logger;

use Psr\Http\Message\MessageInterface;

class Handler implements \Gmponos\GuzzleLogger\Handler\HandlerInterface
{
    public function log(\Psr\Log\LoggerInterface $logger, $value, array $options = [])
    {
	    if ($value instanceof MessageInterface) {
		    $message = \GuzzleHttp\Psr7\str($value);
		    $message = preg_replace('/(Authorization\: )(Basic |Bearer )(.*)/', '$1$2{TOKEN}', $message);
		    $logger->debug('Guzzle HTTP message ' . $message);
	    }
    }
}
