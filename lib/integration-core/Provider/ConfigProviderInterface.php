<?php

namespace Synerise\IntegrationCore\Provider;

interface ConfigProviderInterface
{
    /**
     * return valid api key string
     *
     * @return string
     */
    public function getApiKey(): string;

	/**
	 * return valid api key string
	 *
	 * @return string
	 */
	public function getHost(): string;


	/**
     * @return string
     */
    public function getCookieDomain(): string;

    /**
     * request logging flag
     *
     * @return boolean
     */
    public function isAdminStore(): bool;

    /**
     * request logging flag
     *
     * @return boolean
     */
    public function isRequestLoggingEnabled(): bool;
}
