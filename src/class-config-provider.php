<?php

namespace Synerise\Integration;

use Synerise\IntegrationCore\Provider\ConfigProviderInterface;
use Synerise\IntegrationCore\Provider\TokenProviderInterface;

class Config_Provider implements ConfigProviderInterface
{

    public function getApiKey(): string
    {
        return (string) Synerise_For_Woocommerce::get_setting('synerise_api_key');
    }

	public function getHost(): string {
		return (string) Synerise_For_Woocommerce::get_setting('synerise_api_host_url');
	}

	public function getCookieDomain(): string
    {
        $cookieDomain = Synerise_For_Woocommerce::get_setting('page_tracking_cookie_domain');
        if(!$cookieDomain) {
            $parsedBasedUrl = parse_url(get_site_url());
            $cookieDomain = isset($parsedBasedUrl['host']) ? '.'.$parsedBasedUrl['host'] : null;
        }

        return $cookieDomain;
    }

    public function isAdminStore(): bool
    {
        return is_admin();
    }

    public function isRequestLoggingEnabled(): bool
    {
        return (bool) Synerise_For_Woocommerce::get_setting('request_logging_enabled');
    }
}
