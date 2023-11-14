<?php

namespace Synerise\Integration\Event;

use Exception;
use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synchronization\Synchronization;

if (!defined('ABSPATH')) {
    exit;
}

class Event_Order_Update
{
    const HOOK_NAME = 'save_post_shop_order';
    const EVENT_NAME = 'order_update';

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * @param int $order_id
     * @return void
     */
    public function execute(int $order_id)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        try {
            Synchronization::add_item_to_queue('order', $order_id);
        } catch (Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Failed to add order to cron queue', $e));
        }
    }
}
