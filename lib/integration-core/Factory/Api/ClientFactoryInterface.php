<?php

namespace Synerise\IntegrationCore\Factory\Api;

use GuzzleHttp\ClientInterface;

interface ClientFactoryInterface
{
    public function create($config = []): ClientInterface;
}
