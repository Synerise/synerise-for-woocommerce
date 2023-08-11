<?php

namespace Synerise\Integration\Event_Queue;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Event_Service;
use Synerise\Integration\Synerise_For_Woocommerce;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Consumer {

    const ACTION_PROCESS_EVENT_QUEUE = SYNERISE_FOR_WOOCOMMERCE_PREFIX . '-process-event-queue';

    const MAX_RETRIES = 3;

    const RETRY_INTERVAL = 10;

    /**
     * @var Event_Service
     */
    private $event_service;

    public function __construct(Event_Service $event_service)
    {
        $this->event_service = $event_service;
    }

    public function execute() {
        /** @var Item_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-event-queue-item' );

        /** @var Item_Data[] $queue_items */
        $queue_items = $data_store->get_event_queue_items([
            'limit' => Synerise_For_Woocommerce::get_setting('event_tracking_queue_page_size'),
            'retry_interval' => self::RETRY_INTERVAL
        ]);

        if(empty($queue_items)){
            return;
        }

        $processedItems = [];
        foreach ($queue_items as $item) {
            try {
                $this->event_service->send_event($item->get_event_name(), $item->get_payload());
                $processedItems[] = $item;
            } catch (\Exception $e) {
                Synerise_For_Woocommerce::get_logger()->error(Logger_Service::addExceptionToMessage('Failed to process queue item payload: ' . $item->get_payload(), $e));
                $retries = $item->get_retry_count();
                if ($retries < self::MAX_RETRIES) {
                    $item->set_retry_count(++$retries);
                    $item->set_retry_at(current_time('mysql'));
                    $item->save();
                } else {
                    $processedItems[] = $item;
                }
            }
        }

        if (!empty($processedItems)) {
            self::delete_items_from_queue($processedItems);
        }
    }

    public static function create_cron_jobs() {
	    if ( false === as_has_scheduled_action( self::ACTION_PROCESS_EVENT_QUEUE ) ) {
		    as_schedule_cron_action(
			    time(),
			    Synerise_For_Woocommerce::get_setting( 'event_tracking_queue_cron_expression' ),
			    self::ACTION_PROCESS_EVENT_QUEUE,
			    [],
			    SYNERISE_FOR_WOOCOMMERCE_PREFIX
		    );
	    }
    }

	/**
	 * @throws \Exception
	 * @var Item_Data[] $queue_items
	 */
    public static function delete_items_from_queue(array $queue_items)
    {
        $queue_items_ids = array_map(function($e) {
            return is_object($e) ? $e->get_id() : $e['id'];
        }, $queue_items);

        /** @var Item_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-event-queue-item' );
        $data_store->delete_multiple($queue_items_ids);
    }
}
