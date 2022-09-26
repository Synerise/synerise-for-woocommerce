<?php
namespace Synerise\Integration;

use Psr\Log\LoggerInterface;
use WC_Logger;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Class responsible for logging stuff
 */
class Logger_Service implements LoggerInterface
{
    /**
     * The single instance of the class.
     *
     * @var WC_Logger
     * @since 1.0.0
     */
    public static $logger;

    public function emergency($message, array $context = array())
    {
        self::getCommonInstance()->emergency($message, $context);
    }
    public function alert($message, array $context = array())
    {
        self::getCommonInstance()->alert($message, $context);
    }

    public function critical($message, array $context = array())
    {
        self::getCommonInstance()->critical($message, $context);
    }

    public function error($message, array $context = array())
    {
        self::getCommonInstance()->error($message, $context);
    }

    public function warning($message, array $context = array())
    {
        self::getCommonInstance()->warning($message, $context);
    }

    public function notice($message, array $context = array())
    {
        self::getCommonInstance()->notice($message, $context);
    }

    public function info($message, array $context = array())
    {
        self::getCommonInstance()->info($message, $context);
    }

    public function debug($message, array $context = array())
    {
        self::getCommonInstance()->debug($message, $context);
    }

    public function log($message, $level = 'debug', array $context = array())
    {
        self::getCommonInstance()->log($level, $message, $context);
    }

    protected static function getCommonInstance()
    {
        if (! self::$logger) {
            self::$logger = wc_get_logger();
        }
        return self::$logger;
    }
}
