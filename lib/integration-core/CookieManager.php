<?php

namespace Synerise\IntegrationCore;

class CookieManager implements CookieManagerInterface
{
    public function getCookie($name, $default = null)
    {
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : $default;
    }

    public function setCookie($name, $value, $metadata = []): bool
    {
        return setcookie(
            (string) $name,
            (string) $value,
            $metadata['expires'] ?? 0,
            $metadata['path'] ?? '',
            $metadata['domain'] ?? '',
            $metadata['secure'] ?? false,
            $metadata['httponly'] ?? false
        );
    }
}
