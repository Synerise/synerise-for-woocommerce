<?php

namespace Synerise\Integration;

use Synerise\IntegrationCore\Provider\ConfigProviderInterface;

class Config_Provider implements ConfigProviderInterface
{

    public function getBasicToken(): string
    {
        return base64_encode("{$this->getApiGuid()}:{$this->getApiKey()}");
    }

    public function getApiGuid(): string
    {
        return (string)Synerise_For_Woocommerce::get_setting('synerise_api_guid');
    }

    public function getApiKey(): string
    {
        return (string)Synerise_For_Woocommerce::get_setting('synerise_api_key');
    }

    public function getHost(): string
    {
        return (string)Synerise_For_Woocommerce::get_setting('synerise_api_host_url');
    }

    public function getCookieDomain(): string
    {
        $cookieDomain = Synerise_For_Woocommerce::get_setting('page_tracking_cookie_domain');
        if (!$cookieDomain) {
            $parsedBasedUrl = parse_url(get_site_url());
            $cookieDomain = isset($parsedBasedUrl['host']) ? '.' . $parsedBasedUrl['host'] : null;
        }

        return $cookieDomain;
    }

    public function isAdminStore(): bool
    {
        return is_admin();
    }

    public function isBasicAuthEnabled(): bool
    {
        return (bool)Synerise_For_Woocommerce::get_setting('basic_auth_enabled');
    }

    public function isRequestLoggingEnabled(): bool
    {
        return (bool)Synerise_For_Woocommerce::get_setting('request_logging_enabled');
    }
}
