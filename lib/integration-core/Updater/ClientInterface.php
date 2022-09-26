<?php

namespace Synerise\IntegrationCore\Updater;

interface ClientInterface
{
    public function mergeByEmail($email, $curUuid, $prevUuid);
}
