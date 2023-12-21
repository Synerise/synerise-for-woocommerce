<?php

namespace Synerise\Integration;

use Exception;
use Psr\Log\LoggerInterface;
use WC_Logger;

if (!defined('ABSPATH')) {
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

    public static function addExceptionToMessage($message, Exception $e): string
    {
        $message .= "\nException code: " . $e->getCode();
        $message .= "\nException message: " . $e->getMessage();
        $message .= "\nException file: " . $e->getFile();
        $message .= "\nException trace: " . $e->getTraceAsString();

        return $message;
    }

    public static function addAttributesToMessage($message, array $attributes): string
    {
        foreach ($attributes as $key => $value) {
            $message .= "\n" . $key . ": " . json_encode($value);
        }

        return $message;
    }

    public function emergency($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->emergency($message, $context);
    }

    protected static function getCommonInstance()
    {
        if (!self::$logger) {
            self::$logger = wc_get_logger();
        }
        return self::$logger;
    }

    public function alert($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->alert($message, $context);
    }

    public function critical($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->critical($message, $context);
    }

    public function error($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->error($message, $context);
    }

    public function warning($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->warning($message, $context);
    }

    public function notice($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->notice($message, $context);
    }

    public function info($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->info($message, $context);
    }

    public function debug($message, array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->debug($message, $context);
    }

    public function log($message, $level = 'debug', array $context = array('source' => 'synerise'))
    {
        self::getCommonInstance()->log($level, $message, $context);
    }
}
