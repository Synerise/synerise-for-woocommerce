<?php

namespace Synerise\IntegrationCore;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\IntegrationCore\Exception\InputException;
use Synerise\IntegrationCore\Exception\MergeException;
use Synerise\IntegrationCore\Provider\ConfigProviderInterface;
use Synerise\IntegrationCore\Updater\ClientInterface;

class Tracking
{
    const COOKIE_CLIENT_PARAMS = '_snrs_p';
    const COOKIE_CLIENT_UUID = '_snrs_uuid';
    const COOKIE_CLIENT_UUID_RESET = '_snrs_reset_uuid';

    /**
     * @var CookieManagerInterface
     */
    protected $cookieManager;

    /**
     * @var ConfigProviderInterface
     */
    protected $configProvider;

    /**
     * Client uuid from cookie.
     *
     * @var string
     */
    protected $clientUuid;

    /**
     * Parsed array of _snrs_p params.
     *
     * @var string[]
     */
    protected $cookieParams;

    /**
     * @var ClientInterface
     */
    private $clientUpdater;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        CookieManagerInterface $cookieManager,
        ConfigProviderInterface $configProvider,
        ClientInterface $clientUpdater,
        LoggerInterface $logger
    ) {
        $this->cookieManager = $cookieManager;
        $this->configProvider = $configProvider;
        $this->clientUpdater = $clientUpdater;
        $this->logger = $logger;
    }

    /**
     * Get client uuid from _snrs_uuid cookie.
     *
     * @return string|null
     */
    public function getClientUuid()
    {
        if ($this->isAdminStore()) {
            return null;
        }

        if (!$this->clientUuid) {
            $this->clientUuid = $this->getClientUuidFromCookie();
        }
        return $this->clientUuid;
    }

    public function getClientUuidFromCookie()
    {
        return $this->cookieManager->getCookie(self::COOKIE_CLIENT_UUID);
    }

    /**
     * Get single value form _snrs_p params array.
     *
     * @param string $value
     * @return string|null
     */
    public function getCookieParam(string $value)
    {
        $cookieParams = $this->getCookieParams();
        return $cookieParams[$value] ?? null;
    }

    /**
     * Get parsed array of _snrs_p params.
     *
     * @return string[]
     */
    public function getCookieParams(): array
    {
        if (!$this->cookieParams) {
            $paramsArray = [];
            $items = explode('&', $this->cookieManager->getCookie(self::COOKIE_CLIENT_PARAMS));
            if ($items) {
                foreach ($items as $item) {
                    $values = explode(':', $item);
                    if (isset($values[1])) {
                        $paramsArray[$values[0]] = $values[1];
                    }
                }
                $this->cookieParams = $paramsArray;
            }
        }

        return $this->cookieParams;
    }

    /**
     * @param string $uuid
     * @throws InputException
     */
    public function setResetUuid(string $uuid)
    {
        if (!$uuid) {
            throw new InputException('Uuid can not be empty');
        }

        $cookieMeta = [
            'domain' => $this->configProvider->getCookieDomain(),
            'path' => '/',
            'expires' => time() + 3600 * 24 * 365
        ];

        $this->cookieManager->setCookie(self::COOKIE_CLIENT_UUID_RESET, $uuid, $cookieMeta);

        $this->clientUuid = $uuid;
    }

    /**
     * Verify if current scope is admin.
     *
     * @return bool
     */
    public function isAdminStore()
    {
        return $this->configProvider->isAdminStore();
    }

    /**
     * @param $email
     * @return string|null
     * @throws MergeException
     */
    public function manageClientUuid($email)
    {
        if ($this->isAdminStore()) {
            return null;
        }

        $uuid = $this->getClientUuidFromCookie();

        if(!$uuid) {
            return;
        }

        $emailUuid = Uuid::generateUuidByEmail($email);

        // Email uuid already set
        if ($uuid == $emailUuid) {
            // email uuid already set
            return;
        }

        // reset uuid via cookie
        $this->setResetUuid($emailUuid);

        $identityHash = $this->getCookieParam('identityHash');
        // Client is anonymous or has a different uuid then merge by email
        if ($identityHash || $identityHash != self::hashString($email)) {
            return;
        }

        try{
            $this->clientUpdater->mergeByEmail($email, $emailUuid, $uuid);
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Client update with uuid reset failed', $e));
        }

        return $this->clientUuid;
    }

    protected static function hashString($s)
    {
        $h = 0;
        $len = strlen($s);
        for ($i = 0; $i < $len; $i++) {
            $h = self::overflow32(31 * $h + ord($s[$i]));
        }

        return $h;
    }

    protected static function overflow32($v)
    {
        $v = $v % 4294967296;
        if ($v > 2147483647) {
            return $v - 4294967296;
        } elseif ($v < -2147483648) {
            return $v + 4294967296;
        } else {
            return $v;
        }
    }
}
