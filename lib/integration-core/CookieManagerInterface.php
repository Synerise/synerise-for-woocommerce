<?php

namespace Synerise\IntegrationCore;

interface CookieManagerInterface
{
    public function getCookie($name, $default = null);

    public function setCookie($name, $value, $metadata = []): bool;
}
